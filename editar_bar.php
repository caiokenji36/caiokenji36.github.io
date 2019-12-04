<?php 
	session_start();
	require_once("conecta_bd.php");

	//pega o id do ´bar
	$idBar    = $_GET['idbar'];
	$idBar1   = intval($idBar);	

	//recebe os dados do bar
	$usuario  = $_POST['login'];
	$email 	  = $_POST['email'];
	$nome 	  = $_POST['nome'];
	$endereco = $_POST['endereco'];
	$senha 	  = $_POST['senha'];  

	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$usuario_existe = false;
	$email_existe = false;


	//verificar se o login já existe
	$sql = "select * from bar where login = '$usuario'";
	if($resultado_id = mysqli_query($link, $sql)){
		$dados_login = mysqli_fetch_array($resultado_id);
		if(isset($dados_login['login'])){
			$usuario_existe = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro do bar';
	}

	//verificar se o email já existe
	$sql = "select * from bar where email = '$email'";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro de email';
	}



	//verifica a condição de cima, se existem ou não
	if($usuario_existe || $email_existe){
		$retorno_get ='';

			if($usuario_existee){
				$retorno_get.= "erro_usuario=1&";
			}
			if($email_existee){
				$retorno_get.= "erro_email=1&";
			}

		header('Location: editar_bar.php?'.$retorno_get);
		die(); //Fim da edição caso já existam cadastros iguais
	}


	// colocar os dados na tabela usuarios
	$sql = "update bar set login = '$usuario', nome= '$nome', email = '$email', senha = '$senha', endereco = '$endereco' where idBar = 	'$idBar1' ";


	//executar a quary
	if(mysqli_query($link, $sql)){
		header('Location: perfil-bar.php');
		die();
	}
	else {
		echo 'Erro ao alterar dados do bar!';
	}

?>