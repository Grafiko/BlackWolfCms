<?php
class Module_Panel_Model_Menu_Mapper extends Db_Mapper_Abstract
{
	protected static $_dbModuleModelName = 'Panel_Model_Menu';

#---------------------------------------------------------------------------------------------------------

	public static function findById($id)
	{
		$dbTable = new Module_User_Model_User_DbTable();
		$result = $dbTable->find($id);

		if(0 == count($result)) {
			return null; 
		}

		$row = $result->current();
		return $row;
	}

#---------------------------------------------------------------------------------------------------------

	public static function findByRoleId($role_id)
	{
		$dbTable = new Module_User_Model_User_DbTable();
		$select = $dbTable->select()->where('acl_role_id = ?', $role_id);
		$result = $dbTable->fetchAll($select);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function findByEmail($email)
	{
		$dbTable = new Module_User_Model_User_DbTable();
		$select = $dbTable->select()->where('email = ?', $email);
		$result = $dbTable->fetchRow($select);
		return $result;
	}


#---------------------------------------------------------------------------------------------------------
}