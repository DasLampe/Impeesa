<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once("../config/path.conf.php");

session_start();
set_include_path(PATH_MAIN."lib/" . PATH_SEPARATOR . get_include_path());

//Core Klassen
require_once(PATH_CORE_CLASS."db.class.php");
require_once(PATH_CORE_CLASS."siteConfig.class.php");
require_once(PATH_CORE_CLASS."template.class.php");
require_once(PATH_CORE_CLASS."user.class.php");
require_once(PATH_CORE_CLASS."rights.class.php");
require_once(PATH_CORE_VIEW."defaultView.class.php");
require_once(PATH_CORE_VIEW."exceptionView.class.php");
require_once(PATH_CORE_EXCEPTION."error404Exception.class.php");
require_once(PATH_CORE_EXCEPTION."errorRightsException.class.php");
require_once(PATH_CORE_UTIL."ImpeesaHelper.class.php");
