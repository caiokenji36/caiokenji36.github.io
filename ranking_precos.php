<?php
	session_start();
	include_once("conexao.php");
	require_once('db.class.php');

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	if(!isset($_SESSION['nome'])){
		header('Location: index.php?erro=1');
	}

		$nome = $_SESSION['usuario'];
		$result_id = "SELECT idUsuarios FROM usuarios WHERE usuario='$nome'";
		$resultado_id = mysqli_query($conn, $result_id);
		$row_id = mysqli_fetch_assoc($resultado_id);
		$info = $row_id;
		$string = implode($info);
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
	<link rel="stylesheet" href="ranking.css">
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

	<nav class="nav-testt">
	<!--<a href="menuh.php" class="navbar-brand">
            <span class="img-logo"></span>
        </a>
	-->
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

	<div class="container theme-showcase" role="main">

    	<!-- Formatar descrição da pagina -->	
		<div class="page-header">

			<div class="text-center">
				<span>
					<img src="img/novogooo1.png">
					<h1>Ranking Atendimento</h1>
				</span>
			</div>

		</div>

		<br>

		<div class="row">

			<?php 

				$cont = "SELECT bar.nome,
							    avGeral,
							    avAtende,
							    avPreco,
							    bar.idBar,
							    bar.fotoBar,
							    bar.endereco,
							    SUM(avGeral) as SOMA_GERAL,
							    COUNT(avaliacao.avGeral)   as TOTAL_GERAL,
							    COUNT(avaliacao.avAtende)  as TOTAL_ATENDE,
							    COUNT(avaliacao.avPreco)   as TOTAL_PRECO,
							   (SUM(avGeral)/COUNT(avaliacao.avGeral)) as MEDIA_GERAL,
							   (SUM(avAtende)/COUNT(avaliacao.avAtende)) as MEDIA_ATENDE,
							   (SUM(avPreco)/COUNT(avaliacao.avPreco)) as MEDIA_PRECO
				   	  	   FROM avaliacao, bar
				  	  	  WHERE bar.idBar = avaliacao.idBar
				  	      GROUP BY bar.idBar
				          ORDER BY MEDIA_PRECO DESC 
				  	      LIMIT 3";
				$resultado_cont = mysqli_query($conn, $cont);
					while($rows_cont = mysqli_fetch_assoc($resultado_cont)){ 
		    			  $infoo = $rows_cont;
				  		$stringg = implode($infoo);
				  		$foto = $rows_cont["fotoBar"];
				  		


			?>

			<div class="col-sm-8">

				<div class="thumbnail">
<img src="<?php echo "imagensBar/".$rows_cont["fotoBar"]?>" alt="" id="box"> 
					
<div class="caption text-center">
					

						<h3 class="titulos1"><?php echo $rows_cont["nome"]; ?> </h3>
						<h4 class="titulos1"><?php echo $rows_cont["endereco"]; ?></h4>
												
						<p class="titulos1">

							(<?php echo number_format($rows_cont["MEDIA_PRECO"],1); ?>)
							<img src="imagensBar/dinheiro.png" alt="dinheirinho" width="25px"> <?php echo $rows_cont["TOTAL_PRECO"]; ?> |
							(<?php echo number_format($rows_cont["MEDIA_ATENDE"],1); ?>)
							<img src="imagensBar/emoji.png" alt="carinha feliz" width="25px"> <?php echo $rows_cont["TOTAL_ATENDE"]; ?>  |  
							(<?php echo number_format($rows_cont["MEDIA_GERAL"],1); ?>)
							<img src="imagensBar/estrela.png" alt="estrelinha" width="25px"> <?php echo $rows_cont["TOTAL_GERAL"]; ?>   
							
						</p>
						<p><a class="btn btn-primary btn-sm" role="button" href="verBar.php?id_bar=<?php echo $rows_cont["idBar"]?>">Ver</a></p>
							
					
					</div>

				</div>

			</div>
<?php  };
						?>	
		</div>

	</div>
<!-- Fim do hodape -->
</body>
</html>﻿