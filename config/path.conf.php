<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
$dir	= explode("config", dirname(__FILE__));

define("PATH_MAIN",				$dir[0]);
define("PATH_CORE", 			PATH_MAIN."core/");
define("PATH_CORE_CLASS",		PATH_CORE."class/");
define("PATH_CORE_VIEW",		PATH_CORE."view/");
define("PATH_CORE_UTIL",		PATH_CORE."utils/");
define("PATH_CORE_EXCEPTION",	PATH_CORE."exceptions/");
define("PATH_CORE_CONTROLLER",	PATH_CORE."controller/");
define("PATH_EXTENSION",		PATH_MAIN."extension/");
define("PATH_TPL",				PATH_MAIN."template/");

define("LINK_MAIN",				"http://impeesa/");
