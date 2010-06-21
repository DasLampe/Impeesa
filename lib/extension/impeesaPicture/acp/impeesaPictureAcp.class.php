<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaPictureAcp
{
	private $tplFolder;
	
	public function __construct()
	{
		$this->tplFolder	= impeesaHelper::dirUp(1, dirname(__FILE__))."template/acp/";
	}
	
	public function getContent()
	{
		global $param;
		$rightFail	= true;
		
		if(!isset($param[2]))
		{
			return $this->getMainPage();
		}
		elseif($param[2] == "upload" && impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 2))
		{
			return $this->uploadPicture();
		}
		elseif($param[2] == "editPicture" && impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3))
		{
			return $this->editPicture();
		}
		
		if($rightFail	=== true)
		{
			return impeesaException::error('no_rights');
		}
	}
	
	/**
	 * Request mit Ajax
	 * @return string (Template (json))
	 */
	public function ajaxRequest()
	{
		global $param;
		
		if(isset($param[2]) && impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 2))
		{
			if(method_exists($this, $param[2]))
			{
				define('AJAX', true);
				$return	= $this->$param[2]();
				return impeesaHelper::json_encode($return);
			}
			else
			{
				$array	= array('msg' => impeesaException::error("no_method"),
							'status'	=> false);
				return impeesaHelper::json_encode($array);
			}
		}
		else
		{
			$array	= array('msg'		=> impeesaException::error("wrong_request"),
							'status'	=> false);
			return impeesaHelper::json_encode($array);
		}
	}
	
	private function getMainPage()
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->addCss("pictureAcp.css", "lib-extension-impeesaPicture-template-css-");
		$tpl->vars("LINK_SITE", LINK_MAIN.$_GET['get']);
		$tpl->vars("galerieOption",		$this->getGalerie());
		$tpl->addJS("pictureAcp", "lib-extension-impeesaPicture-template-js-");
		
		return $tpl->load("mainPage", 0, $this->tplFolder);
	}
	
	private function uploadPicture()
	{
		global $param;
		$tpl	= impeesaTemplate::getInstance();
		
		if(!isset($param[3]) || $param[3] != "upload")
		{
			$_SESSION['impeesaPicture_dirName']		= $param[3];
			$tpl->addCss("pictureAcp.css",		"lib-extension-impeesaPicture-template-css-");	
			
			$tpl->vars("form", $tpl->load("_uploadForm", 0, $this->tplFolder));
			
			return $tpl->load("upload", 0, $this->tplFolder);
		}
	}
	
	private function addDir()
	{		
		if(empty($_POST['newDir']) || empty($_POST['newDirYear']) || !preg_match('/[0-9]{4}/', $_POST['newDirYear']))
		{
			$array	= array("msg"		=> "Bitte alle Felder (richtig) ausfüllen!",
							"status"	=> false);
			return $array;
		}
		else
		{
			$newDir		= impeesaHelper::convertPictureDir($_POST['newDir'], "encode");
			
			if(file_exists(PATH_PICTURE.$_POST['newDirYear'].'_'.$newDir))
			{
				$array	= array("msg"		=> "Ordner existiert bereits!",
								"status"	=> false);
				return $array;
			}
			else
			{
				if(mkdir(PATH_PICTURE.$_POST['newDirYear'].'_'.$newDir, 0777) === true)
				{
					$array	= array("msg"		=> "Ordner wurder erfolgreich erstellt!",
									"dir"		=> $_POST['newDirYear'].'_'.$newDir,
									"status"	=> true);
					return $array;
				}
				else
				{
					$array	= array("msg"		=> "Ordner konnte nicht erstellt werden!",
									"status"	=> false);
					return $array;
				}
			}
		}
	}
	
	private function delDir()
	{
		global $param;
		
		if(file_exists(PATH_PICTURE.$param[3]) && is_dir(PATH_PICTURE.$param[3]) && impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3))
		{
			$this->delDirRecursiv(PATH_PICTURE.$param[3]);
			
			$array	= array("msg"		=> "Order erfolgreich gelöscht!",
							"status"	=> true);
		}
		else
		{
			$array	= array("msg"		=> "Fehler beim löschen",
							"status"	=> false);			
		}
		
		return $array;
	}
	
	private function delDirRecursiv($dir)
	{
		$files = glob( $dir . '*', GLOB_MARK );
		foreach( $files as $file )
		{
			if( is_dir( $file ) )
			{
				$this->delDirRecursiv( $file );
			}
			else
			{
				unlink( $file );
			}
		}
		if (is_dir($dir))
		{
			rmdir( $dir );	
		}
	}
	
	private function editPicture()
	{
		global $param;
		$tpl	= impeesaTemplate::getInstance();
		$tpl->vars("LINK_SITE",		LINK_MAIN.$_GET['get']);
				
		if(isset($_POST['action']) && $_POST['action'] == "getGalerie")
		{
			if(file_exists(PATH_PICTURE.$_POST['dir']))
			{ //Wenn Ordner existiert
		
				/* Ordner auslesen */
				$bilder		= array();
				$handle		= opendir(PATH_PICTURE.$_POST['dir']);
				while(false !== ($file	= readdir($handle)))
				{
					if(preg_match("/.(jpg|jpeg)$/i",$file))
					{ //Wenn Datei ein Bild ist, dann schreibe diesen Namen in die Array
						$bilder[]	= $file;
					}
				}
				
				sort($bilder);
				
				if(!empty($bilder))
				{
					$pictures	= "";
					/* Bilder ausgeben */
					foreach($bilder as $picture)
					{
						$tpl->vars("picture",	LINK_MAIN."picture/".$_POST['dir'].'/'.$picture);
						$tpl->vars("thumbmail",	"lib/extension/impeesaPicture/lib/thumb.php?dir=".$_POST['dir']."&pic=".$picture);
						$tpl->vars("pictureName",	$picture);
						$tpl->vars("dirName",		$_POST['dir']);
						$pictures	.= $tpl->load("_pictureBlock", 0, $this->tplFolder);
					}
					
					$array	= array("msg"		=> $pictures,
									"status"	=> true);
				}
				else
				{
					$array	= array("msg"		=> "Es sind keine Bilder in diesem Ordner vorhanden",
									"status"	=> false);
				}
				return $array;
			}
		}
		elseif((isset($param[3]) && $param[3] == "del") && impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3))
		{
			if(file_exists(PATH_PICTURE.$param[4]) && is_dir(PATH_PICTURE.$param[4]) && file_exists(PATH_PICTURE.$param[4].'/'.$param[5]))
			{
				unlink(PATH_PICTURE.$param[4].'/'.$param[5]);
				
				$array		= array("msg"		=> "Löschen des Bildes erfolgreich!",
									"status"	=> true);
			}
			else
			{
				$array	= array("msg"		=> "Löschen des Bildes fehlgeschlagen!",
								"status"	=> false);
			}
			
			return $array;
		}
	}
	
	private function getGalerie()
	{
		$tpl	= impeesaTemplate::getInstance();
				
		/* Ordner auslesen */
		$jahr		= '';
		$handle		= opendir(PATH_PICTURE);
		while(false !== ($dir	= readdir($handle)))
		{
			if(preg_match('/[0-9]{4}_(.*)/', $dir))
			{
				$dir_anz	= explode('_', $dir, 2);
				if($jahr != $dir_anz[0])
				{
					#$bilder_daten[$dir_anz[0]][]	= array("jahr"=>$dir_anz[0]);
					$jahr	= $dir_anz[0];
				}
				$dir_anz[1]	= impeesaHelper::convertPictureDir($dir_anz[1], "decode");
				
				$bilder_daten[$jahr][]	= array("dir" => $dir, "dir_anz" => $dir_anz[1]);
			}
		}
		
		krsort($bilder_daten);
		
		$galerieOption	= "";
		foreach($bilder_daten as $bilderjahr=>$value)
		{
			foreach($value as $info)
				{
					$tpl->vars("value", 		$info['dir']);
					$tpl->vars("year",			$bilderjahr);
					$tpl->vars("description",	$info['dir_anz']);

					$galerieOption	.= $tpl->load("_galerieOption", 0, $this->tplFolder);
				}
		}
		
		return $galerieOption;
	}
	
	private function editPosition()
	{
		if(file_exists(PATH_PICTURE.$_POST['dir'].'/'.$_POST['now']))
		{
			$newName	= substr($_POST['next'],0,4);
			$newName	= $newName - 1;
			$newName	= str_replace(substr($_POST['next'], 0,4), $newName, $_POST['next']);
			rename(PATH_PICTURE.$_POST['dir'].'/'.$_POST['now'], PATH_PICTURE.$_POST['dir'].'/'.$newName);
			
			$array		= array("msg"		=> "Verschiebung gespeichert!",
								"newName"	=> $newName,
								"newThumb"	=> LINK_MAIN.'lib/extension/impeesaPicture/lib/thumb.php?dir='.$_POST['dir'].'&pic='.$newName,
								"status"	=> true);
		}
		else
		{
		 	$array		= array("msg"		=> "Fehler beim Speichern",
		 						"newName"	=> $_POST['now'],
		 						"newThumb"	=>  LINK_MAIN.'lib/extension/impeesaPicture/lib/thumb.php?dir='.$_POST['dir'].'&pic='.$_POST['now'],
		 						"status"	=> false); 
		}
		return $array;
	}
}