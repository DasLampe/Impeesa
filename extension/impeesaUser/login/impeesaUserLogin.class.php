<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(PATH_CORE_UTIL."IExtension.class.php");

class impeesaUserLogin implements IExtension 
{
	
	public function drawExtension($pageId, $contentid)
	{
		$tpl		= impeesaTemplate::getInstance();
		$user		= new ImpeesaUser();
		
		if(isset($_SESSION['userId']) && $contentid != "-1")
		{
			@header("Location: /intern/home");
		}
		
		$tpl->addCSS("extension/impeesaUser/css/loginForm.css");
		$tpl->addJs("extension/impeesaUser/js/login.js");
		
		if(!isset($_POST['submit']))
		{
			return $this->loginForm();
		}
		else
		{
			if($this->checkForm($_POST['username'], $_POST['password']) === false)
			{
				$error	= "Angaben waren nicht korrekt!";
				return $this->loginForm($error, $_POST['username'], $_POST['route']);
			}
			else
			{
				$this->setSession($user->getUserIdByName($_POST['username']));
				
				@header("location: ".$_POST['route']);
			}
		}
	}
	
	private function checkForm($username, $password)
	{
		$user	= new ImpeesaUser();
		
		if($user->existUsername($username) === false)
		{
			return false;
		}
		
		if($user->getPassword($user->getUserIdByName($username)) === md5($password))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function loginForm($error = "", $username="", $route="")
	{
		if($_GET['file'] == "/intern/login")
		{
			$route	= "/intern/home";	
		}
		elseif(empty($route))
		{
			$route	= $_GET['file'];
		}	
		
		$tpl		= impeesaTemplate::getInstance();
		
		$tpl->vars("LoginError", $error);
		$tpl->vars("LoginRoute", $route);
		$tpl->vars("LoginUsername", $username);
		return $tpl->load("loginForm", 0, PATH_EXTENSION."impeesaUser/template/");
	}
	
	private function setSession($userId)
	{
		$_SESSION['userId']	= $userId;
	}
}