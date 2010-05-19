<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaMenu
{
	public static function getNavi($adminPage=0, $controller="content")
	{
		$db		= ImpeesaDb::getConnection();
		$tpl	= ImpeesaTemplate::getInstance();
		
		$result	= $db->query("SELECT siteName, menuTitle
							FROM ".MYSQL_PREFIX."pageConfig
							WHERE enabled = '1'
								AND isAdminPage = '".$adminPage."'
								AND visibleMenu = '1'
								AND topPage		= '0'
							ORDER BY position ASC");
		
		$menu		= "";
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$tpl->vars("LINK_MENU", $controller.'/'.$row['siteName']);
			$tpl->vars("menuTitle",	$row['menuTitle']);
			$menu	.= $tpl->load("_naviLink", 0);
		}
		
		return $menu;
	}
	
	public function getSubMenu($siteId)
	{
		$db		= ImpeesaDb::getConnection();
		$tpl	= impeesaTemplate::getInstance();
		
		$result	= $db->query("SELECT siteName, menuTitle
							FROM ".MYSQL_PREFIX."pageConfig
							WHERE enabled 		= '1'
								AND topPage		= '".$siteId."'
								AND visibleMenu	= '1'
							ORDER BY position ASC");
		$menu		= "";
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$tpl->vars("LINK_MENU", "content/".$row['siteName']);
			$tpl->vars("menuTitle",	$row['menuTitle']);
			$menu	.= $tpl->load("_subMenuLink", 0);
		}
		
		return $menu;
	}
}