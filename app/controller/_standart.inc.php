<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
$tpl->vars("LINK_MAIN",			LINK_MAIN);
$tpl->vars("LINK_ACP",			LINK_ACP);
$tpl->addJs("jquery.min",		"lib-js-",1);
$tpl->addJs("jquery.ui.min",	"lib-js-",1);
$tpl->addJs("jquery.autoResize",	"lib-js-");
$tpl->addJs("main",		"",1);
$tpl->addCss("main.color.css");
$tpl->addCss("main.position.css");
$tpl->addCss("main.autoContent.css");
$tpl->addCss("main.img.css");
$tpl->addCss("main.else.css");
$tpl->addCss("jquery.ui.css");
$tpl->vars("pageContent", $this->getPage());
$tpl->vars("submenu",		"");

if(impeesaHelper::isLogin() === true)
{
	$tpl->vars("logInOut",	"Logout");
}
else
{
	$tpl->vars("logInOut",	"Login");
}