<?php
class Module_User_Model_UserSession_Mapper
{

#---------------------------------------------------------------------------------------------------------

	public static function findByUserId($user_id)
	{
		$dbTable = new Module_User_Model_UserSession_DbTable();
		$select = $dbTable->select()->where('user_id = ?', $user_id);
		$result = $dbTable->fetchAll($select);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}