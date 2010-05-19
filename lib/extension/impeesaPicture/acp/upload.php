<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once("../../../../config/config.php");
require_once(PATH_CLASS."impeesaDB.class.php");
require_once(PATH_CLASS."impeesaUser.class.php");
require_once(PATH_CLASS."impeesaUserRights.class.php");

$db		= impeesaDB::getConnection();
$result	= $db->prepare("SELECT id
						FROM ".MYSQL_PREFIX."user
						WHERE phpSession = :phpSession");
$result->bindParam(':phpSession', $_POST['PHPSESSID']);
$result->execute();
$row	= $result->fetch(PDO::FETCH_ASSOC);

if($row['id'])
{
	$db	= impeesaDB::getConnection();
	
	$db->exec("INSERT INTO ".MYSQL_PREFIX."picture
				(test)
				VALUES
				('".$_SESSION['userId']."')");
	
	if(isset($_FILES['Filedata']))
	{
		//move_uploaded_file($_FILES['Filedata']['tmp_name'], PATH_UPLOAD.$_FILE['Filedata']['tmp_name']);
	}
}
else
{
	header("HTTP/1.1 500 File Upload Error");
	exit(0);
}