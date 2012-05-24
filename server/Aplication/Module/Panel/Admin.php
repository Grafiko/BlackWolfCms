<?php
class Module_Panel_Admin extends Module_Admin implements Module_AdminInterface
{

#---------------------------------------------------------------------------------------------------------

	public function __init() {}

#---------------------------------------------------------------------------------------------------------

	public function display_default()
	{
		System_MetaData::getInstance()->setTitle('Panel zarządzania');

//--> Pobranie widoku dostępnych języków w panelu admina
		$moduleLanguageAdmin = $this->getModule('Module_Language_Admin');
		$view_language = $moduleLanguageAdmin->view_listOfAvailableLanguages();

		$tpl_data = array();
		$tpl_data['TOP_MENU'] = $this->view_menuTop();
		$tpl_data['CLOCK'] = $this->view_clock();
		$tpl_data['LANGUAGE'] = $view_language;

		$this->addToDisplay(
			$this->render('start.tpl', $tpl_data, $this->_path_tpl_start)
		);
	}

#---------------------------------------------------------------------------------------------------------

	protected function view_menuTop()
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

	protected function view_clock()
	{
		$result = $this->render('clock.tpl');
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public function tpl_twoColumn($tpl_data = array())
	{
//--> Pobranie widoku dostępnych języków w panelu admina
		$moduleLanguageAdmin = $this->getModule('Module_Language_Admin');
		$view_language = $moduleLanguageAdmin->view_listOfAvailableLanguages();

//--> Pobranie widoku panelu z logami systemu
		$moduleLogAdmin = $this->getModule('Module_Log_Admin');
		$view_logAdmin = $moduleLogAdmin->view_logPanel(5);

//$this->render('Common', 'messages.tpl', array('M'=>System_Messages::getInstance()->get()))
		$tpl_data = array(
			'MENU_TOP' => $this->view_menuTop(),
			'CLOCK' => $this->view_clock(),
			'LANGUAGE' => $view_language,
			'MODULE_TITLE' => isset($tpl_data['MODULE_TITLE'])?$tpl_data['MODULE_TITLE']:null,
			'MESSAGES' => $view_logAdmin,
			'PANEL_LEFT' => isset($tpl_data['PANEL_LEFT'])?$tpl_data['PANEL_LEFT']:null,
			'PANEL_RIGHT' => isset($tpl_data['PANEL_RIGHT'])?$tpl_data['PANEL_RIGHT']:null
		);

		$this->addToDisplay(
			$this->render('2column.tpl', $tpl_data, $this->_path_tpl_start)
		);
	}

#---------------------------------------------------------------------------------------------------------

	public function tpl_iFrame($tpl_data = array())
	{
		$tpl_data = array(
			'CONTENT' => isset($tpl_data['CONTENT'])?$tpl_data['CONTENT']:null
		);

		$this->addToDisplay(
			$this->render('iFrame.tpl', $tpl_data, $this->_path_tpl_start)
		);
	}

#---------------------------------------------------------------------------------------------------------
}