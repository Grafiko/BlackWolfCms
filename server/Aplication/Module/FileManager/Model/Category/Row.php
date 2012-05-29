<?php
class Module_FileManager_Model_Category_Row extends Db_Table_Lang_Row_Abstract
{
	protected $_items;
	protected $_children;
	protected $_user_created;
	protected $_user_updated;

#---------------------------------------------------------------------------------------------------------

	public function __set($columnName, $value)
	{
		if ($columnName === 'is_activ') {
			$value = $value==null?$value:(int)$value;
		}

		parent::__set($columnName, $value);
	}

#---------------------------------------------------------------------------------------------------------

	public function __get($columnName)
	{
		$value = parent::__get($columnName);

		switch ($columnName) {
			case 'is_activ':
				return $value==null?$value:(int)$value;
				break;

			default:
				return $value;
				break;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getChildren()
	{
		if($this->_children instanceof Module_FileManager_Model_Category_Rowset) {
			return $this->_children;
		} else {
			$this->_children = Module_FileManager_Model_Category_Mapper::findByParentId($this->id);
			return $this->_children;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getItems()
	{
		if($this->_items instanceof Module_FileManager_Model_Item_Rowset) {
			return $this->_items;
		} else {
			$this->_items = Module_FileManager_Model_Item_Mapper::findByGalleryCategoryId($this->id);
			return $this->_items;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function countChildren()
	{
		return count($this->getChildren());
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
			$this->_errors['name'] = $this->getTranslate()->_('error_name');
		}

		if(System_Valid::isNotEmpty($this->parent_id)) {
		}

		if(!System_Valid::isNotEmpty($this->is_activ)) {
			$this->_errors['is_activ'] = $this->getTranslate()->_('error_is_activ');
		}

		parent::validData();
	}

#---------------------------------------------------------------------------------------------------------
}