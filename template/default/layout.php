<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<html>
<head>
<title>Impeesa! - {pageTitle}</title>
{css}
{js}
</head>
<body>
<div id="dialog" style="display:none;"></div>
<div id="dialog-action" style="display:none;"></div>
<div id="hp">
	<div id="header">
		<div id="header_left"></div>
		<div id="header_right"></div>
	</div>
	<div id="navi_left">
		<ul id="menuLeft">
			{naviLeft}
		</ul>
	</div>
	<div id="content">
		{if}{submenu} != ""{/if}
		<ul id="subMenu">
			{submenu}
		</ul>
		{/endif}
		{pageContent}
	</div>
	<div id="footer">
		&copy; <a href="http://andreflemming.de" class="no_dec">André Flemming</a> | <a href="{LINK_MAIN}content/login/">{logInOut}</a> | <a href="{LINK_MAIN}acp/">Adminbereich</a>
	</div>
</div>
</body>
</html>