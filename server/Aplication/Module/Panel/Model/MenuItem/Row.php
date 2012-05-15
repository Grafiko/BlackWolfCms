<?php
class Module_Panel_Model_MenuItem_Row extends Db_Table_Row_Abstract
{
#---------------------------------------------------------------------------------------------------------

	public function getModuleUrl()
	{
		$url = System_Url_Admin::create($this->link_run_module, $this->link_run_show);
		return $url;
	}

#---------------------------------------------------------------------------------------------------------

	public function getActionUrl()
	{
		$url = System_Url_Admin::create($this->action_run_module, $this->action_run_show);
		return $url;
	}

#---------------------------------------------------------------------------------------------------------
}