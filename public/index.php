<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
/*
 * Includiere und lade Klassen, Hilfswerkzeuge, ect.
 */
require_once("../config/config.php");
require_once(PATH_CLASS."impeesaDB.class.php");
require_once(PATH_CLASS."impeesaTemplate.class.php");
require_once(PATH_CLASS."impeesaConfig.class.php");
require_once(PATH_CLASS."impeesaHelper.class.php");
require_once(PATH_CLASS."impeesaUser.class.php");
require_once(PATH_CLASS."impeesaUserRights.class.php");
require_once(PATH_CLASS."impeesaException.class.php");
require_once(PATH_CLASS."impeesaMenu.class.php");
require_once(PATH_CLASS."impeesaLog.class.php");


require_once(PATH_CLASS."impeesaDebug.class.php");
require_once(PATH_EXTENSION."impeesaUser/info/impeesaUserInfo.class.php");

set_error_handler('errorHandler');

$impeesaHelper	= new impeesaHelper();

/*
 * GET in Array packen
 */
$param	= explode("/", $_GET['get']);

impeesaDebug::insert();

/*
 * Eigentlicher Controller
 */
if(isset($param[0]) && $param[0] == "content")
{
	if(isset($param[1]) && !isset($_SERVER['HTTP_X_REQUESTED_WITH']))
	{
		if($impeesaHelper->existSite($param[1]) === false)
		{
			header('HTTP/1.1 404 Not Found');
			echo '404 Fehler!';
		}
		else
		{
			include_once(PATH_CONTROLLER."pageController.class.php");
			$pageController	= new pageController($param[1]);
		}
	}
	elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
	{
		if($impeesaHelper->existSite($param[1]) === false)
		{
			echo 'Fehler bei der Abfrage!';
		}
		else
		{
			include_once(PATH_CONTROLLER."ajaxController.class.php");
			if(isset($_POST['dataType']) && $_POST['dataType'] == "json")
			{
				header('Content-type: text/json');
			}
			$ajaxController	= new ajaxController($param[1]);
		}
	}
	else
	{
		header("Location: ".LINK_MAIN."content/home");
	}
}
elseif(isset($param[0]) && $param[0] == "acp")
{
	if(isset($param[1]) && !empty($param[1]) && !isset($_SERVER['HTTP_X_REQUESTED_WITH']))
	{
		if($impeesaHelper->existSite($param[1]) === false)
		{
			echo $param[1];
			echo '404 Fehler!';
		}
		else
		{
			include_once(PATH_CONTROLLER."acpController.class.php");
			new acpController($param[1]);
		}
	}
	elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
	{
		if($impeesaHelper->existSite($param[1]) === false)
		{
			echo 'Fehler bei der Abfrage!';
		}
		else
		{
			include_once(PATH_CONTROLLER."ajaxAcpController.class.php");
			if(isset($_POST['dataType']) && $_POST['dataType'] == "json")
			{
				header('Content-type: text/json');
			}
			new ajaxAcpController($param[1]);
		}
	}
	else
	{
		header("Location: ".LINK_MAIN."acp/home");
	}
}
elseif(isset($param[0]) && $param[0] == "feed")
{
	echo 'feed';
}
elseif(isset($param[0]) && $param[0]=="resource")
{
	include_once(PATH_CONTROLLER."resourceController.class.php");
	new resourceController($param[1]);
}
elseif(isset($param[0]) && $param[0] == "picture")
{
	include_once(PATH_CONTROLLER."resourceController.class.php");
	new resourceController("upload-picture-".$param[1]."-".$param[2]);
}
elseif(!isset($_GET['get']))
{
	header("Location: ".LINK_MAIN."content/home/");
}
else
{
	header("HTTP/1.1 404 NOT FOUND");
	echo 'Es konnte keine Seite aufgerufen werden!<br>Fehlermeldung senden!';
}
?>