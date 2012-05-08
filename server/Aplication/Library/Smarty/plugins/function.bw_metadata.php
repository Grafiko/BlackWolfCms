<?php
function smarty_function_bw_metadata($params, $template)
{
	$config = Zend_Registry::get('config');

	if(empty($params['action'])) {
		trigger_error("css: nie podano parametru <b>action</b>");
		return;
	} else {
		$action = $params['action'];
	}

	switch($action) {
		case 'display':
			return System_MetaData::getInstance()->display();
			break;
	}
}