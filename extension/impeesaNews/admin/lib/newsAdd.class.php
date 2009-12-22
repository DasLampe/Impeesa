<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once("newsTags.class.php");

class newsAdd extends impeesaNewsAdmin
{
	private $newsTags;
	
	public function __construct()
	{
		$this->newsTags = new newsTags();
	}
	
	/**
	 * Überprüfen ob Einträge aus Array leer sind, wenn leer = false
	 * Array => newsHeadline, newsContent, startDate
	 * @param array $data
	 * @return boolean
	 */
	public function dataComplete($data)
	{
		if(empty($data['newsHeadline']) || empty($data['newsContent']) || empty($data['startDate']))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function add2DB($data)
	{
		$db		= impeesaDB::getConnection();
		
		//Datum in Unix-Timestap konventieren
		$startDate	= $this->convertDate($data['startDate']);
		$endDate	= 0;
		if($data['endDate'] != 0)
		{ //Wenn Endzeit nicht unendlich
			$endDate	= $this->convertDate($data['endDate']);
		}
		
		//Daten eintragen
		$sql_data	= array(
							'newsContent'	=> $data['newsContent'],
							'newsHeadline'	=> $data['newsHeadline'],
							'startDate'		=> $startDate,
							'endDate'		=> $endDate,
							'userId'		=> $_SESSION['userId']
							);
		if($db->insert(MYSQL_PREFIX."news_content", $sql_data))
		{
			//Tags in Datenbank eintragen
			$this->newsTags->countUpTags($data['tags'], $db->lastInsertId(MYSQL_PREFIX.'newsContent'));
			return true;
		}
		else
		{
			return false;
		}
	}
}