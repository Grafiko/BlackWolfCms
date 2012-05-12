<?php
class Module_User_Model_UserRole_Mapper
{
	public static function findById($id)
	{
		$dbTable = new Module_User_Model_UserRole_DbTable();
		$result = $dbTable->find($id);

		if(0 == count($result)) {
			return null;
		}

		$row = $result->current();
		return $row;
	}

#---------------------------------------------------------------------------------------------------------

	public static function findByHash($hash)
	{
		$dbTable = new Module_User_Model_UserRole_DbTable();
		$select = $dbTable->select();
      $select->where('hash = "'.$hash.'"');
		$result = $dbTable->fetchRow($select);

		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getAll($options = null)
	{
		$dbTable = new Module_User_Model_UserRole_DbTable();
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

#---------------------------------------------------------------------------------------------------------
}