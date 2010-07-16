<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaUserManagement
{
	private $tplFolder;
	
	public function __construct()
	{
		$this->tplFolder	= impeesaHelper::dirUp(1, dirname(__FILE__)).'/template/management/';
	}
	
	public function getContent()
	{
		global $param;
		$tpl	= impeesaTemplate::getInstance();
		$tpl->vars("LINK_SITE",		LINK_MAIN.impeesaHelper::getPageModule($_GET['get']));
		
		if(!isset($param[2]) || empty($param[2]))
		{
			$return	= $this->getProfil();
		}
		elseif($param[2] == "pass")
		{
			$return = $this->changePass();
		}
		
		$tpl->vars("submenu",	impeesaMenu::getCustomSubMenu($this->getSubmenu()));
		$tpl->vars("title",		"Benutzer Verwaltung");
		$tpl->vars("content",	$return);
		
		return $tpl->load("_defaultAcpPage", 0);
	}
	
	private function getSubmenu()
	{
		global $param;
		$return 	= array();
		
		$return[]	= array('/', 'Profil Verwalten', '');
		$return[]	= array('/pass', 'Passwort ändern', '');
		$return[]	= array('/avatar', 'Avatar ändern', '');
				
		if(impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3) === true)
		{
			$return[]	= array('/managment', 'Benutzer Verwalten', '');
		}
		
		return	$return;
	}
	
	private function getProfil()
	{
		$db		= ImpeesaDb::getConnection();
		
		if(!isset($_POST['submit']))
		{
			$result	= $db->prepare("SELECT firstname, name, email, tele
									FROM ".MYSQL_PREFIX."user
									WHERE id = :userId");
			$result->bindParam(":userId",	$_SESSION['userId']);
			$result->execute();
			$row	= $result->fetch(PDO::FETCH_ASSOC);
			
			return $this->getProfilForm("", $row['email'], $row['firstname'], $row['name'], $row['tele']);
		}
		elseif(empty($_POST['firstname']) || empty($_POST['name']) || empty($_POST['email']))
		{
			return $this->getProfilForm("Bitte alle mit * gekennzeichneten Felder ausfüllen!", $_POST['email'], $_POST['firstname'], $_POST['name'], $_POST['tele']);
		}
		else
		{
			if(impeesaHelper::validEmail($_POST['email']) === false)
			{
				return $this->getProfilForm("Email Adresse ist nicht gültig!", $_POST['email'], $_POST['firstname'], $_POST['name'], $_POST['tele']);
			}
			else
			{

				$tpl	= impeesaTemplate::getInstance();
				
				$update	= $db->prepare("UPDATE ".MYSQL_PREFIX."user SET
											email 		= :email,
											firstname	= :firstname,
											name		= :name,
											tele		= :tele
											WHERE id	= :userId");
				$update->bindParam(":email",		$_POST['email']);
				$update->bindParam(":firstname",	$_POST['firstname']);
				$update->bindParam(":name",			$_POST['name']);
				$update->bindParam(":tele",			$_POST['tele']);
				$update->bindParam(":userId",		$_SESSION['userId']);
				$update->execute();
				
				$tpl->vars("message",	"Profil wurde geändert");
				return $tpl->load("_success", 0);
			}
		}
	}
	
	private function getProfilForm($error= "", $email="", $firstname="", $name="", $tele="")
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->vars("email",			$email);
		$tpl->vars("firstname",		$firstname);
		$tpl->vars("name",			$name);
		$tpl->vars("tele",			$tele);
		$tpl->vars("error",			$error);
		
		return $tpl->load("profileForm", 0, $this->tplFolder);
	}
	
	private function changePass()
	{
		if(!isset($_POST['submit']))
		{
			return $this->changePassForm();
		}
		else
		{
			$tpl	= impeesaTemplate::getInstance();
			$db		= impeesaDb::getConnection();
			
			if(empty($_POST['passOld']) || empty($_POST['passNew1']) || empty($_POST['passNew2']))
			{
				return $this->changePassForm("Bitte alle Felder ausfüllen!");
			}
			elseif($_POST['passNew1'] != $_POST['passNew2'])
			{
				return $this->changePassForm("Passwörter nicht identisch!");
			}
			else
			{
				$result		= $db->prepare("SELECT password 
											FROM ".MYSQL_PREFIX."user
											WHERE id = :userId");
				$result->bindParam(":userId", $_SESSION['userId']);
				$result->execute();
				$row		= $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['password'] != md5($_POST['passOld']))
				{
					return $this->changePassForm("Aktuelles Passwort nicht korrekt!");
				}
				else
				{
					$update		= $db->prepare("UPDATE ".MYSQL_PREFIX."user SET
												password = :password
												WHERE id	= :userId");
					$update->bindParam(":userId",	$_SESSION['userId']);
					$update->bindParam(":password",	md5($_POST['passNew1']));
					$update->execute();
					
					$tpl->vars("message", "Passwort erfolgreich geändert");
					return $tpl->load("_success", 0);
				}
			}
		}
	}
	
	private function changePassForm($error="")
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->vars("error",	$error);
		
		return $tpl->load("changePassForm", 0, $this->tplFolder);
	}
}