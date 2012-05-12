<?php
abstract class Db_Table_Abstract extends Zend_Db_Table
{
	public function getName()
	{
		return $this->_name;
	}
}