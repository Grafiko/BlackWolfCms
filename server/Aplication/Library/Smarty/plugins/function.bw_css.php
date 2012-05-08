<?php
function smarty_function_bw_css($params, $template)
{
	if (empty($params['file'])) {
		trigger_error("css: nie podano parametru <b>file</b>");
		return;
	}

	if (empty($params['type']) && empty($params['dir'])) {
		trigger_error("css: nie podano parametru <b>type</b> i <b>dir</b>");
		return;
	}

	if (!empty($params['type'])) {
		switch ($params['type']) {
			case 'admin':
				$dir = System_Url::getBaseUrl() . PUBLIC_PATH_ASSET_ADMIN_CSS . '/';
				break;
			case 'site':
			default:
				$dir = System_Url::getBaseUrl() . PUBLIC_PATH_ASSET_SITE_CSS . '/';
				break;
		}
	} elseif (!empty($params['dir'])) {
		$dir = System_Url::getBaseUrl() . $params['dir'];
	}

	if (!file_exists($dir . $params['file'])) {
		trigger_error("css: wybrany plik <b>{$dir}{$params['file']}</b> nie istnieje.");
		return;
	}

	System_MetaData::getInstance()->addCss($dir . $params['file']);
}