<?php
include_once("conexao.php");
require_once('db.class.php');
session_start();

$nome = $_SESSION['usuario'];
$evento = $_GET['id_bar'];


$idUsu = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);

$idEvent = "SELECT idFunc from servico where tipo = '$evento'";
$resultado_event = mysqli_query($conn, $idEvent);
$row_event = mysqli_fetch_assoc($resultado_event);
$infoo = $row_event;
$stringg = implode($infoo);




$idEventt = "SELECT data_servico from servico where tipo = '$evento'";
$resultado_eventt = mysqli_query($conn, $idEventt);
$row_eventt = mysqli_fetch_assoc($resultado_eventt);
$infooo = $row_eventt;
$stringgg = implode($infooo);




$objDB = new db();
$link = $objDB->conecta_mysql();


	$sql = "INSERT into events(idEvent, title, startt, idUsuarios,idFunc) values(null,'$evento','$stringgg',$id_usu,'$stringg')";

	//executar a quar
	if(mysqli_query($link, $sql)){
		header('Location: menuh.php');
	}else {

		echo 'Erro ao adicionar evento';
	}

	
?>


	
