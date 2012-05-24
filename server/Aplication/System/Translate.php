<?php
class System_Translate
{
	protected static $_instance;
	protected $translate;

#---------------------------------------------------------------------------------------------------------

	protected function __construct($language = null)
	{
		$user_setting = Zend_Registry::get('user_setting');

		if ($language === null) {
			$language = $user_setting->language;
		}

//--> Utworzenie obiektu Zend_Translate
		$this->translate = new System_Translate_Zend(array(
			'adapter' => 'gettext',
			'locale'  => $language,
			'disableNotices' => true
		));

//--> Wczytanie pliku wersji językowej systemu
		$file = ROOT_APLICATION_SYSTEM . DS . 'i18n' . DS . $language . '.mo';
		if (file_exists($file)) {
			$this->translate->addTranslation(array(
				'content' => $file,
				'locale'  => $language
			));
		}
	}

#---------------------------------------------------------------------------------------------------------

	public static function getInstance($language = null)
	{
		if (null === self::$_instance) {
			self::$_instance = new self($language);
		}

		return self::$_instance;
	}

#---------------------------------------------------------------------------------------------------------

	public static function get($root_translate_file, $language = null)
	{
		$instance = self::getInstance();
		$translate = clone $instance->translate;
		$user_setting = Zend_Registry::get('user_setting');

		if ($language === null) {
			$language = $user_setting->language;
		}

//--> Wczytanie i dodanie aktualnego pliku wersji językowej
		$file = $root_translate_file . DS . $language . '.mo';
		if (file_exists($file)) {
			$translate->addTranslation(array(
				'content' => $file,
				'locale'  => $language
			));
		}

		return $translate;
	}

#---------------------------------------------------------------------------------------------------------
}