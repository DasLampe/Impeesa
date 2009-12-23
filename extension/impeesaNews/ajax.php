<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once("../config/path.conf.php");
require_once(PATH_CORE."config.php");

include_once("impeesaNews.class.php");
include_once("admin/impeesaNewsAdmin.class.php");
$news		= new impeesaNews();
$newsAdmin	= new impeesaNewsAdmin();


if(!isset($var['action']))
{
	echo 'Bitte geben Sie eine Aktion an!';
}
else
{
	if($var['action'] == "editNews")
	{
		echo $newsAdmin->mainEdit($var['newsId']);
	}
}
?>