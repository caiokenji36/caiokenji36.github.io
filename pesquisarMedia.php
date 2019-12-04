<?php
	session_start();
	include_once("conexao.php");
	require_once('conecta_bd.php');
	error_reporting(0);
ini_set(“display_errors”, 0 );

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	if(!isset($_SESSION['nome'])){
		header('Location: index.php?erro=1');
	}

		//$consulta = "SELECT codigo FROM imagem ORDER BY codigo DESC limit 1";
		//$consulta="SELECT arquivo FROM `imagem` ORDER BY codigo DESC limit 1";
		//$resultado=mysqli_query($conn,$consulta);
		//$row_cursos = mysqli_fetch_assoc($resultado);
		//var_dump($row_cursos);


			//$con = $conn->query($consulta) or die ($conn->error);
			//$resultado_novo ="SELECT arquivo FROM imagem where codigo = $novo_resultado";
			//$dado = $con->fetch_array();
			//$dado=mysqli_fetch_array($con);
			//var_dump($dado);
		$nome = $_SESSION['usuario'];
		
		$sql = "SELECT fotoUsuario FROM usuarios Where usuario = '$nome' limit 1";
		$resultado = $conn->query($sql);
		while($linha=mysqli_fetch_array($resultado)){
			$album[] = $linha;
		}




//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Selecionar todos os bares da tabela
$result_bar = "SELECT * FROM bar";
$resultado_bars = mysqli_query($conn, $result_bar);

//Contar o total de bares
$total_bares = mysqli_num_rows($resultado_bars);

//Seta a quantidade de bares por pagina
$quantidade_pg = 6;

//calcular o número de pagina necessárias para apresentar os Bares
$num_pagina = ceil($total_bares/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os bares a serem apresentado na página
$result_bares = "SELECT * FROM bar limit $incio, $quantidade_pg";
$resultado_bar = mysqli_query($conn, $result_bares);
$total_bares = mysqli_num_rows($resultado_bar);





	

	//Salvar imagem no BD
 $msg = false;
    if(isset($_FILES['arquivo'])){
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novo_nome =md5(time()) . $extensao;
        $diretorio = "imagens/";
        

	
        move_uploaded_file($_FILES['arquivo']['tmp_name'],  $diretorio. $novo_nome);
        $sql_code= "UPDATE usuarios SET fotoUsuario = '$novo_nome' WHERE usuario = '$nome'";
        if($conn->query($sql_code)){
            $msg="arquivo enviado";
        }else{
            $msg="arquivo nao enviado";
        }

    }
//Fim do salvar
		
       

 

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
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNy9R5IT5yu5Za8IdOTUsUp3urF6sZOcI&callback=init">  
    </script>



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


<script>
      function calculateRoute(from, to) {
        // Center initialized to Naples, Italy
        var myOptions = {
          zoom: 12,
          center: new google.maps.LatLng(-23.5114, -46.8729),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Draw the map
        var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
          origin: from,
          destination: to,
          travelMode: google.maps.DirectionsTravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIC
        };
        directionsService.route(
          directionsRequest,
          function(response, status)
          {
            if (status == google.maps.DirectionsStatus.OK)
            {
              new google.maps.DirectionsRenderer({
                map: mapObject,
                directions: response
              });
            }
            else
              $("#error").append("Não foi possível calcular sua rota<br />");
          }
        );
      }

      $(document).ready(function() {
        // If the browser supports the Geolocation API
        if (typeof navigator.geolocation == "undefined") {
          $("#error").text("Seu navegador não tem suporte para esta aplicação");
          return;
        }

        $("#from-link, #to-link").click(function(event) {
          event.preventDefault();
          var addressId = this.id.substring(0, this.id.indexOf("-"));

          navigator.geolocation.getCurrentPosition(function(position) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK)
                $("#" + addressId).val(results[0].formatted_address);
              
 
              else
                $("#error").append("Não foi possível recuperar sua localização<br />");
            });
          },
          function(positionError){
            $("#error").append("Error: " + positionError.message + "<br />");
          },
          {
            enableHighAccuracy: true,
            timeout: 10 * 1000 // 10 seconds
          });
        });

        $("#calculate-route").submit(function(event) {
          event.preventDefault();
          calculateRoute($("#from").val(), $("#to").val());
        });
      });
    </script>
    <style type="text/css">
      #map {
        width: 500px;
        height: 400px;
        margin-top: 10px;
      }
    </style>




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
       


        	
			<?php
			foreach ($album as $foto) {
			
		?>
		
			<img id="foto" src="<?php echo "imagens/".$foto["fotoUsuario"]?>" width="260px" height="150px" /><br><br>
		
		<?php  }

		?>
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


		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<br>
				<br>
					<div class="text-center">
					
						<form method="GET" action="vitrine2.php" enctype="multipart/form-data">
      <label for="from">From:</label>
      <input type="text" id="from" name="from" required="required" placeholder="An address" size="30" />
      <a id="from-link" href="#">Use minha localização atual</a>
      <input type="submit" value="Enviar">
						</div>
					</form>
					
				<br>
				<br>
				<div class="row">
					<div class="col-sm-6 col-md-6">
					<h1 id="pes">Bares</h1>
					</div>
					<br>
					<div class="col-sm-6 col-md-6">
					<form class="form-inline" method="GET" action="pesquisar.php">
							<div class="form-group">
								<label for="exampleInputName2" >Pesquisar</label>
								<input type="text" name="pesquisar" class="form-control" id="exampleInputName2" placeholder="Digitar...">
							</div>
							<button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
					</div>






					<div class="col-md-6">
					<form class="form-inline" method="GET" action="pesquisarMedia.php">
							<div class="form-group">
							
					
							</div>
							<button type="submit" class="btn btn-primary">Média Geral</button>
								</form>
							</div>
								<div class="col-md-6">
							<form class="form-inline" method="GET" action="preco.php">
							<div class="form-group">
								
							</div>
							<button type="submit" class="btn btn-primary">Melhor preço</button>
							</form>
						</div>
						<div class="col-md-6">
							<form class="form-inline" method="GET" action="melhor.php">
							<div class="form-group">
								
							</div>
							<button type="submit" class="btn btn-primary">Melhor Atendimento</button>
						
					
						</form>
					</div>
					
			
	
		</div>
	</div>
					
					
							
						
					
	
			<div class="row">


