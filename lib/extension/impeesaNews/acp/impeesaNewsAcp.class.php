<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(impeesaHelper::dirUp(1, dirname(__FILE__))."impeesaNews.class.php");

class impeesaNewsAcp extends impeesaNews
{
	private $tplFolder;
	
	public function __construct()
	{
		$this->tplFolder	= impeesaHelper::dirUp(1, dirname(__FILE__))."template/acp/";
	}
	
	public function getContent()
	{
		global $param;
		$rightFail	= true;
		
		if(!isset($param[2]) && impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]),1) === true)
		{
			return $this->getMainPage();
		}
		elseif(isset($param[2]) && $param[2] == "edit")
		{
			if(impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3) === true)
			{
				$param[3]	= (int) $param[3];
				return $this->editNews($param[3]);
			}
		}
		elseif(isset($param[2]) && $param[2] == "add")
		{
			if(impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 2) === true)
			{
				if(!isset($_POST['submit']))
				{
					return $this->getForm();
				}
				else
				{
					return $this->addNews();
				}
			}
		}
		elseif(isset($param[2]) && $param[2] == "del")
		{
			if(impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3) === true)
			{
				if(isset($param[3]))
				{
					$param[3]	= (int) $param[3];
					return $this->delNews($param[3]);
				}
			}
		}
		else
		{
			return impeesaException::error("wrong_url");
		}
		
		if($rightFail == true)
		{
			return impeesaException::error("no_rights");
		}
	}
	
	/**
	 * Request mit Ajax
	 * @return string (Template (json))
	 */
	public function ajaxRequest()
	{
		global $param;
		
		if(isset($param[2]) && $param[2] == "del")
		{
			define('AJAX', true);
			$return	= $this->delNews($param[3]);
			return $return;
		}
		else
		{
			$array	= array('msg'		=> impeesaException::error("wrong_request"),
							'status'	=> false);
			return impeesaHelper::json_encode($array);
		}
	}
	
	/**
	 * Hauptseite ausgeben
	 * @return string (Template)
	 */
	private function getMainPage()
	{
		$tpl		= impeesaTemplate::getInstance();
		$tpl->addJs("newsAcp", "lib-extension-impeesaNews-template-js-");
	
		$tpl->vars("site",		$_GET['get']);
		$tpl->vars("newsTable",	$this->getNews());
		$tpl->addCss("newsAcp.css", "lib-extension-impeesaNews-template-css-");
		
		return $tpl->load("mainPage", 0, $this->tplFolder);
	}
	
	/**
	 * Schreibe News in Tabelle
	 * @return string (Template)
	 */
	private function getNews()
	{
		require_once(impeesaHelper::dirUp(1,dirname(__FILE__))."lib/_status.php");
		
		$tpl		= impeesaTemplate::getInstance();
		$db			= impeesaDb::getConnection();
		
		$result		= $db->query("SELECT id, headline, startDate, endDate, userId, newsStatus
								FROM ".MYSQL_PREFIX."news
								ORDER BY startDate DESC, id DESC");
		
		$news		= "";
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			if(empty($row['endDate']) || $row['endDate'] == 0)
			{
				$endDate	= 0;
			}
			else
			{
				$endDate	= date("d.m.Y", $row['endDate']);
			}
			
			$tpl->vars("headline",		$row['headline']);
			$tpl->vars("startDate",		date("d.m.Y", $row['startDate']));
			$tpl->vars("endDate",		$endDate);
			$tpl->vars("newsStatus",	$status[$row['newsStatus']]);
			$tpl->vars("username",		impeesaUserInfo::getUsername($row['userId']));
			$tpl->vars("tags",			$this->getTags($row['id']));
			$tpl->vars("newsId",		$row['id']);
			
			$news	.= $tpl->load("_newsTable", 0, $this->tplFolder);
		}
		
		return $news;
	}
	
	/**
	 * Bearbeitungsforumlar
	 * @param int $id
	 * @param string $headline
	 * @param string $content
	 * @param int $startDate
	 * @param int $endDate
	 * @param string $tags
	 * @return string (Template)
	 */
	private function getForm($id = "", $headline="", $content = "", $startDate="", $endDate="", $tags="", $newsStatus="", $errorMsg="")
	{
		$tpl	= impeesaTemplate::getInstance();
		$tpl->addJs("jquery.wysiwyg", "lib-js-jwysiwyg-");
		$tpl->addJs("newsAcp", "lib-extension-impeesaNews-template-js-");
		$tpl->addCss("jquery.wysiwyg.css",	"lib-js-jwysiwyg-");
		
		if(!empty($endDate) && !is_null($endDate))
		{
			$endDate	= date("d.m.Y", $endDate);
		}
		else
		{
			$endDate	= 0;
		}
		
		if(empty($startDate))
		{
			$startDate	= time();
		}
		
		$tpl->vars("newsId",		$id);
		$tpl->vars("newsHeadline",	$headline);
		$tpl->vars("newsContent",	$content);
		$tpl->vars("startDate",		date("d.m.Y", $startDate));
		$tpl->vars("endDate",		$endDate);
		$tpl->vars("tags",			$tags);
		$tpl->vars("mostTags",		$this->getMostTags());
		$tpl->vars("errorMsg",		$errorMsg);
		$tpl->vars("newsStatus",	$this->newsStatus($newsStatus));
		
		return $tpl->load("_newsForm", 0, $this->tplFolder);
	}
	
	/**
	 * Neue News erstellen
	 * @return string (Template)
	 */
	private function addNews()
	{
		$db		= impeesaDB::getConnection();
		$tpl	= impeesaTemplate::getInstance();
		
		if(empty($_POST['newsHeadline']) || empty($_POST['newsContent']) || empty($_POST['startDate']))
		{
			$errorMsg	= "Bitte alle Felder ausfüllen!";
			return $this->getForm($_POST['newsId'], $_POST['newsHeadline'], $_POST['newsContent'],
				impeesaHelper::getTimestap($_POST['startDate']), impeesaHelper::getTimestap($_POST['endDate']), $_POST['newsTags'], $_POST['newsStatus'], $errorMsg);
		}
		else
		{
			$tags		= explode(",", $_POST['newsTags']);
			
			$update	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."news
									(headline, content, startDate, endDate, newsStatus, permaLink, userId)
									VALUES
									(:headline, :content, :startDate, :endDate, :newsStatus, :permaLink, '".$_SESSION['userId']."')");
			$update->bindParam(":headline",		$_POST['newsHeadline']);
			$update->bindParam(":content",		$_POST['newsContent']);
			$update->bindParam(":startDate",	impeesaHelper::getTimestap($_POST['startDate']));
			$update->bindParam(":endDate",		impeesaHelper::getTimestap($_POST['endDate']));
			$update->bindParam(":newsStatus",	$_POST['newsStatus']);
			$update->bindParam(":permaLink",	impeesaHelper::createPermaLink($_POST['newsHeadline']));
			$update->execute();

			$this->addNewsTag($tags, $db->lastInsertId());
			
			impeesaLog::insertLog(__FILE__, "INSERT NEWS ID: ".$db->lastInsertId(), $_SESSION['userId']);
			
			$tpl->vars("successMessage",	"News erfolgreich erstellt!");
			return $tpl->load("successNews", 0, $this->tplFolder);
		}		
	}
	
	/**
	 * News Editieren
	 * @param int $newsId
	 * @return string (Template)
	 */
	private function editNews($newsId)
	{
		
		$tpl		= impeesaTemplate::getInstance();
		$db			= impeesaDb::getConnection();
		
		if(!isset($_POST['submit']))
		{
			$result		= $db->prepare("SELECT id, headline, content, startDate, endDate, newsStatus
										FROM ".MYSQL_PREFIX."news
										WHERE id = :newsId");
			$result->bindParam('newsId', $newsId, PDO::PARAM_INT);
			$result->execute();		
			$row		= $result->fetch(PDO::FETCH_ASSOC);
			
			//Hole Tags
			$tags		= "";
			$tagResult	= $db->query("SELECT tagId
										FROM ".MYSQL_PREFIX."newsTagAffiliation
										WHERE newsId = '".$row['id']."'");
			while($tagRow	= $tagResult->fetch(PDO::FETCH_ASSOC))
			{
				if(!empty($tags))
				{
					$tags	.= ", ";
				}
				$tags	.= $this->getTagName($tagRow['tagId']);
			}
			
			$tpl->vars("editForm", $this->getForm($row['id'], $row['headline'], $row['content'],
												$row['startDate'], $row['endDate'], $tags, $row['newsStatus']));
			
			return $tpl->load("editNews", 0, $this->tplFolder);
		}
		else
		{
			if(empty($_POST['newsHeadline']) || empty($_POST['newsContent']) || empty($_POST['startDate']))
			{
				$errorMsg	= "Bitte alle Felder ausfüllen!";
				return $this->getForm($_POST['newsId'], $_POST['newsHeadline'], $_POST['newsContent'],
					impeesaHelper::getTimestap($_POST['startDate']), impeesaHelper::getTimestap($_POST['endDate']), $_POST['newsTags'], $_POST['newsStatus'], $errorMsg);
			}
			else
			{
				$tags	= explode(",", $_POST['newsTags']);
				$this->addNewsTag($tags, $_POST['newsId']);
				
				$update	= $db->prepare("UPDATE ".MYSQL_PREFIX."news SET
										headline	= :headline,
										content		= :content,
										startDate	= :startDate,
										endDate		= :endDate,
										newsStatus	= :newsStatus,
										permaLink	= :permaLink
										WHERE id	= :id");
				$update->bindParam(":headline",		$_POST['newsHeadline']);
				$update->bindParam(":content",		$_POST['newsContent']);
				$update->bindParam(":startDate",	impeesaHelper::getTimestap($_POST['startDate']));
				$update->bindParam(":endDate",		impeesaHelper::getTimestap($_POST['endDate']));
				$update->bindParam(":newsStatus",	$_POST['newsStatus']);
				$update->bindParam(":permaLink",	impeesaHelper::createPermaLink($_POST['newsHeadline']));
				$update->bindParam(":id",			$_POST['newsId']);
				$update->execute();				
				
				impeesaLog::insertLog(__FILE__, "UPDATE NEWS ID: ".$_POST['newsId'], $_SESSION['userId']);
				
				$tpl->vars("successMessage",	"Das bearbeiten war erfolgreich!");
				return $tpl->load("successNews", 0, $this->tplFolder);
			}
		}
	}
	
	/**
	 * News löschen
	 * @return string (Template)
	 */
	private function delNews($newsId)
	{
		$db		= impeesaDB::getConnection();
		$tpl	= impeesaTemplate::getInstance();
		
		$db->exec("DELETE FROM ".MYSQL_PREFIX."news WHERE id = '".$newsId."'");
		impeesaLog::insertLog(__FILE__, "DELETE NEWS ID:".$newsId, $_SESSION['userId']);
		
		$db->exec("DELETE FROM ".MYSQL_PREFIX."newsTagAffiliation WHERE newsId= '".$newsId."'");
		$this->updateCountNewsTag($newsId);
		
		$message	= "Löschen der News erfolgreich!";
		
		if(!defined('AJAX'))
		{
			$tpl->vars("successMessage", $message);
			return $tpl->load("successNews", 0, $this->tplFolder);
		}
		else
		{
			$array		= array('msg'		=>  $message,
								'status'	=> true);
			return impeesaHelper::json_encode($array);
		}
	}
	
	/**
	 * Zeige Tags die am meisten benutzt wurden
	 * @return string (Template)
	 */
	private function getMostTags()
	{
		$tpl	= impeesaTemplate::getInstance();
		$db		= ImpeesaDb::getConnection();
		
		$result	= $db->query("SELECT id, name
							FROM ".MYSQL_PREFIX."newsTags
							ORDER BY count DESC
							LIMIT 50");
		$tags	= "";
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$tpl->vars("tagId",		$row['id']);
			$tpl->vars("tagName",	$row['name']);
			
			if(!empty($tags))
			{
				$tags	.= ', ';
			}
			$tags	.= $tpl->load("_mostTags", 0, $this->tplFolder);
		}
		
		return $tags;
	}
	
	/**
	 * Hinzufügen von Tags (Tags in DB schreiben)
	 * @param array $tags
	 * @param integer $newsId
	 * @return boolean
	 */
	private function addNewsTag($tags, $newsId)
	{
		$db		= impeesaDb::getConnection();
		
		$db->beginTransaction();
		//Lösche alle Tags von NewsId
		$result	= $db->prepare("DELETE FROM ".MYSQL_PREFIX."newsTagAffiliation
								WHERE newsId = :newsId");
		$result->bindParam(':newsId',	$newsId);
		$result->execute();
		
		foreach($tags as $tag)
		{
			$tag	= trim($tag);

			//Id von Tag holen
			$result	= $db->prepare("SELECT id
									FROM ".MYSQL_PREFIX."newsTags
									WHERE name LIKE :tag");
			$result->bindParam(':tag', $tag);
			$result->execute();
			$row	= $result->fetch(PDO::FETCH_ASSOC);
			
	
			if(!$row)
			{//Wenn Tag nicht existiert
				$insert		= $db->prepare("INSERT INTO ".MYSQL_PREFIX."newsTags
										(name)
										VALUES
										(:tagName)");
				$insert->bindParam(":tagName",	$tag);
				$insert->execute();
				$row['id']	= $db->lastInsertId();
			}
			
			//Füge Tag hinzu
			$insert		= $db->prepare("INSERT INTO ".MYSQL_PREFIX."newsTagAffiliation
										(tagId, newsId)
										VALUES
										(:tagId, :newsId)");
			$insert->bindParam(':tagId',	$row['id']);
			$insert->bindParam(':newsId',	$newsId);
			$insert->execute();
		}
		$this->updateCountNewsTag($newsId);
		$db->commit();
		
		return true;
	}
	
	private function updateCountNewsTag($newsId)
	{
		$db		= impeesaDB::getConnection();
		
		$result	= $db->query("SELECT COUNT(id), tagId FROM ".MYSQL_PREFIX."newsTagAffiliation GROUP BY tagId");
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
		
			$db->exec("UPDATE ".MYSQL_PREFIX."newsTags SET
						count = '".$row['COUNT(id)']."'
						WHERE id = '".$row['tagId']."'");
		}	
	}
}
