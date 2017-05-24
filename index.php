<?php  

	require_once("config.php");
	
	$usuario = new Usuario;
	$usuario->login("admin", "admin");
	echo $usuario;

	/*
	$search = Usuario::searchUser("h");
	echo json_encode($search);
	*/

	/*
	$root = new Usuario();
	$root->loadById(3);
	echo $root;
	*/

	/*
	$list = Usuario::getList();
	echo json_encode($list);
	*/


	/*
	$sql = new Sql();

	$usuarios = $sql->select("SELECT * FROM tb_usuarios");

	echo json_encode($usuarios);
	*/
?>