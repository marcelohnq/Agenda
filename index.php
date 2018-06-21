<?php

try {

	//Autoload para todas as classes
	require ('config/autoload.php');

	//Navegação pelos controladores
	$controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'index';
	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';

	//Nome das classes iniciam com letra maiuscula
	$controller = ucfirst($controller);

	//Nome das funçoes iniciam com letra minuscula
	$action = strtolower($action);

	//Instanciar a classe e chamar uma função, que ira construir a view
	eval ('$controller = new '.$controller.'Controller();');
	eval ('$controller->'.$action.'Action();');

}
catch (Exception $e)
{
	error_log($e->getMessage());
}