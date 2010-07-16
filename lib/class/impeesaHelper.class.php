<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaHelper
{
	public static function existSite($pageName, $isAdminPage=0)
	{
		/**
		 * @TODO: Bessere Lösung finden
		 *
		global $param;
		
		$isAdminPage 		= 0;
		if($param[0] == "acp")
		{
			$isAdminPage	= 1;
		}*/
		
		$db		= impeesaDB::getConnection();
		$result	= $db->prepare("SELECT id
							FROM ".MYSQL_PREFIX."pageConfig
							WHERE siteName = :pageName
								AND isAdminPage = :isAdminPage");
		$result->bindParam(":pageName",		$pageName);
		$result->bindParam(":isAdminPage",	$isAdminPage);
		$result->execute();
		$row	= $result->fetch(PDO::FETCH_NUM);
		
		if(empty($row))
		{
			return false;
		}
		return true;
	}
	
	public static function getSiteId($sitename)
	{
		/**
		 * @TODO: Bessere Lösung finden
		 */
		global $param;
		
		$isAdminPage	= 0;
		if($param[0] == "acp")
		{
			$isAdminPage	= 1;
		}
		
		$db		= impeesaDB::getConnection();
		$result	= $db->query("SELECT id
							FROM ".MYSQL_PREFIX."pageConfig
							WHERE siteName = '".$sitename."'
								AND isAdminPage = '".$isAdminPage."'");
		$row	= $result->fetch(PDO::FETCH_ASSOC);
		
		return $row['id'];
	}
	
	public static function dirUp($level, $dirPath)
	{
		$dirPath	= explode(DIRECTORY_SEPARATOR, $dirPath);
		
		$newPath	= "";
		for($x=0;$x<count($dirPath)-$level;$x++)
		{
			$newPath	.= $dirPath[$x].'/'; 
		}
		
		return $newPath;
	}
	
	/**
	 * Ist User eingeloggt?
	 * @TODO: Nur noch als Hack, muss sauber gelöst weerden
	 * @return boolean
	 */
	public static function isLogin()
	{
		return impeesaUser::isLogin();
	}
	
	/**
	 * Encodiert String in JSON
	 * @param string $a
	 */
	public static function json_encode($a=false)
	{
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a))
		{
			if (is_float($a))
			{// Always use "." for floats.
				return floatval(str_replace(",", ".", strval($a)));
      		}

			if (is_string($a))
			{
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
			}
			else
			{
				return $a;
			}
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a))
		{
			if (key($a) !== $i)
			{
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList)
		{
			foreach ($a as $v) $result[] = self::json_encode($v);
			return '[' . join(',', $result) . ']';
		}
		else
		{
			foreach ($a as $k => $v) $result[] = self::json_encode($k).':'.self::json_encode($v);
			return '{' . join(',', $result) . '}';
		}
	}
	
	/**
	 * Erstelle Timestap aus Datum
	 * @param string $date
	 * @param string $format
	 */
	public static function getTimestap($date, $format="d.m.Y")
	{
		if($date != 0)
		{			
			if($format == "d.m.Y")
			{
				$date	= explode(".", $date);
				$date	= mktime(0,0,0,$date[1], $date[0], $date[2]);
			}
			elseif($format == "d.m.Y - H:i")
			{
				$date	= preg_split("/[.| - |:]/", $date, -1);
				$date	= mktime($date[4], $date[5], 0, $date[1], $date[0], $date[2]);
			}
		}
			
			return $date;
	}
	
	public static function createPermaLink($string)
	{
		$string	= filter_var($string, FILTER_SANITIZE_STRING);
		$string	= str_replace(array("!", "?", "_", "{", "}", "[", "]"), "", $string);
		$string	= trim($string);
		$string	= str_replace(" ", "-", $string);
		$string	= strToLower($string);

		return $string;
	}
	
	public static function convertPictureDir($name, $action="encode")
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
	
    public static function in_multiarray($elem, $array)
    {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while($bottom <= $top)
        {
            if($array[$bottom] == $elem)
                return true;
            else
                if(is_array($array[$bottom]))
                    if(self::in_multiarray($elem, ($array[$bottom])))
                        return true;
                   
            $bottom++;
        }
        return false;
    }
    
    public static function getPageModule($pageURI)
    {
    	$pageURI	= explode("/", $pageURI);
    	return $pageURI[0].'/'.$pageURI[1];
    }
    
    public static function validEmail($email)
    {
		if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
		{
			return true;
		}
		return false;
    }
}