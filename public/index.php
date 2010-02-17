<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once("../config/config.php");
include_once(PATH_LIB."impeesa/impeesaDB.class.php");
include_once(PATH_LIB."impeesa/impeesaTemplate.class.php");
include_once(PATH_LIB."impeesa/impeesaConfig.class.php");
include_once(PATH_LIB."impeesa/impeesaHelper.class.php");
include_once(PATH_CONTROLLER."pageController.class.php");
include_once(PATH_CONTROLLER."resourceController.class.php");

$impeesaHelper	= new impeesaHelper();

if(isset($_GET['action']) && $_GET['action'] == "content")
{
	if(isset($_GET['site']))
	{
		if($impeesaHelper->existSite($_GET['site']) === false)
		{
			echo '404 Fehler!';
		}
		else
		{
			$pageController	= new pageController($_GET['site']);
		}
	}
	else
	{
		header("Location: index.php?action=content&site=home");
	}
}
elseif(isset($_GET['action']) && $_GET['action']=="feed")
{
	echo 'Feed!';
}
elseif(isset($_GET['action']) && $_GET['action']=="resource")
{
	$resourceController	= new resourceController($_GET['file']);
}
else
{
	echo 'Es konnte keine Seite aufgerufen werden!<br>Fehlermeldung senden!';
}
?>