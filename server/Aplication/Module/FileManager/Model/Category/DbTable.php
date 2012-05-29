<?php
class Module_FileManager_Model_Category_DbTable extends Db_Table_Lang_Abstract
{
	protected $_name			= 'files_category';
	protected $_name_i18n	= 'files_category_i18n';
	protected $_primary		= 'id';
	protected $_rowClass		= 'Module_FileManager_Model_Category_Row';
	protected $_rowsetClass	= 'Module_FileManager_Model_Category_Rowset';
	protected $_mapperClass	= 'Module_FileManager_Model_Category_Mapper';
	protected $lang_fields	= array('name', 'description');
}