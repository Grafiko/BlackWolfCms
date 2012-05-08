<?php
class System_Tpl
{
	protected static $_instance;

#---------------------------------------------------------------------------------------------------------

	protected function __construct()
	{
		
	}

#---------------------------------------------------------------------------------------------------------

	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

#---------------------------------------------------------------------------------------------------------

	public static function checkConfig($tpl_file_path = null)
	{
		$md5_tpl_file_path = md5($tpl_file_path);
		$cacheTemplate = Zend_Registry::get('cacheTemplate')->load($md5_tpl_file_path);

		if(!$cacheTemplate) {
//-----> Rozbicie ścieżki pliku *.tpl
			$_tmp = explode(DS, $tpl_file_path);

//-----> Ustawienie nazwy pliku *.tpl
			$tpl_name = $_tmp[count($_tmp) - 1];

//-----> Ustawienie ścieżki do katalogu pliku *.tpl
			unset($_tmp[count($_tmp) - 1]);
			$root_config = implode(DS, $_tmp);

//-----> Ustawienie ścieżki do potencjalnego katalogu z plikami szablonu *.tpl
			$_tmp = explode('.', $tpl_name);
			$tpl_dir_name = $_tmp[0];

			if (file_exists ($root_config . DS . 'config.xml')) {
				$config = simplexml_load_file($root_config . DS . 'config.xml');

				foreach ($config->tpl as $tpl) {
					if ($tpl->attributes()->name == $tpl_name) {
						$cacheTemplate = array();
						if (isset($tpl->files)) {
//-----------------> Sprawdzanie zmiennej public_path
							$public_path = (string) $tpl->files->attributes()->public_path;
							$public_path = str_replace(array('/', '\\'), DS, $public_path);
							if ($public_path[0] == DS) {
								$public_path = substr($public_path, 1, strlen($public_path) - 1);
							}
							if ($public_path[strlen($public_path) - 1] == DS) {
								$public_path = substr($public_path, 0, -1);
							}

							foreach ($tpl->files->children() as $type => $file) {
								$root_current = $root_config . DS . $tpl_dir_name . DS . $type;
								$root_destination = ROOT . DS . $public_path . DS . $type;
								$root_destination = str_replace(array('/', '\''), DS, $root_destination);
								System_Utilities::mkdirRecursive($root_destination);
								copy($root_current . DS . $file,  $root_destination . DS . $file);
							}
							$cacheTemplate['public_path'] = $public_path;
						}

						Zend_Registry::get('cacheTemplate')->save($cacheTemplate, $md5_tpl_file_path);
					}
				}
			}
		}
		return $cacheTemplate;
	}

#---------------------------------------------------------------------------------------------------------
}