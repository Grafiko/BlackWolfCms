<?php
class System_Logs
{
	const ERROR = 'error';
	const WARNING = 'warning';
	const INFO = 'info';
	const CREATE = 'create';
	const UPDATE = 'update';
	const DELETE = 'delete';

	protected static $_instance;

#---------------------------------------------------------------------------------------------------------

	public function __construct()
	{
		
	}

#---------------------------------------------------------------------------------------------------------

	public static function getInstance()
	{
		if(null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

#---------------------------------------------------------------------------------------------------------

	public static function newItem()
	{
		return System_Logs_Model_Item_Mapper::newItem();
	}

#---------------------------------------------------------------------------------------------------------

	public function getItems($type = null, $message = null)
	{

	}

#---------------------------------------------------------------------------------------------------------
}