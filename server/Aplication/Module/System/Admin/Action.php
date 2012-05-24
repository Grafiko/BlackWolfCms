<?php
class Module_System_Admin_Action extends Module_AdminAction
{
#---------------------------------------------------------------------------------------------------------

	public function testSmtpSetting()
	{
		$system_setting = Zend_Registry::get('system_setting');
		$sEmail = System_Email::newEmail();
		$sEmail->addTo($system_setting['email_from']);
		$result = $sEmail->_send($this->_translate->_('test_smtp_email_title'), $this->_translate->_('test_smtp_email_text'));

		if ($result) {
			$oLog = System_Logs_Model_Item_Mapper::newItem();
			$oLog->is_admin_panel = true;
			$oLog->type = System_Logs::WARNING;
			$oLog->module = 'Module_System_Admin';
			$oLog->setMessage('smtp_server_was_successful_%s', array($system_setting['email_from']));
			$oLog->save();
		} else {
			$oLog = System_Logs_Model_Item_Mapper::newItem();
			$oLog->is_admin_panel = true;
			$oLog->type = System_Logs::INFO;
			$oLog->module = 'Module_System_Admin';
			$oLog->setMessage('could_not_connect_to_smtp_server');
			$oLog->save();
		}

		$url = System_Url_Admin::create('system', 'setting', null, array('hash'=>'settingMail'));
		System_Url::redirect($url);

		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public function saveSmtpSetting()
	{
		$this->setData('mail',
			array(
			  'smtp_server' => System_Url::getPost('smtp_server'),
			  'smtp_email' => System_Url::getPost('smtp_email'),
			  'smtp_pass' => System_Url::getPost('smtp_pass'),
			  'smtp_send_perminute' => System_Url::getPost('smtp_send_perminute'),
			  'email_from' => System_Url::getPost('email_from'),
			  'email_name' => System_Url::getPost('email_name')
			)
		);

//--> Sprawdzamy czy wprowadzone dane są poprawne
		Module_System_Admin_Valid::saveSmtpSetting($this);

		if (false === $this->getData('mail_errors')) {
			foreach ($this->getData('mail') as $var_name=>$value) {
				$oSetting = Module_System_Model_Setting_Mapper::findByVar($var_name);
				if ($oSetting instanceof Module_System_Model_Setting_Row) {
					if ($oSetting->value !== $value) {
						$oSetting->updated_at = Zend_Registry::get('date')->get(Zend_Date::ISO_8601);
						$oSetting->updated_user_id = Zend_Registry::get('identity')->id;
						$oSetting->value = $value;
						$oSetting->save();
					}
				}
			}

			$oLog = System_Logs_Model_Item_Mapper::newItem();
			$oLog->is_admin_panel = true;
			$oLog->type = System_Logs::UPDATE;
			$oLog->module = 'Module_System_Admin';
			$oLog->setMessage('new_settings_for_email_have_been_saved');
			$oLog->save();

			//System_Aplication::reloadSetting();
			$this->testSmtpSetting();
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function cacheClear()
	{
//--> Usuwamy cache
		System_Utilities::removeAllInFolder(ROOT_APLICATION_TEMP_CACHE_DB, true);
		System_Utilities::removeAllInFolder(ROOT_APLICATION_TEMP_CACHE_SYSTEM, true);
		System_Utilities::removeAllInFolder(ROOT_APLICATION_TEMP_TPL_COMPLIE, true);
		System_Utilities::removeAllInFolder(ROOT_APLICATION_TEMP_TPL_CACHE, true);
		System_Utilities::removeAllInFolder(ROOT_ASSET);

//--> Dodajemy log do systemu
		$oLog = System_Logs_Model_Item_Mapper::newItem();
		$oLog->is_admin_panel = true;
		$oLog->type = System_Logs::INFO;
		$oLog->module = 'Module_System_Admin';
		$oLog->setMessage('cache_site_was_successfully_cleaned');
		$oLog->save();

		System_Url::redirect(
			System_Url_Admin::create('system', 'cache')
		);
	}

#---------------------------------------------------------------------------------------------------------
}