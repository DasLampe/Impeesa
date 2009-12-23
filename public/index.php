<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
ob_start();

if(empty($_GET['file']))
{
	header("location: /home");
}

//Boot Datei laden
require_once("../core/config.php");

$db	= ImpeesaDb::getConnection();

$controller			= "pageController";
$pageId				= impeesaHelper::getPageId($_GET['file']);

if(impeesaHelper::getForward($pageId) !== false)
{
	header("location: ".impeesaHelper::getForward($pageId));
}

try
{
	require_once(PATH_CORE_CONTROLLER.$controller.".class.php");
	$controller		= new $controller;
	$controller->executeController($pageId);
}
catch (Exception $e)
{
	echo $e->getMessage();
	$view	= new exceptionView($e->getContent());
	$view->handle();
}
ob_end_flush();