<?php
class Module_Language_Model_Language_Mapper extends Db_Mapper_Abstract
{
#---------------------------------------------------------------------------------------------------------

	public static function getAdminAvailableLanguages()
	{
		$dbTable = new Module_Language_Model_Language_DbTable();
		$select = $dbTable->select()->where('is_admin = ?', 1);
		$result = $dbTable->fetchAll($select);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}