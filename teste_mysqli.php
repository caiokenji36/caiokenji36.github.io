<?php 

	require_once('db.class.php');
	
	//validar o usuario 
	$sql = "SELECT * FROM usuarios";
	
	$objDB = new db();
	$link = $objDB->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);

	
	if($resultado_id){
		$dados_usuario = array();
		while($linha = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){
			$dados_usuario[] = $linha;
		}

		foreach ($dados_usuario as $usuario) { //foreach para percorrer arrays em php
			//var_dump($usuario);
			echo $usuario['email']; //mostrar todos emails no banco de dados
			echo '<br/><br/>';
		}
		
	}else{
		echo 'Erro na execução da consulta, entrar em contato com o admin do site';
	}
	

?>