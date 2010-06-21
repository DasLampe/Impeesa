<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(impeesaHelper::dirUp(1, dirname(__FILE__))."impeesaAppHelper.class.php");

class ajaxAcpController
{
	private $siteId;
	
	public function __construct($siteName)
	{
		$tpl			= impeesaTemplate::getInstance();
		$menu			= new impeesaMenu();
		
		//Standartvariablen laden (Template)
		$tpl->vars("LINK_MAIN",	LINK_MAIN);
		/*$tpl->addJs("jquery_min",1, "lib-js-");
		$tpl->addJs("jquery.ui.min", 1, "lib-js-");
		$tpl->addJs("main.ajax",1);*/
		$tpl->addCss("main.color.css");
		$tpl->addCss("main.position.css");
		$tpl->addCss("main.img.css");
		$tpl->addCss("main.autoContent.css");
		
		$this->siteId		= impeesaHelper::getSiteId($siteName);

		$tpl->vars("pageContent", $this->getPage());
		
		$tpl->load("ajaxLayout");
	}
	
	private function getPage()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$pageElemente	= $this->getPageElements();
		$content		= "";
		foreach($pageElemente as $pageElement)
		{
			$content	.= $this->getElement($pageElement[0]);	
		}
				
		$tpl->vars("content",	$content);
		return $tpl->load("_content", 0);
		
	}
	
	private function getPageElements()
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->query("SELECT id
								FROM ".MYSQL_PREFIX."pageElements
								WHERE pageid = '".$this->siteId."'
								ORDER BY position DESC");
		$row	= $result->fetchAll(PDO::FETCH_NUM);
		
		return $row;
	}
	
	private function getElement($elementId)
	{
		$db		= impeesaDB::getConnection();
		
		$result			= $db->query("SELECT contenttype
									FROM ".MYSQL_PREFIX."pageElements
									WHERE id = '".$elementId."'");
		$row			= $result->fetch(PDO::FETCH_ASSOC);
				
		$result	= $db->query("SELECT extensionPath
								FROM ".MYSQL_PREFIX."contenttype
								WHERE id = '".$row['contenttype']."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		$extensionClass	= impeesaAppHelper::getExtensionClass($row['extensionPath']);
		
		$extensionFile	= PATH_EXTENSION.$row['extensionPath'].$extensionClass.'.class.php';
				
		if(file_exists($extensionFile))
		{		
			include_once($extensionFile);
			$contentClass	= new $extensionClass();
			if(method_exists($contentClass, "ajaxRequest"))
			{
				return $contentClass->ajaxRequest();
			}
			else
			{
				return impeesaException::error('no_method');
			}
		}
		else
		{
			return false;
		}
	}
}