
<?php 
  // caso a condicao seja verdadeira ele executa a acao antes do : 
  //caso seja falsa ele executa a direita do : ,aqui seria o 0
  $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
  
?>



<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoBeer</title>

    <!-- jquery - link cdn -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="icon"  href="imagens/favicon1.png"> <!--Icone que aparece na aba do navegador -->
<link rel="stylesheet" type="text/css" href="entrarcss.css" /> 
<script>
      $(document).ready( function(){
        //verificar se os campos do usuario e senha foram devidamente preenchidos
        $('#btn_login').click(function(){

          var campo_vazio = false;
          //verificar se o campo usuario esta preenchido,pelo seu id
          if($('#campo_usuario').val() ==''){
            $('#campo_usuario').css({'border-color': '#A94442'});
            campo_vazio = true;
          } else{
            $('#campo_usuario').css({'border-color': '#CCC'})
          }
          if($('#campo_senha').val() ==''){
            $('#campo_senha').css({'border-color': '#A94442'})
            campo_vazio = true;
          }else{
            $('#campo_senha').css({'border-color': '#CCC'})
          }
          if(campo_vazio) return false;
        });
      });         
    </script>



  </head>


  <body class="body_entrar">


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
              <li><a href="entrar.php">Quem somos</a></li>
              <li><a href="">Ajuda</a></li>
              <li><a href="">Baixar</a></li>
               <li class="divisor" role="separator"></li>
             <li><a href="inscrevase.php">Inscrever-se</a></li> 

             


               <li class="<?=$erro == 1 ? 'open' : '' ?>">
                <a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
          <ul class="dropdown-menu" aria-labelledby="entrar">
            <div class="col-md-12">
                <p>Você possui uma conta?</h3>
                <br />
              <form method="post" action="validar_acesso.php" id="formLogin">
                <div class="form-group">
                  <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
                </div>
                
                <div class="form-group">
                  <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
                </div>
                
                <button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>

                <br /><br />
                
              </form>
              <?php 
                if($erro ==1){
                  echo '<font color="#FF000">Usuário e ou senha inválidos(s)</font>';
                }
              ?>
            </form>
            </ul>
              </li>
            </ul>
          </div>

      </div> <!-- /container  acaba aqui-->
      
    </nav> <!-- /nav termina aqui-->
    <br/>
    <br/>
    <br/>
    <br/>
    <!--<div class="sair"><a href="indexx.php"><i class="fa fa-times" style="font-size: 3em" ></i></a></div>-->
    <div class="sair"><a href="index.php" class="sair_x"><i class="fa fa-times" style="font-size: 3em" ></i></a></div>
    <div id="a-b-c">
    
    <div class="box">
         <br/>
      <br/>
      <br/>
      <br/>
      <br/>
    
  

    <div><i class="fa fa-user" style="font-size: 3em"></i></div>
      <br/>
      
      <h1 ><a href="tela_cadastro_usuario.php" class="entrar_usu"><b>Entrar como usuário</b></a>
</h1>

</br>
<hr/>
      <p>
        <font size="3">
       Gerencie seu perfil, veja o seu histórico de bares visitados e muito mais.
     </font>
     </p>
    </div>
 
  
    <div class="box left">
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <div><i class="fa fa-beer" style="font-size: 3em" ></i></div>
      <br/>
   
      <h1><a class="entrar_bar" href="tela_cadastro_bar.php"><b>Entrar como bar</b></a></h1>
      </br>
      </br>
      </br>
<hr/>

 <p>
      <font size="3">
       Encontre tudo que você precisa para acompanhar seu bar.
     </font>
     </p>

     
    </div>
  
    
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>