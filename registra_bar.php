<?php 
	
	

	require_once('db.class.php'); //traz o conteudo do db.class.php
	
	// recebe os dados do usuario
	$loginn = $_POST['loginn'];
	$emaill = $_POST['emaill'];
	$nomee = $_POST['nomee'];
	$senhaa = md5($_POST['senhaa']);  //md5 e para criptografar a senha

	$objDB = new db();
	$link = $objDB->conecta_mysql();

	
	// colocar os dados na tabela bar
	$sql = "insert into bar(login, senha, nome, email) values('$loginn','$senhaa','$nomee','$emaill')";

	//executar a quary
	if(mysqli_query($link, $sql)){
		header('Location: inscrevase_bar.php');
	}else {
		echo 'Erro ao registrar o Bar';
	}

?>