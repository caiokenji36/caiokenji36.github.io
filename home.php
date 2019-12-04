<?php
	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	if(!isset($_SESSION['nome'])){
		header('Location: index.php?erro=1');
	}

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Go Beer</title>
		
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<link rel="icon"  href="imagens/favicon1.png"> 
        <link rel="stylesheet" href="homecss.css">

      



		
		
	</head>

	 <body>

  <body class="body_indexx">

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



<!-- Comeco do menu lateral -->
  <input type="checkbox" id="chec">
  <label class="label_test" for="chec">
    <img class="img_logo" src="imagens/icone.png">
  </label>
  <nav class="nav_test">
    <ul class="ul_class">
      <li>
        <a class="link" href="">Nome</a>
      </li>
    
      <li><a class="link" href="">Perfil</a></li>
      <li><a class="link" href="">Configurações</a></li>
      <li><a class="link" href="">Favoritos</a></li>
      
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    <li><a class="link" href="">Sair</a></li>



    </ul>

  </nav>

<!-- Fim do menu lateral -->




          <a href="index.php" class="navbar-brand">

            
            <span class="img-logo"></span>
          </a>

<!-- Fim do menu lateral -->
 <input type="checkbox" id="check">
<label id="icone" for="check"> <img src="imagens/icone.png"></label>

<div class="barra">

<nav class="nav_test">
  <div><i class="fa fa-acorn" style="font-size: 3em"></i></div>
 <a href="" class=""><div class="linkk">Nome</div></a>
    <a href=""><div class="link">Tutoriais</div></a>
    <a href=""><div class="link">Downloads</div></a>
    <a href=""><div class="link">Eventos</div></a>
    <a href=""><div class="link">Contato</div></a>
</nav>

</div>

        
        </div>
          <!-- Navbar -->
          <div class="collapse navbar-collapse" id="barra-navegacao">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="sair.php">Sair</a></li>
              
    
    
           

      </div> <!-- /container  acaba aqui-->
      
    </nav> <!-- /nav termina aqui-->


    <div class="capa">
      <div class="texto-capa">
        <h4><?= '<strong>'.ucfirst($_SESSION['usuario']).'</strong>' ?></h4>


        	<div class="col-md-6">
	    					BARES <br/>1
	    				</div>
	    				<div class="col-md-6">
               
	    					FOLLOWERS <br/>1
	    				</div>
      </div>
    </div>

    
    
    <!-- Rodape-->

<footer id="rodape">
  <div class="container">
    <div class="row"> <!-- row-->
      <div class="col-md-2">
        <span class="img-logo"></span>
      </div>
      <div class="col-md-2">
        <h4>Company</h4>
        <ul class="nav">
          <li><a href="">Sobre</a></li>
          <li><a href="">Empregos</a></li>
          <li><a href="">Imprensa</a></li>
          <li><a href="">Novidades</a></li>
        </ul>
      </div>

       <div class="col-md-2">
        <h4>Comunidades</h4>
        <ul class="nav">
          <li><a href="">Artistas</a></li>
          <li><a href="">Desenvolvedores</a></li>
          <li><a href="">Marcas</a></li>
          
        </ul>
      </div>


       <div class="col-md-2">
        <h4>Links uteis</h4>
        <ul class="nav">
          <li><a href="">Ajuda</a></li>
          <li><a href="">Presentes</a></li>
          
         
        </ul>
      </div>

      <div class="col-md-4">

        <ul class="nav">
          <li class="item-rede-social"><a href=""><img src="imagens/facebook.png"></a></li>
          <li class="item-rede-social"><a href=""><img src="imagens/twitter.png"></a></li>
          <li class="item-rede-social"><a href=""><img src="imagens/instagram.png"></a></li>         
        </ul>
      </div>

    </div>

  </div>
</footer>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>


	    				
	    			