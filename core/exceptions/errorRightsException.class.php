<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(PATH_EXTENSION."impeesaUser/login/impeesaUserLogin.class.php");

class errorRightsException extends Exception
{
	public function getContent()
	{
		$tpl	= impeesaTemplate::getInstance();
		$login	= new impeesaUserLogin();
		
		$tpl->vars("LINK_MAIN", LINK_MAIN);
		$tpl->vars("LoginForm", $login->drawExtension(0,-1));
		return $tpl->load("error/rights", 0);
	}
}