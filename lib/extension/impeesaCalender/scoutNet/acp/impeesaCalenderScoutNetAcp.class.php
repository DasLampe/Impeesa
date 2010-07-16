<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaCalenderScoutNetAcp
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
		
		if(impeesaUserRights::hasRights($_SESSION['userId'], impeesaHelper::getSiteId($param[1]), 1) === true)
		{
			if(!isset($param[2]))
			{
				return $this->getForm();				
			}
			elseif($param[2] == "save")
			{
				return $this->setId($_POST['calenderId']);
			}
			else
			{
				return impeesaException::error("wrong_url");
			}
		}
		
		if($rightFail = true)
		{
			return impeesaException::error("no_rights"); 
		}
	}
	
	private function getForm()
	{
		require_once(impeesaHelper::dirUp(1, dirname(__FILE__)).'calender.func.php');
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->vars("LINK_SITE",		LINK_MAIN.$_GET['get']);
		$tpl->vars("calenderId",	getCalenderId());
		return $tpl->load("editForm", 0, $this->tplFolder);
	}
	
	private function setId($calenderId)
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$file	= fopen(impeesaHelper::dirUp(1, dirname(__FILE__)).'calenderId.conf', 'w');
		fwrite($file, $calenderId);
		fclose($file);
		
		impeesaLog::insertLog(dirname(__FILE__), "UPDATE calederId:".$calenderId);	
		
		$tpl->vars("headline", "Kalender Verwalten");
		$tpl->vars("contentBlock",	'<p class="successful">Id wurde gespeichert!</p>');
		return $tpl->load("_defaultPage", 0);
	}
}