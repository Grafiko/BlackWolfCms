<?php
class System_Auth
{
	const USER_NOACTIV  = 1;
	const USER_ACTIV    = 2;
	const USER_BLOCKED  = 3;
	const USER_DELETED  = 4;

#---------------------------------------------------------------------------------------------------------

	public static function IsLogin()
	{
		return (Zend_Auth::getInstance()->getIdentity() !== null);
	}

#---------------------------------------------------------------------------------------------------------

	public static function Login($redirect = null)
	{
		$f        = new Zend_Filter_StripTags();
		$login    = $f->filter(System_Url::getPost('_email'));
		$password = $f->filter(System_Url::getPost('_pass'));

		if(!empty($login)) {
			$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(), 'user', 'email', 'passwd', 'MD5(?)');
			$authAdapter->setIdentity($login);
			$authAdapter->setCredential($password);
			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($authAdapter);

			if($result->isValid()) {
				$data = $authAdapter->getResultRowObject(array('id', 'email', 'user_role_id', 'state'));
				switch($data->state) {
					case System_Auth::USER_ACTIV:
						$roleData       = Module_User_Model_UserRole_Mapper::findById($data->user_role_id);;
						$data->aclRole  = $roleData['hash'];
						$auth->getStorage()->write($data);

						$oUserArchiveLogin = Module_User_Model_UserArchiveLogin_Mapper::newItem();
						$oUserArchiveLogin->login = $login;
						$oUserArchiveLogin->user_id = $data->id;
						$oUserArchiveLogin->time = Zend_Registry::get('date')->get(Zend_Date::ISO_8601);
						$oUserArchiveLogin->ip = $_SERVER['REMOTE_ADDR'];
						$oUserArchiveLogin->browser = $_SERVER['HTTP_USER_AGENT'];
						$oUserArchiveLogin->save();
						$_json['state'] = true;
						break;

					case System_Auth::USER_NOACTIV:
						Zend_Auth::getInstance()->clearIdentity();
						$_json['state'] = false;
						$_json['msg'] = 'To konto nie zostało jeszcze aktywowane.';
						break;

					case System_Auth::USER_BLOCKED:
						Zend_Auth::getInstance()->clearIdentity();
						$_json['state'] = false;
						$_json['msg'] = 'To konto zostało zablokowane.';
						break;

					case System_Auth::USER_DELETED:
						Zend_Auth::getInstance()->clearIdentity();
						$_json['state'] = false;
						$_json['msg'] = 'Przykro nam, to konto zostało usunięte.';
						break;
				}
			} else {
				$_json['state'] = false;
			}
		} else {
			$_json['state'] = false;
		}

		if(!$_json['state']) {
			$oUserArchiveLogin = Module_User_Model_UserArchiveLogin_Mapper::newItem();
			$oUserArchiveLogin->login = $login;
			$oUserArchiveLogin->time = Zend_Registry::get('date')->get(Zend_Date::ISO_8601);
			$oUserArchiveLogin->ip = $_SERVER['REMOTE_ADDR'];
			$oUserArchiveLogin->browser = $_SERVER['HTTP_USER_AGENT'];
			$oUserArchiveLogin->save();
		}

		if(!$_json['state'] && empty($_json['msg'])) {
			$_json['msg'] = 'Podany login bądź hasło jest błędne';
		}

		if($_json['state']) {
			System_Url::redirect(
				System_Url::create(System_Url::getPageName())
			);
		}
		return $_json;
	}

#---------------------------------------------------------------------------------------------------------
}