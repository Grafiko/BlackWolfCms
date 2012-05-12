<?php
class System_Translate
{
#---------------------------------------------------------------------------------------------------------

	public static function get($root_translate_file, $language = null)
	{
		if ($language === null) {
			$language = Zend_Registry::get('language');
		}

		$file = $root_translate_file . DS . $language . '.mo';
		if (file_exists($file)) {
			$translate = new Zend_Translate(array(
					'adapter' => 'gettext',
					'content' => $file,
					'locale'  => $language
			));
			return $translate;
		}
	}

#---------------------------------------------------------------------------------------------------------
}