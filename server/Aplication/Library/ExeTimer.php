<?php
class ExeTimer {
	private $start = false;
	private $stop = false;
	private $duration = false;

	public function __construct()
	{
		$this->start = $this->getCurrentTime();
	}

	private function getCurrentTime()
	{
		list ($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	private function measureDuration()
	{
		if (false != $this->stop or false != $this->start) {
			$this->duration = $this->stop - $this->start;
			return $this->duration;
		}
		return false;
	}

	public function start()
	{
		$this->stop = false;
		$this->duration = false;
		$this->start = $this->getCurrentTime();
		return $this->start;
	}
   
	public function stop()
	{
		$this->stop = $this->getCurrentTime();
		return $this->measureDuration();
	}

	public function getStartTime()
	{
		return $this->start;
	}
   
	public function getStopTime()
	{
		return $this->stop;
	}

	public function getTime()
	{
		if (false === $this->duration) {
			return $this->stop();
		}
		return $this->duration;
	}
}