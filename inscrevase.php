<?php
	$erro_usuario = isset($_GET['erro_usuario']) ? $_GET['erro_usuario'] : 0 ;
	$erro_email = isset($_GET['erro_email']) ? $_GET['erro_email'] : 0 ;

?>


<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
		<title>Inscreva-se</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		

		<!-- bootstrap - link cdn -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


		 <link rel="icon"  href="imagens/favicon1.png"> <!--Icone que aparece na aba do navegador -->
		<link href="inscrevasecss.css" rel="stylesheet">
	</head>

	<body class="inscrevase_body">
  <nav class="navbar navbar-fixed-top navbar-inverse navbar-transparente">
      <div class="container">
        <!-- Header -->
        <div class="navbar-header">
       

          <a href="index.php" class="navbar-brand">
            
            <span class="img-logo"></span>
          </a>
        </div>
          <!-- Navbar -->
          <div class="collapse navbar-collapse" id="barra-navegacao">
            <ul class="nav navbar-nav navbar-right">

            <li><a href="index.php">Voltar para home</a></li>
            
            </ul>

          </div>

      </div> <!-- /container  acaba aqui-->
      
    </nav> <!-- /nav termina aqui-->


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<br />
	    		<br />
	    		<br />
	    		<br />
	    		<br />
				<form method="post" action="registra_usuario.php" id="formCadastrarse">
					<div class="form-group">
						
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required="requiored">
						<?php
							if($erro_usuario){ //1 true // 0 false
								echo '<font color="#32CD99">Usuário já existe</font>';
							}
						?>

					</div>


					<div class="form-group">
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required="requiored">
					

					</div>

					<div class="form-group">
						<input type="date" class="form-control" id="cData" name="cData"  required="requiored" max="2019-11-18">
					

					</div>

					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="requiored">

						<?php
							if($erro_email){
								echo '<font color="#32CD99">E-mail já existe</font>';
							}
						?>

					</div>

					<div class="form-group">
						<input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Telefone"   maxlength="15">
					

					</div>
					
					<div class="form-group ">
						

						<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="requiored" onkeyup="senhaForca()"></div>
						<div class="form-group row">
							<label class="col-md-6"><font color="#32CD99">Força da senha</font></label>
							<div class="col-md-6" id="erroSenhaForca"></div>
						</div>
						<div class="form-group"><img type="submit" id="imagem" onclick="mostrarSenha()" width="30px" height="30px" src="imagens/eye.png"/>
						<img type="submit" id="imagem2" style="display: none;" onclick="mostrarSenha()" width="30px" height="30px" src="imagens/eye2.png"/>
					</div>

		
					
					<button type="submit" class="btn btn-primary form-control">Inscreva-se</button>
				</form>
			</div>
			<div class="col-md-4"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>


	    </div>
	


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<script src="personalizado.js"></script>
	
	</body>
</html>