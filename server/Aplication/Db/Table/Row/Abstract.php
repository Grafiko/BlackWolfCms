<?php
abstract class Db_Table_Row_Abstract extends Zend_Db_Table_Row_Abstract
{
	protected $_mData = array();
	protected $_isValid = false;
	protected $_errors = array();
	protected $_stored = false;

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
}