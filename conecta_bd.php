<?php

class db{
	
	// host
	private $host = 'localhost';

	// usuario
	private $usuario = 'root';

	// senha 
	private $senha = '36819121oi';

	// banco de dados
	private $database = 'gobeernovo';


	public function conecta_mysql(){
		
		// conexão bd
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		//ajustar a comunicação entre app e bd
		mysqli_set_charset($con, 'utf8');

		//verificar se conectou
		if (mysqli_connect_errno()) {
			echo 'Erro ao se conectar com o BD MySQL'.mysqli_connect_error();
		}

		return $con;
	}

}



?>