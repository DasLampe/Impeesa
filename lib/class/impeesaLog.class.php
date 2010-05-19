<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaLog
{
	function insertLog($file, $message, $userId)
	{
		$db		= impeesaDb::getConnection();
		
		$db->exec("INSERT INTO ".MYSQL_PREFIX."log
					(modulFile, logMessage, logTime, userId)
					VALUES
					('".$file."', '".$message."', '".time()."', '".$userId."')");
	}
}