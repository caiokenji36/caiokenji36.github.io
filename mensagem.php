<?php include_once("conexao.php");
require_once('db.class.php');
session_start();
$id_bar = $_GET['id_bar']; //nome para quem vamos enviar a mensagem

$nome = $_SESSION['usuario'];

$nome = $_SESSION['usuario'];
$result_id = "SELECT idUsuarios FROM usuarios WHERE usuario='$nome'";
$resultado_id = mysqli_query($conn, $result_id);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string); // id do remetente

$result_id2 = "SELECT idUsuarios FROM usuarios WHERE nome='$id_bar'";
$resultado_id2 = mysqli_query($conn, $result_id2);
$row_id2 = mysqli_fetch_assoc($resultado_id2);
$info2 = $row_id2;
$string2 = implode($info2);
$id_usu2 = intval($string2); //id de quem esta recebendo






?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Go Beer</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="icon"  href="imagens/favicon1.png"> 
<link rel="stylesheet" href="menuh2.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		



	<!-- Abre as outras abas do menu -->
<script type="text/javascript">
	 $(document).ready(function() {
 var botao = $('.aaa'); //classe no a
 var dropDown = $('.ul-secundario'); //classe do submenu que vai abrir  

    botao.on('click', function(event){
        dropDown.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});


</script>
<!-- Final das abas do menu -->






</head>

<body class="body_test">

	<!-- Comeco do menu lateral -->
	<input type="checkbox" id="chec">
	<label class="label_test" for="chec">
		<img class="img_logo" src="imagens/icone.png">

	</label>
	<nav class="nav_test">
		<ul class="ul_class">

    
    

			
				<!--Salvar imagem no BD -->
			<form action="menuh.php" method="POST" enctype="multipart/form-data">

<!--Tentando mostrar a imagem-->

       
        <!--Final do tentando mostrar a imagem-->
      
		



        </form>


		

				<!--Comeco do prever imagem-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		
			<div><li>
					<!-- Final do salvar imagem -->
				<a class="linkk" href=""><?= '<strong>'.ucfirst($_SESSION['usuario']).'</strong>' ?></a>
			</li></div>
			
		
			<li><a class="link" href="perfil-usuu.php">Perfil</a></li>
			<li><a class="link" href="adicionarFotoBar.php">Configurações</a></li>
			<li><a class="link" href="favoritos.php">Favoritos</a></li>
			<li><a class="link" href="calendario.php">Calendário</a></li>
			<li><a class="link" href="amigos.php">Amigos</a></li>
			<li><a class="link" href="sair.php">Sair</a></li>



		</ul>

	</nav>

	
<!-- comeco do hodape -->

	

	<nav class="nav-testt">
		<ul id="ul-principal">
			<li class="li-p"><a class="aa" href="amigos.php">Voltar</a></li>
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

<!-- Fim do hodape -->
<br>
<br>
<div class="text-center">
	<h3><?php echo $id_bar;?></h3>

</div>
<?php



							$cont = "SELECT * FROM mensagens where idReme = $id_usu and idDest = $id_usu2 OR  idReme = $id_usu2 and idDest = $id_usu";
								$resultado_cont = mysqli_query($conn, $cont);
								while($rows_cont = mysqli_fetch_assoc($resultado_cont)){ 
							


?>
		<div class="caption text-center">
			<?php
if($rows_cont['idReme']==$id_usu){
	$aa = "Você: ";
	echo "Você: ".$rows_cont['mensagem'];
}else{
	$bb = "Ele: ";
	
	echo  $id_bar.": ".$rows_cont['mensagem'] ;

}
?>



<?php } ?>
	<div>
  
  <form action="mensaProcessa.php?id_bar=<?php echo $id_bar;?>" method="post">
  <textarea name="comentarios" id="comentarios"></textarea>
  <br>
  <input type=submit value="Enviar">
  </form>
  <br>
  <br>
  <br>
  
</div>
