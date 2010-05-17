<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(impeesaHelper::dirUp(1, dirname(__FILE__))."impeesaAppHelper.class.php");

class pageController
{
	private $siteName;
	private $siteId;
	
	public function __construct($sitename)
	{
		$tpl			= impeesaTemplate::getInstance();
		$menu			= new impeesaMenu();
		
		//Standart Variablen laden (Template)
		require_once(dirname(__FILE__)."/_standart.inc.php");
		
		$this->siteId	= impeesaHelper::getSiteId($sitename);

		if(impeesaAppHelper::pageEnable($this->siteId) === false)
		{
			$tpl->vars("pageContent", "Error404");
		}
		else
		{
			$tpl->vars("pageContent", $this->getPage());
		}
		
		$tpl->vars("pageTitle",	impeesaApphelper::getPageTitle($this->siteId));
		$tpl->vars("naviLeft",	$menu->getNavi(0));
		$tpl->vars("submenu",	$menu->getSubMenu($this->siteId));
		$tpl->vars("css",		impeesaAppHelper::getCSS());
		$tpl->vars("js",		impeesaAppHelper::getJS());
		$tpl->load("layout");
	}
	
	/**
	 * Setze Contentelemente in Template
	 * @return string/Template
	 */
	protected function getPage()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$pageElemente	= $this->getPageElements();
		$content		= "";
		for($x=0;$x<count($pageElemente);$x++)
		{
			$content	.= $this->getElement($pageElemente[$x][0]);	
		}
				
		$tpl->vars("content",	$content);
		return $tpl->load("_content", 0);
		
	}
	
	/**
	 * ID der Content Elemente
	 * @return array (int)
	 */
	protected function getPageElements()
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->query("SELECT id
								FROM ".MYSQL_PREFIX."pageElements
								WHERE pageid = '".$this->siteId."'
								ORDER BY position DESC");
		$row	= $result->fetchAll(PDO::FETCH_NUM);
		
		return $row;
	}
	
	/**
	 * Liefert Content Elemente (Blöcke)
	 * @param int $elementId
	 * @return string/Template
	 */
	protected function getElement($elementId)
	{
		$db		= impeesaDB::getConnection();
		
		$result			= $db->query("SELECT contenttype, contentid
									FROM ".MYSQL_PREFIX."pageElements
									WHERE id = '".$elementId."'");
		$row			= $result->fetch(PDO::FETCH_ASSOC);
		$contentId		= $row['contentid'];
				
		$result	= $db->query("SELECT extensionPath
								FROM ".MYSQL_PREFIX."contenttype
								WHERE id = '".$row['contenttype']."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		//ExtensionClass ermitteln
		$extensionClass	= impeesaAppHelper::getExtensionClass($row['extensionPath']);
		
		
		$extensionFile	= PATH_EXTENSION.$row['extensionPath'].$extensionClass.'.class.php';
				
		if(file_exists($extensionFile))
		{		
			include_once($extensionFile);
			$contentClass	= new $extensionClass();
			
			return $contentClass->getContent($contentId);
		}
		else
		{
			return false;
		}
	}
}