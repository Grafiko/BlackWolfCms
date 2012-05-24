<?php
class System_Utilities
{
#---------------------------------------------------------------------------------------------------------
	public static function decToSystem($dec, $separator = ',')
	{
		$dec = str_replace(' ', '', $dec);
		return str_replace($separator, '.', $dec);
	}

#---------------------------------------------------------------------------------------------------------

	public static function decToDisplay($dec, $separator = ',', $waluta = 'PLN')
	{
		$dec = number_format($dec, 2, ',', ' ');
		$dec = str_replace('.', $separator, $dec);
		if ($waluta) return $dec . ' ' . $waluta;
		else return $dec;
	}

#---------------------------------------------------------------------------------------------------------

	public static function _stripslashes($string)
	{
		$string = is_array($string) ? array_map('System_Utilities::_stripslashes', $string) : stripslashes($string);
		return $string;
	}

#---------------------------------------------------------------------------------------------------------

	public static function _addslashes($string)
	{
		if (is_array($string)) {
			$string = array_map('System_Utilities::_addslashes', $string);
		} else {
			if (get_magic_quotes_gpc()) {
				//return $string;
			} else {
				if (function_exists('addslashes')) {
					$string = addslashes($string);
				} else {
					$string = mysql_real_escape_string($string);
				}
			}
		}
		return $string;
	}

#---------------------------------------------------------------------------------------------------------

	public static function fileExists($filename)
	{
		$filename = preg_replace('/(\/\/){2,}|(\\\){1,}/','/',$filename);
		return file_exists($filename);
	}

#---------------------------------------------------------------------------------------------------------
# Funkcja tworząca rekursywnie ścieżkę katalogów
#---------------------------------------------------------------------------------------------------------

	public static function mkdirRecursive($path, $mode = 0777)
	{
		if (is_dir($path)) {
			return true;
		}

		$folder = preg_split( "/[\\\\\/]/" , $path);
		$mkfolder = '';
		for ($i=0; isset($folder[$i]); $i++) {
			if (!strlen(trim($folder[$i])))
				continue;
			$mkfolder .= $folder[$i];
			if (!is_dir($mkfolder)){
				mkdir("$mkfolder" ,  $mode);
			}
			$mkfolder .= DS;
		}

		if (is_dir($path)) {
			return true;
		} else {
			return false;
		}
	}

#---------------------------------------------------------------------------------------------------------
# Funkcja pobiera wielkość całego folderu wraz ze wszystkimi subfloderami oraz pliki
#---------------------------------------------------------------------------------------------------------

	public static function getDirSize($dir_name)
	{
		$dir_size = 0;
		if (is_dir($dir_name)) {
			if ($dh = opendir($dir_name)) {
				while (($file = readdir($dh)) !== false) {
					if ($file !='.' && $file != '..') {
						if (is_file($dir_name . DS . $file)) {
							$dir_size += filesize($dir_name . DS . $file);
						}
						if (is_dir($dir_name . DS . $file)) {
							$dir_size +=  System_Utilities::getDirSize($dir_name . DS . $file);
						}
					}
				}
			}
			closedir($dh);
		}
		return $dir_size;
	}

#---------------------------------------------------------------------------------------------------------
# Funkcja usuwa wszystkie foldery, subflodery oraz pliki z wybranego katalogu
# $empty - czy główny katalog ma zostać
#---------------------------------------------------------------------------------------------------------

	public static function removeAllInFolder($directory, $empty = false)
	{
		if (substr($directory,-1) == "/") {
			$directory = substr($directory,0,-1);
		}

		if (!file_exists($directory) || !is_dir($directory)) {
			return false;
		} elseif (!is_readable($directory)) {
			return false;
		} else {
			$directoryHandle = opendir($directory);

			while ($contents = readdir($directoryHandle)) {
				if ($contents != '.' && $contents != '..') {
					$path = $directory . DS . $contents;

					if (is_dir($path)) {
						self::removeAllInFolder($path);
					} else {
						unlink($path);
					}
				}
			}

			closedir($directoryHandle);

			if ($empty == false) {
				if (!rmdir($directory)) {
					return false;
				}
			}

			return true;
		}
	}

#---------------------------------------------------------------------------------------------------------
# Funkcja sprawdza czy podana wartość została poddana serializacji
#---------------------------------------------------------------------------------------------------------

	public static function is_serialized($data)
	{
		if (!is_string($data)) {
			return false;
		}

		$data = trim( $data );

		if ('N;' == $data) {
			return true;
		}

		if (!preg_match( '/^([adObis]):/', $data, $badions )) {
			return false;
		}

		switch ($badions[1]) {
			case 'a' :
			case 'O' :
			case 's' :
				if (preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data )) {
					return true;
				}
				break;
			case 'b' :
			case 'i' :
			case 'd' :
				if (preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data)) {
					return true;
				}
				break;
		}
		return false;
	}
#---------------------------------------------------------------------------------------------------------
}