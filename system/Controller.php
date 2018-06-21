<?php

class Controller
{
	private $route;
	private $viewModel;
	private $successes;
	private $warnings;
	private $notices;

	public function __construct()
	{
		$this->viewModel = Array();
		$this->successes = Array();
		$this->warnings = Array();
		$this->notices = Array();
	}

	public function show ()
	{
		$successes = $this->getSuccesses();
		$warnings = $this->getWarnings();
		$notices = $this->getNotices();

		foreach ($this->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		include(ROOTPATH.'view/index/header.php');
		include(ROOTPATH.'view/'.$this->getRoute());
		include(ROOTPATH.'view/index/footer.php');
	}

	public function setRoute($route)
	{
		$this->route = $route;
	}

	public function getRoute()
	{
		return $this->route;
	}

	public function setViewModel($viewModel)
	{
		$this->viewModel = $viewModel;
	}

	public function getViewModel() 
	{
		return $this->viewModel;
	}

	public function addSuccesses($successes)
	{
		$this->successes[] = $successes;
	}

	public function getSuccesses() 
	{
		$msgs = $this->successes;
		$this->successes = Array();
		return $msgs;
	}

	public function addWarnings($warnings)
	{
		$this->warnings[] = $warnings;
	}

	public function getWarnings() 
	{
		$msgs = $this->warnings;
		$this->warnings = Array();
		return $msgs;
	}

	public function addNotices($key, $notices)
	{
		$this->notices[$key] = $notices;
	}

	public function getNotices() 
	{
		$msgs = $this->notices;
		$this->notices = Array();
		return $msgs;
	}	
}