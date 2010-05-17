<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class user
{
	public function getUserID()
	{
		if(!empty($_SESSION['userId']))
		{
			return $_SESSION['userId'];
		}
		else
		{
			return 1;
		}
	}
	
	public function getUserGroups($userId)
	{
		$db		= impeesaDb::getConnection();
		
		return $db->fetchAll("SELECT groupid FROM ".MYSQL_PREFIX."group_affiliation WHERE userId = ?", array($userId));
	}
	
	public function getUserIdByName($username)
	{
		$db		= ImpeesaDb::getConnection();
		
		$userId	= $db->fetchOne("SELECT id FROM ".MYSQL_PREFIX."user WHERE username = ?", array($username));
			
		if(empty($userId))
		{
			return false;
		}
		else
		{
			return $userId;
		}
	}
	
	/**
	 * Holt MD5 String aus DB (Achtung keine UserId Prüfung)
	 * @param $userId
	 * @return string
	 */
	public function getPassword($userId)
	{
		$db		= ImpeesaDb::getConnection();
				
		return $db->fetchOne("SELECT password FROM ".MYSQL_PREFIX."user WHERE id = ?", array($userId));
	}
}