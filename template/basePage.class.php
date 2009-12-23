<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
abstract class BasePage
{
	protected $pageId;
	
	public function __construct($pageId)
	{
		$this->pageId	= $pageId;
	}
	
	public function handle()
	{
		$tpl		= impeesaTemplate::getInstance();
		
		$tpl->vars("LINK_MAIN",		LINK_MAIN);
		
		$tpl->vars("body", $this->drawBody());
		$tpl->vars("head", $this->drawHead());
		$tpl->vars("foot", $this->drawFoot());
		//$tpl->vars("piwik", $this->piwik());
		$tpl->vars("pageEnd", $this->pageEnd());
		$tpl->load("_construct");
	}
	
	protected function drawHead()
	{
		
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->addCss("template/default/css/style.css");
		$tpl->addCSS("template/default/css/form.css");
		$tpl->addCss("template/default/css/jquery-ui.css");
		$tpl->addJs("template/default/js/jquery.js",1);
		$tpl->addJs("template/default/js/jquery-ui.js",1);
		$tpl->addJs("template/default/js/ui/ui.core.js",1);
		$tpl->vars("title", $this->getTitle());
		$tpl->vars("meta",	$this->getMeta());
		$tpl->vars("css",	$this->getCss());
		$tpl->vars("js",	$this->getJs());
						
		return $tpl->load("head", 0);
	}
	
	protected function drawBody()
	{
		$tpl	= impeesaTemplate::getInstance();
		$user	= new impeesaUser();
		
		$tpl->vars("header", "Header");
		$tpl->vars("menu", $this->menu());		
		$tpl->vars("content", $this->content());
				
		return $tpl->load("body",0);
	}
	
	protected function drawFoot()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		return $tpl->load("foot",0);
	}
	
	protected function pageEnd()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		return $tpl->load("_pageEnd", 0);
	}
	
	abstract protected function content();
	
	protected function menu()
	{
		include_once(PATH_EXTENSION."impeesaMenu/listMenu/impeesaMenuListMenu.class.php");
		$menu	= new impeesaMenuListMenu();
		
		return $menu->drawExtension($this->pageId, impeesaHelper::getTopPage($this->pageId, 1));
	}
	
	protected function getMeta()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->vars("meta_lang",			siteConfig::get("meta_lang"));
		$tpl->vars("meta_description",	siteConfig::get("meta_description"));
		$tpl->vars("meta_keywords",		siteConfig::get("meta_keywords"));
		$tpl->vars("meta_robots",		siteConfig::get("meta_robots"));
		$tpl->vars("meta_charset",		siteConfig::get("meta_charset"));
		$tpl->vars("meta_contenttype",	siteConfig::get("meta_contenttype"));
		
		return $tpl->load("_head_meta", 0);
	}
	
	protected function getTitle()
	{
		$db		= impeesaDb::getConnection();
		
		$title	= siteConfig::get("title");

		$pageTitle	= $db->fetchOne("SELECT pageTitle FROM ".MYSQL_PREFIX."page_config WHERE id = ?", array($this->pageId));
		if(!empty($pageTitle))
		{
			$title	.= " - ".$pageTitle;
		}
		
		return $title;
	}
	
	protected function getCSS()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$css	= "";
		foreach($tpl->css as $css_file)
		{
			$tpl->vars("css_file", $css_file);
			$css .= $tpl->load("_head_css", 0);
		}
		return $css;
	}
	
	protected function getJs()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		if(!empty($tpl->js))
		{
			array_multisort($tpl->js, SORT_ASC);			
			$js		= "";
			foreach($tpl->js as $js_file)
			{
				$tpl->vars("js_file", $js_file['file']);
				$js	.= $tpl->load("head/_js", 0);
			}
			return $js;
		}
	}
}