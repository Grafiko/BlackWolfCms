<?php
function smarty_function_bw_i18n($params, $template)
{
	if (!empty($params['txt'])) {
		$_text = $params['txt'];
		$_translate = $template->getTemplateVars('_translate');

		if ($_translate instanceof Zend_Translate) {
			return $_translate->_($_text);
		} else {
			return $_text;
		}
	}
}