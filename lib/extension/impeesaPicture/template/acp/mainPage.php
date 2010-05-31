<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<h1>Bilder Verwaltung</h1>
<noscript>
Leider kann dieses Tool nur mit Javascript benutzt werden!
</noscript>

<div class="no-js-hide">
<form id="galerieForm">
	<select>
		<option value="">Bitte eine Galerie Auswählen</option>
		{galerieOption}
	</select>
	<a href="" style="display:none;" name="uploadLink">Bilder Upload</a>
	&nbsp;|&nbsp;
	<a href="" style="display:none;" name="delDir">Ordner löschen</a>
	<input type="hidden" name="uploadUrl" value="{LINK_SITE}/" />
	<br/>
	<strong>ODER</strong>
	<br/>
	Neue Galerie erstellen:
	<br/>
	<label for="newDir">Bezeichnung</label>
	<input type="text" name="newDir" value="" />
	<br/>
	<label for="newDirYear">Jahr (4 Stellig)</label>
	<input type="text" name="newDirYear" value="" maxlength="4" />
	<br/>
	<input type="submit" name="submit" value="Erstellen" />
</form>

<div id="galerie"></div>
</div>