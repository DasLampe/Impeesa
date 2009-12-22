<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(PATH_CORE_CLASS."user.class.php");

class rights extends user
{
	protected function isAdmin($userId)
	{
		$db		= impeesaDb::getConnection();
		if($db->fetchOne("SELECT admin FROM ".MYSQL_PREFIX."user WHERE id = ?", array($userId)) > '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function pageview($pageId)
	{
		$db		= impeesaDb::getConnection();
		$userId	= $this->getUserId();		
		$return	= false;

		$pageId	= $this->inheritPageRights($pageId);
		
		if($this->isAdmin($userId) === true)
		{
			$return = true;
		}
		else
		{
			foreach($this->getUserGroups($userId) as $groupId)
			{
				if($db->fetchOne("SELECT right_read FROM ".MYSQL_PREFIX."page_rights WHERE groupid = ? AND pageId = ?", array($groupId[@groupid],$pageId)) == 1)
				{
					$return	= true;
				}
			}
		}
		
		return $return;
	}
	
	private function inheritPageRights($pageId)
	{
		$db		= impeesaDb::getConnection();
		
		if((impeesaHelper::getTopPage($pageId) !== false) && ($db->fetchOne("SELECT inherit_rights FROM ".MYSQL_PREFIX."page_config WHERE id = ?", array($pageId)) == '1'))
		{
			$pageId		= impeesaHelper::getTopPage($pageId);
			$pageId		= $this->inheritPageRights($pageId);
		}
				
		return $pageId;

	}
}