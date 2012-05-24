<?php
class System_Logs_Model_Item_Mapper
{
#---------------------------------------------------------------------------------------------------------

	public static function newItem()
	{
		$dbTable = new System_Logs_Model_Item_DbTable();
		return $dbTable->createRow();
	}

#---------------------------------------------------------------------------------------------------------

	public static function getItemsFromAdminPanel()
	{
		$dbTable = new System_Logs_Model_Item_DbTable();
		return $dbTable->createRow();
	}

#---------------------------------------------------------------------------------------------------------
}