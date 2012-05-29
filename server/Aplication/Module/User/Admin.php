<?php
class Module_User_Admin extends Module_Admin implements Module_AdminInterface
{
	public $user_id;

#---------------------------------------------------------------------------------------------------------

	public function __init()
	{
		$this->user_id = System_Url::getGet('user');
	}

#---------------------------------------------------------------------------------------------------------

	public function display_default() {}

#---------------------------------------------------------------------------------------------------------

	protected function display_loginPanel()
	{
		System_MetaData::getInstance()->setTitle('Panel logowania');

//--> Pobranie widoku dostępnych języków w panelu admina
		$moduleLanguageAdmin = $this->getModule('Module_Language_Admin');
		$view_language = $moduleLanguageAdmin->view_listOfAvailableLanguages();

//->> Ustawienie danych wejściowych dla szablonu *.tpl
		$tpl_data = array(
			'LANGUAGE' => $view_language,
			'E' => $this->_action_message,
			'URL' => array(
				'POST' => System_Url_Admin::create('user', 'loginPanel', 'login')
			)
		);

		$VS['CONTENT'] = $this->render('loginPanel.tpl', $tpl_data);

		$this->addToDisplay(
			$this->render('html.tpl', $VS, $this->_path_tpl_start)
		);
	}

#---------------------------------------------------------------------------------------------------------
}