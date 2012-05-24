<?php
class System_Logs_Model_Item_Row extends Db_Table_Row_Abstract
{
	protected $_message;
	protected $_parameters;
	protected $_user_created;

#---------------------------------------------------------------------------------------------------------

	public function __set($columnName, $value)
	{
		if ($columnName == 'content') {
			return;
		}
		parent::__set($columnName, $value);
	}

#---------------------------------------------------------------------------------------------------------

	public function init()
	{
		if ($this->isStored()) {
			$this->_message = $this->content['msg'];
			$this->_parameters = $this->content['parameters'];
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getMessage()
	{
		if (null !== $this->module) {
			if (class_exists($this->module)) {
				$module = new $this->module;
				return $module->_translate->_($this->_message, $this->_parameters);
			}
		}

		return null;
	}

#---------------------------------------------------------------------------------------------------------

	public function setMessage($message, $parameters = null)
	{
		$this->_message = $message;
		if ($parameters !== null) {
			if (!is_array($parameters)) {
				$this->_parameters = array($parameters);
			} else {
				$this->_parameters = $parameters;
			}
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getUserCreated()
	{
		if($this->_user_created instanceof Module_User_Model_User_Row) {
			return $this->_user_created;
		} else {
			$this->_user_created = Module_User_Model_User_Mapper::findById($this->created_user_id);
			return $this->_user_created;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function validData()
	{
		if (!System_Valid::isNotEmpty($this->module)) {
			$this->_errors['module'] = 'Nie podano nazwy modułu.';
		} elseif (!@class_exists($this->module)) {
			$this->_errors['module'] = 'Podany moduł nie istnieje.';
		}

		if (!System_Valid::isNotEmpty($this->type)) {
			$this->_errors['type'] = 'Nie podano typu logu.';
		}

		if (!System_Valid::isNotEmpty($this->content)) {
			$this->_errors['content'] = 'Nie podano zawartości logu.';
		}

		parent::validData();
	}

#---------------------------------------------------------------------------------------------------------

	public function save()
	{
		if ($this->created_at == null) {
			$this->created_at = Zend_Registry::get('date')->get(Zend_Date::ISO_8601);
		}

		if ($this->created_user_id == null) {
			$this->created_user_id = Zend_Registry::get('identity')->id;
		}

		parent::__set('content', array(
			'msg' => $this->_message,
			'parameters' => $this->_parameters
		));

		parent::save();
	}

#---------------------------------------------------------------------------------------------------------
}