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
$result->bindParam(':phpSession', $_GET['PHPSESSID']);
$result->execute();
$row	= $result->fetch(PDO::FETCH_ASSOC);

if($row['id'])
{
	foreach($_FILES as $tagName => $fileInfo)
	{

		//Prefix für jedes Bild erstellen
		$fileInfo['name']	= '9999'.$fileInfo['name'];
		
		if(!file_exists(PATH_PICTURE.$_GET['dirName'].'/'.$fileInfo['name']))
		{
			//Ist Datei erlaubt?
			$extensionWhitelist = array("jpg", "jpeg", "JPG", "JPEG");
			$pathinfo 			= pathinfo($fileInfo['name']);
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
				$imageInfo	= getimagesize($fileInfo['tmp_name']);
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
					$oldPic			= ImageCreateFromJPEG($fileInfo['tmp_name']);
					$newPic			= imagecreatetruecolor($newWidth,$newHeight);
					imagecopyresampled($newPic,$oldPic,0,0,0,0,$newWidth,$newHeight,$imageInfo[0],$imageInfo[1]);
					ImageJPEG($newPic, PATH_PICTURE.$_GET['dirName'].'/'.$fileInfo['name']);
				}
				else
				{
					//Führe Datei upload aus
					move_uploaded_file($fileInfo['tmp_name'], PATH_PICTURE.$_GET['dirName'].'/'.$fileInfo['name']);
				}
				//header("HTTP/1.1 200 OK");
				//return true;
			}
			else
			{
				//header("HTTP/1.1 500 File Upload Error");
				//echo 'Angebene Datei nicht erlaubt!';
				//exit(0);
			}
		}
	}
}