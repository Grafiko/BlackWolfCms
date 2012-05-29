<?php
class Module_Files_Model_Item_Mapper
{
#---------------------------------------------------------------------------------------------------------
	public static function newItem()
	{
		$dbTable = new Module_Files_Model_Item_DbTable();
		return $dbTable->createRow();
	}

#---------------------------------------------------------------------------------------------------------

	public static function findById($id)
	{
		$dbTable = new Module_Files_Model_Item_DbTable();
		$result = $dbTable->find($id);

		if(0 == count($result)) {
			return null;
		}

		$row = $result->current();
		return $row;
	}

#---------------------------------------------------------------------------------------------------------

	public static function findByCategoryId($files_category_id = null)
	{
		$dbTable = new Module_Files_Model_Item_DbTable();
		$select = $dbTable->select();
		if(null !== $files_category_id) {
			$select->where('files_category_id = ?', $files_category_id);
		} else {
			$select->where('files_category_id IS NULL');
		}
		$result = $dbTable->fetchAll($select);

		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getAll($options = null)
	{
		$dbTable = new Module_Files_Model_Item_DbTable();
		$select = $dbTable->select();

		if(isset($options['where'])) {
			foreach($options['where'] as $field => $value) {
				if(!is_array($value)) {
					$value = array($value);
				}
				$select->where($field .' in ("'.implode('","', $value).'")');
			}
		}

		if(isset($options['noWhere'])) {
			foreach($options['noWhere'] as $field => $value) {
				if(!is_array($value)) {
					$value = array($value);
				}
				$select->where($field .' not in ("'.implode('","', $value).'")');
			}
		}

		$result = $dbTable->fetchAll($select);
		return $result;
	}
}