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
			global $param;
			if(isset($_SERVER['HTTP_REFERER']))
			{
				$referer	= $_SERVER['HTTP_REFERER'];
			}
			else
			{
				$referer	= LINK_MAIN;
			}
			 header("Content-Type: ".$type);
			 //readfile(PATH_MAIN.$file); ---> Old Way
			 $content		= file_get_contents(PATH_MAIN.$file);
			 /**
			  * @TODO: Elegante Lösung für Param3 finden (Hack für impeesaPicture)
			  */
			 $search		= array(
			 						"%IMPEESA_MAIN_LINK%",
			 						"%IMPEESA_CSS_LINK%",
			 						"%IMPEESA_PARENT%",
			 						"%IMPEESA_SESSIONID%",
			 						"%IMPEESA_PARAM3%"
			 						);
			 $replace		= array(
			 						LINK_MAIN,
			 						LINK_CSS,
			 						$referer,
			 						session_id(),
			 						$_SESSION['impeesaPicture_dirName']
			 						);
			 $content		= str_replace($search, $replace, $content);
			 echo $content;
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