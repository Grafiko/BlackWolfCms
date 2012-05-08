<?php
class System_Session
{
	protected static $_instance;

	public static $sessionConfig = array(
		'name' => 'user_session', //table name as per Zend_Db_Table
		'lifetime' => 1800,
		'primary' => array(
			'session_id', //the sessionID given by PHP
			'save_path', //session.save_path
			'name' //session name
		),
		'primaryAssignment' => array(
			//you must tell the save handler which columns you
			//are using as the primary key. ORDER IS IMPORTANT
			'sessionId', //first column of the primary key is of the sessionID
			'sessionSavePath', //second column of the primary key is the save path
			'sessionName', //third column of the primary key is the session name
		),
		'modifiedColumn' => 'modified', //time the session should expire
		'dataColumn' => 'session_data', //serialized data
		'lifetimeColumn' => 'lifetime', //end of life for a specific record
		'idUserColumn' => 'user_id' //end of life for a specific record
	);

#---------------------------------------------------------------------------------------------------------

	public static function getInstance()
	{
		if(null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

#---------------------------------------------------------------------------------------------------------

	protected function __construct() { }

#---------------------------------------------------------------------------------------------------------

	public static function start()
	{
		$instance = self::getInstance();
		$instance->setConfigSession();
		return $instance;
	}

#---------------------------------------------------------------------------------------------------------

	public static function removeOld()
	{
		$sql = Zend_Db_Table::getDefaultAdapter();
		$sql->delete('user_session', 'modified < ' . (time() - self::$sessionConfig['lifetime']));
	}

#---------------------------------------------------------------------------------------------------------

	private function setConfigSession()
	{
		Zend_Session::setSaveHandler(new Zend_Session_SaveHandler_DbTable(self::$sessionConfig));
		Zend_Session::start();
	}

#---------------------------------------------------------------------------------------------------------

	public function updateSession($user_id = null)
	{
		if(null !== $user_id)
		{
			$session_id = Zend_Session::getId();
			$data = array(
				'user_id' => $user_id
			);
			$sql = Zend_Db_Table::getDefaultAdapter();
			$sql->update('user_session', $data, 'session_id = "' . $session_id . '"');
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function setExpirationSeconds($time = null)
	{
		if($time === null) {
			$time = self::$sessionConfig['lifetime'];
		}

 		$user = new Zend_Session_Namespace('Zend_Auth');
		$user->setExpirationSeconds($time);
	}

#---------------------------------------------------------------------------------------------------------

	public static function deleteSession($user_id)
	{
		if(null !== $user_id) {
			$sql = Zend_Db_Table::getDefaultAdapter();
			$result = $sql->delete('user_session', 'user_id = "' . $user_id . '"');
			return $result;
		} else {
			return false;
		}
	}

#---------------------------------------------------------------------------------------------------------
}