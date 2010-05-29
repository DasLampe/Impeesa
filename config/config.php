<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
error_reporting(E_ALL);
include_once(dirname(__FILE__)."/database.conf.php");
include_once(dirname(__FILE__)."/path.conf.php");

session_start();
header('Content-Type: text/html; charset=utf-8');