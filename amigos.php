<?php
	include_once("conexao.php");
	require_once('db.class.php');
	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	if(!isset($_SESSION['nome'])){
		header('Location: index.php?erro=1');
	}

	//  Selecionar dados do histórico de bares pesquisados para o usuário logado
		$nome = $_SESSION['usuario'];
		?>

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



<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon"  href="imagens/favicon1.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Amigos</title>
		<link rel="stylesheet" href="historico_pesquisados.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
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

<br>
<br>
<br>
<br>

<div class="text-center">
						<div class="col-sm-12 col-md-12">
					<form class="form-inline" method="GET" action="pesquisarr.php">
							<div class="form-group">
								<label for="exampleInputName2" >Pesquisar</label>
								<input type="text" name="pesquisar" class="form-control" id="exampleInputName2" placeholder="Digitar...">
							</div>
							<button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
						</div>
					</div>

		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Listar Amigos</h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Amigos</th>
								<th>Ação</th>
							</tr>
						</thead>
						<tbody>
<?php 
							$foto = "SELECT idUsuarios FROM usuarios WHERE usuario='$nome'";
								$resultado_foto = mysqli_query($conn, $foto);
								$row_foto = mysqli_fetch_assoc($resultado_foto);
								$infoo = $row_foto;
								$string1 = implode($infoo);



								$cont = "SELECT * FROM amigos where idUsuarios = $string1";
								$resultado_cont = mysqli_query($conn, $cont);

							 while($rows_cont = mysqli_fetch_assoc($resultado_cont)){ ?>
								<tr>
									<td><?php echo $rows_cont['idAmigo']; ?></td>
									<td><?php echo $rows_cont['nomeAmigo']; ?></td>
									<td>
									<form method="POST" action="mensagem.php?id_bar=<?php echo $rows_cont['nomeAmigo'];?>" enctype="multipart/form-data">
										<button type="submit" class="btn btn-xs btn-warning">Conversar</button>
										</form>
										<form method="POST" action="excluir.php?id_bar=<?php echo $rows_cont['nomeAmigo'];?>" enctype="multipart/form-data">
										<button type='submit' class="btn btn-xs btn-danger">Apagar</button>
									</td>
								</form>
								</tr>
								<!-- Inicio Modal -->
								<div class="modal fade" id="myModal<?php echo $rows_cont['idAmigo']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title text-center" id="myModalLabel"><?php echo $rows_cont['nomeAmigo']; ?></h4>
											</div>
											<div class="modal-body">
												<p><?php echo $rows_cont['idAmigo']; ?></p>
												<p><?php echo $rows_cont['nomeAmigo']; ?></p>
												
											</div>
										</div>
									</div>
								</div>
								<!-- Fim Modal -->
							<?php } ?>
						</tbody>
					 </table>
				</div>
			</div>		
		</div>
		
		
		

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Curso</h4>
			  </div>
			  <div class="modal-body">
				<form method="POST" action="processaTudo.php" enctype="multipart/form-data">
				  <div class="form-group">
					<label for="recipient-name" class="control-label">Nome:</label>
					<input name="nome" type="text" class="form-control" id="recipient-name">
				  </div>
				  <div class="form-group">
					<label for="message-text" class="control-label">Detalhes:</label>
					<textarea name="detalhes" class="form-control" id="detalhes"></textarea>
				  </div>
				<input name="id" type="hidden" class="form-control" id="id-curso" value="">
				
				<button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger">Alterar</button>
			 
				</form>
			  </div>
			  
			</div>
		  </div>
		</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
  </body>
</html>