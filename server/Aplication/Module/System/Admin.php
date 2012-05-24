<?php
class Module_System_Admin extends Module_Admin implements Module_AdminInterface
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

	public function display_default()
	{
		$this->display_setting();
	}

#---------------------------------------------------------------------------------------------------------

	public function display_setting()
	{
		System_MetaData::getInstance()->setTitle('System');

//--> Tworzymy zakładki
		$tabs = new Plugin_Tabs();
		$tabs->setActiv($this->_hash);
		$tabsItem = new Plugin_Tabs_Item( $this->_translate->_('mailbox') );
		$tabsItem->setContent($this->view_settingMail());
		$tabsItem->setHash('settingMail');
		$tabs->addItem($tabsItem);
		$tabsItem = new Plugin_Tabs_Item( $this->_translate->_('favicon') );
		$tabsItem->setContent($this->view_settingFavicon());
		$tabs->addItem($tabsItem);
		$tabsItem->setHash('settingFavicon');

		$tpl_data['PANEL_RIGHT'] = $tabs->getPluginResult();
		$tpl_data['PANEL_LEFT'] = $this->view_leftPanel();

//--> Pobranie wstępnego szablonu
		$modulePanelAdmin = $this->getModule('Module_Panel_Admin');
		$modulePanelAdmin->tpl_twoColumn($tpl_data);

		$this->addToDisplay(
			$modulePanelAdmin->getModuleResult()
		);
	}

#---------------------------------------------------------------------------------------------------------

	protected function display_cache()
	{
		System_MetaData::getInstance()->setTitle('Ustawienia :: Cache');

//--> Tworzymy zakładki
		$pTabs = new Plugin_Tabs();
		$pTabsItem = new Plugin_Tabs_Item( $this->_translate->_('cache_site') );
		$pTabsItem->setContent($this->view_cache());
		$pTabs->addItem($pTabsItem);

		$tpl_data['PANEL_RIGHT'] = $pTabs->getPluginResult();
		$tpl_data['PANEL_LEFT'] = $this->view_leftPanel();

//--> Pobranie wstępnego szablonu
		$modulePanelAdmin = $this->getModule('Module_Panel_Admin');
		$modulePanelAdmin->tpl_twoColumn($tpl_data);

		$this->addToDisplay(
			$modulePanelAdmin->getModuleResult()
		);
	}

#---------------------------------------------------------------------------------------------------------

	public function view_settingMail()
	{
		if (!is_array($this->getData('mail'))) {
			$system_setting = Zend_Registry::get('system_setting');
			$this->setData('mail',
				array(
				  'smtp_server' => isset($system_setting['smtp_server'])?$system_setting['smtp_server']:null,
				  'smtp_email' => isset($system_setting['smtp_email'])?$system_setting['smtp_email']:null,
				  'smtp_pass' => isset($system_setting['smtp_pass'])?$system_setting['smtp_pass']:null,
				  'smtp_send_perminute' => isset($system_setting['smtp_send_perminute'])?$system_setting['smtp_send_perminute']:null,
				  'email_from' => isset($system_setting['email_from'])?$system_setting['email_from']:null,
				  'email_name' => isset($system_setting['email_name'])?$system_setting['email_name']:null
				)
			);
		}

		$tpl_data = array(
			'V' => $this->getData('mail'),
			'E' => $this->getData('mail_errors'),
			'URL' => array(
				'POST' => System_Url_Admin::create('system', 'setting', 'saveSmtpSetting', array('hash'=>'settingMail')),
				'TEST' => System_Url_Admin::create('system', 'setting', 'testSmtpSetting', array('hash'=>'settingMail'))
			)
		);

		$view = $this->render('setting_mail.tpl', $tpl_data);
		return $view;
	}

#---------------------------------------------------------------------------------------------------------

	public function view_settingFavicon()
	{
		
	}

#---------------------------------------------------------------------------------------------------------

	public function view_cache()
	{
		$size = array(
			'tpl' => System_Utilities::getDirSize(ROOT_APLICATION_TEMP_TPL),
			'db' => System_Utilities::getDirSize(ROOT_APLICATION_TEMP_CACHE_DB),
			'asset' => System_Utilities::getDirSize(ROOT_ASSET)
		);
		$size['sum'] = $size['tpl'] + $size['db'] + $size['asset'];
		
		$tpl_data = array(
			'SIZE' => array(
				'DB' => System_Utilities::decToDisplay($size['db']/1024/1024, ',', 'MB'),
				'TPL' => System_Utilities::decToDisplay($size['tpl']/1024/1024, ',', 'MB'),
				'ASSET' => System_Utilities::decToDisplay($size['asset']/1024/1024, ',', 'MB'),
				'SUM' => System_Utilities::decToDisplay($size['sum']/1024/1024, ',', 'MB')
			),
			'E' => @$this->_error['tpl'],
			'URL' => array(
				'CLEAR' => System_Url_Admin::create('system', 'cache', 'cacheClear')
			)
		);

		$view = $this->render('cache.tpl', $tpl_data);
		return $view;
	}

#---------------------------------------------------------------------------------------------------------

	private function view_leftPanel()
	{
		$result = $this->view_panelLeft_Menu();
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	private function view_panelLeft_Menu()
	{
		$pMenu = new Plugin_MenuLeft( $this->_translate->_('auxiliary_menu') );
		$pMenu->setActiv( System_Url::getRunShow() );

		$pMenuItem = new Plugin_MenuLeft_Item( $this->_translate->_('setting') );
		$pMenuItem->setHref( System_Url_Admin::create('system', 'setting') );
		$pMenuItem->setHash('setting');
		$pMenu->addItem($pMenuItem);

		$pMenuItem = new Plugin_MenuLeft_Item( $this->_translate->_('cache_site') );
		$pMenuItem->setHref( System_Url_Admin::create('system', 'cache') );
		$pMenuItem->setHash('cache');
		$pMenu->addItem($pMenuItem);

		return $pMenu->getPluginResult();
	}

#---------------------------------------------------------------------------------------------------------
}