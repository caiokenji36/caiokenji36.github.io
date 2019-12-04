<?php 
	session_start();
	include_once("conexao.php");

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	if(!isset($_SESSION['nome'])){
		header('Location: index.php?erro=1');
	}


		//pegar a foto
		$nome = $_SESSION['usuario'];
		$sql = "SELECT fotoUsuario FROM usuarios Where usuario = '$nome' limit 1";
		$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$album[] = $linha;
		}


		$biografia = "SELECT descricao from usuarios where usuario = '$nome'";
		$resultado_bio = mysqli_query($conn, $biografia);
		$row_bio = mysqli_fetch_assoc($resultado_bio);
		$string = implode($row_bio);

?>






<!DOCTYPE html>
<html>
<head>
	<title>GOBEER - Perfil Usuário</title>
	<meta charset="utf-8">
	<!--Estilo-->
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
 <link rel="icon"  href="imagens/favicon1.png">
	<!--Normalize-->
	<link rel="stylesheet" type="text/css" href="css/normalize.css">

</head>
<body>

	<!-- MENU FIXO -->
	<header id="barraprincipal">
		<div class="area">
			<h2 id="logo"><img src="">LOGO</h2>
			<div id="menu">
				<a href="menuh.php">Sair</a>
			</div>
		</div>
	</header>

	<!-- AREA DE DADOS DO USUÁRIO -->
	<section class="area">
		<div class="alinhamento-bordas info">

			<?php
			foreach ($album as $foto) {
			
		?>
			<img src="<?php echo "imagens/".$foto["fotoUsuario"]?>" alt="" id="box"> 
			<?php  }

		?>
			<h4><?= '<strong>'.ucfirst($_SESSION['usuario']).'</strong>' ?></h4>
			

			<h4 class="alinhamento"><b>BIOGRÁFIA</b></h4>
			<p class="alinhamento borda">
				<?php echo $string; ?>
			</p>
			<ul class="opcoes">
				<li><a href="editar_usu.php">Configurações</a></li> |
				<li><a href="historico_pesquisados.php">Histórico</a></li> |
				<li><a href="favoritos.php">Favoritos</a></li>
			</ul>
			<div class="borda-cima">
				<ul class="opcoes">
					<li><a href="#">Fotos+</a></li> 
					
					
				</ul>

                
          <ul class="dropdown-menu" aria-labelledby="entrar">
            <div class="col-md-12">
                <p>Editar sua Biográfia</h3>
                <br />
              <form action="editar_bio.php" method="post">
  <textarea name="comentarios" id="comentarios"></textarea>
  <br>
  <input type=submit value="Enviar">
  </form>
                
               

                <br /><br />
                
              </form>
			</div>
		</div>
	</section>
</body>
</html>