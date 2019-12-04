<?php include_once("conexao.php");
require_once('db.class.php');
session_start();

$id_bar = $_GET['id_bar'];
$id_bar1 = intval($id_bar);

$nome = $_SESSION['usuario'];

$idUsu = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);

$objDB = new db();
$link = $objDB->conecta_mysql();

$favorito = "INSERT into favorito(idFav, idBar, idUsuarios) VALUES(null, $id_bar1,  $id_usu)";

if(mysqli_query($link, $favorito)){
		header('Location: verBar.php?id_bar='.$id_bar1);
		$msg="arquivo enviado";
	}else {
		echo 'Erro ao salvar nos favoritos';
	}

	?>