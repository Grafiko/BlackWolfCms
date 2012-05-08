<?php
class System_Url
{
	const PATH_ADMIN = '__admin';
	const PATH_REQUEST = '__request';

	protected static $_instance;
	protected $global = array( '_POST' => array(), '_GET' => array(), '_FILES' => array(), '_SERVER' => array() );
	protected $separator;
	protected $page_name;
	protected $base_url;
	protected $base_url_admin;
	protected $base_url_request;

	private $params = array();	
	private $run = array('module'=>null, 'show'=>null, 'action'=>null);

#---------------------------------------------------------------------------------------------------------

	protected function __construct()
	{
		$this->separator = Zend_Registry::get('config')->getvarsseparator;
		$this->setGlobal();
		$this->setBaseUrl();
		$this->decodeUrl();
		$this->setRun();
	}

#---------------------------------------------------------------------------------------------------------

	public static function getInstance()
	{
		if(null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getBaseUrl()
	{
		$instance = self::getInstance();
		return $instance->base_url;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getBaseUrlAdmin()
	{
		$instance = self::getInstance();
		return $instance->base_url_admin;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getBaseUrlRequest()
	{
		$instance = self::getInstance();
		return $instance->base_url_request;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getRunModule()
	{
		$instance = self::getInstance();
		return $instance->run['module'];
	}

#---------------------------------------------------------------------------------------------------------

	public static function getRunShow()
	{
		$instance = self::getInstance();
		return $instance->run['show'];
	}

#---------------------------------------------------------------------------------------------------------

	public static function getRunAction()
	{
		$instance = self::getInstance();
		return $instance->run['action'];
	}

#---------------------------------------------------------------------------------------------------------

	public static function getPageName()
	{
		$instance = self::getInstance();
		return $instance->page_name;
	}

#---------------------------------------------------------------------------------------------------------

	private function setGlobal()
	{
		global $_POST, $_GET, $_FILES, $_SERVER;

		$this->global = array(
			'_POST' => $_POST,
			'_GET' => $_GET,
			'_FILES' => $_FILES,
			'_SERVER' => $_SERVER
		);
	}

#---------------------------------------------------------------------------------------------------------

	private function setBaseUrl()
	{
		if(Zend_Registry::get('config')->webhost[strlen(Zend_Registry::get('config')->webhost)-1] !== '/') {
			$this->base_url = Zend_Registry::get('config')->webhost . '/';
		} else {
			$this->base_url = Zend_Registry::get('config')->webhost;
		}

		$this->base_url_admin = $this->base_url . '__admin';
		$this->base_url_request = $this->base_url . '__request';
	}

#---------------------------------------------------------------------------------------------------------

	private function decodeUrl()
	{
//---> Parsowanie bazowego adresu url
		$_parse_url = parse_url($this->base_url);

		$_tmp = explode('?', $this->global['_SERVER']['REQUEST_URI']);

		$wzor = "^(" . $_parse_url['path'] . ")^";
		$_url = preg_replace($wzor, '', $_tmp[0], 1);

    	$_tmp = explode('/', $_url);
		$_params = $_tmp[count($_tmp)-1];
		unset($_tmp[count($_tmp)-1]);

//---> Nazwa strony do wyświetlenia
		$this->page_name = implode('/', $_tmp);

//---> Ustawienie paramentrów z url'a
		$_tmp = explode('.html', $_params);
		if(isset($_tmp[0]))
		{
			$_params = explode($this->separator, $_tmp[0]);

			for($i=0, $ln=count($_params); $i<$ln; $i+=2)
			{
				if($i+1<$ln && $_params[$i] && $_params[$i+1])
				{
					$this->params[$_params[$i]] = UrlDecode( $_params[$i+1] );
				}
			}
		}
	}

#---------------------------------------------------------------------------------------------------------

	private function setRun()
	{
		if(isset($this->params['run']))
		{
			switch($this->page_name) {
				case self::PATH_ADMIN: $this->run = System_Url_Admin::decodeRunParam($this->params['run']); break;
				default: $this->run = System_Url_Admin::decodeRunParam($this->params['run']); break;
			}
		}
	}
	
#---------------------------------------------------------------------------------------------------------

	public static function getPost($name, $default = NULL)
	{
		$instance = self::getInstance();

		if(isset($instance->global['_POST'][$name])) {
			if(!empty($instance->global['_POST'][$name]) OR $instance->global['_POST'][$name] == '0') {
				return $instance->global['_POST'][$name];
			}
		}

		return $default;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getGet($name, $default = NULL)
	{
		$instance = self::getInstance();

		if(isset($instance->global['_GET'][$name])) {
			if(!empty($instance->global['_GET'][$name]) OR $instance->global['_GET'][$name] == 0) {
				return $instance->global['_GET'][$name];
			}
		} elseif(isset($instance->params[$name])) {
			if(!empty($instance->params[$name]) OR $instance->params[$name] == 0) {
				return $instance->params[$name];
			}
		}

		return $default;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getFile($name, $default = NULL)
	{
		$instance = self::getInstance();

		if(isset($instance->global['_FILES'][$name])) {
			if(empty($instance->global['_FILES'][$name])) {
				return NULL;
			} else {
				return $instance->global['_FILES'][$name];
			}
		} else {
			return $default;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public static function getGP($name, $default = NULL)
	{
		$instance = self::getInstance();

		if(isset($instance->global['_GET'][$name]) || isset($instance->params[$name])) {
			if(isset($instance->global['_GET'][$name])) {
				if(!empty($instance->global['_GET'][$name]) OR $instance->global['_GET'][$name] == 0) {
					return $instance->global['_GET'][$name];
				}
			} elseif(isset($instance->params[$name])) {
				if(!empty($instance->params[$name]) OR $instance->params[$name] == 0) {
					return $instance->params[$name];
				}
			}
		}

		$default = self::getPost($name, $default);

		return $default;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getPG($name, $default = NULL)
	{
		$instance = self::getInstance();

		if(isset($instance->global['_POST'][$name])) {
			if(!empty($instance->global['_POST'][$name]) OR $instance->global['_POST'][$name] == '0') {
				return $instance->global['_POST'][$name];
			}
		}

		$default = self::getGet($name, $default);

		return $default;
	}

#---------------------------------------------------------------------------------------------------------

	public static function create()
	{
		$vars = func_get_args();
		Zend_Debug::dump(func_get_args());
		//$page = null, $module = null, $action = null, $params=null, $from=false
		$instance = self::getInstance();

		switch($instance->page_name) {
			case self::PATH_ADMIN:
				$_url = System_Url_Admin::create(
					isset($vars[0])?$vars[0]:null,
					isset($vars[1])?$vars[1]:null,
					isset($vars[2])?$vars[2]:null,
					isset($vars[3])?$vars[3]:null
				);
				break;
			default: $_url = System_Url_Site::create(func_get_args()); break;
		}

		return $_url;
	}

#---------------------------------------------------------------------------------------------------------

	public static function getReferer()
	{
		$url = $_SERVER['REQUEST_URI'];
    	$tmp = explode('/', $url);
		$tmp = explode('.html', $tmp[count($tmp)-1]);
		$tmp = explode('run,', $tmp[0]);
		return $tmp[1];  
	}

#---------------------------------------------------------------------------------------------------------

	public static function redirect($url)
	{
		header("Location: " . $url);
		exit;
	}
}