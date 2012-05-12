<?php
class Module_User_Model_UserRole_Row extends Db_Table_Row_Abstract
{
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

	public function validData()
	{
		if(!System_Valid::isNotEmpty($this->name)) {
			$this->_errors['name'] = 'Nie podano nazwy roli.';
		} elseif(@$this->_cleanData['name'] !== $this->name) {
			$oRole = Module_User_Model_UserRole_Mapper::findByHash($this->hash);
			if($oRole instanceof Module_User_Model_UserRole_Row) {
				$this->_errors['name'] = 'Istnieje już rola o takiej nazwie.';
			}
		}

		if($this->parent_id == $this->id AND System_Valid::isNotEmpty($this->id)) {
			$this->_errors['parent_id'] = 'Nie można przypisać tej roli jako roli rodzica.';
		} elseif(System_Valid::isNotEmpty($this->parent_id)) {
			$oRole = Module_User_Model_UserRole_Mapper::findById($this->parent_id);
			if($oRole instanceof Module_User_Model_UserRole_Row) {
				if(!Modules_Access::isAllowed(Modules_UserManager_Acl::getResourceByRole($this->parent_id), array('addRole'))) {
					$this->_errors['parent_id'] = 'Nie posiadasz uprawnień do dodawania w tej roli.';
				}
			} else {
				$this->_errors['parent_id'] = 'Nie istnieje wybrana rola w systemie.';
			}
		}

		parent::validData();
	}

#---------------------------------------------------------------------------------------------------------
}