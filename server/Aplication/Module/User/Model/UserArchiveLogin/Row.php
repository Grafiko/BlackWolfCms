<?php
class Module_User_Model_UserArchiveLogin_Row extends Db_Table_Row_Abstract
{
	protected $_user;

#---------------------------------------------------------------------------------------------------------

	public function __get($columnName)
	{
		if(array_key_exists($this->_transformColumn($columnName), $this->_data)) {
			return parent::__get($columnName);
		} else {
			if($columnName === 'user') return $this->getUser();
			else throw new Exception("Nie istnieje \"$columnName\"");
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function __set($columnName, $value)
	{
		if(array_key_exists($this->_transformColumn($columnName), $this->_data)) {
			parent::__set($columnName, $value);
		} else {
			$columnName = '_'.$columnName;
			$this->$columnName = $value;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getUser() {
		if($this->_user instanceof Module_User_Model_User_Row) {
			return $this->_user;
		} else {
			$this->_user = Module_User_Model_User_Mapper::findById($this->user_id);
			return $this->_user;
		}
	}

#---------------------------------------------------------------------------------------------------------
}