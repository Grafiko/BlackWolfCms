<?php
abstract class Db_Table_Row_Abstract extends Zend_Db_Table_Row_Abstract
{
	protected $_mData = array();
	protected $_isValid = false;
	protected $_errors = array();
	protected $_stored = false;
	protected $_translate;

#---------------------------------------------------------------------------------------------------------

	public function __construct(array $config = array())
	{
		if (isset($config['stored']) && $config['stored'] === true) {
			$this->_stored = true;
		}
		parent::__construct($config);
	}

#---------------------------------------------------------------------------------------------------------

	public function isStored()
	{
		return $this->_stored;
	}

#---------------------------------------------------------------------------------------------------------

	public function __get($columnName)
	{
		if (array_key_exists($this->_transformColumn($columnName), $this->_data)) {
			$value = parent::__get($columnName);
		} else {
			if (!array_key_exists($columnName, $this->_mData)) {
			    throw new Exception("Nie istnieje \"{$columnName}\"");
			}
			$value = $this->_mData[$columnName];
		}

		if ($value !== null) {
			$value = System_Utilities::_stripslashes($value);
		}

		if (System_Utilities::is_serialized($value)) {
			$value = unserialize($value);
		}

		return $value;
	}

#---------------------------------------------------------------------------------------------------------

	public function __set($columnName, $value)
	{
		if (is_array($value)) {
			$value = serialize($value);
		}

		if ($value !== null) {
			$value = System_Utilities::_addslashes($value);
		}

		if (array_key_exists($this->_transformColumn($columnName), $this->_data)) {
			parent::__set($columnName, $value);
		} else {
			$this->_mData[$columnName] = $value;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function validData()
	{
		if (sizeof($this->_errors) > 0) {
			$this->_isValid = false;
		} else {
			$this->_isValid = true;
		}
		return $this->_isValid;
	}

#---------------------------------------------------------------------------------------------------------

	public function getValidErrors()
	{
		return $this->_errors;
	}

#---------------------------------------------------------------------------------------------------------

	public function save()
	{
		$this->validData();

		if ($this->_isValid) {
			return parent::save();
		} else {
				return false;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getTranslate()
	{
		if (false === ($this->_translate instanceof System_Translate_Zend)) {
			$this->_initTranslate();
		}

		return $this->_translate;
	}

#---------------------------------------------------------------------------------------------------------

	protected function _initTranslate()
	{
		$_model_class_files = ROOT_APLICATION;
		$className = get_class($this);
		$_tmp = explode('_', $className);
		unset($_tmp[count($_tmp)-1]);

		foreach ($_tmp as $key=>$value) {
			$_model_class_files.= DS . $value;
		}

		$this->_translate = System_Translate::get($_model_class_files . DS . 'i18n');
	}

#---------------------------------------------------------------------------------------------------------
}