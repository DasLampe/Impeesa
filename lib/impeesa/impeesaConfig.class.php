<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaConfig
{
	function get($key)
	{
		$db		= impeesaDB::getConnection();
		$result	= $db->query("SELECT config_value FROM ".MYSQL_PREFIX."config WHERE config_key = '".$key."'");
		$row	= $result->fetch(PDO::FETCH_NUM);
		
		return $row[0];		
	}
}