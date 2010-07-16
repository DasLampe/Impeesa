<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<h2>Passwort ändern</h2>
{if}{error} != ""{/if}
<p class="error">
{error}
</p>
{/endif}
<form action="{LINK_SITE}/pass" method="post">
<fieldset>
<label for="passOld">Altes Passwort *</label>
<input type="password" name="passOld" /><br/>

<label for="passNew1">Neues Passwort *</label>
<input type="password" name="passNew1" /><br/>

<label for="passNew2">Neues Passwort *</label>
<input type="password" name="passNew2" />
(Passwort wiederholen)<br/>
</fieldset>

<input type="submit" name="submit" value="Ändern" />
</form>