<?php 



?>

















				<?php 
								$id = $rows_bar['idBar'];


							$novo = "	SELECT bar.nome,
							    avGeral,
							    avAtende,
							    avPreco,
							    bar.idBar,
							    bar.endereco,
							    bar.fotoBar,
							    SUM(avGeral) as SOMA_GERAL,
							    COUNT(avaliacao.avGeral)   as TOTAL_GERAL,
							    COUNT(avaliacao.avAtende)  as TOTAL_ATENDE,
							    COUNT(avaliacao.avPreco)   as TOTAL_PRECO,
							   (SUM(avGeral)/COUNT(avaliacao.avGeral)) as MEDIA_GERAL,
							   (SUM(avAtende)/COUNT(avaliacao.avAtende)) as MEDIA_ATENDE,
							   (SUM(avPreco)/COUNT(avaliacao.avPreco)) as MEDIA_PRECO
				   	  	   FROM avaliacao, bar
				  	  	  WHERE bar.idBar = avaliacao.idBar
				  	      GROUP BY bar.idBar
				          ORDER BY MEDIA_GERAL DESC";
				          $resultado_media2 = mysqli_query($conn, $novo);
								while($rows_media2 = mysqli_fetch_assoc($resultado_media2)){


								


							$aaaaa=$rows_media2['MEDIA_ATENDE'];
							$stMed2 = implode($aaaaa);
								$stringg2 = substr($stMed2, 0, -3);

								

							


				

								date_default_timezone_set('America/Bahia');
								$date = date('H:i');
								$hora=strtotime($date);
								
								if($hora >= $aberturaa && $hora < $fechamento){

  									$abre = "<b><font color=\"#008000\"> Aberto </font></b>";
								}else{
 									$abre = "<b><font color=\"#FF0000\"> Fechado </font></b>";
									}

									



					?>










					<div class="col-sm-6 col-md-6">
						<div class="thumbnail">
							

							<a href="verBar.php?id_bar=<?php echo $rows_bar['idBar'];?>"><img src="<?php echo "imagensBar/".$rows_media2['fotoBar'];?>" alt="" id="box"> </a>
							
							<div class="caption text-center">
							
						
								<h3><?php echo $rows_media2['nome']; ?> </h3>
								<h3><?php echo $rows_media2['endereco']; ?></h3>
								
								
								
								<div class="col-md-1"><h4>(<?php echo number_format($rows_media2['MEDIA_GERAL'],1); ?>)</h4></div>

								<div class="col-sm-1"><img src="imagensBar/estrela.png" width="30px" height="30px" alt="..."></div>
								<div class="col-md-1"><h4><?php echo $rows_media2['TOTAL_GERAL']  ?> </h4></div>
								
								
								
									
									
								<div class="col-md-1"><h4><?php echo "|"; ?></h4></div>
								<div class="col-md-1"><h4>(<?php echo number_format($rows_media2['MEDIA_ATENDE'],1);?>)</h4></div>
								<div class="col-sm-1"><img src="imagensBar/emoji.png" width="35px" height="35px" alt="..."></div>
								<div class="col-md-1"><h4><?php echo $rows_media2['TOTAL_ATENDE']  ?> </h4></div>
								

								<div class="col-md-1"><h4><?php echo "|"; ?></h4></div>

								<div class="col-md-1"><h4>(<?php echo number_format($rows_media2['MEDIA_PRECO'],1) ?>)</h4></div>
								<div class="col-sm-1"><img src="imagensBar/dinheiro.png" width="30px" height="30px" alt="..."></div>
								<div class="col-md-1"><h4><?php echo $rows_media2['TOTAL_PRECO']  ?> </h4></div>
								
								

								
								<p><a href="verBar.php?id_bar=<?php echo $rows_bar['idBar'];?>" class="btn btn-primary" role="button">Ver</a> </p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php
				//Verificar a pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>
			<nav class="text-center">
				<ul class="pagination">
					<li>
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="menuh.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="menuh.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="menuh.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>





		</div>






</body>
</html>﻿


