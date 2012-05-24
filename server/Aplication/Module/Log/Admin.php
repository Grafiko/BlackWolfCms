<?php
class Module_Log_Admin extends Module_Admin implements Module_AdminInterface
{

#---------------------------------------------------------------------------------------------------------

	public function __init() {}

#---------------------------------------------------------------------------------------------------------

	public function display_default() {}

#---------------------------------------------------------------------------------------------------------

	public function view_logPanel($count_log = 10)
	{
//--> Pobranie cookie z ustawieniem panelu
		$cookie = (int) System_Url::getCookie('system_logs', 0);

		$dbTable = new System_Logs_Model_Item_DbTable();
		$select = $dbTable->select();
		$select->order('created_at DESC');
		$select->where('is_admin_panel', true);
		$select->where('created_user_id', Zend_Registry::get('identity')->id);
		$select->limit($count_log);
		$oLogRowset = $dbTable->fetchAll($select);

		foreach ($oLogRowset as $oLog) {
			$created_at = new Zend_Date(strtotime($oLog->created_at));
			$oLog->created_at = $created_at->toString("dd.MM.YYYY | HH:mm");
		}

		$tpl_data = array(
			'oLogRowset' => $oLogRowset,
			'isOpen' => $cookie
		);

		$result = $this->render('logPanel.tpl', $tpl_data);
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}