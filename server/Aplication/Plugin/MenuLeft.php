<?php
class Plugin_MenuLeft extends Plugin_Abstract
{
	private $name = null;
	private $activ = null;
	private $display_activ = true;
	private $items = array();

#---------------------------------------------------------------------------------------------------------

	public function __construct($name = null)
	{
		parent::__construct();
		$this->name = $name;
	}

#---------------------------------------------------------------------------------------------------------

	public function getName()
	{
		return $this->name;
	}

#---------------------------------------------------------------------------------------------------------

	public function setName($name = null)
	{
		if (null !== $name) {
			$this->name = $name;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function setActiv($activ = null)
	{
		if (null !== $activ) {
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

	public function addItem(Plugin_MenuLeft_Item $item)
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
		foreach ($this->items as $oMneuLeftItem) {
			if ($oMneuLeftItem->getHash() === $this->activ) {
				$oMneuLeftItem->setActiv(true);
				if ($this->display_activ === false) {
					$oMneuLeftItem->setHidden(true);
				}
			}
		}

		$result = $this->render('menuLeft.tpl', array('oMenuLeft'=>$this));
		return $result;
	}

#---------------------------------------------------------------------------------------------------------
}