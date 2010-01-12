<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once("../lib/Zend/Db.php");
require_once("../lib/Zend/Db/Table.php");
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
				self::$db = new PDO("mysql:host=".MYSQL_HOST.";
										dbname=".MYSQL_DB,
										MYSQL_USER,
										MYSQL_PASS);
			}
			catch(Exeptions $e)
			{
				die("Datenbank Verbindung fehlgeschlagen");
			}
		}
		return self::$db;
	}
}