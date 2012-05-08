<?php
require_once 'paths.php';
require_once 'Zend/Loader/Autoloader.php';
require_once 'Smarty/Smarty.class.php';

// Loader
$loader = Zend_Loader_Autoloader::getInstance();
$loader->setFallbackAutoloader(true);
$loader->pushAutoloader('Smarty', 'smartyAutoload');

// Load Config
$config = new Zend_Config_Ini(ROOT_APLICATION_SYSTEM . DS . 'config.ini', (is_readable('server')?file_get_contents('server'):'local_tomek'));
Zend_Registry::set('config', $config);

// Setting DataBase
$db = Zend_Db::factory($config->database->adapter, $config->database->params->toArray());
$db->query('SET CHARSET ' . $config->database->charset);
Zend_Db_Table::setDefaultAdapter($db);