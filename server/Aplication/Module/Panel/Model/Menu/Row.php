<?php
class Module_Panel_Model_Menu_Row extends Db_Table_Row_Abstract
{
	protected $_items;

#---------------------------------------------------------------------------------------------------------

	public function getItems()
	{
		if($this->_items instanceof Module_Panel_Model_MenuItem_Rowset) {
			return $this->_items;
		} else {
			$this->_items = Module_Panel_Model_MenuItem_Mapper::findByCategoryId($this->id);
			return $this->_items;
		}
	}

#---------------------------------------------------------------------------------------------------------
}