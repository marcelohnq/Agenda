<?php

class ContactDao
{
	private $db;

	public function __construct()
	{
		$this->db = Database::singleton();
	} 

	/*
		Selects
		*/

	public function fetchAll()
	{
		$query = "SELECT * FROM contact ORDER BY id";

		$sql = $this->db->prepare($query);
		
		$sql->execute();

		$list = Array();

		while ($obj = $sql->fetch (PDO::FETCH_OBJ)) {
			$list[] = $this->getObj($obj);
		}

		return $list;
	}

	public function getContact($id)
	{
		$query = 'SELECT * FROM contact WHERE id = ?';
		
		$sql = $this->db->prepare($query);
		
		$sql->bindValue(1, $id, PDO::PARAM_INT);
		
		$sql->execute();
			
		if($obj = $sql->fetch (PDO::FETCH_OBJ))
		{
			return $this->getObj($obj);	
		}
		
		return false;
	}

	public function getCPF($cpf)
	{
		$query = 'SELECT * FROM contact WHERE cpf = ?';
		
		$sql = $this->db->prepare($query);
		
		$sql->bindValue(1, $cpf, PDO::PARAM_STR);
		
		$sql->execute();
			
		if($obj = $sql->fetch (PDO::FETCH_OBJ))
		{
			return true;	
		}
		
		return false;
	}

	public function search($string)
	{
		$query = "SELECT * FROM contact WHERE id like :query";
		$query .= " OR name like :query";
		$query .= " OR cpf like :query";
		$query .= " OR birth like :query";
		$query .= " OR phone like :query";
		$query .= " OR cel like :query";
		$query .= " OR mail like :query";
		$query .= " ORDER BY id";

		$sql = $this->db->prepare($query);
		
		$sql->bindValue(":query", "%{$string}%", PDO::PARAM_STR);
		
		$sql->execute();

		$list = Array();

		while ($obj = $sql->fetch (PDO::FETCH_OBJ)) {
			$list[] = $this->getObj($obj);
		}

		return $list;
	}

	public function fetchLasts($size)
	{
		$query = "SELECT * FROM contact ORDER BY id DESC limit $size";

		$sql = $this->db->prepare($query);
		
		$sql->execute();

		$list = Array();

		while ($obj = $sql->fetch (PDO::FETCH_OBJ)) {
			$list[] = $this->getObj($obj);
		}

		return $list;
	}

	public function fetchHighlights($size = 0)
	{
		$limit = '';

		if ($size > 0) {
			$limit = " limit {$size}";
		}

		$query = "SELECT * FROM contact WHERE highlight = 1 ORDER BY id{$limit}";

		$sql = $this->db->prepare($query);
		
		$sql->execute();

		$list = Array();

		while ($obj = $sql->fetch (PDO::FETCH_OBJ)) {
			$list[] = $this->getObj($obj);
		}

		return $list;
	}

	/*
		Others Operations
		*/

	public function insert($obj)
	{
		$query = "INSERT INTO contact (name, cpf, birth, phone, cel, mail, img, highlight) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			
		$sql = $this->db->prepare($query);
		
		$sql->bindValue(1, $obj->getName(), PDO::PARAM_STR);
		$sql->bindValue(2, $obj->getCpf(), PDO::PARAM_STR);
		$sql->bindValue(3, $obj->getBirth(), PDO::PARAM_STR);
		$sql->bindValue(4, $obj->getPhone(), PDO::PARAM_STR);
		$sql->bindValue(5, $obj->getCel(), PDO::PARAM_STR);
		$sql->bindValue(6, $obj->getMail(), PDO::PARAM_STR);
		$sql->bindValue(7, $obj->getImg(), PDO::PARAM_STR);
		$sql->bindValue(8, $obj->getHighlight(), PDO::PARAM_BOOL);

		if($sql->execute()) {
			return true;
		}
			
		return false;	
	}
	
	public function update($obj)
	{
		$query = 'UPDATE contact SET name = ?, cpf = ?, birth = ?, phone = ?, cel = ?, mail = ?, img = ?, highlight = ? WHERE id = ?';
			
		$sql = $this->db->prepare($query);
		
		$sql->bindValue(1, $obj->getName(), PDO::PARAM_STR);
		$sql->bindValue(2, $obj->getCpf(), PDO::PARAM_STR);
		$sql->bindValue(3, $obj->getBirth(), PDO::PARAM_STR);
		$sql->bindValue(4, $obj->getPhone(), PDO::PARAM_STR);
		$sql->bindValue(5, $obj->getCel(), PDO::PARAM_STR);
		$sql->bindValue(6, $obj->getMail(), PDO::PARAM_STR);
		$sql->bindValue(7, $obj->getImg(), PDO::PARAM_STR);
		$sql->bindValue(8, $obj->getHighlight(), PDO::PARAM_BOOL);
		$sql->bindValue(9, $obj->getId(), PDO::PARAM_INT);

		if($sql->execute()) {
			return true;
		}
			
		return false;
	}

	public function delete($id)
	{
		$obj = $this->getContact($id);
		$img = $obj->getImg();

		$query = 'DELETE FROM contact WHERE id = ?';
			
		$sql = $this->db->prepare($query);
		
		$sql->bindValue(1, $id, PDO::PARAM_INT);

		if($sql->execute()) {
			unlink(ROOTPATH.'public/img/contact/'.$img);
			return true;
		}
			
		return false;
	}

	/*
		Util Functions
		*/

	public function getObj($values)
	{
		$obj = new Contact();

		$obj->setId($values->id);
		$obj->setName($values->name);
		$obj->setCpf($values->cpf);
		$obj->setBirth($values->birth);
		$obj->setPhone($values->phone);
		$obj->setCel($values->cel);
		$obj->setMail($values->mail);
		$obj->setImg($values->img);
		$obj->setHighlight($values->highlight);

		return $obj;
	}
}