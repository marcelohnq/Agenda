<?php

class Contact
{
	private $id;
	private $name; 
	private $cpf;
	private $birth;
	private $phone; 
	private $cel;
	private $mail;
	private $img;
	private $highlight;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setCpf($cpf)
	{
		$this->cpf = $cpf;
	}

	public function getCpf()
	{
		return $this->cpf;
	}

	public function getCpfFormated()
	{
		$data = Util::formatCPF($this->cpf);

		if (!$data) {
			return $this->cpf;
		}

		return $data;
	}

	public function setBirth($birth)
	{
		$this->birth = $birth;
	}

	public function getBirth()
	{
		return $this->birth;
	}

	public function getBirthFormated()
	{
		$date = date_create($this->birth);
		return date_format($date, 'd/m/Y');
	}

	public function setPhone($phone)
	{
		$this->phone = $phone;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function getPhoneFormated()
	{
		$data = Util::formatPhone($this->phone);

		if (!$data) {
			return $this->phone;
		}

		return $data;
	}

	public function setCel($cel)
	{
		$this->cel = $cel;
	}

	public function getCel()
	{
		return $this->cel;
	}

	public function getCelFormated()
	{
		$data = Util::formatPhone($this->cel);

		if (!$data) {
			return $this->cel;
		}

		return $data;
	}

	public function setMail($mail)
	{
		$this->mail = $mail;
	}

	public function getMail()
	{
		return $this->mail;
	}

	public function setImg($img)
	{
		$this->img = $img;
	}

	public function getImg()
	{
		return $this->img;
	}

	public function getImgFormated()
	{
		return $this->img != NULL ? 'public/img/contact/'.$this->img : 'public/img/contact/default.png';
	}

	public function setHighlight($highlight)
	{
		$this->highlight = $highlight;
	}

	public function getHighlight()
	{
		return $this->highlight;
	}
}