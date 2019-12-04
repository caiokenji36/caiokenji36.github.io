<?php 
	session_start();
	require_once('db.class.php'); 
	include_once('conexao.php');


	// recebe os dados do usuario
	$usuarioo = $_POST['usuarioo'];
	$emaill = $_POST['emaill'];
	$nomee = $_POST['nomee'];
	
	$senhaa = md5($_POST['senhaa']); 
	$telefone = $_POST['telefone'];

	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$usuario_existee = false;
	$nome_existee = false;
	$email_existee = false;


	//verificar se o usuario a existe
	$sql = "select * from usuarios where usuario = '$usuarioo'";
	if($resultado_id = mysqli_query($link, $sql)){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['usuarioo'])){
			$usuario_existee = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro de usuário';
	}

	$sql = "select * from usuarios where nome = '$nomee'";
	if($resultado_id = mysqli_query($link, $sql)){
		$dados_nome = mysqli_fetch_array($resultado_id);
		if(isset($dados_nome['nomee'])){
			$nome_existee = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro do nome';
	}


	//verificar se o email ja existe

	$sql = "select * from usuarios where email = '$emaill'";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['emaill'])){
			$email_existee = true;
		}
	}else{
		echo 'Erro ao tentar localizar o registro de email';
	}




	if($usuario_existee || $email_existee){
		$retorno_get ='';

			if($usuario_existee){
				$retorno_get.= "erro_usuario=1&";
			}
			if($email_existee){
				$retorno_get.= "erro_email=1&";
			}

		header('Location: editar_usu.php?'.$retorno_get);
		die(); //nao deixa o script embaixo acontecer
	}


	$usuario=$_SESSION['usuario'];
	// colocar os dados na tabela usuarios
	$sql = "UPDATE usuarios SET  usuario = '$usuarioo', nome= '$nomee', email = '$emaill', senha = '$senhaa', telefone = '$telefone' WHERE usuario = '$usuario'";

	//executar a quary
	if(mysqli_query($link, $sql)){
		header('Location: menuh.php');
	}else {
		echo 'Erro ao registrar o usuário';
	}

?>