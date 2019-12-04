<?php include_once("conexao.php");
require_once('db.class.php');
session_start();
$id_bar = $_GET['id_bar']; //nome para quem vamos enviar a mensagem

$nome = $_SESSION['usuario'];

$nome = $_SESSION['usuario'];
$result_id = "SELECT idUsuarios FROM usuarios WHERE usuario='$nome'";
$resultado_id = mysqli_query($conn, $result_id);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string); // id do remetente

$result_id2 = "SELECT idUsuarios FROM usuarios WHERE nome='$id_bar'";
$resultado_id2 = mysqli_query($conn, $result_id2);
$row_id2 = mysqli_fetch_assoc($resultado_id2);
$info2 = $row_id2;
$string2 = implode($info2);
$id_usu2 = intval($string2); //id de quem esta recebendo

$coment = $_POST['comentarios']; //mensagem

$objDB = new db();
$link = $objDB->conecta_mysql();


// colocar os dados na tabela usuarios
	$sql = "INSERT into mensagens(mensagem, idReme, idDest) values('$coment',$id_usu, $id_usu2)";

	//executar a quar
	if(mysqli_query($link, $sql)){
		header('Location: mensagem.php?id_bar='.$id_bar);
	}else {

		echo 'Erro ao adicionar comentário';
	}

	
	?>
