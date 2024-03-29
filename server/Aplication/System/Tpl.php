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
		if (strpos($tpl_file_path, ROOT_APLICATION_TEMPLATE) !== false) {
			return self::checkConfigStartTpl($tpl_file_path);
		} else {
			return self::checkConfigModuleTpl($tpl_file_path);
		}
	}

#---------------------------------------------------------------------------------------------------------

	private static function checkConfigStartTpl($tpl_file_path = null)
	{
		if (strpos($tpl_file_path, ROOT_APLICATION_TEMPLATE_ADMIN) !== false) {
			$md5_tpl_file_path = md5(ROOT_APLICATION_TEMPLATE_ADMIN);
		} elseif (strpos($tpl_file_path, ROOT_APLICATION_TEMPLATE_SITE) !== false) {
			$md5_tpl_file_path = md5(ROOT_APLICATION_TEMPLATE_SITE);
		} else {
			return;
		}

		$cacheTemplate = Zend_Registry::get('cacheTemplate')->load($md5_tpl_file_path);

		if (!$cacheTemplate) {
//-----> Rozbicie ścieżki pliku *.tpl
			$_tmp = explode(DS, $tpl_file_path);

//-----> Ustawienie ścieżki do katalogu plików startowych *.tpl
			unset($_tmp[count($_tmp) - 1]);
			$root_config = implode(DS, $_tmp);

			if (file_exists ($root_config . DS . 'config.xml')) {
				$config = simplexml_load_file($root_config . DS . 'config.xml');

				if (isset($config->tpl)) {
					$cacheTemplate = array();
					if (isset($config->tpl->files)) {
//--------------> Sprawdzanie zmiennej public_path
						$public_path = (string) $config->tpl->files->attributes()->public_path;
						$public_path = str_replace(array('/', '\\'), DS, $public_path);
						if ($public_path[0] == DS) {
							$public_path = substr($public_path, 1, strlen($public_path) - 1);
						}
						if ($public_path[strlen($public_path) - 1] == DS) {
							$public_path = substr($public_path, 0, -1);
						}

						foreach ($config->tpl->files->children() as $type => $file) {
							$root_current = $root_config . DS . $type . DS . $file;
							$root_current = str_replace(array('/', '\''), DS, $root_current);

							$root_destination = ROOT . DS . $public_path . DS . $type . DS . $file;
							$root_destination = str_replace(array('/', '\''), DS, $root_destination);

//-----------------> Utworzenie ścieżki katalogów dla pliku
							$tmp = explode(DS, $root_destination);
							unset($tmp[count($tmp)-1]);
							implode(DS, $tmp);
							System_Utilities::mkdirRecursive(implode(DS, $tmp));

							if (file_exists($root_current)) {
								//echo $root_current . ' ' .$root_destination;
								copy($root_current,  $root_destination);
							}
						}
						$cacheTemplate['public_path'] = $public_path;
					}

					Zend_Registry::get('cacheTemplate')->save($cacheTemplate, $md5_tpl_file_path);
				}
			}
		}
		return $cacheTemplate;
	}

#---------------------------------------------------------------------------------------------------------

	private static function checkConfigModuleTpl($tpl_file_path = null)
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
								$root_current = $root_config . DS . $tpl_dir_name . DS . $type . DS . $file;
								$root_current = str_replace(array('/', '\''), DS, $root_current);

								$root_destination = ROOT . DS . $public_path . DS . $type . DS . $file;
								$root_destination = str_replace(array('/', '\''), DS, $root_destination);

//--------------------> Utworzenie ścieżki katalogów dla pliku
								$tmp = explode(DS, $root_destination);
								unset($tmp[count($tmp)-1]);
								implode(DS, $tmp);
								System_Utilities::mkdirRecursive(implode(DS, $tmp));
//echo '<br />' .$root_current . '<br />';
								if (file_exists($root_current)) {
									copy($root_current,  $root_destination);
								}
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