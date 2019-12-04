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
    <link href="novoestilo.css" rel="stylesheet">



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
            
            <span class="img-logo">Spotify</span>
          </a>
        </div>
          <!-- Navbar -->
          <div class="collapse navbar-collapse" id="barra-navegacao">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="quemsomos.php">Quem somos</a></li>
              <li><a href="menuh.php">Ajuda</a></li>
              <li><a href="">Baixar</a></li>
               
             
          </ul>
        </div>
 </nav>
            <div class="div_principal">
      <div class="imagem_perfil">
        <img class="imagem_person" src="imagens/person.png" height="150px" width="150px">
      </div>
      <div class="editar">
          <li><a href="quemsomos.php">Quem somos</a></li>
              <li><a href="menuh.php">Ajuda</a></li>
              <li><a href="">Baixar</a></li>
        
      </div>


    </div>
  
      </div>
    </nav>
    
   

              


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>