<?php
class Module_FileManager_Model_Category_Mapper extends Db_Mapper_Abstract
{
	public static $_dbModelName = 'Module_FileManager_Model_Category';

#---------------------------------------------------------------------------------------------------------

	public static function findByParentId($parent_id = null)
	{
		$timer = new ExeTimer();
		$timer->start();


		$cache_db = Zend_Registry::get('cache_db');
		$result = $cache_db->load('Module_FileManager_Model_Category_Rowset_ParentId_' . $parent_id);

		if (false === ($result instanceof Module_FileManager_Model_Category_Rowset)) {
			$dbTable = new Module_FileManager_Model_Category_DbTable();
			$select = $dbTable->select();
			if ($parent_id === null) {
				$select->where('parent_id IS NULL');
			} else {
				$select->where('parent_id = ?', $parent_id);
			}

			$result = $dbTable->fetchAll($select);

			/*
			 * Ustawienia Tagów dla cache
			 */
			$aTags = array();
			foreach ($result as $oCategory) {
				$aTags[] = 'Module_FileManager_Model_Category_Row_Id_' . $oCategory->id;
			}
			$aTags = array_merge($aTags, array('Module_FileManager_Model_Category'));

			/*
			 * Zapisanie cache
			 */
			$cache_db->save(
				$result,
				'Module_FileManager_Model_Category_Rowset_ParentId_' . $parent_id,
				$aTags
			);
		} else {
			$result->setTable(new Module_FileManager_Model_Category_DbTable());
		}
echo $timer->stop() . '<br />';
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}