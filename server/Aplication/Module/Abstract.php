<?php
abstract class Module_Abstract extends System_Abstract
{
	protected $_toDisplay;
	protected $_page;
	protected $_hash;
	private $_data;

#---------------------------------------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		$this->_page = System_Url::getGP('page', 1);
		$this->_hash = System_Url::getGP('hash');
	}

#---------------------------------------------------------------------------------------------------------

	public function __get($name)
	{
		if (isset($this->$name)) {
			return $this->$name;
		} else {
			return null;
		}
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

	protected function getModule($_moduleClassName, $_action = null)
	{
		if (class_exists($_moduleClassName)) {
			$module = new $_moduleClassName($_action);
			return $module;
		} else {
			die('Nie istnie klasa modułu: ' . $_moduleClassName);
		}
	}

#---------------------------------------------------------------------------------------------------------

	protected function checkModuleAction($action)
	{
		if (null !== $action) {
			$className = get_class($this) . '_Action';
			$execute = new $className($this);
			$result = $execute->execute($action);

			if ($result !== null and is_array($result)) {
				foreach ($result as $name => $value) {
					$this->setData($name, $value);
				}
			}
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
}