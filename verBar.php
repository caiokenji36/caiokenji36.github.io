<?php include_once("conexao.php");
session_start();
$id_bar = $_GET['id_bar'];

//transformando o id do bar em inteiro SELECT user.fotoUsuario, user.nome FROM comentarios as c inner join usuario as user on (c.idUsuario = user.idUsuario) inner join bar as b on (c.idBar = b.idBar)
$id_bar1 = intval($id_bar);

//Nao mostrar nenhum erro
error_reporting(0);
ini_set(“display_errors”, 0 );

   $sqll = "SELECT foto_bar FROM albumbar Where idBar = $id_bar1 ORDER BY codAlbum DESC Limit 4";
        $resultadoo = $conn->query($sqll);
        while($linha=mysqli_fetch_array($resultadoo)){
            $album[] = $linha;
        }

$result_bar = "SELECT * FROM bar WHERE idBar='$id_bar'";
$resultado_bar = mysqli_query($conn, $result_bar);
$row_bares = mysqli_fetch_assoc($resultado_bar);


$nome = $_SESSION['usuario'];
$result_id = "SELECT idUsuarios FROM usuarios WHERE usuario='$nome'";
$resultado_id = mysqli_query($conn, $result_id);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);


$result_bar1 = "SELECT * FROM servico WHERE idBar = $id_bar1";
$resultado_bar1 = mysqli_query($conn, $result_bar1);
		




$historico="INSERT into historico (idHis,data_historico, idBar, idUsuarios) values(null,NOW(),$id_bar1, $id_usu)";

 if($conn->query($historico)){
            $msg="arquivo enviado";
        }else{
            $msg="arquivo nao enviado";
        }

$foto = "SELECT fotoBar FROM bar WHERE idBar='$id_bar'";
$resultado_foto = mysqli_query($conn, $foto);
$row_foto = mysqli_fetch_assoc($resultado_foto);
$info = $row_foto;
$string = implode($info);


$horario = "SELECT * FROM funcionamento WHERE idBar='$id_bar' and dia_semana ='Segunda' ";
$resultado_horario = mysqli_query($conn, $horario);
$row_horario = mysqli_fetch_assoc($resultado_horario);

$horariod = "SELECT * FROM funcionamento WHERE idBar='$id_bar' and dia_semana ='Domingo' ";
$resultado_horariod = mysqli_query($conn, $horariod);

$row_horariod = mysqli_fetch_assoc($resultado_horariod);

$mudar = "SELECT * FROM favorito WHERE idBar = $id_bar AND idUsuarios = $id_usu";
$resultado_mudar = mysqli_query($conn, $mudar);

$row_mudar = mysqli_fetch_assoc($resultado_mudar);
$mud = $row_mudar['idUsuarios'];


date_default_timezone_set('America/Bahia');
$date = date('H:i');



?>

<script >
	// AddEmpresaMarker()

var coordsEmp = new google.maps.LatLng(latitude, longitude);
marcadorEmp = new google.maps.Marker {
  map: map,
  position: coordsEmp
};

// FindUserLocation()
// Mapa e opções do mapa já estão definidos previamente

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
    var posicao = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };
    console.log(posicao); // Confira se a localização está correta
    marcadorUsu = new google.maps.Marker {
      map: map,
      position: posicao
    };
  });
} else {
  // Browser não suporta Geolocalização ou o usuário impediu o uso
  return alert('Falha na tentativa de localização do usuário'); // Esse return é pra finalizar a função. De nada adianta executar toda a função se você não tem uma das posições
}

// MostrarCaminho()
// Aciona a Directions API

var directionsService = new google.maps.DirectionsService;
var directionsDisplay = new google.maps.DirectionsRenderer({
  map: mapa,
  suppressMarkers: true, // Não exibe os marcadores da rota, porque senão, pode confundir o usuário
});
directionsService.route({
  origin: pointA,
  destination: pointB,
  travelMode: google.maps.TravelMode.DRIVING
}, function(response, status) {
  if (status == google.maps.DirectionsStatus.OK) { // Se deu tudo certo
    directionsDisplay.setDirections(response);
  } else {
    alert('Não foi possível exibir o trajeto devido ao seguinte erro: ' + status);
  }
});


</script>

<script>
function mudarFoto(){
<?php 
$mudar = "SELECT * FROM favorito WHERE idBar = $id_bar AND idUsuarios = $id_usu";
$resultado_mudar = mysqli_query($conn, $mudar);

$row_mudar = mysqli_fetch_assoc($resultado_mudar);

?>


if(<?php $row_mudar ?> ==null){
          document.getElementById('imagem1').style.display = 'none';
          document.getElementById('imagem2').style.display = 'block';
}else{
   document.getElementById('imagem1').style.display = 'block';
    document.getElementById('imagem2').style.display = 'none';
}
}
</script>




