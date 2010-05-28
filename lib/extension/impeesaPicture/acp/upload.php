<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
error_reporting(E_ALL);
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

			$db->exec("INSERT INTO ".MYSQL_PREFIX."picture
						(test) VALUES ('".time()."')");
if($row['id'] && $_FILES['Filedata']['error'] == 0)
{	
	if(!file_exists(PATH_PICTURE.$_POST['dirName'].'/'.$_FILES['Filedata']['name']))
	{
		//Ist Datei erlaubt?
		$extensionWhitelist = array("jpg", "jpeg", "JPG", "JPEG");
		$pathinfo 			= pathinfo($_FILES['Filedata']['name']);
		print_r($pathinfo);
		$fileExtension 		= $pathinfo["extension"];
		$isValidExtension	= false;
		foreach ($extensionWhitelist as $extension)
		{
			if (strcasecmp($fileExtension, $extension) == 0)
			{
				$isValidExtension = true;
				break;
			}
		}
		

		if($isValidExtension === true)
		{
			//Bild zu groß?
			$imageInfo	= getimagesize($_FILES['Filedata']['tmp_name']);
			if(($imageInfo[0] > 640 || $imageInfo[1] > 480) || ($imageInfo[0] > 360 || $imageInfo[1] > 480))
			{
				//Ist Bild Hochkant?
				if($imageInfo[0] < $imageInfo[1])
				{
					$newWidth	= 360;
					$newHeight	= 480;
				}
				else
				{
					$newWidth	= 640;
					$newHeight	= 480;
				}
				
				//Verkleinern
				$oldPic			= ImageCreateFromJPEG($_FILES['Filedata']['tmp_name']);
				$newPic			= imagecreatetruecolor($newWidth,$newHeight);
				imagecopyresampled($newPic,$oldPic,0,0,0,0,$newWidth,$newHeight,$imageInfo[0],$imageInfo[1]);
				ImageJPEG($newPic, PATH_PICTURE.$_POST['dirName'].'/'.$_FILES['Filedata']['name']);
			}
			else
			{
				//Führe Datei upload aus
				move_uploaded_file($_FILES['Filedata']['tmp_name'], PATH_PICTURE.$_POST['dirName'].'/'.$_FILES['Filedata']['name']);
			}
		}
		else
		{
			echo 'Angebene Datei nicht erlaubt!';
			//header("HTTP/1.1 500 File Upload Error");
			echo 'Angebene Datei nicht erlaubt!';
			exit(0);
		}

	}
}
else
{
	header("HTTP/1.1 500 File Upload Error");
	exit(0);
}