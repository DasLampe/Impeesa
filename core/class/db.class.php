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
				self::$db = Zend_Db::factory('Pdo_Mysql', array(
	                                                   'host'     => MYSQL_HOST,
	                                                   'username' => MYSQL_USER,
	                                                   'password' => MYSQL_PASS,
	                                                   'dbname'   => MYSQL_DB
	            ));
			}
			catch(Exeptions $e)
			{
				die("Datenbank Verbindung fehlgeschlagen");
			}
		}
		return self::$db;
	}
}