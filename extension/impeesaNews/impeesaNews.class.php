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
		
		$tpl->addJs("template/default/js/ui/ui.dialog.js");
		$tpl->addJs("template/default/js/ui/ui.draggable.js");
		$tpl->vars("newsBoxes", $this->getNews());
		
		return $tpl->load("listNews", 0, PATH_EXTENSION."impeesaNews/template/");
	}
	
	private function getNews()
	{
		$db			= ImpeesaDb::getConnection();
		$newsBoxes	= "";
		
		//print_r($db->fetchAssoc("SELECT id, newsHeadline, newsContent FROM ".MYSQL_PREFIX."news_content WHERE endDate = 0 OR endDate >= '".time()."'"));
		$row	= $db->fetchAll("SELECT id, newsHeadline, newsContent FROM ".MYSQL_PREFIX."news_content WHERE endDate = ? OR endDate >= ?", array(0, time()));
		for($x=0;$x<count($row);$x++)
		{
			$newsBoxes	.= $this->getNewsTpl($row[$x]);
		}
		
		return $newsBoxes;
	}
	
	/**
	 * Schreib News in _newsBox (Template)
	 * @param array $row
	 * @return string (Template)
	 */
	private function getNewsTpl($row)
	{
		$user		= new ImpeesaUser();
		$tpl		= impeesaTemplate::getInstance();
		
		$tpl->vars("newsEditLink",		LINK_MAIN."intern/news/edit/");
		$tpl->vars("newsId",			$row['id']);
		$tpl->vars("editUserRights",	$user->isLogin());
		$tpl->vars("newsHeadline",		$row['newsHeadline']);
		$tpl->vars("newsContent",		$row['newsContent']);
		$tpl->vars("newsTags",			$this->newsTags->getTagsByNewsId($row['id']));
		
		return $tpl->load("_newsBox", 0, PATH_EXTENSION."impeesaNews/template/");
	}
}