<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class ImpeesaUser
{
	private	$userId;
	public	$guestId;
	private	$isLogin = false;
	
	public function __construct($userId = "")
	{
		//Id von Gast Account ermitteln
		$db		= ImpeesaDb::getConnection();
		$this->guestId		= $db->fetchOne("SELECT id FROM ".MYSQL_PREFIX."user WHERE password = ''"); 
		
		if(empty($userId) && isset($_SESSION['userId']) && !empty($_SESSION['userId']))
		{
			$this->userId	= $_SESSION['userId'];
			$this->isLogin	= true;
		}
		elseif(!empty($userId) && $this->existUserId($userId) === true)
		{
			$this->userId	= $userId;
		}
		else
		{
			$this->userId	= $this->guestId;
		}
	}
	
	/**
	 * Existiert die UserId in der Datenbank?
	 * @param integer $userId
	 * @return boolean
	 */
	public function existUserId($userId)
	{
		$db		= ImpeesaDb::getConnection();
		$row	= $db->fetchOne("SELECT username FROM ".MYSQL_PREFIX."user WHERE id = ?", array($userId));
		
		if(empty($row))
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}
	
	/**
	 * Ist Username in DB vorhanden
	 * @param string $username
	 * @return boolean
	 */
	public function existUsername($username)
	{
		$db		= ImpeesaDb::getConnection();
		$row	= $db->fetchOne("SELECT id FROM ".MYSQL_PREFIX."user WHERE username LIKE ?", array($username));
		
		if(empty($row))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
	/**
	 * Rückgabe der UserId
	 * @return integer
	 */
	public function getUserId()
	{
		return $this->userId;
	}
	
	/**
	 * UserId von Username
	 * @param string $username
	 * @return integer
	 */
	public function getUserIdByName($username)
	{
		if($this->existUsername($username) === true)
		{
			$db		= ImpeesaDb::getConnection();
			return $db->fetchOne("SELECT id FROM ".MYSQL_PREFIX."user WHERE username = ?", array($username));
		}
		else
		{
			return $this->guestId;
		}
	}
	
	/**
	 * Gruppen zu denen User gehört
	 * @return array (integer)
	 */
	public function getUserGroups()
	{
		$db		= impeesaDb::getConnection();
		
		return $db->fetchAll("SELECT groupid FROM ".MYSQL_PREFIX."group_affiliation WHERE userId = ?", array($this->userId));
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
	
	
	public function isLogin()
	{
		return $this->isLogin;
	}
}