<?php 
	session_start();
	include_once("conexao.php");
	require_once('db.class.php');

	$erro_login = isset($_GET['erro_login']) ? $_GET['erro_login']   : 0;
  	$erro_email = isset($_GET['erro_email']) ? $_GET['erro_email']   : 0;

	if(!isset($_SESSION['login'])){
		header('Location: index.php?erro=1');
	}

	if(!isset($_SESSION['nome'])){
		header('Location: index.php?erro=1');
	}
		error_reporting(0);
ini_set(“display_errors”, 0 );

		$nome = $_SESSION['login'];
		$result_id = "SELECT idBar FROM bar WHERE login = '$nome' ";
		$resultado_id = mysqli_query($conn, $result_id);
		$row_id = mysqli_fetch_assoc($resultado_id);
		$info = $row_id;
		$string = implode($info);

		//PEGAR DADOS DO BAR LOGADO
		$nome = $_SESSION['login'];
		$sql = "SELECT * FROM bar Where idBar = '$string'";
		$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$bar[] = $linha;
		}

		
		$sql = "SELECT * FROM funcionamento Where idBar = '$string'";
		$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$fun[] = $linha;
		}

		$horario = "SELECT * FROM funcionamento WHERE idBar='$string' and dia_semana ='Segunda' ";
		$resultado_horario = mysqli_query($conn, $horario);
		$row_horario = mysqli_fetch_assoc($resultado_horario);

		$horariod = "SELECT * FROM funcionamento WHERE idBar='$string' and dia_semana ='Domingo' ";
		$resultado_horariod = mysqli_query($conn, $horariod);
		$row_horariod = mysqli_fetch_assoc($resultado_horariod);

		$sql = "SELECT * FROM albumbar Where idBar = '$string'";
		$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$album[] = $linha;
		}

		$sql = "SELECT a.fotoUsuario, a.nome , b.descricao, b.dataComentario
From usuarios as A,
comentario as B
Where B.idBar  = '$string' and
B.idUsuarios = A.idUsuarios ORDER BY idFunc ASC ";
$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$com[] = $linha;
		}

		$sql = "SELECT * FROM servico Where idBar = '$string'";
		$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$serv[] = $linha;
		}
?>

<?php 
    $stringg3 = substr($row_horario['horario_abertura'], 0, -3);
    $stringg4 = substr($row_horario['horario_fechamento'], 0, -3);

    $stringg5 = substr($row_horariod['horario_abertura'], 0, -3);
    $stringg6 = substr($row_horariod['horario_fechamento'], 0, -3);
?>

