<?php
class Module_System_Model_Setting_Row extends Db_Table_Row_Abstract
{
	protected $_user_updated;

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
		if(!System_Valid::isNotEmpty($this->var)) {
			$this->_errors['var'] = 'Nie podano nazwy zmiennej.';
		}

		parent::validData();
	}

#---------------------------------------------------------------------------------------------------------
}