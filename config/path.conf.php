<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
$dir	= explode("config", dirname(__FILE__));

define("PATH_MAIN",				$dir[0]);
define("PATH_LIB",				PATH_MAIN."lib/");
define("PATH_CLASS",			PATH_LIB."class/");
define("PATH_IMPLEMENTS",		PATH_LIB."implements/");
define("PATH_EXTENSION",		PATH_LIB."extension/");
define("PATH_APP",				PATH_MAIN."app/");
define("PATH_CONTROLLER",		PATH_APP."controller/");
define("PATH_TPL",				PATH_MAIN."template/");

define("LINK_MAIN",				"http://impeesa/");
define("LINK_ACP",				LINK_MAIN."acp/");
define("LINK_CSS",				"template-default-css-");
define("LINK_JS",				"template-default-js-");
