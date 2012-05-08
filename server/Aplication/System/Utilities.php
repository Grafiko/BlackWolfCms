<?php
class System_Utilities
{
#---------------------------------------------------------------------------------------------------------

	public static function fileExists($filename)
	{
		echo $filename = preg_replace('/(\/\/){2,}|(\\\){1,}/','/',$filename);
		return file_exists($filename);
	}

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

	public static function getDirSize($dir_name)
	{
		$dir_size = 0;
		if (is_dir($dir_name)) {
			if ($dh = opendir($dir_name)) {
				while (($file = readdir($dh)) !== false) {
					if ($file !='.' && $file != '..') {
						if (is_file($dir_name.'/'.$file)) {
							$dir_size += filesize($dir_name.'/'.$file);
						}
						/* check for any new directory inside this directory */
						if (is_dir($dir_name.'/'.$file)) {
							$dir_size +=  System_Utilities::getDirSize($dir_name.'/'.$file);
						}
					}
				}
			}
		}
		closedir($dh);
		return $dir_size;
	}

#---------------------------------------------------------------------------------------------------------
}