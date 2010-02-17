<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaContentText
{
	function getContent($contentId)
	{
		$db			= impeesaDB::getConnection();
		$tpl		= impeesaTemplate::getInstance();
		
		$result		= $db->query("SELECT headline, content
								FROM ".MYSQL_PREFIX."contentText
								WHERE id = '".$contentId."'");
		$row		= $result->fetch(PDO::FETCH_ASSOC);
		
		$tpl->vars("headline",			$row['headline']);
		$tpl->vars("contentBlock",		$row['content']);

		return $tpl->load("_defaultPage", 0);
	}
}