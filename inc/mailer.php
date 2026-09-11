<?php
/**
 * Minimal dependency-free mailer.
 *   - If SMTP is configured in Settings, sends via SMTP (STARTTLS / SSL / plain).
 *   - Otherwise falls back to PHP mail().
 * Returns true on success, false on failure. Never throws to the caller.
 */

require_once __DIR__ . '/lib.php';

function ck_send_mail(string $to, string $subject, string $body): bool
{
    $host = trim((string) ck_setting('smtp_host'));
    $from = trim((string) ck_setting('smtp_from')) ?: ('no-reply@' . ($_SERVER['SERVER_NAME'] ?? 'localhost'));
    $fromName = trim((string) ck_setting('smtp_from_name')) ?: 'Codeksha Website';

    $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    $headers = [
        'From: ' . ck_enc_name($fromName) . " <{$from}>",
        'Reply-To: ' . $from,
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
        'X-Mailer: Codeksha',
    ];

    if ($host === '') {
        return @mail($to, $subject, $body, implode("\r\n", $headers));
    }

    try {
        return ck_smtp_send($host, $to, $from, $subject, $body, $headers);
    } catch (\Throwable $e) {
        error_log('[ck-smtp] ' . $e->getMessage());
        return false;
    }
}

function ck_enc_name(string $n): string
{
    return preg_match('/[^\x20-\x7e]/', $n) ? '=?UTF-8?B?' . base64_encode($n) . '?=' : $n;
}

function ck_smtp_send(string $host, string $to, string $from, string $subject, string $body, array $headers): bool
{
    $port   = (int) (ck_setting('smtp_port') ?: 587);
    $secure = strtolower((string) ck_setting('smtp_secure'));   // tls | ssl | none
    $user   = (string) ck_setting('smtp_user');
    $pass   = (string) ck_setting('smtp_pass');

    $transport = $secure === 'ssl' ? "ssl://{$host}:{$port}" : "{$host}:{$port}";
    $fp = @stream_socket_client($transport, $errno, $errstr, 10,
        STREAM_CLIENT_CONNECT, stream_context_create(['ssl' => ['verify_peer' => true, 'verify_peer_name' => true]]));
    if (!$fp) throw new RuntimeException("connect failed: $errstr ($errno)");
    stream_set_timeout($fp, 10);

    $read = function () use ($fp) {
        $data = '';
        while ($line = fgets($fp, 512)) {
            $data .= $line;
            if (isset($line[3]) && $line[3] === ' ') break;
        }
        return $data;
    };
    $cmd = function (string $c, array $ok) use ($fp, $read) {
        fwrite($fp, $c . "\r\n");
        $r = $read();
        if (!in_array((int) substr($r, 0, 3), $ok, true)) {
            throw new RuntimeException("SMTP: '$c' -> $r");
        }
        return $r;
    };

    $read(); // greeting
    $ehlo = 'EHLO ' . ($_SERVER['SERVER_NAME'] ?? 'localhost');
    $cmd($ehlo, [250]);

    if ($secure === 'tls') {
        $cmd('STARTTLS', [220]);
        if (!stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            throw new RuntimeException('TLS negotiation failed');
        }
        $cmd($ehlo, [250]);
    }

    if ($user !== '') {
        $cmd('AUTH LOGIN', [334]);
        $cmd(base64_encode($user), [334]);
        $cmd(base64_encode($pass), [235]);
    }

    $cmd("MAIL FROM:<{$from}>", [250]);
    $cmd("RCPT TO:<{$to}>", [250, 251]);
    $cmd('DATA', [354]);

    $data = "To: {$to}\r\nSubject: {$subject}\r\n" . implode("\r\n", $headers) . "\r\n\r\n"
        . preg_replace('/^\./m', '..', str_replace("\r\n", "\n", $body));
    $data = str_replace("\n", "\r\n", $data);
    fwrite($fp, $data . "\r\n.\r\n");
    $r = $read();
    $cmd('QUIT', [221, 250]);
    fclose($fp);

    return (int) substr($r, 0, 3) === 250;
}
