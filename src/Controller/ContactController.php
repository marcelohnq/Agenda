<?php

class ContactController extends Controller
{
	private $dao;

	public function __construct()
	{
		parent::__construct();
		$this->dao = new ContactDao();
	}

	public function listAction()
	{
		$viewModel['contacts'] = $this->dao->fetchAll();

		$this->setViewModel($viewModel);
		$this->setRoute(ContactView::listRoute());
		$this->show();
	}

	/*
		Função para Create e Update
		- Se possuir parâmetro ID = Update
		- Caso contrário = Create
		*/

	public function createAction()
	{
		$viewModel = Array();
		$obj = NULL;

		$viewModel['action'] = 'create';

		try {

			$id = isset($_REQUEST['id']) ? trim($_REQUEST['id']) : false;

			if (intval($id) == 0 && $id !== false) {
				throw new Exception("Não foi possível identificar o [Contato]");
			}

			if(isset($_REQUEST) && array_key_exists ('save', $_REQUEST)) {

				$array['id'] = false;
				$array['name'] = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : false;
				$array['cpf'] = isset($_REQUEST['cpf']) ? trim($_REQUEST['cpf']) : false;
				$array['birth'] = isset($_REQUEST['birth']) ? trim($_REQUEST['birth']) : false;
				$array['phone'] = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : false;
				$array['cel'] = isset($_REQUEST['cel']) ? trim($_REQUEST['cel']) : false;
				$array['mail'] = isset($_REQUEST['mail']) ? trim($_REQUEST['mail']) : false;
				$array['img'] = isset($_FILES['img']) ? $_FILES['img'] : false;
				$array['highlight'] = isset($_REQUEST['highlight']) ? 1 : 0;

				$obj = (object) $array;

				$formCheck = true;

				if (!$obj->name || empty($obj->name) || strlen($obj->name) > 50) {
					$this->addNotices("name", "Por favor, informe um [nome] com no máximo 50 caracteres");
					$formCheck = false;
				}

				$uniqueCPF = false;

				if (!$id) {
					$uniqueCPF = $this->dao->getCPF($obj->cpf);
				}

				if (!$obj->cpf || empty($obj->cpf) || strlen($obj->cpf) != 11 || $uniqueCPF) {
					$this->addNotices("cpf", "[CPF] informado inválido ou já existe");
					$formCheck = false;
				}

				if (!$obj->birth || empty($obj->birth)) {
					$this->addNotices("birth", "Por favor, informe a [data de nascimento]");
					$formCheck = false;
				}

				if (!$obj->phone || empty($obj->phone) || strlen($obj->phone) != 10) {
					$this->addNotices("phone", "Por favor, informe o DDD e o número de [telefone]");
					$formCheck = false;
				}

				if (!$obj->cel || empty($obj->cel) || strlen($obj->cel) > 11 || strlen($obj->cel) < 10) {
					$this->addNotices("cel", "Por favor, informe o DDD e o número de [celular]");
					$formCheck = false;
				}

				if (!$obj->mail || empty($obj->mail) || strlen($obj->mail) > 255) {
					$this->addNotices("mail", "Por favor, informe o [e-mail]");
					$formCheck = false;
				}

				if ($obj->img && $obj->img['error'] == 0 && $result = $this->uploadFile($obj->img, $obj->cpf)) {
					$obj->img = $result;
				}
				else {
					$obj->img = NULL;
					$this->addNotices("img", "Não foi possível adicionar a [Imagem]");
				}

				$obj = $this->dao->getObj($obj);

				if (!$formCheck) {
					throw new Exception("Formulário não foi preenchido corretamente");
				}

				if($id) {

					$obj->setId($id);

					$result = $this->dao->update($obj);

					if ($result) {
						$this->addSuccesses("Atualizado com sucesso");
					}
					else {					
						throw new Exception("Não foi possível atualizar");
					}
				}
				else {

					$result = $this->dao->insert($obj);

					if ($result) {
						$this->addSuccesses("Adicionado com sucesso");
					}
					else {
						throw new Exception("Não foi possível adicionar");		
					}

				}
			}

			if ($id) {
				$viewModel['action'] = 'update';
				$viewModel['contact'] = $this->dao->getContact($id);
				$viewModel['hiddenID'] = '<input type="text" name="id" value="'.$id.'" hidden/>';
			}
		}
		catch (Exception $e) {			
			$this->addWarnings($e->getMessage());
			$viewModel['contact'] = $obj;
		}

		$this->setViewModel($viewModel);
		$this->setRoute(ContactView::createRoute());	
		$this->show();

		unset($_FILES);
	}	

	/*
		URL semântica
		*/
	public function updateAction()
	{
		$this->createAction();
	}

	public function deleteAction()
	{
		$viewModel = Array();

		try {

			if(isset($_REQUEST) && array_key_exists ('save', $_REQUEST)) {
			
				$id = isset($_REQUEST['id']) ? trim($_REQUEST['id']) : false;

				if (intval($id) == 0) {
					throw new Exception("Não foi possível identificar o [Contato]");
				}

				$result = $this->dao->delete($id);

				if ($result) {
					$this->addSuccesses("Deletado com sucesso");
				}
				else {
					throw new Exception("Não foi possível deletar");
				}
			} 
		}
		catch (Exception $e) {
			$this->addWarnings($e->getMessage());
		}

		$viewModel['contacts'] = $this->dao->fetchAll();

		$this->setViewModel($viewModel);
		$this->setRoute(ContactView::listRoute());
		$this->show();
	}

	public function viewAction()
	{
		$viewModel = Array();

		$id = isset($_REQUEST['id']) ? trim($_REQUEST['id']) : false;

		if (intval($id) == 0) {
			$viewModel['contacts'] = $this->dao->fetchAll();
			$this->addWarnings("Não foi possível identificar o [Contato]");
			$this->setRoute(ContactView::listRoute());
		}
		else {
			$viewModel['contact'] = $this->dao->getContact($id);
			$this->setRoute(ContactView::viewRoute());
		}

		$this->setViewModel($viewModel);
		$this->show();
	}

	public function searchAction()
	{
		$search = isset($_REQUEST['search']) ? trim($_REQUEST['search']) : false;

		$viewModel['action'] = "search";
		$viewModel['contacts'] = $this->dao->search($search);

		$this->setViewModel($viewModel);
		$this->setRoute(ContactView::listRoute());
		$this->show();
	}

	public function uploadFile($file, $cpf)
	{
		$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
		$nameFile = "{$cpf}.{$extension}";

		$dir = ROOTPATH.'public/img/contact/';
		$upload = $dir . $nameFile;

		if (is_file($upload)) {
			unlink($upload);
		}

		if (move_uploaded_file($file['tmp_name'], $upload)) {		
		    return $nameFile;
		} else {
		    return NULL;
		}
	}
}