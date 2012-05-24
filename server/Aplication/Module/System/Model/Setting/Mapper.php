<?php
class Module_System_Model_Setting_Mapper extends Db_Mapper_Abstract
{
	protected static $_dbModuleModelName = 'System_Model_Setting';

#---------------------------------------------------------------------------------------------------------

	public static function findByVar($var = null)
	{
		$result = false;
		if($var !== null) {
			$dbTable = new Module_System_Model_Setting_DbTable();
			$select = $dbTable->select();
			$select->where('var = ?', $var);
			$result = $dbTable->fetchRow($select);
		}

		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}