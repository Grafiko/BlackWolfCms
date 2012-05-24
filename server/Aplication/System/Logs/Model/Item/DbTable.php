<?php
class System_Logs_Model_Item_DbTable extends Db_Table_Abstract
{
	protected $_name			= 'log';
	protected $_primary		= 'id';
	protected $_rowClass		= 'System_Logs_Model_Item_Row';
	protected $_rowsetClass	= 'System_Logs_Model_Item_Rowset';
	protected $_mapperClass	= 'System_Logs_Model_Item_Mapper';
}