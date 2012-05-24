<?php
abstract class Db_Table_Lang_Abstract extends Db_Table_Abstract
{
	protected $_language;

#---------------------------------------------------------------------------------------------------------

	public function __construct($config = array(), $definition = null)
	{
		$user_setting = Zend_Registry::get('user_setting');
		$this->_language = $user_setting->language;
		parent::__construct($config, $definition);
	}

#---------------------------------------------------------------------------------------------------------

	public function setLanguage($language)
	{
		$this->_language = $language;
	}

#---------------------------------------------------------------------------------------------------------

	public function getLanguage()
	{
		return $this->_language;
	}

#---------------------------------------------------------------------------------------------------------

	public function getLanguageTable()
	{
		return $this->_name_i18n;
	}

#---------------------------------------------------------------------------------------------------------

	public function select($withFromPart = self::SELECT_WITHOUT_FROM_PART)
	{
		$select = new Zend_Db_Table_Select($this);
		$select->setIntegrityCheck(false)
			->from(array('table' => $this->_name))
			->joinLeft(
				array('i18n' => $this->_name_i18n),
				"table.id = i18n.id AND i18n.language = '{$this->_language}'",
				$this->lang_fields
			);

		foreach($this->lang_fields as $field) {
			$select->columns("IF( (i18n.{$field} IS NULL), table.{$field}, i18n.{$field}) as {$field}");
		}

		return $select;
	}

#---------------------------------------------------------------------------------------------------------
}
//SELECT `t`.id, IFNULL(i18n.name,t.name) AS `name`, t.sort, t.is_removable FROM `admin_panel_menu` AS `t` LEFT JOIN `admin_panel_menu_i18n` AS `i18n` ON t.id = i18n.id AND i18n.language = 'en'