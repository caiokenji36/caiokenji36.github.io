<?php
include_once("conexao.php");
require_once('db.class.php');
session_start();
$id_bar = $_GET['idbar'];
$id_bar1 = intval($id_bar); 

$nome = $_SESSION['usuario'];



$coment = $_POST['descricao'];





$objDB = new db();
$link = $objDB->conecta_mysql();


// colocar os dados na tabela usuarios
$sql = "UPDATE bar
SET descricao_bar = '$coment'
WHERE idBar = $id_bar1";

	//executar a quary
	if(mysqli_query($link, $sql)){
		header('Location: perfil-bar.php');
	}else {

		echo 'Erro ao adicionar comentário';
	}

	
?>