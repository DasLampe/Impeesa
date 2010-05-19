<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaNews
{
	/**
	 * Get All Tags for News Entry
	 * @param int $newsId
	 * @return (multi-)string
	 */
	protected function getTags($newsId)
	{
		$db			= ImpeesaDb::getConnection();
		$tpl		= impeesaTemplate::getInstance();
		
		$result		= $db->query("SELECT tagId
								FROM ".MYSQL_PREFIX."newsTagAffiliation
								WHERE newsId = '".$newsId."'");

		$tags		= array();
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$tpl->vars("tagName",	$this->getTagName($row['tagId']));
			$tpl->vars("tagId",		$row['tagId']);
			
			$tags[]	= $tpl->load("_tags", 0, dirname(__FILE__)."/template/");
		}
		
		$tags		= implode(",", $tags);
		
		return $tags;
	}
	
	/**
	 * Gets Tag Name from DB
	 * @param int $tagId
	 * @return string
	 */
	protected function getTagName($tagId)
	{
		$db		= ImpeesaDb::getConnection();
		
		$result	= $db->query("SELECT name
								FROM ".MYSQL_PREFIX."newsTags
								WHERE id = '".$tagId."'");
		$row		= $result->fetch(PDO::FETCH_ASSOC);
		
		return $row['name'];
	}
	
	/**
	 * Liste der Statuse ausgeben
	 * @param integer $newsStatus
	 * @return string (Template)
	 */
	protected function newsStatus($newsStatus="")
	{
		require_once(dirname(__FILE__)."/lib/_status.php");
		$tpl	= impeesaTemplate::getInstance();
				
		if(empty($newsStatus))
		{
			$newsStatus	= 2;
		}

		$option	= "";
		for($x=1;$x<=count($status);$x++)
		{
			$tpl->vars('optionValue',		$x);
			$tpl->vars('optionValueText',	$status[$x]);
			if($newsStatus == $x)
			{
				$tpl->vars('selected',		"selected");
			}
			else
			{
				$tpl->vars('selected',			"");
			}
			
			$option	.= $tpl->load("_selectOption", 0);
		}
		
		return $option;
	}
}