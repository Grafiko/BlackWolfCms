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
		$_translate = self::_initTranslate();
		$_result = array('isLogin', 'msg');

		$f        = new Zend_Filter_StripTags();
		$login    = $f->filter(System_Url::getPost('_email'));
		$password = $f->filter(System_Url::getPost('_pass'));

		if(!empty($login)) {
			$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(), 'user', 'email', 'passwd', 'MD5(?)');
			$authAdapter->setIdentity($login);
			$authAdapter->setCredential($password);
			$auth = Zend_Auth::getInstance();
			$authenticate = $auth->authenticate($authAdapter);

			if($authenticate->isValid()) {
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
						$_result['login'] = true;
						break;

					case System_Auth::USER_NOACTIV:
						Zend_Auth::getInstance()->clearIdentity();
						$_result['login'] = false;
						$_result['msg'] = $_translate->_('this_account_has_not_been_activated_yet');
						break;

					case System_Auth::USER_BLOCKED:
						Zend_Auth::getInstance()->clearIdentity();
						$_result['login'] = false;
						$_result['msg'] = $_translate->_('this_account_has_been_blocked');
						break;

					case System_Auth::USER_DELETED:
						Zend_Auth::getInstance()->clearIdentity();
						$_result['login'] = false;
						$_result['msg'] = $_translate->_('sorry_this_account_has_been_deleted');
						break;
				}
			} else {
				$_result['login'] = false;
			}
		} else {
			$_result['login'] = false;
		}

		if(!$_result['login']) {
			$oUserArchiveLogin = Module_User_Model_UserArchiveLogin_Mapper::newItem();
			$oUserArchiveLogin->login = $login;
			$oUserArchiveLogin->time = Zend_Registry::get('date')->get(Zend_Date::ISO_8601);
			$oUserArchiveLogin->ip = $_SERVER['REMOTE_ADDR'];
			$oUserArchiveLogin->browser = $_SERVER['HTTP_USER_AGENT'];
			$oUserArchiveLogin->save();
		}

		if(!$_result['login'] && empty($_result['msg'])) {
			$_result['msg'] = $_translate->_('the_specified_username_or_password_is_incorrect');
		}

		return $_result;
	}

#---------------------------------------------------------------------------------------------------------

	private static function _initTranslate()
	{
		return System_Translate::get(ROOT_APLICATION_SYSTEM . DS . 'Auth' . DS . 'i18n');
	}

#---------------------------------------------------------------------------------------------------------
}