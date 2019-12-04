<?php
	require_once("conecta_bd.php");

	$idBar    = $_GET['idbar'];
	$idBar1   = intval($idBar);	
	$foto_bar = $_POST['fotoAlbum'];
	

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	
	$sql = "INSERT INTO albumbar (foto_bar, data_albBar, idBar) VALUES ('$foto_bar', NOW() , '$idBar1')"; //falta a data...
	
	// executar a inserção
	if(mysqli_query($link, $sql)){
		header('Location: perfil-bar.php');
	}else {
		echo 'Erro ao registrar foto';
	}


?>