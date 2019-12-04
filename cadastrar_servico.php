<?php
	require_once("conecta_bd.php");

	$idBar        = $_GET['idbar'];
	$idBar1       = intval($idBar);	
	$titulo_serv  = $_POST['tipo'];
	$desc_serv	  = $_POST['descricao'];
	$data_serv	  = $_POST['data'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	//CADASTRAR SERVIÇO
	if ($data_serv == '' || $data_serv == NULL) {
		$sql = "INSERT INTO servico (tipo, descricao, idBar) VALUES ('$titulo_serv', '$desc_serv', '$idBar1')";
	}
	else{
		$sql = "INSERT INTO servico (tipo, descricao, data_servico, idBar) VALUES ('$titulo_serv', '$desc_serv', '$data_serv', '$idBar1')";
	}

	// executar a inserção
	if(mysqli_query($link, $sql)){
		header('Location: perfil-bar.php');
	}else {
		echo 'Erro ao registrar o serviço';
	}


?>