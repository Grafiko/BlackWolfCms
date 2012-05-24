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
}