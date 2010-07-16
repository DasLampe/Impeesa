<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaLog
{
	public static function insertLog($file, $message)
	{
		$db		= impeesaDb::getConnection();
		
		$db->exec("INSERT INTO ".MYSQL_PREFIX."log
					(modulFile, logMessage, logTime, userId)
					VALUES
					('".$file."', '".$message."', '".time()."', '".$_SESSION['userId']."')");
	}
}