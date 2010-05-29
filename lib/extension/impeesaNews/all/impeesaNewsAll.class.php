<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(impeesaHelper::dirUp(1, dirname(__FILE__))."impeesaNews.class.php");

class impeesaNewsAll extends impeesaNews
{
	public function getContent($tagId=0)
	{
		global $param;
		
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->addCss("news.img.css", "lib-extension-impeesaNews-template-css-");
		$tpl->addCss("news.color.css", "lib-extension-impeesaNews-template-css-");
		$tpl->addCss("news.position.css", "lib-extension-impeesaNews-template-css-");
		
		if(!isset($param[2]) || !is_numeric($param[2]) || $param[2]==0)
		{
			return $this->getAllNews();
		}
		else
		{
			return $this->getNewsByTag($param[2]);
		}
	}
	
	private function getNewsByTag($tagId)
	{
		$db			= ImpeesaDb::getConnection();
		
		$result		= $db->prepare("SELECT newsId
								FROM ".MYSQL_PREFIX."newsTagAffiliation
								JOIN ".MYSQL_PREFIX."news
								WHERE ".MYSQL_PREFIX."newsTagAffiliation.tagId = :tagId
								ORDER BY ".MYSQL_PREFIX."news.startDate DESC, ".MYSQL_PREFIX."news.id DESC");
		$result->bindParam(":tagId",		$tagId);
		$result->execute();
		
		$news		= "";
		
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$news	.= $this->getNews($row['newsId']);
		}
		
		if(empty($news))
		{
			return impeesaException::error("no_news");
		}

		return $news;
		
	}
	
	private function getAllNews()
	{
		$db			= ImpeesaDb::getConnection();

		$result		= $db->query("SELECT id
								FROM ".MYSQL_PREFIX."news
								WHERE endDate > '".time()."'
									OR endDate = 0
								ORDER BY startDate DESC, id DESC");
		$news		= ""; 
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$news	.= $this->getNews($row['id']);
		}
		return $news;
	}
	
	private function getNews($newsId)
	{
		$db		= ImpeesaDb::getConnection();
		$tpl	= impeesaTemplate::getInstance();
		
		$result	= $db->query("SELECT id, headline, content, startDate, permaLink
							FROM ".MYSQL_PREFIX."news
							WHERE (endDate > '".time()."'
								OR endDate = 0)
								AND id = '".$newsId."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		if(!empty($row))
		{
			$permaLink		= date('Y', $row['startDate']).'-'.date('m', $row['startDate']).'-'.date('d', $row['startDate']).'-'.$row['permaLink'];
			$tpl->vars("newsId",	$row['id']);
			$tpl->vars("permaLink",	$permaLink);
			$tpl->vars("headline",	$row['headline']);
			$tpl->vars("content",	$row['content']);
			$tpl->vars("startDate", date("d.m.Y", $row['startDate']));
			$tpl->vars("tags",		$this->getTags($newsId));
		
			return $tpl->load("_newsBlock", 0, impeesaHelper::dirUp(1, dirname(__FILE__))."/template/");
		}
	}
}
?>