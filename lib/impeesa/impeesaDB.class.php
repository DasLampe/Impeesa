<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once("../config/database.conf.php");

class ImpeesaDb {
	private static $db = NULL;
 
	public function __construct()
	{
	}
 
	public function __clone()
	{
	}
 
	public static function getConnection()
	{
		if(self::$db == NULL)
		{
			try
			{
				self::$db	= new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS);
			}
			catch(Exeptions $e)
			{
				die("Datenbank Verbindung fehlgeschlagen");
			}
		}
		return self::$db;
	}
}
	
	/*function __construct()
	{
		try
		{
			return $dbh	= new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS);	
		}
		catch(PDOException $e)
    	{
    		echo $e->getMessage();
    		die("Fehler beim Datenbank Verbindungsaufbau!");
    	}
	}*/