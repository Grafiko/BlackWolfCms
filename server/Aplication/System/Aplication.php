<?php
class System_Aplication
{
	protected static $_instance;
	protected $_user_setting;
	private $_tpl;
	private $config;

#---------------------------------------------------------------------------------------------------------

	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

#---------------------------------------------------------------------------------------------------------

	protected function __construct()
	{
		$this->setSetting();

		switch (System_Url::getPageName()) {
			case System_Url::PATH_ADMIN:
				$this->getAdmin();
				break;

			default:
				$this->getSite();
				break;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function setLanguage()
	{
//--> Sprawdzenie czy nastapiła zmiana języka
		$_language = System_Url::getGP('language', null);
		if ($_language !== null) {
			$this->_user_setting->language = $_language;
		}

//--> Sprawdzenie czy został ustawiony domyślny język
		if (null === $this->_user_setting->language_default) {
			$this->_user_setting->language_default = Module_Language_Model_Language_Mapper::getDefaultAdminLanguage()->code;
		}

//--> Sprawdzenie czy został ustawiony aktualny język
		if (null === $this->_user_setting->language) {
			$this->_user_setting->language = $this->_user_setting->language_default;
		}
	}

#---------------------------------------------------------------------------------------------------------

	private function setSetting()
	{
//--> Start Sesji
		$_session = System_Session::start();
		$this->_user_setting = new Zend_Session_Namespace('setting');
		if (System_Auth::IsLogin()) {
			$id_user	= Zend_Auth::getInstance()->getIdentity()->id;
			$_session->updateSession($id_user);
			$_session->setExpirationSeconds();
		}

//--> Ustawienia CACHE dla plików *.tpl
		$frontendOptions = array('lifetime' => 1, 'automatic_serialization' => true);
		$backendOptions = array('cache_dir' => ROOT_APLICATION_TEMP_TPL_CACHE);
		$cache = Zend_Cache::factory('Output', 'File', $frontendOptions, $backendOptions);
		Zend_Registry::set('cacheTemplate', $cache);

//--> Ustawienia CACHE dla ustawień
		$frontendOptions = array('lifetime' => 1, 'automatic_serialization' => true);
		$backendOptions = array('cache_dir' => ROOT_APLICATION_TEMP_CACHE_SYSTEM);
		$cache_system_setting = Zend_Cache::factory('Output', 'File', $frontendOptions, $backendOptions);

//--> Ustawienie aktualnego języka
		$this->setLanguage();

//--> Wczytanie ustawień z bazy danych
		$db_setting = $cache_system_setting->load('db_setting');
		if (!$db_setting) {
			$oSettingList = Module_System_Model_Setting_Mapper::getAll();
			foreach ($oSettingList as $var) {
				$db_setting[$var->var] = $var->value;
			}
			$cache_system_setting->save($db_setting, 'db_setting');
		}

//--> Ustawienia dla Zend_Registry
		Zend_Registry::set('locale', 'pl_PL');
		Zend_Registry::set('date', new Zend_Date(null, null, Zend_Registry::get('locale')));
		Zend_Registry::set('identity', Zend_Auth::getInstance()->getIdentity());
		Zend_Registry::set('user_setting', $this->_user_setting);
		Zend_Registry::set('system_setting', $db_setting);
	}

#---------------------------------------------------------------------------------------------------------

	public static function reloadSetting() {
		$settingList = Module_Setting_Model_Setting_Mapper::getAll();
		$setting = array();
		foreach ($settingList as $var) {
			$setting[$var->var] = $var->value;
		}
		Zend_Registry::set('setting', $setting);
	}

#---------------------------------------------------------------------------------------------------------

	private function getAdmin()
	{
		define('ASSET_PATH', '/asset/template/admin/default');

		$_module = System_Url::getRunModule();
		$_show = System_Url::getRunShow();
		$_action = System_Url::getRunAction();

		if (!System_Auth::IsLogin()) {
			if ('user' !== $_module AND 'loginPanel' !== $_show) {
				$url = System_Url_Admin::create('user', 'loginPanel');
				System_Url::redirect($url);
			}
		} elseif ($_module === null) {
			$url = System_Url_Admin::create('panel', 'start');
			System_Url::redirect($url);
		}

		$_className = 'Module_'.ucfirst(System_Url::getRunModule()).'_Admin';

		if (class_exists($_className)) {
			$result = new $_className($_action);
			$result->run($_show);
			$toDisplay = $result->getModuleResult();
			echo $toDisplay;
		} else {
			/** TODO
			 *  Dorobić obsługe gdy brak modułu
			 */
			//echo dirname(__FILE__);
			die('Brak modulu : ' . $_className);
		}
	}

#---------------------------------------------------------------------------------------------------------

	private function getSite()
	{
		
	}

#---------------------------------------------------------------------------------------------------------
}