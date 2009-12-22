<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(PATH_CORE_UTIL."IExtension.class.php");

class impeesaNewsAdmin implements IExtension
{
	private $newsAdd;
	private $newsDelete;
	private $newsEdit;
	
	public function drawExtension($pageId, $contentid)
	{
		$db			= impeesaDB::getConnection();
		$uri		= $db->fetchOne("SELECT uri FROM ".MYSQL_PREFIX."page_config WHERE id = ?", array($pageId));
		
		if($uri != $_GET['file'])
		{
			$action		= explode($uri.'/', $_GET['file']);
			$action		= explode("/", $action[1]);	
			//$action[]	= str_replace('/', '', $action[0]);
		
			switch($action[0])
			{
				case 'add':
					$return = $this->mainAdd();
					break;
				case 'del':
					$return = $this->mainDel();
					break;
				case 'edit':
					$return = $this->mainEdit();
					break;
				default:
					$return = $this->mainNews();
					break;
			}
		}
		else
		{
			$return	= $this->mainNews();
		}		
		return $return;
	}
	
	private function mainAdd()
	{
		include_once(dirname(__FILE__)."/lib/newsAdd.class.php");
		$this->newsAdd	= new newsAdd();
			
		$tpl		= impeesaTemplate::getInstance();
		$error		= true;
		$errormsg	= array();
		
		if(isset($_POST['submit']))
		{
			$error	= false;
			
			//Überprüfen ob Daten Komplett sind
			if($this->newsAdd->DataComplete($_POST) === false)
			{
				$errormsg[]		= "Bitte alle Felder ausfüllen!";
				$error			= true;
			}
			
			
			if($this->dateFormat($_POST['startDate'], $_POST['endDate']) === false)
			{
				$errormsg[]		= "Das Datums Format ist falsch!";
				$error			= true;	
			}
			else
			{
				//Ist End Zeit später als Startzeit
				if($this->endDate($_POST['startDate'], $_POST['endDate']) === false)
				{
					$errormsg[]		= "Die Endzeit darf nicht vor der Startzeit sein!";
					$error			= true;
				}
			}
		}
		
		if($error == true)
		{
			//Error Meldungen in Template füllen
			$error_msg		= "";
			for($x=0;$x<count($errormsg);$x++)
			{
				$tpl->vars("errorMsg", $errormsg[$x]);
				$error_msg	.=	$tpl->load("error/_list", 0);			
			}
			
			//Setzte Inhalt für Template Variablen
			if(isset($_POST['submit']))
			{
				$data	= array(
								"formAction"		=> $_GET['file'],
								"errorMsg"			=> $error_msg,
								"startDate" 		=> $_POST['startDate'],
								"endDate"			=> $_POST['endDate'],
								"tags"				=> $_POST['tags'],
								"newsHeadline"		=> $_POST['newsHeadline'],
								"newşContent"		=> $_POST['newsContent']
								);
			}
			else
			{
				$data	= array(
								"formAction"		=> $_GET['file']."/1",
								"errorMsg"			=> $error_msg,
								"startDate"			=> date("d.m.Y - H:i"),
								"endDate"			=> "0",
								"tags"				=> "",
								"newsHeadline"	=> "",
								"newşContent"		=> ""
								); 
			}
			
			//Fülle Template Variablen
			$data_key	= array_keys($data);
			$data_value	= array_values($data);
		
			for($i=0;$i<count($data);$i++)
			{
				$tpl->vars($data_key[$i], $data_value[$i]);
			}
			
			//Gebe Template zurück
			return $tpl->load("addForm", 0, PATH_EXTENSION."impeesaNews/template/admin/");
		}
		else
		{
			if($this->newsAdd->add2Db($_POST) === true)
			{
				return $tpl->load("addSuccess", 0, PATH_EXTENSION."impeesaNews/template/admin/");
			}
			else
			{
				return $tpl->load("addError", 0, PATH_EXTENSION."impeesaNews/template/admin/");
			}
		}
	}
	
	private function mainNews()
	{
		echo 'Jaja';
	}
	
	/**
	 * Sonstge Funktionen
	 */
	
	/**
	 * Datumsformat (d.m.Y - H:i) korrekt? ($endDate darf 0 sein)
	 * @param string $startDate
	 * @param string $endDate
	 * @return boolean
	 */
	private function dateFormat($startDate, $endDate)
	{
		if(($endDate == "0" ||
			preg_match("/[0-9]{2}.[0-9]{2}.[0-9]{4} - [0-9]{2}:[0-9]{2}/i", $endDate)) &&
			preg_match("/[0-9]{2}.[0-9]{2}.[0-9]{4} - [0-9]{2}:[0-9]{2}/i", $startDate))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Ist die Startzeit früher als Endzeit?
	 * @param string(d.m.Y - H:i) $startDate
	 * @param string(d.m.Y - H:i) $endDate
	 * @return boolean
	 */
	private function endDate($startDate, $endDate)
	{
		if($endDate == "0")
		{
			return true;
		}
		
		if($this->convertDate($endDate) <= $this->convertDate($startDate))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/**
	 * Umformen von Datums String (d.m.Y - H:i) in Unix-Timestap
	 * @param string $date
	 * @return integer
	 */
	protected function convertDate($date)
	{
		$date	= preg_split("/[(.|:| - |)]/", $date);
		$date	= mktime($date[4], $date[5], 0, $date[1], $date[0], $date[2]);

		return $date;
	}
}