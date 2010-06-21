<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaContentAcp
{
	private $tplFolder;
	
	public function __construct()
	{
		$this->tplFolder	= dirname(__FILE__).'/template/';		
	}
	
	public function getContent()
	{
		global $param;
		$tpl	= impeesaTemplate::getInstance();
		
		if(!isset($param[2]))
		{
			$return	= $this->getPageList(0);
		}
		elseif((impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3)) && ($param[2] == "edit" && is_numeric($param[3])))
		{
			$return = $this->editPage($param[3]);
		}

		$tpl->vars("title",		"Inhalt Verwalten");
		$tpl->vars("content", $return);
		
		return $tpl->load("_defaultAcpPage", 0); 
	}
	
	/**
	 * Hole alle Unterseiten
	 * @param integer $topPage
	 */
	private function getPageList($topPage=0)
	{
		$db		= impeesaDB::getConnection();
		$tpl	= impeesaTemplate::getInstance();
		
		$result	= $db->prepare("SELECT id, siteName, pageTitle, menuTitle
								FROM ".MYSQL_PREFIX."pageConfig
								WHERE toppage = :topPage
									AND isAdminPage	!= '1'
								ORDER BY position");
		$result->bindParam(":topPage",		$topPage);
		$result->execute();
		
		$pageList	= '';
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$pageList	.= $this->getListItem($row['id'], $row['siteName'], $row['pageTitle'], $row['menuTitle']);
			$pageList	.= $this->getPageList($row['id']);
		}
		
		$tpl->vars("pageListItems", $pageList);
		return $tpl->load("pageList", 0, $this->tplFolder);
	}
	
	/**
	 * Liefere Item für Liste (Template)
	 * @param integer $pageId
	 * @param string $siteName
	 * @param string $pageTitle
	 * @param string $menuTitle
	 */
	private function getListItem($pageId, $siteName, $pageTitle, $menuTitle)
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->vars("LINK_SITE",	LINK_MAIN.$_GET['get']);
		$tpl->vars("siteName",	$siteName);
		$tpl->vars("pageTitle", $pageTitle);
		$tpl->vars("menuTitle",	$menuTitle);
		$tpl->vars("pageId",	$pageId);
		
		return $tpl->load("_pageListItem", 0, $this->tplFolder);
	}
	
	private function editPage($pageId)
	{
		$db		= ImpeesaDb::getConnection();
			
		if(!isset($_POST['submit']))
		{		
			$result	= $db->prepare("SELECT siteName, pageTitle, menuTitle, enabled, toppage, visibleMenu, position
							FROM ".MYSQL_PREFIX."pageConfig
							WHERE id = :pageId");
			$result->bindParam(':pageId',	$pageId);
			$result->execute();
			
			$row	= $result->fetch(PDO::FETCH_ASSOC);
			return $this->editPageForm($pageId, $row['siteName'], $row['pageTitle'], $row['menuTitle'], $row['enabled'], $row['toppage'], $row['visibleMenu'], $row['position']);
		}
		else
		{
			$tpl	= impeesaTemplate::getInstance();
			
			if(empty($_POST['siteName']))
			{
				return $this->editPageForm($pageId, $_POST['siteName'], $_POST['pageTitle'], $_POST['enabled'], $_POST['topPage'], $_POST['visibleMenu'], $_POST['menuPosition']);
			}
			else
			{
				
				$enabled	= "1";
				if(!isset($_POST['enabled']))
				{
					$enabled	= '0';
				}
				
				$visibleMenu	= '1';
				if(!isset($_POST['visibleMenu']))
				{
					$visibleMenu	= '0';
				}
				
				$db->beginTransaction();
				//PageConfig
				$update	= $db->prepare("UPDATE ".MYSQL_PREFIX."pageConfig SET
										siteName	= :siteName,
										pageTitle	= :pageTitle,
										enabled		= :enabled,
										toppage		= :toppage,
										visibleMenu	= :visibleMenu,
										position	= :menuPosition
										WHERE id	= :pageId");
				$update->bindParam(":siteName",			$_POST['siteName']);
				$update->bindParam(":pageTitle",		$_POST['pageTitle']);
				$update->bindParam(":enabled",			$enabled);
				$update->bindParam(":toppage",			$_POST['topPage']);
				$update->bindParam(':visibleMenu',		$visibleMenu);
				$update->bindParam(':menuPosition',		$_POST['menuPosition']);
				$update->bindParam(':pageId',			$pageId);
				$update->execute();
				
				//ContentText
				$update	= $db->prepare("UPDATE ".MYSQL_PREFIX."contentText SET
										content			= :content
										WHERE pageId	= :pageId");
				$update->bindParam(":content",			$_POST['content']);
				$update->bindParam(":pageId",			$pageId);
				$update->execute();
				
				//PageElements
				$delete	= $db->prepare("DELETE FROM ".MYSQL_PREFIX."pageElements WHERE pageId = :pageId");
				$delete->bindParam(":pageId",			$pageId);
				$delete->execute();
				
				foreach($_POST['modulEnabled'] as $modulId)
				{
					$insert	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."pageElements
											(pageid, contenttype, position)
											VALUES
											(:pageId, :contentType, :position)");
					$insert->bindParam(":pageId",		$pageId);
					$insert->bindParam(":contentType",	$modulId);
					$insert->bindParam(":position",		$_POST['modulPosition'][$modulId]);
					$insert->execute();
				}
				$db->commit();
				return "Ok!";
			}
		}

	}
	
	
	private function editPageForm($pageId, $siteName="", $pageTitle="", $menuTitle="", $enabled="", $topPage="", $visibleMenu="", $position="")
	{
		$tpl	= impeesaTemplate::getInstance();

		$tpl->vars("LINK_SITE",		LINK_MAIN.$_GET['get']);
		$tpl->addJs("jquery.wysiwyg", "lib-js-jwysiwyg-");
		$tpl->addJs("contentAcp", "lib-extension-impeesaContent-acp-template-js-");
		$tpl->addCss("jquery.wysiwyg.css",	"lib-js-jwysiwyg-");
		
		if($enabled == '1')
		{
			$enabled	= "checked";
		}
		
		if($visibleMenu == '1')
		{
			$visibleMenu	= 'checked';
		}
		
		$tpl->vars("siteName",		$siteName);
		$tpl->vars("pageTitle",		$pageTitle);
		$tpl->vars("menuTitle", 	$menuTitle);
		$tpl->vars("enabled",		$enabled);
		$tpl->vars("topPage",		$this->getDropDownTopPage($topPage, $pageId));
		$tpl->vars("visibleMenu",	$visibleMenu);
		$tpl->vars("menuPosition",	$position);
		$tpl->vars("selectModule",	$this->getBlockSelectModule($pageId));
		$tpl->vars("content",		$this->getPageContent($pageId));
		
		return $tpl->load("editForm", 0, $this->tplFolder);
	}
	
	private function getDropDownTopPage($topPage, $pageId)
	{
		$db		= impeesaDB::getConnection();
		$tpl	= impeesaTemplate::getInstance();

		$result	= $db->prepare("SELECT id, siteName, pageTitle 
								FROM ".MYSQL_PREFIX."pageConfig
								WHERE toppage != :pageId
									AND toppage = '0'
									AND id != :pageId
									AND isAdminPage != '1'");
		$result->bindParam(":pageId",	$pageId);
		$result->execute();
		
		$tpl->vars("optionValue",			'0');
		$tpl->vars("optionValueText",		'Keine');
		$tpl->vars("selected",				'');
		$dropDownOption	= $tpl->load("_selectOption", 0);
		
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$tpl->vars("optionValue",		$row['id']);
			$tpl->vars("optionValueText",	$row['pageTitle'].' ('.$row['siteName'].')');
			$tpl->vars("selected",			"");
			
			if($row['id'] == $topPage)
			{
				$tpl->vars("selected",		"selected");
			}
			$dropDownOption	.= $tpl->load("_selectOption", 0);
		}
		return $dropDownOption;
	}
	
	private function getBlockSelectModule($pageId)
	{
		$db		= impeesaDB::getConnection();
		$tpl	= impeesaTemplate::getInstance();
		
		$result	= $db->query("SELECT id, name
							FROM ".MYSQL_PREFIX."contenttype
							WHERE onlyAdmin != '1'");
		
		$module		= "";
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$active	= $this->isActivModul($pageId, $row['id']);
			
			$tpl->vars("checked", "");
			$tpl->vars("position",	"");
			if($active != false )
			{
				$tpl->vars("position",	$active['position']);
				$tpl->vars("checked",		'checked');
			}	
			$tpl->vars("modulId",		$row['id']);
			$tpl->vars("modulName",		$row['name']);
			
			$module	.= $tpl->load("_modulBlock", 0, $this->tplFolder);
		}
		
		return $module;
	}
	
	private function isActivModul($pageId, $modulId)
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->prepare("SELECT contenttype, position
								FROM ".MYSQL_PREFIX."pageElements
								WHERE pageId = :pageId
									AND contenttype = :modulId");
		$result->bindParam(":pageId",	$pageId);
		$result->bindParam(":modulId",	$modulId);
		$result->execute();
		
		$array	= array();
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$array	= array(
							"contentttype"	=> $row['contenttype'],
							"position"		=> $row['position']
						);
		}
		
		if(!empty($array))
		{
			return $array;
		}
		else
		{		
			return false;
		}	
	}
	
	private function getPageContent($pageId)
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->prepare("SELECT content
								FROM ".MYSQL_PREFIX."contentText
								WHERE pageId = :pageId");
		$result->bindParam(":pageId",	$pageId);
		$result->execute();
		
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		return $row['content'];
	}
}