<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(PATH_CORE_UTIL."IController.class.php");
require_once(PATH_CORE_VIEW."defaultView.class.php");

class pageController implements IController
{
	public function executeController($pageId)
	{
		if(empty($pageId))
		{
			throw new error404Exception();
		}
		
		$rights		= new rights();
		
		$pageView		= $rights->pageview($pageId);

		if($pageView === false)
		{
			throw new errorRightsException();
		}
		
		$view	= impeesaTemplate::getInstance();
				
		$view	= new defaultView($pageId);
		$view->handle();
	}	
}