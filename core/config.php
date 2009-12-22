<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once("../config/path.conf.php");

session_start();
set_include_path(PATH_MAIN."lib/" . PATH_SEPARATOR . get_include_path());