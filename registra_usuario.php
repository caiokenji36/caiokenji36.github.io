<?php 
	
	require_once('db.class.php'); //traz o conteudo do db.class.php

	// recebe os dados do usuario
	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	$nome = $_POST['nome'];
	$cData = $_POST['cData'];
	$senha = md5($_POST['senha']);  //md5 e para criptografar a senha

	$objDB = new db();
	$link = $objDB->conecta_mysql();

	$usuario_existe = false;
	$nome_existe = false;
	$email_existe = false;
	$data_existe=false;

	//verificar se o usuario a existe
	$sql = "select * from usuarios where usuario = '$usuario'";
	if($resultado_id = mysqli_query($link, $sql)){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['usuario'])){
			$usuario_existe = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro de usuário';
	}

	$sql = "select * from usuarios where nome = '$nome'";
	if($resultado_id = mysqli_query($link, $sql)){
		$dados_nome = mysqli_fetch_array($resultado_id);
		if(isset($dados_nome['nome'])){
			$nome_existe = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro de nome';
	}


	//verificar se o email ja existe

	$sql = "select * from usuarios where email = '$email'";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro de email';
	}

	$sql = "select * from usuarios where dataNasc = '$cData'";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_data = mysqli_fetch_array($resultado_id);

		if(isset($dados_data['cData'])){
			$data_existe = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro de data';
	}


	if($usuario_existe || $email_existe){
		$retorno_get ='';

			if($usuario_existe){
				$retorno_get.= "erro_usuario=1&";
			}
			if($email_existe){
				$retorno_get.= "erro_email=1&";
			}

		header('Location: inscrevase.php?'.$retorno_get);
		die(); //nao deixa o script embaixo acontecer
	}


	
	// colocar os dados na tabela usuarios
	$sql = "insert into usuarios(usuario, nome, email, senha, telefone, dataNasc) values('$usuario','$nome', '$email', '$senha','$telefone', '$cData')";

	//executar a quary
	if(mysqli_query($link, $sql)){
		header('Location: index.php');
	}else {
		echo 'Erro ao registrar o usuário';
	}

	

?>