<?php

//Necessário configurar o arquivo config/config.php
require_once ('config.php');

function __autoload($class)
{
	$classPath = '';
	switch ($class) {
		case 'Controller':
		case 'Database':
		case 'Util':
			$classPath = 'system';
			break;
		
		case 'IndexController':
		case 'ContactController':
			$classPath = 'src/Controller';
			break;

		case 'Contact':
		case 'ContactDao':
			$classPath = 'src/Model';
			break;

		case 'IndexView':
		case 'ContactView':
			$classPath = 'src/View';
			break;
	}

	if (empty($classPath)) {
		return;
	}

	require_once(ROOTPATH.$classPath.'/'.$class.'.php');
}