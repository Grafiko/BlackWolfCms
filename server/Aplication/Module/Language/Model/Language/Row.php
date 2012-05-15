<?php
class Module_Language_Model_Language_Row extends Db_Table_Row_Abstract
{
#---------------------------------------------------------------------------------------------------------

	public function getChangeUrl()
	{
		//Zend_Debug::dump($language);
		//exit;
		$_action_run_module = System_Url::getRunModule();
		$_action_run_show = System_Url::getRunShow();
		$_action_run_action = null;

		$url = System_Url::create($_action_run_module, $_action_run_show, $_action_run_action, array(
			'language' => $this->code
		));
		return $url;
	}

#---------------------------------------------------------------------------------------------------------
}