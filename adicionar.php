<?php include_once("conexao.php");
require_once('db.class.php');

session_start();
$id_bar = $_GET['id_bar'];

//transformando o id do bar em inteiro SELECT user.fotoUsuario, user.nome FROM comentarios as c inner join usuario as user on (c.idUsuario = user.idUsuario) inner join bar as b on (c.idBar = b.idBar)
$id_bar1 = intval($id_bar);

$nome = $_SESSION['usuario']; 

$idUsu2 = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id2 = mysqli_query($conn, $idUsu2);
$row_id2 = mysqli_fetch_assoc($resultado_id2);
$info2 = $row_id2;
$string2 = implode($info2);
$id_usu2 = intval($string2);

$idUsu = "SELECT nome from usuarios where idUsuarios = $id_bar1";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);



$objDB = new db();
$link = $objDB->conecta_mysql();


// colocar os dados na tabela usuarios
	$sql = "INSERT into amigos(idAmigo, nomeAmigo, idAmi,idUsuarios) values(null,'$string',$id_bar1, $id_usu2)";

	//executar a quar
	if(mysqli_query($link, $sql)){
		header('Location: amigos.php');
	}else {

		echo 'Erro ao adicionar Amigo';
	}

	
?>