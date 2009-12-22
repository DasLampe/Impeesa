<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class siteConfig
{
	public function get($key)
	{
		$db 	= impeesaDb::getConnection();
		
		$row	= $db->fetchOne("SELECT config_value FROM ".MYSQL_PREFIX."config WHERE config_key = ?", $key);		
		return $row;
	}
}