<?php  

	require_once("config.php");

	$usuario = new Usuario();
	$usuario->loadById(6);
	$usuario->update("professor", "professor");
	echo $usuario;
	
	/* criando um novo usuario
	$aluno = new Usuario("usuario", "usuario");
	$aluno->insert();
	echo $aluno;
	*/

	/* carrega um usuario pelo login e senha
	$usuario = new Usuario;
	$usuario->login("admin", "admin");
	echo $usuario;
	*/

	/* pesquisa usuario
	$search = Usuario::searchUser("h");
	echo json_encode($search);
	*/

	/* carrega um usuario pelo ID
	$root = new Usuario();
	$root->loadById(3);
	echo $root;
	*/

	/* carrega uma lista de usuarios
	$list = Usuario::getList();
	echo json_encode($list);
	*/


	/*
	$sql = new Sql();

	$usuarios = $sql->select("SELECT * FROM tb_usuarios");

	echo json_encode($usuarios);
	*/
?>