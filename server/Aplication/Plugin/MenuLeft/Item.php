<?php
class Plugin_MenuLeft_Item
{
	private $name = null;
	private $href = null;
	private $is_activ = false;
	private $on_click = null;
	private $hash = null;
	private $is_hidden = false;

#---------------------------------------------------------------------------------------------------------

	public function __construct($name = null)
	{
		if ($name === null) {
			die('Należy Podać nazwę elementu menu');
		}

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

	public function getHref()
	{
		return $this->href;
	}

#---------------------------------------------------------------------------------------------------------

	public function setHref($href)
	{
		$this->href = $href;
	}

#---------------------------------------------------------------------------------------------------------

	public function getHash()
	{
		return $this->hash;	
	}

#---------------------------------------------------------------------------------------------------------

	public function setHash($hash)
	{
		$this->hash = $hash;
	}

#---------------------------------------------------------------------------------------------------------

	public function getOnClick()
	{
		return $this->on_click;	
	}

#---------------------------------------------------------------------------------------------------------

	public function setOnClick($on_click)
	{
		$this->on_click = $on_click;
	}

#---------------------------------------------------------------------------------------------------------

	public function isActiv()
	{
		return $this->is_activ;
	}

#---------------------------------------------------------------------------------------------------------

	public function setActiv($is_activ = null)
	{
		if (null !== $is_activ) {
			$this->is_activ = $is_activ;
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function isHidden()
	{
		return $this->is_hidden;
	}

#---------------------------------------------------------------------------------------------------------

	public function setHidden($is_hidden = null)
	{
		if (null !== $is_hidden) {
			$this->is_hidden = $is_hidden;
		}
	}

#---------------------------------------------------------------------------------------------------------
}