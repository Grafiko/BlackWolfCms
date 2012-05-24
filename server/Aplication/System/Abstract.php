<?php
abstract class System_Abstract
{
	protected $_root_class_files;
	protected $_translate;

#---------------------------------------------------------------------------------------------------------

	public function __construct()
	{
		$this->setRootClassFiles();
		$this->_initTranslate();
	}

#---------------------------------------------------------------------------------------------------------

	protected function setRootClassFiles()
	{
		$_root_class_files = ROOT_APLICATION;
		$className = get_class($this);
		$_tmp = explode('_', $className);

		foreach ($_tmp as $key=>$value) {
			$_root_class_files.= DS . $value;
		}

		$this->_root_class_files = $_root_class_files;
	}

#---------------------------------------------------------------------------------------------------------

	protected function render($tpl_name, $values = null, $tpl_path = null)
	{
		if ($tpl_path) {
			$tpl = $tpl_path . DS . $tpl_name;
		} else {
			$tpl = $this->_root_class_files . DS . 'Template' . DS . $tpl_name;
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

	public function getTranslate()
	{
		return $this->_translate;
	}

#---------------------------------------------------------------------------------------------------------

	protected function _initTranslate()
	{
		$this->_translate = System_Translate::get($this->_root_class_files . DS . 'i18n');
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