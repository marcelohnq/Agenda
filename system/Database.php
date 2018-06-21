<?php

class Database
{
	static private $instance;

	private $connection;

	

	private final function __construct()
	{
		$this->connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME, DB_USER, DB_PASSWD);
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function singleton()
	{
		if (self::$instance != NULL) {
			return self::$instance;
		}

		$class = __CLASS__;

		self::$instance = new $class();

		return self::$instance;
	}

	public function __call($function, $args)
	{
		return call_user_func_array(array($this->connection, $function), $args);
	}
}