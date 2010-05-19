<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaUserInfo implements IExtension
{
	public function getContent($contentId)
	{
		
	}
	
	/**
	 * Rückgabe des Usernamen
	 * @param int $userId
	 * @return string
	 */
	public function getUsername($userId)
	{
		$db		= impeesaDb::getConnection();
		
		$result	= $db->query("SELECT username
							FROM ".MYSQL_PREFIX."user
							WHERE id = '".$userId."'");
		$row	= $result->fetch(PDO::FETCH_NUM);
		return $row[0];
	}
}