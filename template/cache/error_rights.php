<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<h1>Fehler - Rechte</h1>
<p>
Die Seite kann nicht angezeigt werden, nötige Rechte sind nicht vorhanden!
</p>

<div id="loginForm">
<div id="loginError">
	
</div>
<form action="http://impeesa//intern/login" method="post">
<label for="username">Benutzername:</label>
<input type="text" name="username" value="" /><br/>

<label for="password">Passwort:</label>
<input type="password" name="password" value="" /><br/>

<input type="hidden" name="route" value="/intern/news/add" />

<input type="submit" name="submit" value="Login" />
</form>
</div>