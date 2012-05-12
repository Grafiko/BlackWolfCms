<?php
class Module_User_Model_UserArchiveLogin_DbTable extends Db_Table_Abstract
{
	protected $_name					= 'user_archive_login';
	protected $_primary				= 'id';
	protected $_rowClass				= 'Module_User_Model_UserArchiveLogin_Row';
	protected $_rowsetClass			= 'Module_User_Model_UserArchiveLogin_Rowset';
	protected $_mapperClass			= 'Module_User_Model_UserArchiveLogin_Mapper';
}