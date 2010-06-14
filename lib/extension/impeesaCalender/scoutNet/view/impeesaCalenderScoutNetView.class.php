<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaCalenderScoutNetView
{
	private $tplFolder;
	
	public function __construct()
	{
		$this->tplFolder	= impeesaHelper::dirUp(1, dirname(__FILE__))."template/";
	}
	
	public function getContent()
	{
		global $param;
		$tpl			= impeesaTemplate::getInstance();
		require_once(impeesaHelper::dirUp(1, dirname(__FILE__)).'calender.func.php');
		
		$appointments	= $this->getAppointments(getCalenderId());
	
		$appointmentsBlock	= "";
		foreach($appointments as $appointment)
		{
			$startDate	= $this->getDate($appointment->SDate);
			$endDate	= $this->getDate($appointment->EDate);
			if($this->getMktime($appointment->EDate) > time())
			{
				$tpl->vars("startDate",			$startDate);
				$tpl->vars("endDate",			$endDate);
				$tpl->vars("appointmentId",		$appointment->Id);
				$tpl->vars("title",				$appointment->Title);
				$tpl->vars("groups",			$appointment->Section);
				$tpl->vars("category",			$appointment->Category);
				$tpl->vars("info",				$appointment->Info);
				
				$appointmentsBlock	.= $tpl->load("_appointmentBlock", 0, $this->tplFolder);
			}
			$tpl->vars("appointmentsBlock",		$appointmentsBlock);
		}
		
		return $tpl->load("calender", 0, $this->tplFolder);
	}
	
	private function getAppointments($calenderId)
	{
		$calenderUrl	= "http://kalender.scoutnet.de/2.0/show.php?id=".$calenderId."&template=export/xml2.tpl";
		return simplexml_load_file($calenderUrl);
	}
	
	private function getDate($dateString)
	{
		$date	=    explode("-",$dateString);
    	return sprintf("%02d.%02d.%02d", $date[2], $date[1], $date[0]);
	}
	
	private function getMktime($dateString)
	{
		$date	=    explode("-",$dateString);
		return mktime(0,0,0,$date[1],$date[2],$date[0]);		
	}
}