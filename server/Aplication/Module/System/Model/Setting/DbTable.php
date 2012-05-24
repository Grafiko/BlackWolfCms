<?php
class Module_System_Model_Setting_DbTable extends Db_Table_Abstract
{
	protected $_name					= 'setting';
	protected $_primary				= 'id';
	protected $_rowClass				= 'Module_System_Model_Setting_Row';
	protected $_rowsetClass			= 'Module_System_Model_Setting_Rowset';
	protected $_mapperClass			= 'Module_System_Model_Setting_Mapper';
}