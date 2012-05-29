<?php
abstract class Module_AdminAction
{
	protected $module;
	public $_translate;
	private $_data = null;

#---------------------------------------------------------------------------------------------------------

	public function __construct($module)
	{
		$this->module = $module;
		$this->_translate = $this->module->getTranslate();
	}

#---------------------------------------------------------------------------------------------------------

	public function execute($action)
	{
		if (method_exists($this, $action)) {
			$this->$action();
		}

		return $this->_data;
	}

#---------------------------------------------------------------------------------------------------------

	public function getModule()
	{
		return $this->module;
	}

#---------------------------------------------------------------------------------------------------------

	public function getData($name)
	{
		if (isset($this->_data[$name])) {
			return $this->_data[$name];
		} else {
			return null;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function setData($name, $value)
	{
		$this->_data[$name] = $value;
	}

#---------------------------------------------------------------------------------------------------------
}