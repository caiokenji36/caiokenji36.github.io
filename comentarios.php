<?php include_once("conexao.php");
session_start();

$id_bar = $_GET['id_bar'];
$id_bar1 = intval($id_bar);

$nome = $_SESSION['usuario'];

//Nao mostrar nenhum erro
error_reporting(0);
ini_set(“display_errors”, 0 );

$idUsu = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);



$comentario = "SELECT a.fotoUsuario, a.nome , b.descricao, b.dataComentario,b.idUsuarios,b.idFunc
From usuarios as A,
comentario as B
Where B.idBar  = $id_bar1 and
B.idUsuarios = A.idUsuarios ORDER BY idFunc DESC ";
$resultado = $conn->query($comentario);
		while($linha=mysqli_fetch_array($resultado)){
			$hist[] = $linha;
		}



?>
<link rel="stylesheet" type="text/css" href="css/comentario.css">

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoBeer</title>
    <link rel="icon"  href="imagens/favicon1.png"> <!--Icone que aparece na aba do navegador -->

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/verBar.css" rel="stylesheet">

   

  </head>


  <body>

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
              <li><a href="quemsomos.php">Quem somos</a></li>
              <li><a href="fotosBar.php?id_bar=<?php echo $id_bar1;?>">Fotos</a></li>
               <li class="divisor" role="separator"></li> 
             <li><a href="verBar.php?id_bar=<?php echo $id_bar1;?>">Voltar</a></li> 

                
                
            </form>
            </ul>
              </li>
            </ul>
          </div>

      </div> <!-- /container  acaba aqui-->
      
    </nav> <!-- /nav termina aqui-->







            </ul>
          </div>

<br>
<br>
<br>
<br>
<br>
<section class="area">
		<div class="caption text-center">




	<div>
  Adicione seu comentário:<br>
  <form action="script.php?id_bar=<?php echo $id_bar1;?>" method="post">
  <textarea name="comentarios" id="comentarios"></textarea>
  <br>
  <input type=submit value="Enviar">
  </form>
  <br>
  <br>
  <br>
</div>







<?php

				foreach ($hist as $dados) {
					
			?>
<?php
      if($dados["idUsuarios"]== $id_usu){
 
  $a= "none";
  $b = "block";

}else{
  
  $a = "block";
  $b = "none";
}

?>			
				<img width="60px" height="60px"  src="<?php echo "imagens/".$dados['fotoUsuario']?>" ><p><?php echo $dados["nome"]; ?></p>
				<p><?php echo $dados["dataComentario"]; ?></p>
				<p><?php echo '"'.$dados["descricao"].'"'; ?></p>
       
                 <a href="fa.php?id_bar=<?php echo $dados["idFunc"];?>"><img id="imagem3" width="30px" height="25px" type=submit style="display: <?php echo $b;?>;" onclick="mostrarFoto()"  src="img/remove.png"></a>

           
           
				<hr/>
				<br><br>
			<?php  }
 			?>		



</div>
	</section>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
