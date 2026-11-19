<?php
/**
 * Call status shared by the Form Submissions and Walk-in Inquiries tabs.
 * Stored inside form_submissions.extra_json as call_status / call_at / call_by (no schema change).
 * Needs admin/inc/bootstrap.php (csrf, is_role, admin_log) and admin/inc/stats.php (fmt_ist) loaded first.
 */

// slug => label. The slug is what gets stored.
$CALL = [
    'initial'       => 'Initial call done',
    'followup'      => 'Follow-up done',
    'waiting'       => 'Waiting for response',
    'noreceive'     => 'Not receiving call',
    'notuseful'     => 'Not useful',
    'notinterested' => 'Not interested anymore',
];
$canEdit = !is_role('viewer');

/** Handles POST action=call_status (AJAX, JSON reply) and exits; does nothing for any other request. */
function ck_call_handle(PDO $db, array $CALL, bool $canEdit): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' || ($_POST['action'] ?? '') !== 'call_status') return;
    header('Content-Type: application/json');
    csrf_verify();
    $fail = function (int $code, string $msg) { http_response_code($code); echo json_encode(['ok' => false, 'message' => $msg]); exit; };
    if (!$canEdit) $fail(403, 'Read-only account.');
    $id = (int) ($_POST['id'] ?? 0);
    $slug = (string) ($_POST['call_status'] ?? '');
    if ($slug !== '' && !isset($CALL[$slug])) $fail(422, 'Unknown status.');
    $s = $db->prepare('SELECT extra_json FROM form_submissions WHERE id=?');
    $s->execute([$id]);
    $row = $s->fetch();
    if (!$row) $fail(404, 'Not found.');
    $x = json_decode((string) $row['extra_json'], true) ?: [];
    if ($slug === '') {
        unset($x['call_status'], $x['call_at'], $x['call_by']);
    } else {
        $x['call_status'] = $slug;
        $x['call_at'] = date('Y-m-d H:i:s');
        $x['call_by'] = (string) ($_SESSION['uname'] ?? '');
    }
    $db->prepare('UPDATE form_submissions SET extra_json=? WHERE id=?')->execute([json_encode($x, JSON_UNESCAPED_UNICODE), $id]);
    admin_log('call_status', "#$id -> " . ($slug ?: 'not called'));
    echo json_encode(['ok' => true, 'slug' => $slug, 'at' => $slug ? fmt_ist($x['call_at']) : '', 'by' => $x['call_by'] ?? '']);
    exit;
}

/** Adds the list filter for ?call=none|<slug> to a WHERE/args pair. */
function ck_call_where(string $call, array $CALL, array &$w, array &$args): void
{
    if ($call === 'none') {
        $w[] = "JSON_EXTRACT(extra_json,'$.call_status') IS NULL";
    } elseif (isset($CALL[$call])) {
        $w[] = "JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.call_status'))=?";
        $args[] = $call;
    }
}

/** The coloured dropdown for one row. */
function ck_call_select(array $CALL, ?string $current, int $id, bool $canEdit, string $label = 'Call status', string $extraClass = ''): string
{
    $cur = isset($CALL[(string) $current]) ? $current : '';
    $o = '<option value="">Not called yet</option>';
    foreach ($CALL as $k => $l) $o .= '<option value="' . $k . '"' . ($cur === $k ? ' selected' : '') . '>' . h($l) . '</option>';
    return '<select class="cs cs-' . ($cur ?: 'none') . ($extraClass ? ' ' . $extraClass : '') . '" data-id="' . $id . '" aria-label="' . h($label) . '"' . ($canEdit ? '' : ' disabled') . '>' . $o . '</select>';
}

/** Raw CSS rules for the dropdown (so a page can drop them inside its own <style>). */
function ck_call_css_rules(): string
{
    return <<<'CSS'
  .cs{-webkit-appearance:none;appearance:none;border:1.5px solid;border-radius:999px;padding:6px 30px 6px 13px;font:inherit;font-size:12.5px;font-weight:700;cursor:pointer;max-width:200px;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat:no-repeat;background-position:right 11px center;transition:box-shadow .2s}
  .cs:disabled{opacity:.7;cursor:default}
  .cs-saved{box-shadow:0 0 0 3px rgba(34,197,94,.45)}
  .cs-lg{font-size:14.5px;padding:10px 38px 10px 16px;max-width:none;width:100%}
  .cs-none{background-color:#f1f5f9;color:#475569;border-color:#cbd5e1}
  .cs-initial{background-color:#dbeafe;color:#1d4ed8;border-color:#93c5fd}
  .cs-followup{background-color:#e0e7ff;color:#4338ca;border-color:#a5b4fc}
  .cs-waiting{background-color:#fef3c7;color:#b45309;border-color:#fcd34d}
  .cs-noreceive{background-color:#ffedd5;color:#c2410c;border-color:#fdba74}
  .cs-notuseful{background-color:#e5e7eb;color:#374151;border-color:#d1d5db}
  .cs-notinterested{background-color:#fee2e2;color:#b91c1c;border-color:#fca5a5}

CSS;
}

/** <style> + <script> that make every select.cs on the page save instantly. */
function ck_call_assets(): string
{
    $tok = json_encode(csrf_token());
    return '<style>' . ck_call_css_rules() . '.cs-meta{margin-top:8px;font-size:12.5px;color:#64748b}</style>' . <<<JS
<script>
(function(){
  var TOKEN=$tok;
  function paint(s,slug){s.className=s.className.replace(/cs-(none|initial|followup|waiting|noreceive|notuseful|notinterested)/,'cs-'+(slug||'none'));}
  [].forEach.call(document.querySelectorAll('select.cs'),function(sel){sel.addEventListener('change',function(){
    var slug=sel.value,fd=new FormData();paint(sel,slug);
    fd.append('_csrf',TOKEN);fd.append('action','call_status');fd.append('id',sel.getAttribute('data-id'));fd.append('call_status',slug);
    sel.disabled=true;
    fetch(location.pathname,{method:'POST',headers:{Accept:'application/json'},body:fd}).then(function(r){return r.json()}).then(function(j){
      if(!j.ok)throw 0;sel.disabled=false;sel.classList.add('cs-saved');setTimeout(function(){sel.classList.remove('cs-saved')},1200);
      var meta=document.getElementById('csMeta');if(meta)meta.textContent=slug&&j.at?'Updated '+j.at+(j.by?' by '+j.by:''):'';
    }).catch(function(){sel.disabled=false;alert('Could not save the call status. Please reload the page and try again.');});
  })});
})();
</script>
JS;
}
