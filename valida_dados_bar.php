<?php

	require_once("conecta_bd.php");

	$login_bar 	  = $_POST['login'];
	$senha_bar	  = $_POST['senha'];
	$email_bar	  = $_POST['email'];
	$nome_bar  	  = $_POST['nome'];
	$telefone_bar = $_POST['telefone'];
	$cnpj_bar 	  = $_POST['cnpj'];
	$end_bar 	  = $_POST['endereco'];
	$desc_bar 	  = $_POST['descricao'];
	

	$objDb = new db();
	$link = $objDb->conecta_mysql();


	$login_existe = false;
	$email_existe = false;
	$cnpj_existe  = false;

	//VERIFICAR SE BAR JÁ É CADASTRADO
	$sql = "select u.login, b.login FROM bar as b, usuario as u WHERE (b.login = '$login_bar') OR (u.login = '$login_bar')";
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
	$sql = "select u.email, b.email FROM bar as b, usuario as u WHERE (b.email = '$email_bar') OR (u.email = '$email_bar')";
	if ($resultado = mysqli_query($link, $sql)) {

		$dados_login = mysqli_fetch_array($resultado);

		if (isset($dados_login)) {
			$email_existe = true;
		}
	}
	else{
		echo "Erro else do E-mail";
	}


	//VERFICA SE O CNPJ JÁ ESTÁ CADASTRADO!!
	$sql = "select * FROM bar WHERE cnpj = '$cnpj_bar'";
	if ($resultado = mysqli_query($link, $sql)) {

		$dados_login = mysqli_fetch_array($resultado);

		if (isset($dados_login)) {
			$cnpj_existe = true;
		}
	}
	else{
		echo "Erro else do CNPJ";
	}


	//VERIFICA SE JÁ EXISTE E EXIBE A MENSAGEM NO FORMULARIO.
	if ($login_existe || $email_existe || $cnpj_existe) {

		$retorno_get = '';

		if ($login_existe) {
			$retorno_get.= "erro_login=1&";
		}

		if ($email_existe) {
			$retorno_get.= "erro_email=1&";
		}

		if ($cnpj_existe) {
			$retorno_get.= "erro_cnpj=1&";
		}

		header('Location: tela_cadastro_bar.php?'.$retorno_get);
		die();
	}

	

	$sql = "insert into bar(login, senha, email, nome, telefone, cnpj, endereco, descricao_bar) VALUES ('$login_bar', '$senha_bar', '$email_bar', '$nome_bar', '$telefone_bar', '$cnpj_bar','$end_bar', '$desc_bar')";
	
	// executar a inserção
	if(mysqli_query($link, $sql)){
		header('Location: index.php');
	}else {
		echo 'Erro ao registrar o Bar';
	}


?>