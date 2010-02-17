<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaHelper
{
	function existSite($sitename)
	{
		$db		= impeesaDB::getConnection();
		$result	= $db->query("SELECT id FROM ".MYSQL_PREFIX."page_config WHERE siteName = '".$sitename."'");
		$row	= $result->fetch(PDO::FETCH_NUM);
		
		if(empty($row))
		{
			return false;
		}
		return true;
	}
	
	function getSiteId($sitename)
	{
		$db		= impeesaDB::getConnection();
		$result	= $db->query("SELECT id FROM ".MYSQL_PREFIX."page_config WHERE siteName = '".$sitename."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		return $row['id'];
	}
}