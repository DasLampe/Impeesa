<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaAppHelper
{
	/**
	 * Ist die Seite verfügbar
	 * @param int $siteId
	 * @return bool
	 */
	public static function pageEnable($siteId)
	{
		$db		= impeesaDB::getConnection();
		$result	= $db->query("SELECT enabled FROM ".MYSQL_PREFIX."pageConfig WHERE id = '".$siteId."'");
		$row	= $result->fetch(PDO::FETCH_NUM);
		
		if($row[0] == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Extension Klasse aus Pfad lesen
	 * @param string $extensionPath
	 * @return string
	 */
	public static function getExtensionClass($extensionPath)
	{
		$extensionClassArray	= explode("/", $extensionPath);
		
		for($x=1;$x<count($extensionClassArray)-1;$x++)
		{
			$extensionClassArray[$x]	= ucfirst($extensionClassArray[$x]);
		}
		
		$extensionClasses		= "";
		foreach($extensionClassArray as $extensionClass)
		{
			$extensionClasses	.= $extensionClass;
		}
		
		return $extensionClasses;
	}
	
	/**
	 * Liefert CSS-Links
	 * @return string/Template
	 */
	public static function getCss()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$css	= "";
		foreach($tpl->css as $cssFile)
		{
			$tpl->vars("css_file", $cssFile);
			$css	.=	$tpl->load("_css", 0);
		}
		
		return $css;
	}
	
	/**
	 * Liefert JS-Links
	 * @return string/Template
	 */
	public static function getJS()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$js		= "";
		foreach($tpl->js as $jsFile)
		{
			$tpl->vars("js_file", $jsFile['file'].".js");
			$js		.= $tpl->load("_js", 0);
		}
		return $js;
	}
	
	/**
	 * Titel der aktuellen Seite
	 * @param int $siteId
	 * @return string
	 */
	public static function getPageTitle($siteId)
	{
		$db		= ImpeesaDb::getConnection();
		
		$result	= $db->query("SELECT pageTitle
							FROM ".MYSQL_PREFIX."pageConfig
							WHERE id = '".$siteId."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		return $row['pageTitle'];
	}
	
	public static function isAdminPage($siteId)
	{
		$db		= impeesaDb::getConnection();
		
		$result	= $db->query("SELECT isAdminPage
							FROM ".MYSQL_PREFIX."pageConfig
							WHERE id = '".$siteId."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		if($row['isAdminPage'] == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}