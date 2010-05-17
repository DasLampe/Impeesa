<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class error404Exception extends Exception
{
	public function getContent()
	{
		$content	= impeesaTemplate::getInstance();
		return $content->load("error/404", 0);
	}
}