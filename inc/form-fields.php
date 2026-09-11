<?php
/**
 * Hidden anti-spam fields for the public forms.
 * Usage inside a <form>:
 *     <?php $ck_form_type = 'contact'; require __DIR__ . '/inc/form-fields.php'; ?>
 */
require_once __DIR__ . '/lib.php';

$ck_form_type = in_array($ck_form_type ?? '', ['instructor', 'demo'], true) ? $ck_form_type : 'contact';
$ck_ts  = time();
$ck_tok = hash_hmac('sha256', $ck_form_type . '|' . $ck_ts, ck_config()['app_key']);
?>
<input type="hidden" name="form_type" value="<?= $ck_form_type ?>">
<input type="hidden" name="ts" value="<?= $ck_ts ?>">
<input type="hidden" name="tok" value="<?= $ck_tok ?>">
<div aria-hidden="true" style="position:absolute;left:-9999px;top:-9999px;height:0;width:0;overflow:hidden">
  <label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
</div>
