<?php
class Module_Panel_Admin extends Module_Admin implements Module_AdminInterface
{

#---------------------------------------------------------------------------------------------------------

	public function __construct($action = null)
	{
//--> Ustawienie początkowych ustawień modułu
		parent::__construct();

//--> Akcje wewnętrzne modułu
		$this->user_id = System_Url::getGet('user');

//--> Sprawdzenie czy istnieje akcja do wykonania
		$this->checkModuleAction($action);
	}

#---------------------------------------------------------------------------------------------------------

	protected function display_default()
	{
		System_MetaData::getInstance()->setTitle('Panel zarządzania');

		$moduleLanguageAdmin = $this->getModule('Module_Language_Admin');
		$moduleLanguageAdmin->view_listOfAvailableLanguages();

		$tpl_data = array();
		$tpl_data['TOP_MENU'] = $this->_menuTop();
		$tpl_data['CLOCK'] = $this->_clock();
		$tpl_data['LANGUAGE'] = $this->_clock();

		$this->addToDisplay(
			$this->render('start.tpl', $tpl_data, $this->_path_tpl_start)
		);
	}

#---------------------------------------------------------------------------------------------------------

	protected function _menuTop()
	{
		$oMenuRowset = Module_Panel_Model_Menu_Mapper::getAll();
		foreach($oMenuRowset as $oMenuRow) {
			$oMenuRow->getItems();
		}
		$tpl_data = array(
			'oMenuRowset' => $oMenuRowset
		);
		$result = $this->render('menuTop.tpl', $tpl_data);

		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	protected function _clock()
	{
		$result = $this->render('clock.tpl');
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}