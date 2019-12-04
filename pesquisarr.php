
<?php include_once("conexao.php");
//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
if(!isset($_GET['pesquisar'])){
	header("Location: menuh.php");
}else{
	$valor_pesquisar = $_GET['pesquisar'];
}

//Nao mostrar nenhum erro
error_reporting(0);
ini_set(“display_errors”, 0 );


//Selecionar os cursos a serem apresentado na página
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bares</title>
		<link rel="icon"  href="imagens/favicon1.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		
		<link href="css/vitrine.css" rel="stylesheet">
	</head>
	
<body class="body_index">
		<nav class="navbar navbar-fixed-top navbar-inverse navbar-transparente">
      <div class="container">
        <!-- Header -->
        <div class="navbar-header">
        	  <!-- botao toggle -->
            <button type="button" class="navbar-toggle collapsed"
              data-toggle="collapse" data-target="#barra-navegacao">
              <span class="sr-only">alternar navegacao</span> <!-- Apenas para leitores de telas -->
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

        	<a href="index.php" class="navbar-brand">
            
            <span class="img-logo"></span>
          </a>


		</div>
          <!-- Navbar -->
          <div class="collapse navbar-collapse" id="barra-navegacao">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="menuh.php">Voltar</a></li>
              


            </ul>
              </li>
            </ul>
          </div>

      </div> <!-- /container  acaba aqui-->
      
    </nav> <!-- /nav termina aqui-->









		<div class="container theme-showcase" role="main">
			<br>
				<br>
			<div class="page-header">
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<h1>Adicionar</h1>
					</div>
					<br>
					<div class="col-sm-6 col-md-6">
						<form class="form-inline" method="GET" action="pesquisarr.php">
							<div class="form-group">
								<label for="exampleInputName2" >Pesquisar</label>
								<input type="text" name="pesquisar" class="form-control" id="exampleInputName2" placeholder="Digitar...">
							</div>
							<button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
					</div>
				</div>
			</div>


<?php 

$result_bares = "SELECT * FROM usuarios WHERE nome LIKE '%$valor_pesquisar%'";
$resultado_cont = mysqli_query($conn, $result_bares);
while($rows_cont = mysqli_fetch_assoc($resultado_cont)){ 

?>


	<div class="text-center">

			
					<h3><?php echo $rows_cont['nome']."  Email:".$rows_cont['email']; ?></h3>
					<p><a href="adicionar.php?id_bar=<?php echo $rows_cont['idUsuarios'];?>" class="btn btn-primary" role="button">Adicionar</a> </p>

<?php }?>
</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>