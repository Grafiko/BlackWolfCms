<?php
class Module_Language_Admin extends Module_Admin implements Module_AdminInterface
{

#---------------------------------------------------------------------------------------------------------

	public function __construct($action = null)
	{
//--> Ustawienie początkowych ustawień modułu
		parent::__construct();

//--> Sprawdzenie czy istnieje akcja do wykonania
		$this->checkModuleAction($action);
	}

#---------------------------------------------------------------------------------------------------------

	public function view_listOfAvailableLanguages()
	{
		$current_language = Zend_Registry::get('language');
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