<?php
class System_Aplication
{
	protected static $_instance;
	private $_tpl;
	private $config;

#---------------------------------------------------------------------------------------------------------

	public static function getInstance()
	{
		if(null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

#---------------------------------------------------------------------------------------------------------

	protected function __construct()
	{
		System_Session::start();
		$this->setSetting();

		switch(System_Url::getPageName())
		{
			case System_Url::PATH_ADMIN:
				$this->getAdmin();
				break;

			default:
				$this->getSite();
				break;
		}
	}

#---------------------------------------------------------------------------------------------------------

	private function setSetting()
	{
		// LANGUAGE
		Zend_Registry::set('language', 'pl_PL');

		// OTHER
		Zend_Registry::set('locale', 'pl_PL');
		Zend_Registry::set('date', new Zend_Date(null, null, Zend_Registry::get('locale')));
		Zend_Registry::set('identity', Zend_Auth::getInstance()->getIdentity());

		// SESSION
		if(System_Auth::IsLogin()) {
			$id_user	= Zend_Registry::get('identity')->id;
			$_session->updateSession($id_user);
			$_session->setExpirationSeconds();
		}
/*
		// LOAD SETTING
		$settingList = Module_Setting_Model_Setting_Mapper::getAll();
		$setting = array();
		foreach($settingList as $var) {
			$setting[$var->var] = $var->value;
		}
		Zend_Registry::set('setting', $setting);

		// CACHE
		$frontendOptions = array('lifetime' => 10000, 'automatic_serialization' => true);
		$backendOptions = array('cache_dir' => DB_CACHE);
		$cache = Zend_Cache::factory('Output', 'File', $frontendOptions, $backendOptions);
		//$cache->clean();
		Zend_Registry::set('cache', $cache);
 */
	}

#---------------------------------------------------------------------------------------------------------

	public static function reloadSetting() {
		$settingList = Module_Setting_Model_Setting_Mapper::getAll();
		$setting = array();
		foreach($settingList as $var) {
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
			if ('user' !== $_module AND 'login' !== $_show) {
				$url = System_Url_Admin::create('user','login');
				System_Url::redirect($url);
			}
		} elseif ($_module === null){
			$url = System_Url_Admin::create('panel','start');
			System_Url::redirect($url);
		}

		$_className = 'Module_'.ucfirst(System_Url::getRunModule()).'_Admin';

		if (@class_exists($_className)) {
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
		define('ASSET_PATH', '/asset/template/site/default' );
		$this->page = System_Page::getInstance($this->url->getPageName());
		$this->genereOutPut();
	}

#---------------------------------------------------------------------------------------------------------

	public function genereOutPut()
	{
		$page = $this->page->getPageData();

		$oMetaData = System_MetaData::getInstance();
		$oMetaData->setTitle($page->meta_title!==null?$page->meta_title:$page->name);
		$oMetaData->setDescription($page->meta_description!==null?$page->meta_description:$page->name);
		$oMetaData->setKeywords($page->meta_keywords!==null?$page->meta_keywords:$page->name);

		$outPutTPL = new smarty();
		//$outPutTPL->error_reporting = 0;
		$outPutTPL->assign('SITE', Zend_Registry::get('config')->site);

		$oTags = $page->getTpl()->getTplTags();
		$oObjects = $page->getObjects();

		for($t=0,$tLn=count($oTags); $t<$tLn; $t++) {
			$result = null;
			for($o=0,$oLn=count($oObjects); $o<$oLn; $o++) {
				if($oObjects[$o]->tpl_tag_id === $oTags[$t]->id) {
					$result.= $oObjects[$o]->result;
				}
			}
			$outPutTPL->assign($oTags[$t]->name, $result);
		}

		$config = Zend_Registry::get('config');
		$_DIR['IMG'] = $config->weburl . ASSET_PATH . '/img';
		$outPutTPL->assign('PATH', $_DIR);
		$display = $outPutTPL->fetch(TEMPLATE_SITE_PATH . DS . SITE_TEMPLATE_NAME . DS . 'Start' . DS . $page->getTpl()->file);

		echo $display;
	}

#---------------------------------------------------------------------------------------------------------
}