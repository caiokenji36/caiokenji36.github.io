<?php

	require_once("conecta_bd.php");

	$login_usuario 	  = $_POST['login'];
	$senha_usuario	  = md5($_POST['senha']);
	$email_usuario	  = $_POST['email'];
	$nome_usuario  	  = $_POST['nome'];
	$tel_usuario 	  = $_POST['telefone'];
	

	$objDb = new db();
	$link = $objDb->conecta_mysql();


	$login_existe = false;
	$email_existe = false;

	//VERIFICAR SE LOGIN JÁ É CADASTRADO NO BD
	$sql = "select u.usuario, b.login FROM bar as b, usuarios as u WHERE (b.login = '$login_usuario') OR (u.usuario = '$login_usuario')";
	if ($resultado = mysqli_query($link, $sql)) {

		$dados_login = mysqli_fetch_array($resultado);

		if (isset($dados_login)) {
			$login_existe = true;
		}
	}
	else{
		echo "Erro else do Login";
	}

	//VERFICA SE O E-MAIL JÁ ESTÁ CADASTRADO!!
	$sql = "select u.email, b.email FROM bar as b, usuarios as u WHERE (b.email = '$email_usuario') OR (u.email = '$email_usuario')";
	if ($resultado = mysqli_query($link, $sql)) {

		$dados_login = mysqli_fetch_array($resultado);

		if (isset($dados_login)) {
			$email_existe = true;
		}
	}
	else{
		echo "Erro else do E-mail";
	}


	//VERIFICA SE JÁ EXISTE E EXIBE A MENSAGEM NO FORMULARIO.
	if ($login_existe || $email_existe) {

		$retorno_get = '';

		if ($login_existe) {
			$retorno_get.= "erro_login=1&";
		}

		if ($email_existe) {
			$retorno_get.= "erro_email=1&";
		}

		header('Location: tela_cadastro_usuario.php?'.$retorno_get);
		die();
	}

	$sql = "insert into usuarios(idUsuarios, usuario, nome, email, senha, telefone) VALUES(null,'$login_usuario', '$nome_usuario', '$email_usuario', '$senha_usuario', '$tel_usuario')";
	
	// executar a inserção
	if(mysqli_query($link, $sql)){
		header('Location: index.php');
		$msg="arquivo enviado";
	}else {
		echo 'Erro ao registrar o Usuario';
	}

?>