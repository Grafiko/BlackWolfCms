<?php
class System_MetaData
{
	protected static $_instance;
	private $config;
	private $css = array();
	private $js	= array();
	private $title;
	private $meta_description;
	private $meta_keywords;
	private $charset = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

#---------------------------------------------------------------------------------------------------------

	protected function __construct()
	{
		$this->config = Zend_Registry::get('config');
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

	public function addCss($name)
	{
		$name = str_replace(DS, '/', $name);
		if (!in_array($name, $this->css)) {
			$this->css[$name] = '<link href="'.$name.'" rel="stylesheet" type="text/css" />';
		}
	}

#---------------------------------------------------------------------------------------------------------

	private function getCss()
	{
		$t = array_reverse($this->css);
		return implode("\n\t",  $t);
	}

#---------------------------------------------------------------------------------------------------------

	public function addJs($name)
	{
		$name = str_replace(DS, '/', $name);
		if (!in_array($name, $this->js)) {
		  $this->js[$name] = '<script type="text/javascript" src="'.$name.'"></script>';
		}
	}

#---------------------------------------------------------------------------------------------------------

	private function getJs()
	{
		$t = array_reverse($this->js);
		return implode("\n\t",  $t);
	}

#---------------------------------------------------------------------------------------------------------

	public function setCharset($type)
	{
		$this->charset = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$type}\" />";
	}

#---------------------------------------------------------------------------------------------------------

	public function setTitle($title)
	{
		$this->title = "<title>{$title}</title>";
	}

#---------------------------------------------------------------------------------------------------------

	public function setDescription($meta_description)
	{
		$this->meta_description = "<meta name=\"description\" content=\"{$meta_description}\" />";
	}

#---------------------------------------------------------------------------------------------------------

	public function setKeywords($meta_keywords)
	{
		$this->meta_keywords = "<meta name=\"keywords\" content=\"{$meta_keywords}\" />";
	}

#---------------------------------------------------------------------------------------------------------

	public function display()
	{
//		$setting = Zend_Registry::get('setting');
		$config = Zend_Registry::get('config');
/*
		if ($setting['favicon']) {
			$favicon = '<link rel="shortcut icon" href="'.$config->webhost . '/' . $setting['favicon'].'" />';
		}
*/
		if ($this->title) {
			$display = $this->title;
		}
		if ($this->meta_description) {
			$display.= "\n\t".$this->meta_description;
		}
		if ($this->meta_keywords) {
			$display.= "\n\t".$this->meta_keywords;
		}

		$display.= "\n\t".$this->charset;
		$display.= "\n\n\t"."<!-- FAVICON -->";
		//$display.= $favicon;
		$display.= "\n\n\t"."<!-- CSS FILES -->";
		$display.= "\n\t".$this->getCss();
		$display.= "\n\n\t"."<!-- JS FILES -->";
		$display.= "\n\t".$this->getJs();

		return $display;
	}

}