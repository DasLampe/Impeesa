<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaUserLogin
{
	public function getContent($contentId)
	{
		global $param;
		$tpl	= impeesaTemplate::getInstance();		
		
		if(impeesaUser::isLogin() === false)
		{
			$tpl->addJs("login.ajax", "lib-extension-impeesaUser-template-js-");
		
			if(!isset($_POST['submit']))
			{
				$content	= $this->getForm();
			}
			else
			{
				$content	= $this->login();
			}
		
			$tpl->vars("contentBlock",	$content);

		}
		else
		{
			if(!isset($param[2]) || $param[2] != "logout")
			{
				$tpl->vars("contentBlock", $tpl->load("_ask2Logout", 0, impeesaHelper::dirUp(1, dirname(__FILE__))."template/"));
			}
			else
			{
				$tpl->vars("contentBlock", $this->logout());
			}
		}
		$tpl->vars("headline", 		"An-/Abmelden");
		return $tpl->load("_defaultPage",0);
	}

	/**
	 * Request mit Ajax
	 * @return string (Template (json))
	 */
	public function ajaxRequest()
	{
		global $param;
		
		if(isset($param[2]))
		{
			if(method_exists($this, $param[2]))
			{
				define('AJAX', true);
				$return	= $this->$param[2]();
				return $return;
			}
			else
			{
				$array	= array('msg' => impeesaException::error("no_method"),
							'status'	=> false);
				return impeesaHelper::json_encode($array);
			}
		}
		else
		{
			$array	= array('msg'		=> impeesaException::error("wrong_request"),
							'status'	=> false);
			return impeesaHelper::json_encode($array);
		}
	}
	
	/**
	 * Login Formular
	 * @param string $username
	 * @param string $errorMsg
	 * @return string (Template)
	 */
	private function getForm($username="", $errorMsg="")
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->vars("username",		$username);
		$tpl->vars("errorMsg",		$errorMsg);
		
		return $tpl->load("form",0, impeesaHelper::dirUp(1, dirname(__FILE__))."template/");
	}
	
	/**
	 * Logge User ein
	 * @return string (Template)
	 */
	private function login()
	{
		$tpl	= impeesaTemplate::getInstance();
		$db		= impeesaDb::getConnection();
		$user	= new impeesaUser();
		
		if(empty($_POST['username']) || empty($_POST['password']))
		{
			$errorMsg	= "Bitte alle Felder ausfüllen!";
			
			if(!defined('AJAX'))
			{//Wenn Abfrage nicht mit Ajax gemacht wurde
				return $this->getForm($_POST['username'], $errorMsg);
			}
			else
			{
				$array	= array('msg'		=> '<div class="error"><p>'.$errorMsg.'</p></div>',
								'status'	=> false);
				return impeesaHelper::json_encode($array);
			}	
		}
		else
		{
			$result	= $db->query("SELECT username, password, id
								FROM ".MYSQL_PREFIX."user
								WHERE username LIKE '".$_POST['username']."'");
			$row	= $result->fetch(PDO::FETCH_ASSOC);
			
			if(empty($row) || ($row['password'] != md5($_POST['password'])))
			{
				$errorMsg		= "Username oder Passwort sind falsch!";
				
				if(!defined('AJAX'))
				{//Wenn Abfrage nicht mit Ajax gemacht wurde
					return $this->getForm($_POST['username'], $errorMsg);
				}
				else
				{
					$array	= array('msg'		=> '<div class="error"><p>'.$errorMsg.'</p>',
									'status'	=> false);
					return impeesaHelper::json_encode($array);
				}	
			}
			else
			{			
				$user->loginUser($row['id']);
				
				if(!defined('AJAX'))
				{//Wenn Abfrage nicht mit Ajax gemacht wurde
					return $tpl->load("_loginSuccess",0,impeesaHelper::dirUp(1, dirname(__FILE__))."template/");
				}
				else
				{
					$array		= array('msg'		=>  $tpl->load("_loginSuccess", 0,impeesaHelper::dirUp(1, dirname(__FILE__))."template/"),
										'status'	=> true);
					return impeesaHelper::json_encode($array);
				}
			}
		}
	}
	
	/**
	 * Logge User aus
	 * @return string (Template)
	 */
	private function logout()
	{
		$tpl		= impeesaTemplate::getInstance();
		$user		= new impeesaUser();
		
		$user->logoutUser();		
		
		return $tpl->load("_logoutSuccess",0,impeesaHelper::dirUp(1, dirname(__FILE__))."template/");
	}
}