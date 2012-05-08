<?php
function smarty_function_bw_js($params, $template)
{
	if (empty($params['file'])) {
		trigger_error("js: nie podano parametru <b>file</b>");
		return;
	}

	if (empty($params['type']) && empty($params['dir'])) {
		trigger_error("js: nie podano parametru <b>type</b> i <b>dir</b>");
		return;
	}

	if (!empty($params['type'])) {
		switch ($params['type']) {
			case 'admin':
				$public_path = PUBLIC_PATH_ASSET_ADMIN_JAVASCRIPT . '/';
				$dir = System_Url::getBaseUrl() . PUBLIC_PATH_ASSET_ADMIN_JAVASCRIPT . '/';
				break;
			case 'site':
			default:
				$public_path = PUBLIC_PATH_ASSET_SITE_JAVASCRIPT . '/';
				$dir = System_Url::getBaseUrl() . PUBLIC_PATH_ASSET_SITE_JAVASCRIPT . '/';
				break;
		}
	} elseif (!empty($params['dir'])) {
		$public_path = $params['dir'];
		$dir = System_Url::getBaseUrl() . $params['dir'];
	}

	if (!file_exists($dir . $params['file'])) {
		trigger_error("js: wybrany plik <b>{$dir}{$params['file']}</b> nie istnieje.");
		return;
	}

	System_MetaData::getInstance()->addJs($dir . $params['file']);
}