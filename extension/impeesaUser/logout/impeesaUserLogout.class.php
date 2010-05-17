<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(PATH_CORE_UTIL."IExtension.class.php");

class impeesaUserLogout implements IExtension
{
	public function drawExtension($pageId, $contentid)
	{
		$tpl		= impeesaTemplate::getInstance();
		
		session_destroy();
		
		return $tpl->load("logoutSuccess", 0, PATH_EXTENSION."impeesaUser/template/");
	}
}