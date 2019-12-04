<?php
session_start();
include_once("conexao.php");



$nome = $_SESSION['usuario'];
$id_bar = $_GET['id_bar'];
$id_bar1 = intval($id_bar);


$idUsu = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);

if(!empty($_POST['estrela'])){
	$estrela = $_POST['estrela'];
	$dinheiro = $_POST['dinheiro'];
	$atendimento = $_POST['atendimento'];
	//Salvar no banco de dados
	$result_avaliacos = "INSERT INTO avaliacao (avGeral, avPreco,avAtende, data_avaliacao, idBar, idUsuario) VALUES ('$estrela','$dinheiro','$atendimento', NOW(), $id_bar1, $id_usu)";
	$resultado_avaliacos = mysqli_query($conn, $result_avaliacos);
	
	if(mysqli_insert_id($conn)){
		$_SESSION['msg'] = "Avaliação cadastrada com sucesso";
		header('Location: verBar.php?id_bar='.$id_bar1);
	}else{
		$_SESSION['msg'] = "Erro ao cadastrar a avaliação";
		header('Location: verBar.php?id_bar='.$id_bar1);
	}
	
}else{
	$_SESSION['msg'] = "Necessário selecionar pelo menos 1 estrela";
	header('Location: verBar.php?id_bar='.$id_bar1);
}




