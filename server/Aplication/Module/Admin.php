<?php
abstract class Module_Admin extends Module_Abstract
{
	protected $_path_tpl_start;
	protected $_url_asset;

#---------------------------------------------------------------------------------------------------------

	public function __construct($action = null)
	{
		parent::__construct($action);
		$this->_path_tpl_start = ROOT_APLICATION_TEMPLATE_ADMIN;
		$this->_url_asset = System_Url::getBaseUrl() . PUBLIC_PATH_ASSET_ADMIN;
	}

#---------------------------------------------------------------------------------------------------------

	public function run($display)
	{
		if (preg_match( "/json/i", $display)) {
			$method = $display;
		} else {
			$method = 'display_'.$display;
		}

		if (method_exists($this, $method)) {
			$this->$method();
		} elseif (method_exists($this, 'display_default')) {
			$this->display_default();
		} else {
			System_Url::redirect(
				System_Url_Admin::create('error', 'modulemethodnoexist')
			);
		}

		return;
	}

#---------------------------------------------------------------------------------------------------------
}