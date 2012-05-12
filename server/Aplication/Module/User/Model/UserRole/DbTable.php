<?php
class Module_User_Model_UserRole_DbTable extends Db_Table_Abstract
{
	protected $_name					= 'user_role';
	protected $_primary				= 'id';
	protected $_rowClass				= 'Module_User_Model_UserRole_Row';
	protected $_rowsetClass			= 'Module_User_Model_UserRole_Rowset';
	protected $_mapperClass			= 'Module_User_Model_UserRole_Mapper';
	protected $_dependentTables	= array('Module_User_Model_User_DbTable');
}