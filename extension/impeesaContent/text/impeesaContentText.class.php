<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(PATH_CORE_UTIL."IExtension.class.php");

class ImpeesaContentText implements IExtension
{
	function drawExtension($pageId, $contentid)
	{
		$content		= impeesaTemplate::getInstance();
		$db				= impeesaDb::getConnection();
		
		$content_output	= $db->fetchOne("SELECT content FROM ".MYSQL_PREFIX."content WHERE id = ?", array($contentid));
		
		$content->vars("content_output", $content_output);		

		return $content->load("_content_default", 0);
	}
}