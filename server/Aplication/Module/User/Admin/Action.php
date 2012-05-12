<?php
class Module_User_Admin_Action extends Module_AdminAction
{
#---------------------------------------------------------------------------------------------------------

	public function login()
	{
		$result = System_Auth::Login();

		if($result['login']) {
			System_Url::redirect(
				System_Url_Admin::create('panel')
			);
		}

		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}
