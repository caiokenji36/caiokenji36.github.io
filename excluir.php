<?php include_once("conexao.php");
require_once('db.class.php');
session_start();
$id_bar = $_GET['id_bar'];

$objDB = new db();
$link = $objDB->conecta_mysql();


$favorito="DELETE FROM amigos WHERE nomeAmigo = '$id_bar'";

if(mysqli_query($link, $favorito)){
		header('Location: amigos.php');
		$msg="arquivo enviado";
	}else {
		echo 'Erro ao salvar nos favoritos';
	}

	?>
