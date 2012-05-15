<?php
class Module_Language_Model_Language_DbTable extends Db_Table_Abstract
{
	protected $_name			= 'language';
	protected $_primary		= 'id';
	protected $_rowClass		= 'Module_Language_Model_Language_Row';
	protected $_rowsetClass	= 'Module_Language_Model_Language_Rowset';
	protected $_mapperClass	= 'Module_Language_Model_Language_Mapper';
}