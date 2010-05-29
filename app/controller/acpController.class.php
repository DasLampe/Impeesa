<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(impeesaHelper::dirUp(1, dirname(__FILE__))."impeesaAppHelper.class.php");

/**
 * @TODO: Code Dopplung mit ./pageController.class.php
 *
 */
class acpController
{
	private $siteId;
	
	public function __construct($siteName)
	{
		$this->siteId	= impeesaHelper::getSiteId($siteName);
		
		if(impeesaAppHelper::isAdminPage($this->siteId) === true)
		{
			$tpl			= impeesaTemplate::getInstance();
			
			if(impeesaUser::isLogin() === false)
			{
				@header("Location: ".LINK_MAIN."content/login/");
			}
			elseif(impeesaAppHelper::pageEnable($this->siteId) === false)
			{
				$tpl->vars("pageContent", "Error404");
				impeesaDebug::insert('Error404');
			}
			else
			{		
				//Standart Variablen laden (Template)
				require_once(dirname(__FILE__)."/_standart.inc.php");
			}
			
			$tpl->vars("pageTitle",	impeesaApphelper::getPageTitle($this->siteId));
			$tpl->vars("css",		impeesaAppHelper::getCss());
			$tpl->vars("js",		impeesaAppHelper::getJs());
			$tpl->vars("naviLeft",	impeesaMenu::getNavi(1, "acp"));
			
			$tpl->load("layout");
		}
	}
	
	/**
	 * Setze Contentelemente in Template
	 * @return string/Template
	 */
	protected function getPage()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$pageElemente	= $this->getPageElements();
		$content		= "";
		foreach($pageElemente as $pageElement)
		{
			$content	.= $this->getElement($pageElement[0]);	
		}
				
		$tpl->vars("content",	$content);
		return $tpl->load("_content", 0);
		
	}
	
	/**
	 * ID der Content Elemente
	 * @return array (int)
	 */
	protected function getPageElements()
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->query("SELECT id
								FROM ".MYSQL_PREFIX."pageElements
								WHERE pageid = '".$this->siteId."'
								ORDER BY position DESC");
		$row	= $result->fetchAll(PDO::FETCH_NUM);
		
		return $row;
	}
	
	/**
	 * Liefert Content Elemente (Blöcke)
	 * @param int $elementId
	 * @return string/Template
	 */
	protected function getElement($elementId)
	{
		$db				= impeesaDB::getConnection();
		$userRigths		= new impeesaUserRights();
		
		$result			= $db->query("SELECT contenttype, contentid
									FROM ".MYSQL_PREFIX."pageElements
									WHERE id = '".$elementId."'");
		$row			= $result->fetch(PDO::FETCH_ASSOC);
		$contentId		= $row['contentid'];
				
		$result	= $db->query("SELECT id, extensionPath
								FROM ".MYSQL_PREFIX."contenttype
								WHERE id = '".$row['contenttype']."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		//ExtensionClass ermitteln
		$extensionClass	= impeesaAppHelper::getExtensionClass($row['extensionPath']);
		
		
		$extensionFile	= PATH_EXTENSION.$row['extensionPath'].$extensionClass.'.class.php';
				
		if(file_exists($extensionFile) && $userRigths->hasRights($_SESSION['userId'], $this->siteId, 1) === true)
		{
			include_once($extensionFile);
			$contentClass	= new $extensionClass();
			
			return $contentClass->getContent($contentId);
		}
		else
		{
			if($userRigths->hasRights($_SESSION['userId'], $row['id']) === false)
			{
				return impeesaException::error("no_rigths");				
			}
			else
			{
				return false;
			}
		}
	}
}