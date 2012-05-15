<?php
abstract class Db_Table_Row_Abstract extends Zend_Db_Table_Row_Abstract
{
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

		return $value;
	}

#---------------------------------------------------------------------------------------------------------

	public function __set($columnName, $value)
	{
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
}