

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
		<title>Inscreva-se</title>

			<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
		<script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript" /></script>
		
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
				<form method="post" action="registra_bar.php" id="formCadastrarse">
					<div class="form-group">
						
						<input type="text" class="form-control" id="loginn" name="loginn" placeholder="Usuário" required="requiored">
						

					</div>


					<div class="form-group">
						<input type="text" class="form-control" id="nomee" name="nomee" placeholder="Nome do Bar" required="requiored">
					

					</div>

					<div class="form-group">
						<input type="email" class="form-control" id="emaill" name="emaill" placeholder="Email" required="requiored">

						

					</div>
<!-- /nav termina aqui
					<div class="form-group">
						<input name="cnpj" type="text" id="cnpj" class="form-control"
						placeholder="CNPJ" required="requiored">
					

					</div>

					<div class="form-group">
						<input name="endereco" type="text" id="endereco" class="form-control"
						placeholder="Endereço" required="requiored">
					

					</div>
					-->
					<div class="form-group ">
						

						<input type="password" class="form-control" id="senhaa" name="senhaa" placeholder="Senha" required="requiored" ></div>
						

		
					
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

		
	</body>
</html>