<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once("../template/basePage.class.php");

class exceptionView extends basePage
{
	protected $pageContent;
	
	public function __construct($pageContent)
	{
		parent::__construct(0);
		$this->pageContent = $pageContent;
	}
	
	protected  function content()
	{
		$content	= impeesaTemplate::getInstance();
		$content->vars("content_output", $this->pageContent);
		
		return $content->load("_content_default", 0);	
	}
	
}