<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoBeer</title>
    <link rel="icon"  href="imagens/favicon1.png"> <!--Icone que aparece na aba do navegador -->
<link rel="stylesheet" href="css/verBar.css">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    

   

  </head>


  <body class="body_test">

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
              <li><a href="menuh.php">Quem somos</a></li>
              <li><a href="fotosBar.php?id_bar=<?php echo $row_bares['idBar'];?>">Fotos</a></li>
              <li><a href="comentarios.php?id_bar=<?php echo $row_bares['idBar'];?>">Comentarios</a></li>
               <li class="divisor" role="separator"></li>
             
             <li><a href="javascript:history.back()">Voltar</a></li> 

                
                
            </form>
            </ul>
              </li>
            </ul>
          </div>

      </div> <!-- /container  acaba aqui-->
      
    </nav> <!-- /nav termina aqui-->







            </ul>
          </div>

      
  

  

    <!-- Conteudos-->
    <br>
    <br>
    <br>
    <br>
<img src="<?php echo "imagensBar/$string"?>" alt="" id="box"> 

<?php  
if($mud == null){
  $img = "cor.png";
  $a= "none";
  $b = "block";

}else{
  $img = "cor1.png";
  $a = "block";
  $b = "none";
}


?>
           
    <section id="servicos">
      <div class="container">
        <div class="row">  <!-- Cria as linhas-->
          <!-- Albuns-->
          <div class="col-md-6" > <!-- Cria  colunas-->
            <div class="row albuns"> <!-- Cria  mais uma linha-->
              <div class="col-md-6">
                <img src="imagens/img1.jpg" class="img-responsive">
              </div>
              <div class="col-md-6">
                <img src="imagens/img2.jpg" class="img-responsive">
              </div>
            </div> <!-- Cfim da row-->

            <?php 

            $stringg3 = substr($row_horario['horario_abertura'], 0, -3);
            $stringg4 = substr($row_horario['horario_fechamento'], 0, -3);

            $stringg5 = substr($row_horariod['horario_abertura'], 0, -3);
            $stringg6 = substr($row_horariod['horario_fechamento'], 0, -3);
            ?>

          </div>
           <div class="text-left">
            <form action="vitrine.php" method="post">
                 <a href="favorito.php?id_bar=<?php echo $row_bares['idBar'];?>"><img id="imagem1" width="30px" height="25px" type=submit style="display: <?php echo $b;?>;" onclick="mostrarFoto()"  src="imagens/cor.png"></a>

             <a href="favorito1.php?id_bar=<?php echo $row_bares['idBar'];?>"><img type="submit" id="imagem2" style="display: <?php echo $a;?>;" onclick="mostrarFoto()" width="30px" height="20px" src="imagens/cor1.png"></a>
           </form>
           </div>
          <div class="col-md-6" > <!-- Cria  colunas-->

            <h3><?php echo "Bem-vindo ao " .$row_bares['nome']; ?></h3>
            <p ><?php echo $row_bares['descricao_bar']; ?></p>

            

            
        </div>
      </div>
      
    </section>


  <section id="servicoss">
      <div class="container">
        <div class="row">  <!-- Cria as linhas-->
          <!-- Albuns-->
          <div class="col-md-4" > <!-- Cria  colunas-->
            <div class="row albuns"> <!-- Cria  mais uma linha-->
              <div class="col-md-8">
                <h3>Contato!</h3>
            <p ><?php echo $row_bares['endereco']; ?></p>
            <p ><?php echo "Tel: ".$row_bares['telefone']; ?></p>
            <p ><?php echo "E-mail: ".$row_bares['email']; ?></p>
            
              </div>
            </div> <!-- Cfim da row-->

            

          </div>
            <div class="col-md-4" > <!-- Cria  colunas-->
            <h3>Nosso Horário!</h3>
            <p >Segunda a Sexta</p>
            <p ><?php echo $stringg3." - ".$stringg4 ; ?></p>
            <p >Sábado e Domingo</p>
            <p ><?php echo $stringg5." - ".$stringg6 ; ?></p>
            

         

            
        </div>
         
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<br>
				<br>
				<h2>Eventos</h2>
			</div>
				<div class="container theme-showcase" role="main">
			<div class="page-header">
				
			</div>
			<div class="row">
				<?php while($rows_baress = mysqli_fetch_assoc($resultado_bar1)){ 

                
?>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							
							<div class="caption text-center">
                
								<h3><?php echo $rows_baress['tipo']; ?></h3>
								<p><?php echo $rows_baress['descricao'] ;?>
									<p><?php echo $rows_baress['data_servico'] ;?>
                     <form action="evento.php?id_bar=<?php echo $rows_baress['tipo'];?>" method="post">
                <input type=submit value="Presença">
                </form>
								
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="caption text-center">
		<h3>Fotos postadas por nossos clientes</h3>
	</div>
  <?php
            foreach ($album as $foto) {
            
        ?>
        
		<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <img id="foto" src="<?php echo "imagensBar/".$foto["foto_bar"]?>" width="400px" height="250px"><br><br>
      </div>
    </div>
  </div>
 <?php  }

        ?>
         <div class="caption text-center">

             <a href="http://maps.google.com/?saddr=Current%20Location&daddr=<?php echo $row_bares['endereco']?>" target="_blank">COMO CHEGAR</a>
        </div>
      </div>
  </div>
     
    </section>
<section id="servicoss">
      <div class="container">
        <div class="row"> 
          <div class="text-center">
  <h3>Deixe sua Avaliação</h3>
    <?php
    if(isset($_SESSION['msg'])){
      echo $_SESSION['msg']."<br><br>";
      unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="processa.php?id_bar=<?php echo $row_bares['idBar'];?>" enctype="multipart/form-data">
      <div class="estrelas">
        <p> Deixe uma avaliação sobre o bar em geral:   
        <input type="radio" id="vazio" name="estrela" value="" checked>
        
        <label for="estrela_um"><i class="fa"></i></label>
        <input type="radio" id="estrela_um" name="estrela" value="1">
        
        <label for="estrela_dois"><i class="fa"></i></label>
        <input type="radio" id="estrela_dois" name="estrela" value="2">
        
        <label for="estrela_tres"><i class="fa"></i></label>
        <input type="radio" id="estrela_tres" name="estrela" value="3">
        
        <label for="estrela_quatro"><i class="fa"></i></label>
        <input type="radio" id="estrela_quatro" name="estrela" value="4">
        
        <label for="estrela_cinco"><i class="fa"></i></label>
        <input type="radio" id="estrela_cinco" name="estrela" value="5"><br><br>
</div>

           <div class="dinheiro">
        <p> Deixe uma avaliação sobre o preço do bar:   
        
        
        <label for="estrela_seis"></label>
        <input type="radio" id="estrela_seis" name="dinheiro" value="1" ><span class="label label-danger">Irregular</span>
        
        <label for="estrela_sete"><i class="fa"></i></label>
        <input type="radio" id="estrela_sete" name="dinheiro" value="2"><span class="label label-warning">Regular</span>
        
        <label for="estrela_oito"><i class="fa"></i></label>
        <input type="radio" id="estrela_oito" name="dinheiro" value="3"><span class="label label-warning">Médio</span>
        
        <label for="estrela_nove"><i class="fa"></i></label>
        <input type="radio" id="estrela_quatro" name="dinheiro" value="4"><span class="label label-success">Bom</span>
        
        <label for="estrela_dez"><i class="fa"></i></label>
        <input type="radio" id="estrela_dez" name="dinheiro" value="5"><span class="label label-success">Excelente</span><br><br>


        
      
        
      </div>


      <div class="atendimento">
        <p> Deixe uma avaliação sobre o atendimento do bar:   
        
        
        <label for="estrela_once"></label>
        <input type="radio" id="estrela_once" name="atendimento" value="1" ><span class="label label-danger">Irregular</span>
        
        <label for="estrela_doze"><i class="fa"></i></label>
        <input type="radio" id="estrela_doze" name="atendimento" value="2"><span class="label label-warning">Regular</span>
        
        <label for="estrela_treze"><i class="fa"></i></label>
        <input type="radio" id="estrela_treze" name="atendimento" value="3"><span class="label label-warning">Médio</span>
        
        <label for="estrela_quatorze"><i class="fa"></i></label>
        <input type="radio" id="estrela_quatorze" name="atendimento" value="4"><span class="label label-success">Bom</span>
        
        <label for="estrela_quinze"><i class="fa"></i></label>
        <input type="radio" id="estrela_quinze" name="atendimento" value="5"><span class="label label-success">Excelente</span><br><br>


        
      
        
      </div>



        
        <input type="submit" value="Cadastrar">
        
      </div>
    </form>
         </div>
  </div>
     </div>
    </section>

    



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
