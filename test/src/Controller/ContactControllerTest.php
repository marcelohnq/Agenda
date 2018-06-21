<?php
use PHPUnit\Framework\TestCase;

class ContactControllerTest extends TestCase
{
	public function testCreateActionNotSave()
	{
		unset($_REQUEST);

		$controller = new ContactController();
		$controller->createAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (isset($action) && $action == "create") {
			$this->assertTrue(true);
		}
		else {
			$this->assertTrue(false);
		}

		if (!isset($contact)) {
			$this->assertTrue(true);
		}
		else {
			$this->assertTrue(false);
		}
	}

	public function testInfoCPF()
	{
		$cpf = "40812132831";

		$this->assertFalse(!$cpf);

		$this->assertFalse(empty($cpf));

		$this->assertEquals(11, strlen($cpf));

		$dao = new ContactDao();
		$cpf = $dao->getCPF($cpf);

		$this->assertFalse($cpf);		
	}

	public function testCreateAction()
	{
		$_REQUEST['name'] = "Sirlei";
		$_REQUEST['cpf'] = "40812132831";
		$_REQUEST['birth'] = "1966-12-12";
		$_REQUEST['phone'] = "6781267054";
		$_REQUEST['cel'] = "6781267054";
		$_REQUEST['mail'] = "sirlei@sirlei.com";
		// $_REQUEST['img'] = "";
		$_REQUEST['highlight'] = '1';
		$_REQUEST['save'] = 'Inserir';

		$controller = new ContactController();
		$controller->createAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (isset($action) && $action == "create") {
			$this->assertTrue(true);
		}
		else {
			$this->assertTrue(false);
		}

		if (isset($msgForm) && !empty($msgForm)) {
			$this->assertEquals(array('name'), array_keys($msgForm));
		}

		if (!isset($alert)) {
			$this->assertTrue(false);
		}
	}

	/**
     * @depends testCreateAction
     */
	public function testListAction()
	{
		$controller = new ContactController();
		$controller->listAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (isset($contacts)) {
			$flag = false;

			foreach ($contacts as $contact) {
				if ($contact->getName() == "Sirlei") {
					$flag = true;
				}
			}

			$this->assertTrue($flag);
		}
		else {
			$this->assertTrue(false);
		}
	}

	/**
     * @depends testCreateAction
     */
	public function testSearchActionFalse()
	{
		unset($_REQUEST);

		$controller = new ContactController();
		$controller->searchAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (isset($contacts) && !empty($contacts)) {
			$flag = true;

			foreach ($contacts as $contact) {
				if ($contact->getName() == "Sirlei") {
					$flag = false;
				}
			}

			$this->assertFalse($flag);
		}
		else {
			$this->assertFalse(false);
		}
	}

	/**
     * @depends testCreateAction
     */
	public function testSearchActionCPF()
	{
		$_REQUEST['search'] = "121328";

		$controller = new ContactController();
		$controller->searchAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (isset($contacts) && count($contacts)>0) {
			$this->assertTrue(true);
		}
	}

	/**
     * @depends testCreateAction
     */
	public function testSearchActionName()
	{
		$_REQUEST['search'] = "Sirlei";

		$controller = new ContactController();
		$controller->searchAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (!isset($contacts)) {
			$this->assertTrue(false);
		}

		$this->assertTrue(count($contacts)>0);

		$_REQUEST['id'] = $contacts[0]->getId();
	}

	/**
     * @depends testSearchActionName
     */
	public function testViewAction()
	{
		$controller = new ContactController();
		$controller->viewAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (!isset($contact)) {
			$this->assertTrue(false);
		}

		$this->assertEquals("Sirlei", $contact->getName());
	}

	/**
     * @depends testSearchActionName
     */
	public function testUpdateAction()
	{
		$_REQUEST['name'] = "Marcelo";
		$_REQUEST['cpf'] = "40812132831";
		$_REQUEST['birth'] = "1966-12-12";
		$_REQUEST['phone'] = "6781267054";
		$_REQUEST['cel'] = "6781267054";
		$_REQUEST['mail'] = "sirlei@sirlei.com";
		// $_REQUEST['img'] = "";
		$_REQUEST['highlight'] = '1';
		$_REQUEST['save'] = 'Atualizar';

		$controller = new ContactController();
		$controller->updateAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (!isset($contact)) {
			$this->assertTrue(false);
		}

		$this->assertEquals("Marcelo", $contact->getName());

		if (!isset($alert)) {
			$this->assertTrue(false);
		}

		$this->assertTrue(array_key_exists("success", $alert));
	}

	/**
     * @depends testUpdateAction
     */
	public function testDeleteAction()
	{
		$_REQUEST['save'] = "Deletar";

		$controller = new ContactController();
		$controller->deleteAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (!isset($alert)) {
			$this->assertTrue(false);
		}

		$this->assertTrue(array_key_exists("success", $alert));
	}	

	/**
     * @depends testDeleteAction
     */
	public function testDeleteActionFalse()
	{
		unset($_REQUEST);

		$controller = new ContactController();
		$controller->deleteAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (isset($alert) && !empty($alert)) {
			$this->assertEquals(array('success','warning'), array_keys($alert));
		}
		else {
			$this->assertFalse(false);
		}
	}

	/**
     * @depends testDeleteAction
     */
	public function testViewActionFalse()
	{
		unset($_REQUEST);

		$controller = new ContactController();
		$controller->viewAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (!isset($alert)) {
			$this->assertTrue(false);
		}

		$this->assertTrue(array_key_exists("warning", $alert));
	}

	/**
     * @depends testDeleteAction
     */
	public function testUpdateActionFalse()
	{
		unset($_REQUEST);

		$controller = new ContactController();
		$controller->updateAction();
		
		foreach ($controller->getViewModel() as $key => $value) {
			eval("\${$key} = \$value;");
		}

		if (isset($action) && $action == "update") {
			$this->assertFalse(true);
		}
		else {
			$this->assertFalse(false);
		}
	}

}