<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaDebug
{
	public static function insert($meldung = "")
	{
		$db		= impeesaDb::getConnection();
		
		if(isset($_POST['submit']))
		{
			$post	= $_POST['submit'];
		}
		else
		{
			$post	= "no";
		}
		
		$db->exec("INSERT INTO ".MYSQL_PREFIX."debug
					(site, loadTime, errorMessage)
					VALUES
					('".$_GET['get']."', '".date("d.m.Y - H:i:s", time())."', '".$post."')");
	}
}

function errorHandler($fehlercode, $fehlertext, $fehlerdatei, $fehlerzeile)
{
	$db		= impeesaDB::getConnection();
	
	$db->exec("INSERT INTO ".MYSQL_PREFIX."debug
			(site, errorMessage, errorNumber, errorFile, errorRow)
			VALUES
			('".$_GET['get']."', '".$fehlertext."', '".$fehlercode."', '".$fehlerdatei."', '".$fehlerzeile."')");
}