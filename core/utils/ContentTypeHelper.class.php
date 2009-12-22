<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class ContentTypeHelper
{
	protected $contentTypes;
	
	public function __construct()
	{
		$db					= impeesaDb::getConnection();
		$this->contentTypes	= $db->fetchAll("SELECT * FROM ".MYSQL_PREFIX."contenttype");
	}
	
	public function getForId($id)
	{
		foreach($this->contentTypes as $contenttypes)
		{
			if($contenttypes['id'] == $id)
			{
				return $contenttypes;
			}
		}
	} 
}