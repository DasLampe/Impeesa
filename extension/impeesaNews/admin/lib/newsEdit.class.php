<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class newsEdit extends impeesaNewsAdmin
{
	var $newsId;
	
	public function __construct($newsId)
	{
		$this->newsId	= $newsId;	
	}

}