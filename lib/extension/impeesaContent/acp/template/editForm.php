<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<form action="{LINK_SITE}" method="post">
<fieldset>
	<legend>Namensgebung</legend>
	
	<label for="siteName">Internername *</label>
	<input type="text" name="siteName" value="{siteName}" />
	(Änderung nicht empfohlen!)<br/>
	
	<label for="pageTitle">Titel</label>
	<input type="text" name="pageTitle" value="{pageTitle}" /><br/>
	
	<label for="menuTitle">Anzeigename (Menü)</label>
	<input type="text" name="menuTitle" value="{menuTitle}" /><br/>
</fieldset>

<fieldset>
	<legend>Status</legend>
	
	<label for="enabled">Seite aktiv</label>
	<input type="checkbox" name="enabled" value="1" {enabled} /><br/>
	
	<label for="visibleMenu">Anzeige in Menü</label>
	<input type="checkbox" name="visibleMenu" value="1" {visibleMenu} /><br/>
	
	<label for="position">Menüposition</label>
	<input type="text" name="menuPosition" value="{menuPosition}" /><br/>
	
	<label for="topPage">Elternseite</label>
	<select name="topPage">{topPage}</select><br/>
</fieldset>

<fieldset>
	<legend>Module</legend>
	{selectModule}
</fieldset>

<fieldset>
	<legend>Inhalt</legend>
	
	Achtung! Dieser Bereich wird nur auf der Webseite angezeigt wenn ein "Content"-Modul aktiv ist!
	<textarea rows="15" cols="90" name="content" id="wysiwyg">{content}</textarea><br/>
</fieldset>

<input type="submit" value="Ändern" name="submit" />
</form>