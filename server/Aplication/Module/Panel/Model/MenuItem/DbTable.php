<?php
class Module_Panel_Model_MenuItem_DbTable extends Db_Table_Lang_Abstract
{
	protected $_name			= 'admin_panel_menu_item';
	protected $_name_i18n	= 'admin_panel_menu_item_i18n';
	protected $_primary		= 'id';
	protected $_rowClass		= 'Module_Panel_Model_MenuItem_Row';
	protected $_rowsetClass	= 'Module_Panel_Model_MenuItem_Rowset';
	protected $_mapperClass	= 'Module_Panel_Model_MenuItem_Mapper';
	protected $lang_fields	= array('link_name', 'action_name', 'action_title');
}