<?php
class Module_User_Admin extends Module_Admin implements Module_AdminInterface
{
	public $user_id;

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

	protected function display_loginPanel()
	{
		$tpl_data = array(
			'E' => $this->_data_from_action,
			'URL' => array(
				'POST' => System_Url_Admin::create('user', 'loginPanel', 'login')
			)
		);

		System_MetaData::getInstance()->setTitle('Panel logowania');
		$VS['CONTENT'] = $this->render('loginPanel.tpl', $tpl_data);

		$this->addToDisplay(
			$this->render('html.tpl', $VS, $this->_path_tpl_start)
		);
	}

#---------------------------------------------------------------------------------------------------------
}