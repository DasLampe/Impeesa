<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaException
{
	private function __construct()
	{
	}
	
	public static function error($errorDescription)
	{
		$tpl	= impeesaTemplate::getInstance();
		
		$tpl->vars("headline", "Fehler");
		$tpl->vars("errorDescription", $errorDescription);
		
		return $tpl->load("_defaultError", 0);		
	}
}