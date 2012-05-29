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
		$_action_run_params = System_Url::getRunParams();

		if (isset($_action_run_params['run'])) {
			unset($_action_run_params['run']);
		}

		$_action_run_params = array_merge($_action_run_params, array('language' => $this->code));
		$url = System_Url::create($_action_run_module, $_action_run_show, $_action_run_action, $_action_run_params);
		return $url;
	}

#---------------------------------------------------------------------------------------------------------

	public function getChangeEditUrl()
	{
		$_action_run_module = System_Url::getRunModule();
		$_action_run_show = System_Url::getRunShow();
		$_action_run_action = null;
		$_action_run_params = System_Url::getRunParams();

		if (isset($_action_run_params['run'])) {
			unset($_action_run_params['run']);
		}

		//$_action_run_action['locale'] = $this->code;
		$_action_run_params = array_merge($_action_run_params, array('i18n' => $this->code));

		$url = System_Url_Admin::create($_action_run_module, $_action_run_show, $_action_run_action, $_action_run_params);
		return $url;
	}

#---------------------------------------------------------------------------------------------------------
}