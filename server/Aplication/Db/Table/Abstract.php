<?php
abstract class Db_Table_Abstract extends Zend_Db_Table
{
#---------------------------------------------------------------------------------------------------------

	public function __construct($config = array(), $definition = null)
	{
		parent::__construct($config, $definition);
	}

#---------------------------------------------------------------------------------------------------------

	public function getName()
	{
		return $this->_name;
	}

#---------------------------------------------------------------------------------------------------------
}