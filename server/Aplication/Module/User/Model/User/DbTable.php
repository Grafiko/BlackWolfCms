<?php
class Module_User_Model_User_DbTable extends Db_Table_Abstract
{
	protected $_name					= 'user';
	protected $_primary				= 'id';
	protected $_rowClass				= 'Module_User_Model_User_Row';
	protected $_rowsetClass			= 'Module_User_Model_User_Rowset';
	protected $_mapperClass			= 'Module_User_Model_User_Mapper';
	protected $_dependentTables	= array();

	protected $_referenceMap = array();
}