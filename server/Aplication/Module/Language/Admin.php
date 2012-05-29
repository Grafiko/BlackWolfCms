<?php
class Module_Language_Admin extends Module_Admin implements Module_AdminInterface
{

#---------------------------------------------------------------------------------------------------------

	public function __init() {}

#---------------------------------------------------------------------------------------------------------

	public function display_default() {}

#---------------------------------------------------------------------------------------------------------

	public function view_listOfAvailableLanguages()
	{
		$user_setting = Zend_Registry::get('user_setting');
		$current_language = $user_setting->language;

		$oLanguageRowset = Module_Language_Model_Language_Mapper::getAdminAvailableLanguages();
		foreach ($oLanguageRowset as $oLanguage) {
			if ($oLanguage->code == $current_language) {
				$oCurrentLanguage = clone $oLanguage;
			}
		}

		$tpl_data = array(
			'oCurrentLanguage' => $oCurrentLanguage,
			'oLanguageRowset' => $oLanguageRowset
		);

		$result = $this->render('selectLanguage.tpl', $tpl_data);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public function view_languageSelectionWhenEditingItem()
	{
		$current_language = System_Url::getGP('i18n', null);

		$oLanguageRowset = Module_Language_Model_Language_Mapper::getSiteAvailableLanguages();
		foreach ($oLanguageRowset as $oLanguage) {
			if (
					($current_language !== null AND $oLanguage->code == $current_language) ||
					($current_language === null AND $oLanguage->is_default)
				) {
				$oLanguage->_isCurrent = true;
			} else {
				$oLanguage->_isCurrent = false;
			}
		}

		$tpl_data = array(
			'oLanguageRowset' => $oLanguageRowset
		);

		$result = $this->render('selectionWhenEditingItem.tpl', $tpl_data);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}