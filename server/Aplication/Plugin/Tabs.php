<?php
class Plugin_Tabs extends Plugin_Abstract
{
	private $name = null;
	private $activ = null;
	private $items = array();

#---------------------------------------------------------------------------------------------------------

	public function __construct($name = null)
	{
		parent::__construct();
		$this->name = $name;
	}

#---------------------------------------------------------------------------------------------------------

	public function setActiv($activ = null)
	{
		if(null !== $activ) {
			$this->activ = $activ;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getActiv()
	{
		return $this->activ;
	}

#---------------------------------------------------------------------------------------------------------

	public function getItems()
	{
		return $this->items;
	}

#---------------------------------------------------------------------------------------------------------

	public function addItem(Plugin_Tabs_Item $item)
	{
		$this->items[] = $item;
	}

#---------------------------------------------------------------------------------------------------------

	public function count()
	{
		return sizeof($this->items);
	}

#---------------------------------------------------------------------------------------------------------

	public function getPluginResult()
	{
		$result = $this->render('tabsTop.tpl', array('oTabs'=>$this));
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}