<!DOCTYPE html>
<html>
<head>
	<title>GOBEER - Perfil Bar</title>
	<meta charset="utf-8">

	<!-- LIGHTBOX2 -->
	<link href="dist/css/lightbox.css" rel="stylesheet" />

	<!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--Estilo-->
	<link rel="stylesheet" type="text/css" href="perfil.css">

	<!--Normalize-->
	<link rel="stylesheet" type="text/css" href="css/normalize.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="icon"  href="imagens/favicon1.png"> 

	<!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
	<!-- CEBEÇALHO -->
	<nav class="navbar navbar-fixed-top navbar-inverse navbar-transparente">
      <div class="container">
        <!-- CABEÇALHO -->
        <div class="navbar-header">
          <!-- LOGO -->
          <a href="index.php" class="navbar-brand center"> 
            <span class="img-logo">GO BEER</span>
          </a> <!-- // FIM DO LOGO -->
        </div> 
        <a class="float-right" href="index.php">
          	<span>Sair</span>
        </a>
      </div>
    </nav> <!-- // FIM DO MENU -->
    <!-- // FIM DO CABEÇALHO -->

	<!-- AREA DE DADOS E LINKS -->
	<div class="row">
		<div class=" area area-dados col-md-10 col-md-offset-1">

		<!-- MOSTRA FOTO DO BAR -->
		<?php
			foreach ($bar as $foto) {
		?>
			<img class="img-box" src="<?php echo "./imagensBar/".$foto["fotoBar"];?>" alt="" id="box" >
		<?php  }
		?>
			<!-- MOSTRA O NOME DO BAR -->
			<h4><?= '<strong>'.ucfirst($_SESSION['nome']).'</strong>' ?></h4>
			<?php
				foreach ($bar as $dados) {
			?>
			<h4><?php echo $dados["endereco"];?></h4>
			<a class="alinhamento2" href="http://maps.google.com/?saddr=Current%20Location&daddr=<?php echo $dados['endereco']?>" target="_blank"><span class="glyphicon glyphicon-map-marker"></span>	Como chegar</a>
			

			<h4 class="alinhamento2 borda-cima"><b>SOBRE O BAR:</b></h4>
			<!-- CAMPO DE DESCRIÇÃO -->
			<div class="descricao">
				<ul>
					<!-- MOSTRA A DESCRIÇÃO DO BAR -->
					
						<h4 class="titulos1"><?php echo $dados["descricao_bar"]; ?>
			<?php  }
			?>		
				</ul>
			</div> <!-- FIM DA DESCRIÇÃO -->

			<!-- LINKS DE ATALHOS -->
			<ul class="opcoes borda-cima">
				<li class="btn "><a data-toggle="modal" data-target="#editarBar" href="#editarBar">Configurações</a></li> 
				
				<li class="btn "><a data-toggle="modal" data-target="#add-horario" href="#horarios">Alterar horário</a></li>  
				<li class="btn "><a data-toggle="modal" data-target="#add-foto2" href="#fotos" >Adicionar foto perfil</a></li>
				<li class="btn "><a href="#comentarios">Ver comentários</a></li>
				<li class="btn "><a data-toggle="modal" data-target="#janela2" href="#servicos">Editar perfil</a></li>
			</ul> <!-- FIM DOS LINKS -->
		</div>
	</div> <!-- FIM DOS DADOS E LINKS -->

	<!-- DESTINO DOS LINKS -->
	<div class="row">
		<div id="horarios" class="area col-md-2 col-md-offset-1">
			<h4 class="alinhamento2"><b>Nosso horário:</b></h4>
			<h4 class="alinhamento2">Segunda a Sexta</h4>
            <p class="alinhamento2"><?php echo $stringg3." - ".$stringg4 ; ?></p>
            <h4 class="alinhamento2">Sábado e Domingo</h4>
            <p class="alinhamento2"><?php echo $stringg5." - ".$stringg6 ; ?></p>
		</div>
		<div id="servicos" class="area col-md-7 col-md-offset-1">
			<h3 class="alinhamento2 col-md-9"><b>Serviços</b></h3>
			<a class="btn float-right" data-toggle="modal" data-target="#janela">
				<span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-target="left" title="Adicionar mais serviços"></span>
			</a>
			<?php
			foreach ($serv as $servicos) {
			
			?>
			<div class="col-sm-6 col-md-6">
				<div class="thumbnail">		
					<div class="caption text-center">
						<h3><?php echo $servicos['tipo']; ?></h3>
						<p><?php  echo $servicos['descricao'];  ?>
						<p><?php  echo $servicos['data_servico'];  ?>

                 <a href="removeServico.php?id_bar=<?php echo $servicos['idFunc'];?>"><img id="imagem3" width="30px" height="25px" type=submit    src="img/remove.png"></a>
					</div>
				</div>
			</div>
			<?php
			}
			?>
		</div>			
	</div>



