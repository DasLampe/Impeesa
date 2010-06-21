<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaContentText
{
	function getContent()
	{
		global $param;
		$db			= impeesaDB::getConnection();
		$tpl		= impeesaTemplate::getInstance();
		
		$result		= $db->prepare("SELECT content
								FROM ".MYSQL_PREFIX."contentText
								WHERE pageId = :pageId");
		$result->bindParam(":pageId",	impeesaHelper::getSiteId($param[1]));
		$result->execute();
		
		$row		= $result->fetch(PDO::FETCH_ASSOC);
		
		$tpl->vars("content",		$row['content']);

		return $tpl->load("_content", 0);
	}
}