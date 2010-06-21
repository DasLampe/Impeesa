<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(impeesaHelper::dirUp(1, dirname(__FILE__))."impeesaNews.class.php");

class impeesaNewsSpecify extends impeesaNews
{
	public function getContent()
	{
		global $param;
		if(isset($param[2]) && is_numeric($param[2]))
		{
			return $this->getNews($param[2]);
		}
		elseif(isset($param[2]) && preg_match("/[1-2][0-9]{3}-[0-1][0-9]-[0-3][0-9]-[a-z0-9-]+$/i", $param[2], $treffer))
		{
			return $this->getNews($this->getIdByPermaLink($param[2]));
		}
		else
		{
			return impeesaException::error("wrong_url");
		}
	}
	
	/**
	 * Returns a Single News
	 * @param int $newsId
	 * @return template text/html
	 */
	private function getNews($newsId)
	{
		$newsId	= (int)$newsId;
		$tpl	= impeesaTemplate::getInstance();
		$db		= ImpeesaDb::getConnection();
		
		$result	= $db->query("SELECT headline,content
							FROM ".MYSQL_PREFIX."news
							WHERE id = '".$newsId."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		if(empty($row))
		{
			return impeesaException::error("wrong_id");
		}
		
		
		$tpl->vars("tags",	$this->getTags($newsId));
		$tpl->vars("headline",	$row['headline']);
		$tpl->vars("content",	$row['content']);
		
		return $tpl->load("newsSpecify", 0, impeesaHelper::dirup(1, dirname(__FILE__))."/template/");
	}
	
	private function getIdByPermaLink($permaLink)
	{
		$db			= ImpeesaDb::getConnection();
		
		$permaLink	= explode("-", $permaLink, 4);
		$timestap	= mktime(0,0,0,$permaLink[1],$permaLink[2],$permaLink[0]);
		
		$result		= $db->prepare("SELECT id
								FROM ".MYSQL_PREFIX."news
								WHERE startDate = :timestap
									AND permaLink	= :permaLink");
		$result->bindParam(":timestap",		$timestap);
		$result->bindParam(":permaLink",	$permaLink[3]);
		$result->execute();
		$row		= $result->fetch(PDO::FETCH_ASSOC);
		
		return $row['id'];
	}
}