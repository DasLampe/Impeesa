<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
function errorHandler($errorCode, $errorMessage, $errorFile, $errorRow)
{
	$db		= impeesaDB::getConnection();
	
	$db->exec("INSERT INTO ".MYSQL_PREFIX."debug
			(site, errorMessage, errorNumber, errorFile, errorRow)
			VALUES
			('".$_GET['get']."', '".$errorMessage."', '".$errorCode."', '".$errorFile."', '".$errorRow."')");
}