<?php
abstract class Module_Common
{
	protected $_toDisplay;
	protected $_tpl_path;
	protected $_root_module;
	protected $_page;
	protected $_data_from_action;
	protected $_translate;

#---------------------------------------------------------------------------------------------------------

	public function __construct()
	{
		$this->_page = System_Url::getGP('page', 1);
		$this->setModulePath();
		$this->setTplPath();
		$this->_initTranslate();
	}

#---------------------------------------------------------------------------------------------------------

	protected function checkModuleAction($action)
	{
		if (null !== $action) {
			$className = get_class($this) . '_Action';
			$execute = new $className($this);
			$this->_data_from_action = $execute->execute($action);
		}
	}

#---------------------------------------------------------------------------------------------------------

	protected function addToDisplay($toDisplay)
	{
		$this->_toDisplay.= $toDisplay;
	}

#---------------------------------------------------------------------------------------------------------

	public function getModuleResult()
	{
		return $this->_toDisplay;
	}

#---------------------------------------------------------------------------------------------------------

	protected function setModulePath()
	{
		$tpl_path = ROOT_APLICATION_MODULE;
		$className = get_class($this);
		$_tmp = explode('_', $className);
		unset($_tmp[0]);
		foreach ($_tmp as $key=>$value) {
			$tpl_path.= DS . $value;
		}

		$this->_root_module = $tpl_path;
	}

#---------------------------------------------------------------------------------------------------------

	protected function setTplPath()
	{
		$tpl_path = ROOT_APLICATION_MODULE;
		$className = get_class($this);
		$_tmp = explode('_', $className);
		unset($_tmp[0]);
		foreach ($_tmp as $key=>$value) {
			$tpl_path.= DS . $value;
		}

		$this->_tpl_path = $tpl_path . DS . 'Template';
	}

#---------------------------------------------------------------------------------------------------------

	protected function render($tpl_name, $values = null, $tpl_path = null)
	{
		if ($tpl_path) {
			$tpl = $tpl_path . DS . $tpl_name;
		} else {
			$tpl = $this->_tpl_path . DS . $tpl_name;
		}

		if (file_exists($tpl)) {
			$config = System_Tpl::checkConfig($tpl);

			$output = new smarty();
			$output->assign('_config', $config);
			$output->assign('_translate', $this->_translate);

			if (is_array($values)) {
				foreach ($values as $name => $value) {
					$output->assign($name, $value);
				}
			}

			$result = $output->fetch($tpl);
		} else {
			$result = "Szablon .tpl '{$tpl_name}' nie istnieje.";
		}

		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	protected function _initTranslate()
	{
		$this->_translate = System_Translate::get($this->_root_module . DS . 'i18n');
		/*
		$language = Zend_Registry::get('language');
		$file = $this->_root_module . DS . 'i18n' . DS . $language . '.mo';
		if (file_exists($file)) {
			$this->_translate = new Zend_Translate(array(
					'adapter' => 'gettext',
					'content' => $file,
					'locale'  => $language
			));
		}
		*/
	}

#---------------------------------------------------------------------------------------------------------

	protected function sendJson($json)
	{
		header('Content-Type: application/json');
		echo Zend_Json::encode($json, Zend_Json::TYPE_OBJECT);
		exit;
	}

#---------------------------------------------------------------------------------------------------------
}