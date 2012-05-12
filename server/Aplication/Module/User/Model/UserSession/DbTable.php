<?php
class Module_User_Model_UserSession_DbTable extends Db_Table_Abstract
{
	protected $_name					= 'user_session';
	protected $_primary				= 'session_id';
	protected $_rowClass				= 'Module_User_Model_UserSession_Row';
	protected $_rowsetClass			= 'Module_User_Model_UserSession_Rowset';
	protected $_mapperClass			= 'Module_User_Model_UserSession_Mapper';
	protected $_dependentTables	= array();

	protected $_referenceMap = array(
		'User' => array(
			'columns'           => 'user_id',
			'refTableClass'     => 'Module_User_Model_User_DbTable',
			'refColumns'        => 'id',
			'onDelete'          => self::CASCADE,
			'onUpdate'          => self::CASCADE
		)
	);
}