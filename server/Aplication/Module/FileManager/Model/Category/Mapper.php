<?php
class Module_FileManager_Model_Category_Mapper extends Db_Mapper_Abstract
{
	public static $_dbModelName = 'Module_FileManager_Model_Category';

#---------------------------------------------------------------------------------------------------------

	public static function findByParentId($parent_id = null)
	{
		$dbTable = new Module_FileManager_Model_Category_DbTable();
		$select = $dbTable->select();
		if ($parent_id === null) {
			$select->where('parent_id IS NULL');
		} else {
			$select->where('parent_id = ?', $parent_id);
		}

		$result = $dbTable->fetchAll($select);

		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}