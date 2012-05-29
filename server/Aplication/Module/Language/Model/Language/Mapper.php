<?php
class Module_Language_Model_Language_Mapper extends Db_Mapper_Abstract
{
#---------------------------------------------------------------------------------------------------------

	public static function getAdminAvailableLanguages()
	{
		$cache_db = Zend_Registry::get('cache_db');
		$result = $cache_db->load('Module_Language_Model_Language_Rowset_AdminAvailableLanguages');

		if (false === ($result instanceof Module_Language_Model_Language_Rowset)) {
			$dbTable = new Module_Language_Model_Language_DbTable();
			$select = $dbTable->select()->where('is_admin = ?', 1);
			$result = $dbTable->fetchAll($select);

			$cache_db->save(
				$result,
				'Module_Language_Model_Language_Rowset_AdminAvailableLanguages',
				array('Module_Language_Model_Language')
			);
		}
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getSiteAvailableLanguages()
	{
		$cache_db = Zend_Registry::get('cache_db');
		$result = $cache_db->load('Module_Language_Model_Language_Rowset_SiteAvailableLanguages');

		if (false === ($result instanceof Module_Language_Model_Language_Rowset)) {
			$dbTable = new Module_Language_Model_Language_DbTable();
			$select = $dbTable->select()->where('is_admin = ?', 0);
			$result = $dbTable->fetchAll($select);

			$cache_db->save(
				$result,
				'Module_Language_Model_Language_Rowset_SiteAvailableLanguages',
				array('Module_Language_Model_Language')
			);
		}
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getDefaultAdminLanguage()
	{
		$cache_db = Zend_Registry::get('cache_db');
		$result = $cache_db->load('Module_Language_Model_Language_Row_AdminDefaultLanguage');

		if (false === ($result instanceof Module_Language_Model_Language_Row)) {
			$dbTable = new Module_Language_Model_Language_DbTable();
			$select = $dbTable->select()->where('is_admin = ?', 1)->where('is_default = ?', 1);
			$result = $dbTable->fetchRow($select);

			$cache_db->save(
				$result,
				'Module_Language_Model_Language_Row_AdminDefaultLanguage',
				array('Module_Language_Model_Language')
			);
		}
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getDefaultSiteLanguage()
	{
		$cache_db = Zend_Registry::get('cache_db');
		$result = $cache_db->load('Module_Language_Model_Language_Row_SiteDefaultLanguage');

		if (false === ($result instanceof Module_Language_Model_Language_Row)) {
			$dbTable = new Module_Language_Model_Language_DbTable();
			$select = $dbTable->select()->where('is_admin = ?', 0)->where('is_default = ?', 1);
			$result = $dbTable->fetchRow($select);

			$cache_db->save(
				$result,
				'Module_Language_Model_Language_Row_SiteDefaultLanguage',
				array('Module_Language_Model_Language')
			);
		}
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}