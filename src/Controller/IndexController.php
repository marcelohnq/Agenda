<?php

class IndexController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function indexAction()
	{
		$contactDao = new ContactDao();

		$viewModel['lasts'] = $contactDao->fetchLasts(5);
		$viewModel['highlights'] = $contactDao->fetchHighlights();

		$this->setViewModel($viewModel);
		$this->setRoute(IndexView::indexRoute());
		$this->show();
	}
}