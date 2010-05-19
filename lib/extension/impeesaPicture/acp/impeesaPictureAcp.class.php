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
	
	/**
	 * (non-PHPdoc)
	 * @see lib/implements/IExtension#getContent($contentId)
	 */
	public function getContent($contentId)
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
		elseif($param[2] == "edit" && impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 3))
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
		
		$tpl->vars("LINK_SITE", LINK_MAIN.$_GET['get']);
		$tpl->vars("galerieOption",		$this->getGalerie());
		$tpl->addJS("pictureAcp", "lib-extension-impeesaPicture-template-js-");
		
		return $tpl->load("mainPage", 0, $this->tplFolder);
	}
	
	private function uploadPicture()
	{
		$tpl	= impeesaTemplate::getInstance();
		$db		= impeesaDB::getConnection();
		
		$db->exec("INSERT INTO ".MYSQL_PREFIX."picture
				(test)
				VALUES
				('".$_POST['submit']."')");
		
		if(!isset($param[3]) || $param[3] != "upload")
		{
			$tpl->addJs("swfupload", "lib-extension-impeesaPicture-lib-swfupload-");
			$tpl->addJs("swfupload.queue", "lib-extension-impeesaPicture-lib-js-");
			$tpl->addJs("fileprogress", "lib-extension-impeesaPicture-lib-js-");
			$tpl->addJs("handlers", "lib-extension-impeesaPicture-lib-js-");
			$tpl->addJs("_uploadConfig", "lib-extension-impeesaPicture-lib-");			
			
			$tpl->vars("form", $tpl->load("_uploadForm", 0, $this->tplFolder));
			
			$db->exec("INSERT INTO ".MYSQL_PREFIX."picture
						(test)
						VALUES
						('FAIL!!')");
			return $tpl->load("upload", 0, $this->tplFolder);
		}
		else
		{
			/**
			 * @TODO: Überprüfen ob es eie möglichkeit gibt, einen Ordner einzutragen in welchen die Bilder geladen werden! index.php beachten
			 * @var unknown_type
			 */
			$db->exec("INSERT INTO ".MYSQL_PREFIX."picture
						(test)
						VALUES
						('OK!')");
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
			$newDir		= $this->convertPictureDir($_POST['newDir'], "encode");
			
			if(file_exists(PATH_PICTURE.$_POST['newDirYear'].'_'.$newDir))
			{
				$array	= array("msg"		=> "Ordner existiert bereits!",
								"status"	=> false);
				return $array;
			}
			else
			{
				if(mkdir(PATH_PICTURE.$_POST['newDirYear'].'_'.$newDir) === true)
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
	
	private function editPicture()
	{
		$tpl	= impeesaTemplate::getInstance();
		if($_POST['action'] == "getGalerie")
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
					$picture	= "";
					/* Bilder ausgeben */
					for($x=0;$x<count($bilder);$x++)
					{
						$tpl->vars("picture",	LINK_MAIN."picture/".$bilder[$x]);
						$tpl->vars("thumbmail",	"lib/extension/impeesaPicture/lib/thumb.php?dir=".$_POST['dir']."&pic=".$bilder[$x]);
						$picture	.= $tpl->load("_pictureBlock", 0, $this->tplFolder);
					}
					
					$array	= array("msg"		=> $picture,
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
	}
	
	private function convertPictureDir($name, $action="encode")
	{		
		/* Konfiguration */
		$system	= array('_','oe','ae','ue','Oe','Ae','Ue',);
		$user	= array(' ','ö','ä','ü','Ö','Ä','Ü');
		
		if($action == "decode")
		{
			$name	= str_replace($system, $user, $name);		
		}
		elseif($action == "encode")
		{
			$name	= str_replace($user, $system, $name);
		}
		
		return $name;					
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
				$dir_anz[1]	= $this->convertPictureDir($dir_anz[1], "decode");
				
				$bilder_daten[$jahr][]	= array("dir" => $dir, "dir_anz" => $dir_anz[1]);
			}
		}
		
		krsort($bilder_daten);
		
		$galerieOption	= "";
		foreach($bilder_daten as $bilderjahr=>$value)
		{
			for($x=0;$x<count($value);$x++)
				{
					$tpl->vars("value", 		$value[$x]['dir']);
					$tpl->vars("year",			$bilderjahr);
					$tpl->vars("description",	$value[$x]['dir_anz']);

					$galerieOption	.= $tpl->load("_galerieOption", 0, $this->tplFolder);
				}
		}
		
		return $galerieOption;
	}
}