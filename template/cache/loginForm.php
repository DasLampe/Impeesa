<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<div id="loginForm">
<div id="loginError">
	
</div>
<form action="http://impeesa//intern/login" method="post">
<label for="username">Benutzername:</label>
<input type="text" name="username" value="" /><br/>

<label for="password">Passwort:</label>
<input type="password" name="password" value="" /><br/>

<input type="hidden" name="route" value="/intern/home" />

<input type="submit" name="submit" value="Login" />
</form>
</div>