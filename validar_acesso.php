<?php 

	session_start();
	
	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$senha = md5($_POST['senha']);
	$senhaBar =$_POST['senha'];


	/*como mostrar na outra pagina
	while ($dados=mysql_fetch_assoc($sql)) {
		$_SESSION['senha'] = $dados['senha'];
	}

	*/
	
	//validar o usuario 
	$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha ='$senha'";
	$sql2 = "SELECT * FROM bar WHERE login = '$usuario' AND senha = '$senhaBar' ";
	
	$objDB = new db();
	$link = $objDB->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);
	$resultado_id2 = mysqli_query($link, $sql2);

	//update retorna true/false
	//insert retorna true/false
	//select retorna false/resource
	//delete retorna true/false

	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		//testando para ver se o usuario existe
		if(isset($dados_usuario['usuario'])){
			$_SESSION['usuario'] = $dados_usuario['usuario'];
			$_SESSION['email'] = $dados_usuario['email'];
			$_SESSION['nome'] = $dados_usuario['nome'];
			


			header('Location: menuh.php');
			//SE NÃO EXISTIR USUARIO COMEÇA O TESTE DO BAR
		}elseif ($resultado_id2) {

			//TESTANDO SE EXISTE
			$dados_bar = mysqli_fetch_array($resultado_id2);
			if (isset($dados_bar['login'])) {
				$_SESSION['login'] = $dados_bar['login'];
				$_SESSION['email'] = $dados_bar['email'];
				$_SESSION['nome'] = $dados_bar['nome'];
				header('Location: perfil-bar.php');
			}

			//SE NÃO EXISTIR ELE DA UM ERRO E EXIBE MENSAGEM DE ERRO NO FORMULARIO
			else{
				header('Location: index.php?erro=1');
			}
		}
	}



















/*
	session_start();
	
	require_once('conecta_bd.php');

	$login = $_POST['usuario'];
	$senha = md5($_POST['senha']);


	/*como mostrar na outra pagina
	while ($dados=mysql_fetch_assoc($sql)) {
		$_SESSION['senha'] = $dados['senha'];
	}

	*/


	//update retorna true/false
	//insert retorna true/false
	//select retorna false/resource
	//delete retorna true/false	


	// ======================== VALIDAR USUARIOS ===============================

	//----------------------------- SELECT USUARIOS ----------------------------
	//$sql = "SELECT * FROM usuarios WHERE usuario = '$login' AND senha = '$senha' ";

	//----------------------------- SELECT BARES ----------------------------
	//$sql2 = "SELECT * FROM bar WHERE login = '$login' AND senha = '$senha' ";


	//$objDB = new db();
	//$link = $objDB->conecta_mysql();
/*
	$resultado_id  = mysqli_query($link, $sql);
	$resultado_id2 = mysqli_query($link, $sql2);

	// TESTA PRIMEIRO A QUERY DE USUÁRIOS, PARA VERIFICAR SE EXISTEM.
	if ($resultado_id) {

		//PEGANDO A POSSIVEL ARRAY DA QUERY USUARIO
		$dados_usuario = mysqli_fetch_array($resultado_id);
		
		//TESTANDO SE EXISTE
		if(isset($dados_usuario['login'])){
			$_SESSION['usuario'] = $dados_usuario['login'];
			$_SESSION['email'] = $dados_usuario['email'];
			$_SESSION['nome'] = $dados_usuario['nome'];
			header('Location: menuh.php');
		}

		//SE NÃO EXISTIR USUARIO COMEÇA O TESTE DO BAR
		elseif ($resultado_id2) {

			//TESTANDO SE EXISTE
			$dados_usuario = mysqli_fetch_array($resultado_id2);
			if (isset($dados_usuario['login'])) {
				header('Location: perfil-bar.html');
			}

			//SE NÃO EXISTIR ELE DA UM ERRO E EXIBE MENSAGEM DE ERRO NO FORMULARIO
			else{
				header('Location: index.php?erro=1');
			}
		}
	}
	
	*/
?>