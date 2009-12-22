<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(PATH_CORE_UTIL."IExtension.class.php");

class impeesaNews implements IExtension
{
	private $newsTags;
	
	public function __construct()
	{
		include_once("admin/lib/newsTags.class.php");
		$this->newsTags	= new newsTags();	
	}
	
	public function drawExtension($pageId, $contentid)
	{
		$tpl		= impeesaTemplate::getInstance();
		
		$tpl->vars("newsBoxes", $this->getNews());
		
		return $tpl->load("listNews", 0, PATH_EXTENSION."impeesaNews/template/");
	}
	
	private function getNews()
	{
		$tpl		= impeesaTemplate::getInstance();
		$db			= ImpeesaDb::getConnection();
		$newsBoxes	= "";
		
		//print_r($db->fetchAssoc("SELECT id, newsHeadline, newsContent FROM ".MYSQL_PREFIX."news_content WHERE endDate = 0 OR endDate >= '".time()."'"));
		$row	= $db->fetchAll("SELECT id, newsHeadline, newsContent FROM ".MYSQL_PREFIX."news_content WHERE endDate = 0 OR endDate >= '".time()."'");
		for($x=0;$x<count($row);$x++)
		{
			$tpl->vars("newsHeadline",	$row[$x]['newsHeadline']);
			$tpl->vars("newsContent",	$row[$x]['newsContent']);
			$tpl->vars("newsTags",		$this->newsTags->getTagsByNewsId($row[$x]['id']));
			
			$newsBoxes	.= $tpl->load("_newsBox", 0, PATH_EXTENSION."impeesaNews/template/");
		}
		
		return $newsBoxes;
	}
}