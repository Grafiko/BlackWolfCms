<?php
class Module_Files_Model_Item_DbTable extends Db_Table_Abstract
{
	protected $_name					= 'files_item';
	protected $_primary				= 'id';
	protected $_rowClass				= 'Module_Files_Model_Item_Row';
	protected $_rowsetClass			= 'Module_Files_Model_Item_Rowset';
	protected $_mapperClass			= 'Module_Files_Model_Item_Mapper';
	protected $_dependentTables	= array();
}