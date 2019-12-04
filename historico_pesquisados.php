<?php
	session_start();
	include_once("conexao.php");
	require_once('db.class.php');

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	if(!isset($_SESSION['nome'])){
		header('Location: index.php?erro=1');
	}

	//  Selecionar dados do histórico de bares pesquisados para o usuário logado
		$nome = $_SESSION['usuario'];
		$result_id = "SELECT idUsuarios FROM usuarios WHERE usuario='$nome'";
		$resultado_id = mysqli_query($conn, $result_id);
		$row_id = mysqli_fetch_assoc($resultado_id);
		$info = $row_id;
		$string = implode($info);
		$sql = "SELECT  bar.idBar,
						bar.nome,
						bar.telefone,
						bar.endereco,
						bar.fotoBar,
						bar.descricao_bar,
						
						historico.data_historico
				  FROM  historico, bar
				 WHERE  historico.idUsuarios = $string
				   
				   AND  bar.idBar = historico.idBar
				 ORDER BY historico.data_historico DESC";
		$resultadoo = mysqli_query($conn, $sql);
		$total_bares = mysqli_num_rows($resultadoo);

		$quantidade_pg = 8;

		$num_pagina = 20;

		$incio = ($quantidade_pg*$pagina)-$quantidade_pg;


			$sql = "SELECT  bar.idBar,
						bar.nome,
						bar.telefone,
						bar.endereco,
						bar.fotoBar,
						bar.descricao_bar,
						
						historico.data_historico
				  FROM  historico, bar
				 WHERE  historico.idUsuarios = $string
				   
				   AND  bar.idBar = historico.idBar
				 ORDER BY historico.data_historico DESC limit $incio, $quantidade_pg";
		$resultadoo = mysqli_query($conn, $sql);
		$total_bares = mysqli_num_rows($resultadoo);



		$sql = "SELECT fotoUsuario FROM usuarios Where usuario = '$nome' limit 1";
		$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$album[] = $linha;
		}

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Go Beer</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="icon"  href="imagens/favicon1.png">
	<link rel="stylesheet" href="historico_pesquisados.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Abre as outras abas do menu -->
	<script type="text/javascript">
		$(document).ready(function()
		{
 			var botao = $('.aaa'); //classe no a
 			var dropDown = $('.ul-secundario'); //classe do submenu que vai abrir
	   	 	botao.on('click', function(event)
	    	{
        		dropDown.stop(true,true).slideToggle();
        		event.stopPropagation();
    		});
		});
	</script>
<!-- Final das abas do menu -->

</head>

