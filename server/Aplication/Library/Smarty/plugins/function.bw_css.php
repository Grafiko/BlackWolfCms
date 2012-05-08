<?php
function smarty_function_bw_css($params, $template)
{
	$_tpl_config = $template->getTemplateVars('_config');
	Zend_Debug::dump($_tpl_config);
	if (empty($params['file'])) {
		trigger_error("css: nie podano parametru <b>file</b>");
		return;
	}

	if (empty($params['dir'])) {
		$path_css = $_tpl_config['public_path'] . DS . 'css';
	} elseif (!empty($params['dir'])) {
		$path_css = System_Url::getBaseUrl() . $params['dir'];
	}

	if (!System_Utilities::fileExists(ROOT . DS . $path_css. DS . $params['file'])) {
		trigger_error("css: wybrany plik <b>{$params['file']}</b> nie istnieje.");
		return;
	}

	System_MetaData::getInstance()->addCss(DS . $path_css . DS . $params['file']);
}