<!-- JANELA DE CADASTROS DE HORARIO DE FUNCIONAMENTO -->
	<form method="post" action="cad-horariofunc.php?idbar=<?php echo $string;?>" class="modal fade" role="dialog" id="add-horario">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- CABEÇALHO -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">HORARIOS</h4>
				</div><!-- FIM DO CABEÇALHO -->

				<!-- CORPO -->
				<div class="modal-body">
					<form>	
				        <label for="recipient-name" class="control-label">Segunda a Sexta:</label>
				        <p class="alinhamento2">Abertura e Fechamento</p>
				        <div class="form-group">
				            <input class="col-md-5" type="time" class="form-control" name="abre1" id="abre1">
				            <input class="col-md-5 col-md-offset-1" type="time" class="form-control" name="fecha1" id="fecha1">
				        </div>
				        <br>
				        <label for="recipient-name" class="control-label">Sabádo e Domingo:</label>
				        <p class="alinhamento2">Abertura e Fechamento</p>
				        <div class="form-group">
				            <input class="col-md-5" type="time" class="form-control" name="abre2" id="abre2">
				            <input class="col-md-5 col-md-offset-1" type="time" class="form-control" name="fecha2" id="fecha2">
				        </div>
				    </form>
			    </div> <!-- FIM DO CORPO -->

				<!-- RODAPÉ -->
				<div class="modal-footer">
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

					<button type="submit" class="btn btn-primary">Cadastrar</button>
				</div><!-- FIM DO RODAPÉ -->
			</div>
		</div>
	</form><!-- FIM DA JANELA DE ALBUM BAR -->




	<!-- JANELA DE CADASTRO DE SERVIÇOS -->
	<form method="post" action="cadastrar_servico.php?idbar=<?php echo $string;?>" class="modal fade" role="dialog" id="janela">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- CABEÇALHO -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">CADASTRE UM SERVIÇO</h4>
				</div><!-- FIM DO CABEÇALHO -->

				<!-- CORPO -->
				<div class="modal-body">
					<form>
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Nome do serviço:</label>
			            <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Título do evento">
			          </div>
			          <div class="form-group">
			            <label for="message-text" class="control-label">Descrição do serviço:</label>
			            <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreve o evento"></textarea>
			          </div>
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Data:</label>
			            <input type="date" class="form-control" name="data" id="data">
			          </div>
			         
			        </form>
				</div><!-- FIM DO CORPO -->

				<!-- RODAPÉ -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

					<button type="submit" class="btn btn-primary">Cadastrar</button>
				</div><!-- FIM DO RODAPÉ -->
			</div>
		</div>
	</form><!-- FIM DA JANELA DE SERVIÇOS -->



