<?php
class Module_User_Model_UserArchiveLogin_Mapper
{
	protected static $_dbTableName = 'userArchiveLogin';

#---------------------------------------------------------------------------------------------------------

	public static function findByUserId($user_id)
	{
		$dbTable = new Module_User_Model_UserArchiveLogin_DbTable();
		$select = $dbTable->select()->where('user_id = ?', $user_id);
		$result = $dbTable->fetchAll($select);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function findByUserLogin($login)
	{
		$dbTable = new Module_User_Model_UserArchiveLogin_DbTable();
		$select = $dbTable->select()->where('login = ?', $login);
		$result = $dbTable->fetchAll($select);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function newItem()
	{
		$dbTable = new Module_User_Model_UserArchiveLogin_DbTable();
		return $dbTable->createRow();
	}

#---------------------------------------------------------------------------------------------------------
}