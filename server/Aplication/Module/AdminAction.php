<?php
abstract class Module_AdminAction
{
	protected $module;

#---------------------------------------------------------------------------------------------------------

	public function __construct($module)
	{
		$this->module = $module;
	}

#---------------------------------------------------------------------------------------------------------

	public function execute($action)
	{
		if (method_exists($this, $action)) {
			return $this->$action();
		}
	}

#---------------------------------------------------------------------------------------------------------
}