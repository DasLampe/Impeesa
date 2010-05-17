<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(PATH_CORE_UTIL."IExtension.class.php");

class impeesaMenuListMenu implements IExtension
{
	public function drawExtension($pageId, $contentId)
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->addCss("extension/impeesaMenu/css/menu.css");
		
		
		$menu_links		= '';
		foreach($this->getLinks($contentId) as $links)
		{
			$tpl->vars("menu_link",		$links['uri']);
			$tpl->vars("menu_title",	$links['menuTitle']);
			$menu_links	.= $tpl->load("_li", 0, PATH_EXTENSION.'impeesaMenu/template/');
		}

		$tpl->vars("links", $menu_links);
		$menu	= $tpl->load("menu", 0, PATH_EXTENSION.'impeesaMenu/template/');
		
		return $menu;
	}
	
	private function getLinks($topPage)
	{
		$db		= impeesaDb::getConnection();		
		
		return $db->fetchAll("SELECT menuTitle, uri FROM ".MYSQL_PREFIX."page_config WHERE toppage = ? AND enabled = ? AND visibleMenu = ? ORDER BY position", array($topPage, 1,1));
	}
}