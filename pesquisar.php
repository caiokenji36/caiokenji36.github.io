
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
//Selecionar todos os bares da tabela
$result_bar = "SELECT * FROM bar WHERE nome LIKE '%$valor_pesquisar%'";
$resultado_bar = mysqli_query($conn, $result_bar);

//Contar o total de cursos
$total_bares = mysqli_num_rows($resultado_bar);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 6;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_bares/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os cursos a serem apresentado na página
$result_bares = "SELECT * FROM bar WHERE nome LIKE '%$valor_pesquisar%' limit $incio, $quantidade_pg";
$resultado_bares = mysqli_query($conn, $result_bares);
$total_bares = mysqli_num_rows($resultado_bares);
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
						<h1>Bares</h1>
					</div>
					<br>
					<div class="col-sm-6 col-md-6">
						<form class="form-inline" method="GET" action="pesquisar.php">
							<div class="form-group">
								<label for="exampleInputName2">Pesquisar</label>
								<input type="text" name="pesquisar" class="form-control" id="exampleInputName2" placeholder="Digitar...">
							</div>
							<button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<?php while($rows_bares = mysqli_fetch_assoc($resultado_bares)){ 
					$id = $rows_bares['idBar'];
								$cont = "SELECT COUNT(avGeral) FROM avaliacao where idBar = $id";
								$resultado_cont = mysqli_query($conn, $cont);
								while($rows_cont = mysqli_fetch_assoc($resultado_cont)){ 
								$info = $rows_cont;
								$string = implode($info);
								
								$media="SELECT AVG(avGeral) FROM avaliacao where idBar = $id";
								$resultado_media = mysqli_query($conn, $media);
								while($rows_media = mysqli_fetch_assoc($resultado_media)){
								$med = $rows_media;
								$stMed = implode($med);
								$stringg = substr($stMed, 0, -3);

								$media2="SELECT AVG(avPreco) FROM avaliacao where idBar = $id";
								$resultado_media2 = mysqli_query($conn, $media2);
								while($rows_media2 = mysqli_fetch_assoc($resultado_media2)){
								$med2 = $rows_media2;
								$stMed2 = implode($med2);
								$stringg2 = substr($stMed2, 0, -3);


								$cont2 = "SELECT COUNT(avPreco) FROM avaliacao where idBar = $id";
								$resultado_cont2 = mysqli_query($conn, $cont2);
								while($rows_cont2 = mysqli_fetch_assoc($resultado_cont2)){ 
								$info2 = $rows_cont2;
								$string2 = implode($info2);


								$media3="SELECT AVG(avAtende) FROM avaliacao where idBar = $id";
								$resultado_media3 = mysqli_query($conn, $media3);
								while($rows_media3 = mysqli_fetch_assoc($resultado_media3)){
								$med3 = $rows_media3;
								$stMed3 = implode($med3);
								$stringg3 = substr($stMed3, 0, -3);

								$cont3 = "SELECT COUNT(avAtende) FROM avaliacao where idBar = $id";
								$resultado_cont3 = mysqli_query($conn, $cont3);
								while($rows_cont3 = mysqli_fetch_assoc($resultado_cont3)){ 
								$info3 = $rows_cont3;
								$string3 = implode($info3);

								$foto = "SELECT fotoBar FROM bar WHERE idBar='$id'";
								$resultado_foto = mysqli_query($conn, $foto);
								$row_foto = mysqli_fetch_assoc($resultado_foto);
								$infoo = $row_foto;
								$string1 = implode($infoo);

								$saber = "SELECT * FROM funcionamento WHERE idBar ='$id' ";
								$resultado_saber = mysqli_query($conn, $saber);
								$row_saber = mysqli_fetch_assoc($resultado_saber);
								$aberturaa = strtotime($row_saber['horario_abertura']);
								$fechamento = strtotime($row_saber['horario_fechamento']);
								

								date_default_timezone_set('America/Bahia');
								$date = date('H:i');
								$hora=strtotime($date);
								
								if($hora >= $aberturaa && $hora < $fechamento){

  									$abre = "<b><font color=\"#008000\"> Aberto </font></b>";
								}else{
 									$abre = "<b><font color=\"#FF0000\"> Fechado </font></b>";
									}

					

					?>

					<div class="col-sm-6 col-md-6">
						<div class="thumbnail">
							

							<a href="verBar.php?id_bar=<?php echo $rows_bares['idBar'];?>"><img width="600px" height= "10px" src="imagensBar/123.jpg" > </a>
							
							<div class="caption text-center">
							
						
							
								<h3><?php echo $rows_bares['nome']; ?></h3>
								<h3><?php echo $rows_bares['endereco']; ?></h3>
								<p><?php echo $abre; ?></p>
								<div class="col-md-1"><h4><?php echo $stringg; ?></h4></div>
								<div class="col-sm-1"><img src="imagensBar/estrela.png" width="30px" height="30px" alt="..."></div>
								<div class="col-md-1" id=""> <h4><?php echo "(".$string.')'; ?></h4></div>

								<div class="col-md-1"><h4><?php echo "|"; ?></h4></div>
								<div class="col-md-1"><h4><?php echo $stringg3; ?></h4></div>
								<div class="col-sm-1"><img src="imagensBar/emoji.png" width="35px" height="35px" alt="..."></div>
								<div class="col-md-1" id=""> <h4><?php echo "(".$string3.')'; ?></h4></div>

								<div class="col-md-1"><h4><?php echo "|"; ?></h4></div>

								<div class="col-md-1"><h4><?php echo $stringg2; ?></h4></div>
								<div class="col-sm-1"><img src="imagensBar/dinheiro.png" width="30px" height="30px" alt="..."></div>
								<div class="col-md-1" id=""> <h4><?php echo "(".$string2.')'; ?></h4></div>
								
								

								
								<p><a href="verBar.php?id_bar=<?php echo $rows_bares['idBar'];?>" class="btn btn-primary" role="button">Ver</a> </p>
							</div>
						</div>
					</div>
				<?php } }}}}}}?>
			</div>
			<?php
				//Verificar a pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>
			<nav class="text-center">
				<ul class="pagination">
					<li>
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="pesquisar.php?pagina=<?php echo $pagina_anterior; ?>&pesquisar=<?php echo $valor_pesquisar; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="pesquisar.php?pagina=<?php echo $i; ?>&pesquisar=<?php echo $valor_pesquisar; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="pesquisar.php?pagina=<?php echo $pagina_posterior; ?>&pesquisar=<?php echo $valor_pesquisar; ?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>
		</div>
		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>