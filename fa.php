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


$idBar = "SELECT idBar from comentario where idFunc = $id_bar1";
$resultado_bar = mysqli_query($conn, $idBar);
$row_bar = mysqli_fetch_assoc($resultado_bar);
$infobar = $row_bar;
$stringbar = implode($infobar);
$id_bar = intval($stringbar);

$objDB = new db();
$link = $objDB->conecta_mysql();



$favorito="DELETE FROM comentario WHERE idFunc = $id_bar1" ;

if(mysqli_query($link, $favorito)){
		header('Location: comentarios.php?id_bar='.$id_bar);
		$msg="arquivo enviado";
	}else {
		echo 'Erro ao salvar nos favoritos';
	}

	?>