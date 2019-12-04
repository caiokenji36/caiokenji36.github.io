<?php
include_once("conexao.php");
require_once('db.class.php');
session_start();


$nome = $_SESSION['usuario'];



$idUsu = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);

$coment = $_POST['comentarios'];




$objDB = new db();
$link = $objDB->conecta_mysql();


// colocar os dados na tabela usuarios
$sql = "UPDATE usuarios
SET descricao = '$coment'
WHERE idUsuarios = $id_usu";

	//executar a quary
	if(mysqli_query($link, $sql)){
		header('Location: perfil-usuu.php');
	}else {

		echo 'Erro ao adicionar comentário';
	}

	
?>