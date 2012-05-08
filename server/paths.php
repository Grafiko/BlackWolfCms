<?php
// Define
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath($_SERVER['DOCUMENT_ROOT']));
define('ROOT_APLICATION', ROOT . DS . 'Aplication');
define('ROOT_APLICATION_ADMIN', ROOT_APLICATION . DS . 'Admin');
define('ROOT_APLICATION_LIBRARY', ROOT_APLICATION . DS . 'Library');
define('ROOT_APLICATION_SYSTEM', ROOT_APLICATION . DS . 'System');
define('ROOT_APLICATION_MODULE', ROOT_APLICATION . DS . 'Module');
define('ROOT_APLICATION_TEMPLATE', ROOT_APLICATION . DS . 'Template');
define('ROOT_APLICATION_TEMPLATE_ADMIN', ROOT_APLICATION_TEMPLATE . DS . 'Admin');
define('ROOT_APLICATION_TEMPLATE_SITE', ROOT_APLICATION_TEMPLATE . DS . 'Site');
define('ROOT_APLICATION_TEMP', ROOT_APLICATION . DS . 'temp');
define('ROOT_APLICATION_TEMP_DB', ROOT_APLICATION_TEMP . DS .'db');
define('ROOT_APLICATION_TEMP_DB_CACHE', ROOT_APLICATION_TEMP_DB . DS .'cache');
define('ROOT_APLICATION_TEMP_TPL', ROOT_APLICATION_TEMP . DS .'tpl');
define('ROOT_APLICATION_TEMP_TPL_CACHE', ROOT_APLICATION_TEMP_TPL . DS .'cache');
define('ROOT_APLICATION_TEMP_TPL_COMPLIE', ROOT_APLICATION_TEMP_TPL . DS . 'compile');
define('ROOT_ASSET', ROOT . DS . 'asset');
define('ROOT_ASSET_ADMIN', ROOT_ASSET . DS . 'admin');
define('ROOT_ASSET_SITE', ROOT_ASSET . DS . 'site');


/*** OTHERS ***/
define('ROOT_FILES', ROOT . DS . 'files');
define('ROOT_FILES_CACHE', ROOT_FILES . DS . 'cache');
define('ROOT_FILES_MANAGER', ROOT_FILES . DS . 'manager');
define('ROOT_FILES_SLIDER', ROOT_FILES . DS . 'slider');


/*** PUBLIC PATHS ***/
define('PUBLIC_PATH_ASSET', 'asset');
define('PUBLIC_PATH_ASSET_ADMIN', PUBLIC_PATH_ASSET . '/admin');
define('PUBLIC_PATH_ASSET_ADMIN_IMAGE', PUBLIC_PATH_ASSET_ADMIN . '/image');
define('PUBLIC_PATH_ASSET_ADMIN_CSS', PUBLIC_PATH_ASSET_ADMIN . '/css');
define('PUBLIC_PATH_ASSET_ADMIN_JAVASCRIPT', PUBLIC_PATH_ASSET_ADMIN . '/javascript');
define('PUBLIC_PATH_ASSET_SITE', PUBLIC_PATH_ASSET . '/site');
define('PUBLIC_PATH_ASSET_SITE_IMAGE', PUBLIC_PATH_ASSET_SITE . '/image');
define('PUBLIC_PATH_ASSET_SITE_CSS', PUBLIC_PATH_ASSET_SITE . '/css');
define('PUBLIC_PATH_ASSET_SITE_JAVASCRIPT', PUBLIC_PATH_ASSET_SITE . '/javascript');


/*** TEMPLATE ***/
define('TAG_IDENTIFIER',				'[$]'); 
define('TAG_PREGEXP',					'/{'.TAG_IDENTIFIER.'(.+)}/Ui');


/*
define('CSS_PATH',						ROOT . DS . 'asset' . DS . 'template' . DS . 'site' . DS . 'default' . DS . 'css');
define('FILES_PATH_TEMP',				FILES_PATH . DS . 'temp');
define('FILES_PATH_FILES',				FILES_PATH . DS . 'files');
define('FILES_PATH_GALLERY',			FILES_PATH . DS . 'gallery');
define('FILES_PATH_GALLERY_IMAGE',	FILES_PATH_GALLERY . DS . 'image');
define('FILES_PATH_GALLERY_AUDIO',	FILES_PATH_GALLERY . DS . 'audio');
define('FILES_PATH_GALLERY_VIDEO',	FILES_PATH_GALLERY . DS . 'video');
define('FILES_PATH_SLIDER',			FILES_PATH . DS . 'slider');




define('TEMPLATE_PATH',					PATH_APLICATION . DS . 'Template');
define('TEMPLATE_ADMIN_PATH',			TEMPLATE_PATH . DS . 'Admin');
define('TEMPLATE_SITE_PATH',			TEMPLATE_PATH . DS . 'Site');
define('TEMPLATE_NAME',					'Default');
define('SITE_TEMPLATE_NAME',			'Default');


//define('IMAGE_CACHE',					CACHE_PATH . DS . 'image' . DS);
define('IMAGE_CACHE',					FILES_PATH . DS . 'image_cache' . DS);
define('IMAGEEDITOR_CACHE',			FILES_PATH . DS . 'tmb' . DS);

define('GALLERY_LINK',					'/files/gallery/');
define('GALLERY_AUDIO_LINK',			GALLERY_LINK . 'audio/');
define('GALLERY_VIDEO_LINK',			GALLERY_LINK . 'video/');
define('PUBLIC_IMAGE_CACHE',			'/files/image_cache/');
*/


set_include_path('.'
  . PATH_SEPARATOR . ROOT_APLICATION . DS
  . PATH_SEPARATOR . ROOT_APLICATION_LIBRARY . DS
  . PATH_SEPARATOR . ROOT_APLICATION_MODULE . DS
  . PATH_SEPARATOR . get_include_path()
);