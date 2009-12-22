<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once("../config/path.conf.php");
$file	= explode("/", $_GET['file']);
$path	= "";

if($file[0]	== "extension")
{
	$path	.= PATH_EXTENSION; 
}
elseif($file[0] == "template")
{
	$path	.= PATH_TPL;
}
else
{
	$path	.= PATH_MAIN.$file[0].'/';
}

$type	= explode(".", $file[count($file)-1]);

switch($type)
{
	case "css":
		$type	= "text/css";
		break;
	case "jpg":
		$type	= "image/jpg";
		break;
	case "png":
		$tpye	= "image/png";
		break;
	case "js":
		$type	= "text/javascript";
		break;
}

for($x=1;$x<=count($file)-1;$x++)
{
	if($x > 1)
	{
		$path	.= '/';
	}		
	$path	.= $file[$x];
}

if(file_exists($path))
{
	header("Content-Type: ".$type);
	readfile($path);
}
else
{
	echo 'Datei "'.$path.'" existiert nicht!';
}
?>