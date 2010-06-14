<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
function getCalenderId()
{
	$file	= fopen(dirname(__FILE__).'/calenderId.conf', 'r');
	$calenderId	= fgets($file);
	fclose($file);
	
	return $calenderId;
}