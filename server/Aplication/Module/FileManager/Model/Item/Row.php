<?php
class Module_Files_Model_Item_Row extends Db_Table_Row_Abstract
{
	private $_category;
	private $_user_created;
	private $_user_updated;

#---------------------------------------------------------------------------------------------------------

	public function __get($columnName)
	{
		if(array_key_exists($this->_transformColumn($columnName), $this->_data)) {
			return parent::__get($columnName);
		} else {
			return parent::__get($columnName);
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function __set($columnName, $value)
	{
		if(array_key_exists($this->_transformColumn($columnName), $this->_data)) {
			parent::__set($columnName, $value);
		} else {
			parent::__set($columnName, $value);
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getCategory() {
		if($this->_category instanceof Module_Files_Model_Category_Row) {
			return $this->_category;
		} else {
			$this->_category = Module_Files_Model_Category_Mapper::findById($this->files_category_id);
			return $this->_category;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getUserCreated() {
		if($this->_user_created instanceof Module_User_Model_User_Row) {
			return $this->_user_created;
		} else {
			$this->_user_created = Module_User_Model_User_Mapper::findById($this->created_user_id);
			return $this->_user_created;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getUserUpdated() {
		if($this->_user_updated instanceof Module_User_Model_User_Row) {
			return $this->_user_updated;
		} else {
			$this->_user_updated = Module_User_Model_User_Mapper::findById($this->updated_user_id);
			return $this->_user_updated;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function validData()
	{
		if(!System_Valid::isNotEmpty($this->name)) {
			$this->_errors['name'] = 'Nie podano nazwy.';
		}

		if(!System_Valid::isNotEmpty($this->files_category_id)) {
			$this->_errors['files_category_id'] = 'Nie wybrano galleri video.';
		}

		if(!System_Valid::isNotEmpty($this->filename)) {
			$this->_errors['filename'] = 'Nie wybrano pliku.';
		}

		parent::validData();
	}

#---------------------------------------------------------------------------------------------------------
}