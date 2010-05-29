<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaPictureGallery
{
	private $tplFolder;
	
	public function __construct()
	{
		$this->tplFolder	= impeesaHelper::dirUp(1, dirname(__FILE__))."template/";
	}
	
	function getContent($contentId)
	{
		global $param;
		
		if(!isset($param[2]) || ($param[2] == "gallery" && !isset($param[3])))
		{
			return $this->getMainGallery();	
		}
		elseif($param[2] == "gallery" && isset($param[3]))
		{
			return $this->getGallery();
		}
	}
	
	private function getMainGallery()
	{
		$tpl	= impeesaTemplate::getInstance();
		$tpl->vars("LINK_SITE",		LINK_MAIN.$_GET['get'].'/gallery/');
				
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
					$jahr	= $dir_anz[0];
				}
				$dir_anz[1]	= impeesaHelper::convertPictureDir($dir_anz[1], "decode");
				
				$bilder_daten[$jahr][]	= array("dir" => $dir, "dir_anz" => $dir_anz[1]);
			}
		}
		
		krsort($bilder_daten);
		
		$gallery	= "";
		foreach($bilder_daten as $bilderjahr=>$value)
		{
			$galleryLink	= "";
			foreach($value as $info)
			{
				$tpl->vars("galleryDir", 		$info['dir']);
				$tpl->vars("galleryName",		$info['dir_anz']);

				$galleryLink .= $tpl->load("_galerieLink", 0, $this->tplFolder);
			}
			
			$tpl->vars("year",			$bilderjahr);
			$tpl->vars("galleryLink",	$galleryLink);
			$gallery	.= $tpl->load("galleryMain", 0, $this->tplFolder);
		}
		
		return $gallery;	
	}
	
	private function getGallery()
	{
		global $param;
		
		$tpl	= impeesaTemplate::getInstance();
		$tpl->addCss("pictureAcp.css",		"lib-extension-impeesaPicture-template-css-");
		$tpl->addJs("jquery.lightbox",		"lib-extension-impeesaPicture-lib-js-");
		$tpl->addCSS("jquery.lightbox.css",	"lib-extension-impeesaPicture-template-css-");
		$tpl->addJs("picture",				"lib-extension-impeesaPicture-template-js-");

		$tpl->vars("LINK_SITE",		LINK_MAIN.$_GET['get']);
				
		if(file_exists(PATH_PICTURE.$param[3]))
		{ //Wenn Ordner existiert
	
			/* Ordner auslesen */
			$bilder		= array();
			$handle		= opendir(PATH_PICTURE.$param[3]);
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
					$headline	= explode("_", $param[3], 2);
					$tpl->vars("Link2Picture",	LINK_MAIN."picture/".$param[3].'/'.$picture);
					$tpl->vars("thumbmail",	"lib/extension/impeesaPicture/lib/thumb.php?dir=".$param[3]."&pic=".$picture);
					$pictures	.= $tpl->load("_pictureBlock", 0, $this->tplFolder);
				}
				
				$tpl->vars("headline",		impeesaHelper::convertPictureDir($headline[1], "decode"));
				$tpl->vars("pictures", $pictures);
				return $tpl->load("gallery", 0, $this->tplFolder);
			}
			else
			{
				$tpl->vars("headline",	"Keine Bilder");
				$tpl->vars("errorDescription",	"In diesem Ordner sind keine Bilder vorhanden");
				return $tpl->load("_defaultError", 0);
			}
		}
	} 
}