<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaUser
{
	/**
	 * Ist Client eingeloggt?
	 * @return boolean
	 */
	public static function isLogin()
	{
		if(isset($_SESSION['userId']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Erstelle Session für Client
	 * @param integer $userId
	 * @return boolean
	 */
	public function loginUser($userId)
	{
		$db					= impeesaDB::getConnection();
		
		$db->exec("UPDATE ".MYSQL_PREFIX."user SET
					phpSession = '".session_id()."'
					WHERE id = '".$userId."'");
		
		$_SESSION['userId']	= $userId;
		return true;
	}
	
	/**
	 * Zerstöre Session von Client
	 * @return boolean
	 */
	public function logoutUser()
	{
		$db		= impeesaDB::getConnection();
		
		$db->exec("UPDATE ".MYSQL_PREFIX."user SET
					phpSession = '0'
					WHERE id = '".$_SESSION['userId']."'");
		session_unset();
		unset($_SESSION['userId']);
		return true;
	}
	
	public static function getRole($userId)
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->prepare("SELECT role
							FROM ".MYSQL_PREFIX."user
							WHERE id = :userId");
		$result->bindParam(':userId', $userId);
		$result->execute();
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		return $row['role'];
	}
}