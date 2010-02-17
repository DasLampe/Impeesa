<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class pageController
{
	private $siteName;
	private $siteId;
	
	function __construct($sitename)
	{
		$tpl			= impeesaTemplate::getInstance();
		
		$this->siteName	= $sitename;
		$this->siteId	= impeesaHelper::getSiteId($sitename);

		if($this->pageEnable() === false)
		{
			$tpl->vars("pageContent", "Error404");
		}
		else
		{
			$tpl->vars("pageContent", $this->getPage());
		}
		
		$tpl->addCss("main.color.css");
		$tpl->addCss("main.position.css");
		$tpl->addCss("main.img.css");
		
		$tpl->vars("LINK_MAIN",	LINK_MAIN);
		$tpl->vars("css",		$this->getCSS());
		$tpl->vars("js",		$this->getJS());
		$tpl->load("layout");
	}
	
	private function getPage()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$pageElemente	= $this->getPageElements();
		$content		= "";
		for($x=0;$x<count($pageElemente);$x++)
		{
			$content	.= $this->getElement($pageElemente[$x][0]);	
		}
				
		$tpl->vars("content",	$content);
		return $tpl->load("content", 0);
		
	}
	
	
	private function getPageElements()
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->query("SELECT id
								FROM ".MYSQL_PREFIX."page_elements
								WHERE pageid = '".$this->siteId."'
								ORDER BY position DESC");
		$row	= $result->fetchAll(PDO::FETCH_NUM);
		
		return $row;
	}
	
	private function getElement($elementId)
	{
		$db		= impeesaDB::getConnection();
		
		$result			= $db->query("SELECT contenttype, contentid
									FROM ".MYSQL_PREFIX."page_elements
									WHERE id = '".$elementId."'");
		$row			= $result->fetch(PDO::FETCH_ASSOC);
		$contentId		= $row['contentid'];
				
		$result	= $db->query("SELECT extensionClass, extensionPath
								FROM ".MYSQL_PREFIX."contenttype
								WHERE id = '".$row['contenttype']."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		$extensionFile	= PATH_EXTENSION.$row['extensionPath'].$row['extensionClass'].'.class.php';
				
		if(file_exists($extensionFile))
		{		
			include_once($extensionFile);
			$contentClass	= new $row['extensionClass']();
			
			return $contentClass->getContent($contentId);
		}
		else
		{
			return false;
		}
	}
	
	private function pageEnable()
	{
		$db		= impeesaDB::getConnection();
		$result	= $db->query("SELECT enabled FROM ".MYSQL_PREFIX."page_config WHERE id = '".$this->siteId."'");
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
	
	private function getCss()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$css	= "";
		for($x=0; $x<count($tpl->css);$x++)
		{
			$tpl->vars("css_file", $tpl->css[$x]);
			$css	.=	$tpl->load("_css", 0);
		}
		/*while($cssFile	= $tpl->css)
		{
			$tpl->vars("css_file", $cssFile);
			$css	.= $tpl->load("_css", 0);
		}*/
		
		return $css;
	}
	
	private function getJS()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$js		= "";
		while($jsFile	= $tpl->js)
		{
			$tpl->vars("js_file",	$ksFile);
			$js	.= $tpl->load("_js", 0);
		}
		
		return $js;
	}
}