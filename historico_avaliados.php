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

	//  Selecionar dados do histórico de bares avaliados para o usuário logado
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
						avaliacao.avAtende,
						avaliacao.avGeral,
						avaliacao.avPreco,
						avaliacao.data_avaliacao
				  FROM  avaliacao, bar
				 WHERE  avaliacao.idUsuario = $string
				   AND  bar.idBar = avaliacao.idBar
				 ORDER BY avaliacao.data_avaliacao DESC";
		$resultadoo = mysqli_query($conn, $sql);
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
	<link rel="stylesheet" href="historico_avaliados.css">
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
					<h2>Bares Avaliados</h2>
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
			?>

			<div class="col-sm-8">

				<div class="thumbnail">
											
					<img height="40px" width="450px" src="<?php echo "imagensBar/".$string1?>" >

					<div class="caption text-center">

						<h3 class="titulos1"><?php echo $rows_bar["nome"]; ?></h3>
						<h4 class="titulos1"><?php echo $rows_bar["endereco"]; ?></h4>
						<p class="titulos1">
							<img src="imagensBar/emoji.png" alt="carinha feliz" width="25px"> <?php echo $rows_bar["avAtende"]; ?><span>  |  </span>
							<img src="imagensBar/estrela.png" alt="estrelinha" width="25px"> <?php echo $rows_bar["avGeral"]; ?><span>  |  </span>
							<img src="imagensBar/dinheiro.png" alt="dinheirinho" width="25px"> <?php echo $rows_bar["avPreco"]; ?>
						</p>
						<p class="titulos1">Data de avaliacao: <?php echo $rows_bar["data_avaliacao"]; ?></p>
						<p><a class="btn btn-primary btn-sm" role="button" href="verBar.php?id_bar=<?php echo $rows_bar["idBar"]?>">Ver</a></p>
										
					</div>

				</div>

			</div>
		
			<?php } ?>

	</div>
		
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
<!-- Fim do hodape -->
</body>
</html>﻿