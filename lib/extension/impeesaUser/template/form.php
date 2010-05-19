<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
{if}{errorMsg} != ""{/if}
	<div class="error">
	<p>{errorMsg}</p>
	</div>
{/endif}
<form id="loginForm" action="{LINK_MAIN}/content/login" method="post">
<label for="username">Benutzername</label>
<input type="text" name="username" value="{username}" /><br/>
<label for="password">Passwort</label>
<input type="password" name="password" /><br/>
<input type="submit" name="submit" value="Login" />
</form>