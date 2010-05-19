<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(dirname(__FILE__)."/impeesaUser.class.php");

class impeesaUserRights extends impeesaUser
{
	/**
	 * Hat User Recht für diese Aktion
	 * @param integer $userId
	 * @param integer $pageId
	 * @param integer $action (1=lesen;2=schreiben;3=editieren/löschen)
	 * @return boolean
	 */
	public static function hasRights($userId, $pageId, $action="1")
	{
		$db		= impeesaDb::getConnection();
		
		$roleId	= impeesaUser::getRole($userId);
		
		$result	= $db->prepare("SELECT rights
								FROM ".MYSQL_PREFIX."pageRights
								WHERE roleId	= :roleId
									AND pageId	= :pageId");
		$result->bindParam(':roleId',	$roleId);
		$result->bindParam(':pageId',	$pageId);
		$result->execute();
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		if(($row['rights'] & (2 << $action)) == (2 << $action))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}