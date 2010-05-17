<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class newsAdd
{
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
	
	public function endDate($startDate, $endDate)
	{
		if($endDate	== "0")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}