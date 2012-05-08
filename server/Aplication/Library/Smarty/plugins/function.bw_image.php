<?php
function smarty_function_bw_image($params, $template)
{
	$src = $params['src'];
	$prefix = isset($params['prefix'])?$params['prefix']:null;
	$width = $params['width'];
	$height = $params['height'];
	$type = $params['type'];

	if(empty($src)) {
		trigger_error("image: nie wybrano zdjęcia", E_USER_WARNING);
		return;
	}

	$photo = System_Utilities::getImage($prefix, $src, $width, $height, $type);
	return $photo;
}