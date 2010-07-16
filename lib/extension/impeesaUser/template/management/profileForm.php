<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<h2>Profil Verwalten</h2>
{if}{error} != ""{/if}
<p class="error">
{error}
</p>
{/endif}
<form action="{LINK_SITE}/" method="post">
<fieldset>
	<legend>Persönliche Informationen</legend>
	
	<label for="firstname">Vorname *</label>
	<input type="text" name="firstname" value="{firstname}" /><br/>
	
	<label for="name">Nachname *</label>
	<input type="text" name="name" value="{name}" /><br/>
</fieldset>

<fieldset>
	<legend>Kontakt Info</legend>
	
	<label for="email">E-Mail Adressse *</label>
	<input type="text" name="email" value="{email}" /><br/>
	
	<label for="tele">Telefon</label>
	<input type="text" name="tele" value="{tele}" /><br/>
</fieldset>

<input type="submit" name="submit" value="Ändern" />
</form>