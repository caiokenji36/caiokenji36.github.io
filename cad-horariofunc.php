<?php
	require_once("conecta_bd.php");

	$idBar        = $_GET['idbar'];
	$idBar1       = intval($idBar);	
	$horario_a	  = $_POST['abre1'];
	$horario_f	  = $_POST['fecha1'];
	$horario_a2	  = $_POST['abre2'];
	$horario_f2	  = $_POST['fecha2'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();


	$dia_semana = false;
	$dia_semana2 = false;

	//VERIFICAR SE JÁ EXISTE CADASTRO NOS DIAS DA SEMANA
	$sql = "SELECT * FROM funcionamento WHERE dia_semana = 'Segunda' AND idBar = '$idBar1'";
	if($resultado_id = mysqli_query($link, $sql)){
		$dados_func1 = mysqli_fetch_array($resultado_id);
		if(isset($dados_func1['idFunc'])){
			$dia_semana = true;
			$idFunc1 = $dados_func1['idFunc'];
		}
	}else{
		echo 'Erro ao tentar localizar data de funcionamento';
	}

	//VERIFICAR SE JÁ EXISTE CADASTRO NO FIM DE SEMANA
	$sql = "SELECT * FROM funcionamento WHERE dia_semana = 'Domingo' AND idBar = '$idBar1'";
	if($resultado_id = mysqli_query($link, $sql)){
		$dados_func2 = mysqli_fetch_array($resultado_id);
		if(isset($dados_func2['idFunc'])){
			$dia_semana2 = true;
			$idFunc2 = $dados_func2['idFunc'];
		}
	}else{
		echo 'Erro ao tentar localizar data de funcionamento';
	}

	//CADASTRAR HORARIO SEGUNDA A SEXTA
	if ($dia_semana){
	$sql = "UPDATE funcionamento SET horario_abertura = '$horario_a', horario_fechamento = '$horario_f', dia_semana = 'Segunda', idBar = '$idBar1' WHERE idBar = '$idBar1' AND dia_semana = 'Segunda'";

	}
	else if ($horario_a != '' || $horario_a != NULL || $horario_f != '' || $horario_f != NULL) {
		$sql = "INSERT INTO funcionamento (horario_abertura, horario_fechamento, dia_semana, idBar) VALUES ('$horario_a', '$horario_f', 'Segunda', '$idBar1')";
	}
	else{
		echo "Erro ao cadastrar/alterar o horario de funcionamento 1";
	}
	

	//CADASTRAR HORARIO SEGUNDA A SEXTA

	


	//CADASTRAR HORARIO SABÁDO E DOMINGO
	if ($dia_semana2){
		$sql2 = "UPDATE funcionamento SET horario_abertura = '$horario_a2', horario_fechamento = '$horario_f2', dia_semana = 'Domingo', idBar = '$idBar1' WHERE idBar = '$idBar1' AND dia_semana = 'Domingo'";

		}
	else if ($horario_a2 != '' || $horario_a2 != NULL || $horario_f2 != '' || $horario_f2 != NULL) {
		$sql2 = "INSERT INTO funcionamento (horario_abertura, horario_fechamento, dia_semana, idBar) VALUES ('$horario_a2', '$horario_f2', 'Domingo', '$idBar1')";
	}
	else{
		echo " Erro ao cadastrar/alterar o horario de funcionamento 2";
	}



	//executar a quary
	if(mysqli_query($link, $sql2)){
		if(mysqli_query($link, $sql)) {
			header('Location: perfil-bar.php');
			die();
		}
	}
	else {
		echo "Erro ao alterar dados do bar!";
	}



?>