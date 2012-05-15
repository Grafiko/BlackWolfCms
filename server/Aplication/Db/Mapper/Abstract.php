<?php
abstract class Db_Mapper_Abstract
{
	//protected static $_dbModuleModelName;

#---------------------------------------------------------------------------------------------------------

	public static function getDbTableClassName()
	{
		$_tmp = explode('_', static::$_dbModuleModelName);
		for($i=0,$ln=count($_tmp); $i<$ln; $i++) {
			$_tmp[$i] = ucfirst($_tmp[$i]);
		}

		$_dbModuleModelName = implode('_', $_tmp);

		$_dbTableName = 'Module_' . $_dbModuleModelName . '_DbTable';
		return $_dbTableName;
	}

#---------------------------------------------------------------------------------------------------------

	public static function newItem()
	{
		$dbTable_className = static::getDbTableClassName();

		$dbTable = new $dbTable_className();
		return $dbTable->createRow();
	}


#---------------------------------------------------------------------------------------------------------

	public static function getAll($options = null)
	{
		$dbTable_className = static::getDbTableClassName();

		$dbTable = new $dbTable_className();
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