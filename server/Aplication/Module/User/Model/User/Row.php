<?php
class Module_User_Model_User_Row extends Db_Table_Row_Abstract
{
	protected $_role;
	protected $_user_created;
	protected $_user_updated;
	protected $_last_login = null;
	protected $_session;

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

	public function getSession()
	{
		if($this->_session instanceof Module_User_Model_UserSession_Row) {
			return $this->_session;
		} else {
			$dbTable = new Module_User_Model_UserSession_DbTable();
			$select = $dbTable->select()->where('user_id = ?', $this->id)->order('modified ASC');
			$this->_session = $dbTable->fetchRow($select);
			return $this->_session;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getRole()
	{
		if($this->_role instanceof Module_User_Model_UserRole_Row) {
			return $this->_role;
		} else {
			$this->_role = Module_User_Model_UserRole_Mapper::findById($this->user_role_id);
			return $this->_role;
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

	public function getLastLogin()
	{
		if($this->_last_login instanceof Module_User_Model_UserArchiveLogin_Row) {
			return $this->_last_login;
		} else {
			$dbTable = new Module_User_Model_UserArchiveLogin_DbTable();
			$select = $dbTable->select()->where('user_id = ?', $this->id)->order('time DESC');
			$this->_last_login = $dbTable->fetchRow($select);
			return $this->_last_login;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function validData()
	{
		if(!System_Valid::isNotEmpty($this->email)) {
			$this->_errors['email'] = 'Nie podano adresu email.';
		} elseif(!System_Valid::isEmail($this->email)) {
			$this->_errors['email'] = 'Podany adres email jest błędny';
		} elseif(@$this->_cleanData['email'] !== $this->email) {
			$oUser = Module_User_Model_User_Mapper::findByEmail($this->email);
			if($oUser instanceof Module_User_Model_User_Row) {
				$this->_errors['email'] = 'Istnieje już użytkownik o podanym adresie email';
			}
		}

		if(!System_Valid::isNotEmpty($this->name)) {
			$this->_errors['name'] = 'Nie podano imienia.';
		}

		if(!System_Valid::isNotEmpty($this->state)) {
			$this->_errors['state'] = 'Nie wybrano statusu';
		} elseif($this->state < 1 || $this->state > 4) {
			$this->_errors['state'] = 'Wybrany status użytkownika nie istnieje';
		}

		if(!System_Valid::isNotEmpty($this->user_role_id)) {
			$this->_errors['user_role_id'] = 'Nie wybrano roli dla tego użytkownika.';
		} elseif(false === ($this->getRole() instanceof Module_User_Model_UserRole_Row)) {
			$this->_errors['user_role_id'] = 'Nie istnieje taka rola w systemie.';
		}

		if(array_key_exists('passwd', $this->_modifiedFields)) {
			if(!System_Valid::isNotEmpty($this->passwd)) {
				$this->_errors['passwd'] = 'Nie podano hasła.';
			} elseif(!System_Valid::isNotEmpty($this->_rpasswd)) {
				$this->_errors['rpasswd'] = 'Nie powtórzono hasła.';
			} elseif($this->passwd !== $this->_rpasswd) {
				$this->_errors['rpasswd'] = 'Podane hasła nie zgadzają się.';
			} elseif(count($this->_errors) === 0) {
				$this->passwd = md5($this->passwd);
			}
		}

		parent::validData();
	}

#---------------------------------------------------------------------------------------------------------
}