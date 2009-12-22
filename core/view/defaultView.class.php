<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(PATH_TPL."basePage.class.php");
require_once(PATH_CORE_UTIL."ContentTypeHelper.class.php");

class defaultView extends basePage
{
	protected function content()
	{
		$db			= ImpeesaDb::getConnection();
		$content	= impeesaTemplate::getInstance();

		$page_elements	= $db->fetchAll("SELECT * FROM ".MYSQL_PREFIX."page_elements WHERE pageid = ? AND viewport = ? ORDER BY position", array($this->pageId, 1));
		
		if(empty($page_elements))
		{
			throw new error404Exception();
		}
		
		$contentTypeHelper	= new ContentTypeHelper();
		$contentOutput		= "";
		
		foreach($page_elements as $elements)
		{
			$contenttype			= $contentTypeHelper->getForId($elements['contenttype']);
			$extension				= $contenttype['extension'];
			$contentExtensionClass	= $contenttype['extensionClass'];

			$extensionFile			= PATH_EXTENSION.$extension.DIRECTORY_SEPARATOR.$contentExtensionClass.".class.php";
			
			if(file_exists($extensionFile))
			{
				require_once($extensionFile);
				
				$extensionContent	= new $contentExtensionClass;
				$contentOutput		.= $extensionContent->drawExtension($this->pageId, $elements['contentid']);
			}
		}
		return $contentOutput;
	}
}