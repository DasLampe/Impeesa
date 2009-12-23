<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class newsTags {
	/**
	 * Zähle Tags hoch, wenn nicht vorhanden füge hinzu
	 * @param string $tags
	 * @return boolean
	 */
	public function countUpTags($tags, $newsId)
	{
		$tags	= explode(",", $tags);
		
		foreach($tags as $tag)
		{
			if($this->existTag($tag) === true)
			{
				$this->countUpTag($tag, $newsId);
			}
			else
			{
				$this->addTag($tag);
				$this->countUpTag($tag, $newsId);
			}
		}
	}
	
	/**
	 * Tags hochzählen
	 * @param string $tag
	 * @return boolean
	 */
	private function countUpTag($tag, $newsId)
	{
		$db		= impeesaDB::getConnection();
		$data	= array(
						'count'	=> $db->fetchOne("SELECT count FROM ".MYSQL_PREFIX."news_tags WHERE tag LIKE '$tag'") + 1
						);
		
		$db->update(MYSQL_PREFIX.'news_tags', $data, "tag LIKE '$tag'");
		
		$data	= array(
						'tagId'		=> $db->fetchOne("SELECT id FROM ".MYSQL_PREFIX."news_tags WHERE tag LIKE '$tag'"),
						'newsId'	=> $newsId
						);
		$db->insert(MYSQL_PREFIX.'news_tags_affiliation', $data);
	}
	
	/**
	 * Füge Tag zu DB hinzu wenn nicht vorhanden
	 * @param string $tag
	 * @return boolean
	 */
	public function addTag($tag)
	{
		if($this->existTag($tag) === true)
		{
			return true;
		}
		else
		{
			$db		= impeesaDB::getConnection();
			$data	= array(
							'tag'	=> $tag,
							'count'	=> '0'
							);
			if($db->insert(MYSQL_PREFIX."news_tags", $data))
			{
				return true;
			}
			else
			{
				return false;
			}			
		}
	}
	
	/**
	 * Existert der Tag schon?
	 * @param string $tag
	 * @return boolean
	 */
	private function existTag($tag)
	{
		$db		= ImpeesaDb::getConnection();
		
		$row	= $db->fetchRow("SELECT id FROM ".MYSQL_PREFIX."news_tags WHERE tag LIKE ?", $tag);
		
		if($row !== false)
		{
			return true;						
		}
		else
		{
			return false;
		}
	}
	
	public function getTagsByNewsId($newsId)
	{
		$db		= impeesaDB::getConnection();
		$row	= $db->fetchAll("SELECT tagId FROM ".MYSQL_PREFIX."news_tags_affiliation WHERE newsId = ?", $newsId);
		$tag	= "";
		
		if($row)
		{
			for($x=0;$x<count($row);$x++)
			{
				if(!empty($tag))
				{
					$tag	.= ", ";
				}
				$tag	.= $db->fetchOne("SELECT tag FROM ".MYSQL_PREFIX."news_tags WHERE id = '".$row[$x]['tagId']."'");
			}
		}
		
		if(empty($tag))
		{
			$tag	= "Keine";
		}
		return $tag; 
	}
}