<body class="body_test">

	<nav class="nav-testt navbar navbar-fixed-top">
		<!-- Comeco do menu lateral -->
		<input type="checkbox" id="chec">
		<label class="label_test" for="chec">
			<img class="img_logo" src="imagens/icone.png">
		</label>
		<nav class="nav_test">
			<ul class="ul_class">
				<!--Salvar imagem no BD -->
				<form action="menuh.php" method="POST" enctype="multipart/form-data">

				<?php
				foreach ($album as $foto) {

			?>

				<img id="foto" src="<?php echo "imagens/".$foto["fotoUsuario"]?>" width="260px" height="150px" /><br><br>

			<?php  }

			?>
	          		 <input type="file"  name="arquivo" id="arquivo" onchange="previewImagem()"><br><br>
	    			<input type="submit" value="Salvar">

	        </form>

					<!--Comeco do prever imagem-->
	        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	        	<script>
				  function previewImagem(){
					var imagem = document.querySelector('input[name=arquivo]').files[0];
					var preview = document.querySelector('#ab');

					var reader = new FileReader();

					reader.onloadend = function () {
						preview.src = reader.result;
					}

					if(imagem){
						reader.readAsDataURL(imagem);

					}else{
						preview.src = "";
					}

				}
				//final do prever Imagem

			</script>

			<div>
				<li>
				  <!-- Final do salvar imagem -->
					<a class="linkk" href=""><?= '<strong>'.ucfirst($_SESSION['usuario']).'</strong>' ?></a>
				</li>
			</div>

			<li><a class="link" href="perfil-usuu.php">Perfil</a></li>
			<li><a class="link" href="adicionarFotoBar.php">Configurações</a></li>
			<li><a class="link" href="vitrine.php">Favoritos</a></li>

			</br><br><br>

			<li><a class="link" href="sair.php">Sair</a></li>

			</ul>

		</nav>
		<ul id="ul-principal">
			<li class="li-p"><a  class="aa" href="menuh.php">Voltar</a></li>
			<li class="li-p"><a class="aa" href="favoritos.php">Favoritos</a></li>
			<li class="li-p">
				<a class="aaa" href="javascript://">Histórico
					<img src="imagens/seta1.png" width="12px">
				</a>
				<ul class="ul-secundario">
					<li class="li-s"><a class="aa" href="historico_avaliados.php">Bares avaliados</a></li>
					<li class="li-s"><a class="aa" href="historico_pesquisados.php">Bares pesquisados</a></li>
				</ul>
			</li>
			<li class="li-p"><a  class="aa" href="ranking_geral.php">Ranking</a></li>
			<li class="li-p"><a class="aa" href="">Pesquisar Bares</a></li>
		</ul>
	</nav>

	<br><br>

	<div class="container theme-showcase" role="main">
		
		<div class="page-header">

			<div class="text-center">
				<span>
					<img src="img/novogooo1.png">
					<h1>Histórico</h1>
					<h2>Bares Pesquisados</h2>
				</span>
			</div>

		</div>

		<div class="row">
			<?php while($rows_bar = mysqli_fetch_assoc($resultadoo)){ 
				$id = $rows_bar['idBar'];
				$foto = "SELECT fotoBar FROM bar WHERE idBar='$id'";
				$resultado_foto = mysqli_query($conn, $foto);
				$row_foto = mysqli_fetch_assoc($resultado_foto);
				$infoo = $row_foto;
				$string1 = implode($infoo);

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


			?>

			<div class="col-sm-8">

				<div class="thumbnail">
											
					<img height="40px" width="450px" src="<?php echo "imagensBar/".$string1?>" >

					<div class="caption text-center">

						<h3 class="titulos1"><?php echo $rows_bar["nome"]; ?></h3>
						<h4 class="titulos1"><?php echo $rows_bar["endereco"]; ?></h4>
						<p class="titulos1">
							<div class="col-md-1"><h4><?php echo $stringg; ?></h4></div>
								<div class="col-sm-1"><img src="imagensBar/estrela.png" width="30px" height="30px" alt="..."></div>
								<div class="col-md-1" id=""> <h4><?php echo "(".$string.')';?></h4></div>
								
								
									
									
								<div class="col-md-1"><h4><?php echo "|"; ?></h4></div>
								<div class="col-md-1"><h4><?php echo $stringg3; ?></h4></div>
								<div class="col-sm-1"><img src="imagensBar/emoji.png" width="35px" height="35px" alt="..."></div>
								<div class="col-md-1" id=""> <h4><?php echo "(".$string3.')'; ?></h4></div>

								<div class="col-md-1"><h4><?php echo "|"; ?></h4></div>

								<div class="col-md-1"><h4><?php echo $stringg2; ?></h4></div>
								<div class="col-sm-1"><img src="imagensBar/dinheiro.png" width="30px" height="30px" alt="..."></div>
								<div class="col-md-1" id=""> <h4><?php echo "(".$string2.')'; ?></h4></div>
						<p class="titulos1">Data de pesquisa: <?php echo $rows_bar["data_historico"]; ?></p>
						<p><a class="btn btn-primary btn-sm" role="button" href="verBar.php?id_bar=<?php echo $rows_bar["idBar"]?>">Ver</a></p>
															
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
							<a href="historico_pesquisados.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="historico_pesquisados.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="historico_pesquisados.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
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
<!-- Fim do hodape -->
</body>
</html>﻿