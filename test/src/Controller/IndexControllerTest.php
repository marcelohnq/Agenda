<?php
use PHPUnit\Framework\TestCase;

class IndexControllerTest extends TestCase
{
	public function testCreateAction()
	{
		$_REQUEST['name'] = "Marcelo";
		$_REQUEST['cpf'] = "40812132833";
		$_REQUEST['birth'] = "1966-12-12";
		$_REQUEST['phone'] = "6781267054";
		$_REQUEST['cel'] = "6781267054";
		$_REQUEST['mail'] = "sirlei@sirlei.com";
		$_REQUEST['img'] = "1.jpg";
		$_REQUEST['highlight'] = '1';
		$_REQUEST['save'] = 'Inserir';

		$controller = new ContactController();
		$controller->createAction();

		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (!isset($alert)) {
			$this->assertTrue(false);
		}

		$this->assertTrue(array_key_exists("success", $alert));
	}

	/**
     * depends testCreateAction
     */
	public function testIndexAction()
	{
		$controller = new IndexController();
		$controller->indexAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (!isset($lasts) || !isset($highlights) || !isset($imgs)) {
			$this->assertTrue(false);
		}
		
		$this->assertTrue(count($lasts) > 0);
		$this->assertTrue(count($highlights) > 0);
		$this->assertTrue(count($imgs) > 0);
	}
}