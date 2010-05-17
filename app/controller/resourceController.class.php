<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class resourceController
{
	public function __construct($file)
	{
		//$file	= explode("/", $file);
		$file	= str_replace("-", "/", $file);
		$type	= $this->getHeaderType($file);

		if(file_exists(PATH_MAIN.$file))
		{
			 header("Content-Type: ".$type);
			 readfile(PATH_MAIN.$file);
		}
		else
		{
			echo 'Datei ('.$file.') existiert nicht!';
		}
	}
	
	private function getHeaderType($file)
	{
		$type	= explode(".", $file[count($file)-1]);
		
		switch($type)
		{
			 case "css":
				$type = "text/css";
				break;
			case "jpg":
				$type = "image/jpg";
				break;
			case "png":
				$tpye = "image/png";
				break;
			case "js":
				$type = "text/javascript";
				break;
		}
	}
}