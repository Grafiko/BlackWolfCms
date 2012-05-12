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

		$tpl_data = array();
		$tpl_data['TOP_MENU'] = $this->_menuTop();
		$tpl_data['CLOCK'] = $this->_clock();

		$this->addToDisplay(
			$this->render('start.tpl', $tpl_data, $this->_path_tpl_start)
		);
	}

#---------------------------------------------------------------------------------------------------------

	protected function _menuTop()
	{
		$tpl_data = array();
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