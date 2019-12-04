<?php
session_start();
include_once("conexao.php");
require_once('db.class.php');
$id_bar = $_GET['id_bar'];
$id_bar1 = intval($id_bar);

//Nao mostrar nenhum erro
error_reporting(0);
ini_set(“display_errors”, 0 );


    $sql = "SELECT foto_bar FROM albumbar Where idBar = $id_bar1 ORDER BY codAlbum DESC";
        $resultado = $conn->query($sql);
        while($linha=mysqli_fetch_array($resultado)){
            $album[] = $linha;
        }




?>
 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/verFoto.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="icon"  href="imagens/favicon1.png"> 

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Fotos</title>
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
              
          
               <li class="divisor" role="separator"></li>
             <li><a href="comentarios.php?id_bar=<?php echo $id_bar1;?>">Comentarios</a></li>
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
                <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            // salvando a foto e enviando para proc_cad_imgg.php
        }
        ?>

        
  
        <form method="POST" action="proc_img.php?id_bar=<?php echo $id_bar1;?>" enctype="multipart/form-data">
           
            
            <label>Imagem</label>

            <input type="file" name="imagem"><br><br>
            
            <input name="SendCadImg" type="submit" value="Cadastrar">
        </form>

    </div>
</section>

    <?php
            foreach ($album as $foto) {
            
        ?>

    

        
         
        
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        
        <img id="foto" src="<?php echo "imagensBar/".$foto["foto_bar"]?>" width="560px" height="250px" /><br><br>

      </div>

    </div>

  </div>

 <?php  }

        ?>
    </body>

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
</html>
