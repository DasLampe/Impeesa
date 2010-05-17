<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaHelper
{
	/**
	 * Aus URI PageId ziehen
	 * @param string $request_uri
	 * @return int
	 */
	public function getPageId($request_uri)
	{
		$db			= impeesaDb::getConnection();
		
		$uri		= explode("/", $request_uri);
		$uri_exist	= "";
		
		for($x=1;$x<count($uri);$x++)
		{
			$row	= $db->fetchOne("SELECT id FROM ".MYSQL_PREFIX."page_config WHERE uri = ?", array($uri_exist."/".$uri[$x]));
			
					
			if(empty($row))
			{
				break;
			}
			else
			{
				$uri_exist		.= "/".$uri[$x];
			}
		}
		
		return $db->fetchOne("SELECT id FROM ".MYSQL_PREFIX."page_config WHERE uri = ?", array($uri_exist)); 
	}
	
	/**
	 * Rückgabe von TopPageId, wenn returnPageId = 1 wird anstatt false die PageId zurück gegeben
	 * @param int $pageId
	 * @param int $returnPageId
	 * @return int/bool
	 */
	public function getTopPage($pageId, $returnPageId=0)
	{
		$db		= impeesaDb::getConnection();
		
		$topPageId	= $db->fetchOne("SELECT topPage FROM ".MYSQL_PREFIX."page_config WHERE id = ?", array($pageId));
		
		if(empty($topPageId) && $returnPageId == 0)
		{
			return false;
		}
		elseif(empty($topPageId) && $returnPageId == 1)
		{
			return $pageId;
		}
				
		return $topPageId;
 
	}
	
	/**
	 * Wenn Weiterleitung vorhanden ist, gebe diese aus
	 * @param int $pageId
	 * @return string/bool
	 */
	public function getForward($pageId)
	{
		$db		= impeesaDb::getConnection();
		
		$forward	= $db->fetchOne("SELECT route FROM ".MYSQL_PREFIX."page_config WHERE id = ?", array($pageId));
		
		if(!empty($forward))
		{
			return $forward;
		}
		return false;
	}
}