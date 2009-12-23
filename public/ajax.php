<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once("../config/path.conf.php");


$_GET['file']	= preg_split('/\/ajax\/(.*)\/var\/(.*)/i', $_GET['file'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

if(file_exists(PATH_MAIN.'extension/'.$_GET['file'][0].'/ajax.php'))
{
	$var	= array();
	$vars	= explode("/", $_GET['file'][1]);
	
	$count	= count($vars);
	if(empty($vars[$count-1]))
	{
		$count	= $count -1;
	}
	
	for($x=0;$x<$count;$x++)
	{
		$var[$vars[$x]]	= $vars[$x+1];
		$x++;
	}
	
	unset($vars);
	
	include_once(PATH_MAIN.'extension/'.$_GET['file'][0].'/ajax.php');
}
else
{
	echo 'Die Datei ist leider nicht vorhanden!';
}
?>