<?php
class Module_Panel_Model_Menu_DbTable extends Db_Table_Lang_Abstract
{
	protected $_name			= 'admin_panel_menu';
	protected $_name_i18n	= 'admin_panel_menu_i18n';
	protected $_primary		= 'id';
	protected $_rowClass		= 'Module_Panel_Model_Menu_Row';
	protected $_rowsetClass	= 'Module_Panel_Model_Menu_Rowset';
	protected $_mapperClass	= 'Module_Panel_Model_Menu_Mapper';
	protected $lang_fields	= array('name');
}