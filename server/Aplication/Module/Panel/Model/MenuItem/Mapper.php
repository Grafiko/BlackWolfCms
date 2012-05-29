<?php
class Module_Panel_Model_MenuItem_Mapper extends Db_Mapper_Abstract
{
	protected static $_dbModelName = 'Module_Panel_Model_MenuItem';

#---------------------------------------------------------------------------------------------------------

	public static function findByCategoryId($category_id = null)
	{
		$dbTable = new Module_Panel_Model_MenuItem_DbTable();
		$select = $dbTable->select();
		if(null !== $category_id) {
			$select->where('admin_panel_menu_id = ?', $category_id);
		} else {
			$select->where('admin_panel_menu_id IS NULL');
		}
		$result = $dbTable->fetchAll($select);

		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}