<form method="post" action="editar_perfilBar.php?idbar=<?php echo $string;?>" class="modal fade" role="dialog" id="janela2">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- CABEÇALHO -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">EDITAR PERFIL</h4>
				</div><!-- FIM DO CABEÇALHO -->

				<!-- CORPO -->
				<div class="modal-body">
					<form>
			        
			          <div class="form-group">
			            <label for="text" class="control-label">Coloque seu perfil</label>
			            <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreve o perfil"></textarea>
			          </div>
			          
			        </form>
				</div><!-- FIM DO CORPO -->

				<!-- RODAPÉ -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

					<button type="submit" class="btn btn-primary">Editar</button>
				</div><!-- FIM DO RODAPÉ -->
			</div>
		</div>
	</form><!-- FIM DA JANELA DE SERVIÇOS -->














	
	<!-- DESTINO DOS LINKS -->
	<div id="fotos" class="row">
		<div class="area col-md-10 col-md-offset-1">
			<h3 class="alinhamento2"><b>Galeria de Fotos</b></h3>
		
			<table>
				<tr>
				<?php
					$cont = 0;
					foreach ($album as $foto) {
					$cont++;
				?>
					<td >
						<a href="<?php echo "./imagensBar/".$foto["foto_bar"]?>" data-lightbox="image-1" data-title="<?php echo $foto["foto_bar"]?>">
							<img class="box-img img-responsive" src="<?php echo "./imagensBar/".$foto["foto_bar"]?>">
						</a>
					</td>
				<?php
						if($cont == 3){
							echo "</tr>";
							echo "<tr>";
							$cont = 0;
						}
					}
				?>
					<td>
						<p class="float-middle" data-toggle="modal" data-target="#add-foto">
							<span class="glyphicon glyphicon-plus img-responsive" data-toggle="tooltip" data-target="left" title="Adicionar mais fotos"></span>
						</p>
					</td>
				</tr>
			</table>
		</div>		
	</div>





	<!-- JANELA DE CADASTROS DE FOTOS NO ALBUM DO BAR -->
	<form method="POST" action="proc_cad_imgg.php?idbar=<?php echo $string;?>" class="modal fade" role="dialog" id="add-foto2" enctype="multipart/form-data">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- CABEÇALHO -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">ADICIONE FOTO AO SEU PERFIL</h4>
				</div><!-- FIM DO CABEÇALHO -->

				<!-- CORPO -->
				<div class="modal-body">
					<form>
			          <div class="form-group">
			      
			            <label for="recipient-name" class="control-label">Adicione uma foto:</label>
			            <input type="file" name="imagem">
			          </div>
			      
				</div><!-- FIM DO CORPO -->

				<!-- RODAPÉ -->
				<div class="modal-footer">
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

					<input name="SendCadImg" type="submit" value="Cadastrar">
					  </form>
				</div><!-- FIM DO RODAPÉ -->
			</div>
		</div>
	</form><!-- FIM DA JANELA DE ALBUM BAR -->



	<!-- JANELA DE CADASTROS DE FOTOS NO ALBUM DO BAR -->
	<form method="POST" action="proc_cad_imgg2.php?idbar=<?php echo $string;?>" class="modal fade" role="dialog" id="add-foto" enctype="multipart/form-data">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- CABEÇALHO -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">ADICIONE UMA FOTO AO SUA GALERIA</h4>
				</div><!-- FIM DO CABEÇALHO -->

				<!-- CORPO -->
				<div class="modal-body">
					<form>
			          <div class="form-group">
			          	
			            <label for="recipient-name" class="control-label">Adicione uma foto:</label>
			            <input type="file" name="imagem">
			          </div>
			      
				</div><!-- FIM DO CORPO -->

				<!-- RODAPÉ -->
				<div class="modal-footer">
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

					<input name="SendCadImg" type="submit" value="Cadastrar">
					  </form>
				</div><!-- FIM DO RODAPÉ -->
			</div>
		</div>
	</form><!-- FIM DA JANELA DE ALBUM BAR -->


	<!-- AREA DE COMENTÁRIOS -->
	<div class="row">
		<div class="area col-md-10 col-md-offset-1">
			<h3 id="comentarios" class="alinhamento2"><b>Comentários</b></h3>
			<?php
			foreach ($com as $comentarios) {
			
			?>
			<div class="col-sm-6 col-md-6">
				<div class="thumbnail">		
					<div class="caption text-center">
						<h3><?php echo $comentarios['nome']; ?></h3>
						<p><?php  echo $comentarios['descricao'];  ?>
						<p><?php  echo $comentarios['dataComentario'];  ?>
					</div>
				</div>
			</div>
			<?php
			}
			?>
			
		</div>
	</div><!-- FIM DOS COMENTÁRIOS --> 

	<!-- JANELA DE CONFIGURAÇÕES DE DADOS -->
	<form method="post" action="editar_bar.php?idbar=<?php echo $string;?>" class="modal fade" role="dialog" id="editarBar">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- CABEÇALHO -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">CONFIGURAÇÕES</h4>
				</div><!-- FIM DO CABEÇALHO -->

				<!-- CORPO -->
				<div class="modal-body">
					<form>
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Adicione um novo login:</label>
			            <input type="login" class="form-control" id="login" name="login" placeholder="Novo login">
			          </div>

			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Adicione um novo nome:</label>
			            <input type="text" class="form-control" id="nome" name="nome" placeholder="Novo nome">
			          </div>

			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Adicione um novo e-mail:</label>
			            <input type="email" class="form-control" id="email" name="email" placeholder="Novo e-mail">
			          </div>

			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Adicione um novo endereço:</label>
			            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Novo endereço">
			          </div>
			          
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Adicione uma nova senha:</label>
			            <input type="password" class="form-control" id="senha" name="senha" placeholder="Nova senha">
			          </div>
			        
			        </form>
				</div><!-- FIM DO CORPO -->

				<!-- RODAPÉ -->
				<div class="modal-footer">
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

					<button type="submit" class="btn btn-primary">Cadastrar</button>
				</div><!-- FIM DO RODAPÉ -->
			</div>
		</div>
	</form> <!-- FIM DAS CONFIGURAÇÕES DE DADOS -->


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript">
    	$(function(){
    		$('[data-toggle="tooltip"]').tooltip()
    	});
    </script>

    <!-- Lightbox -->
    <script src="dist/js/lightbox.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>