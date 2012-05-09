<?php
function smarty_function_bw_css($params, $template)
{
	$_tpl_config = $template->getTemplateVars('_config');

	if (empty($params['file'])) {
		trigger_error("css: nie podano parametru <b>file</b>");
		return;
	}

	if (empty($params['dir'])) {
		$path_css = $_tpl_config['public_path'] . DS . 'css';
	} elseif (!empty($params['dir'])) {
		$dir = str_replace(array('/', '\\'), DS, $params['dir']);
		if ($dir[0] == DS) {
			$dir = substr($dir, 1, strlen($dir) - 1);
		}
		if ($dir[strlen($dir) - 1] == DS) {
			$dir = substr($dir, 0, -1);
		}
		$path_css = $dir;
	}

	if (!System_Utilities::fileExists(ROOT . DS . $path_css. DS . $params['file'])) {
		trigger_error("css: wybrany plik <b>" . ROOT . DS . $path_css. DS . $params['file'] . "</b> nie istnieje.");
		return;
	}

	System_MetaData::getInstance()->addCss(DS . $path_css . DS . $params['file']);
}