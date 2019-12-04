<?php

  $erro_login = isset($_GET['erro_login']) ? $_GET['erro_login']   : 0;
  $erro_email = isset($_GET['erro_email']) ? $_GET['erro_email']   : 0;
  $erro_cnpj  = isset($_GET['erro_cnpj'])  ? $_GET['erro_cnpj']    : 0;

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cadastre-se | Bares</title>
    
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="icon"  href="imagens/favicon1.png">
    
    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <!-- Funções para validação de CPF e CNPJ -->
    <script src="valida_cpf_cnpj_com_js/js/valida_cpf_cnpj.js"></script>    
    
    <!-- Formatando o CPF ou CNPJ -->
    <script src="valida_cpf_cnpj_com_js/js/exemplo_3.js"></script>

    <!-- jquery - link cdn -->
    <script href="bootstrap/js/jquery-3.4.1.slim.js"></script>

    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse navbar-transparente">
      <div class="container">

        <!-- CABEÇALHO -->
        <div class="navbar-header">

          <!-- LOGO -->
          <a href="index.php" class="navbar-brand center"> 
            <span class="img-logo">GO BEER</span>
          </a> <!-- // FIM DO LOGO -->
          <a href="index.php" class="navbar-brand center">Voltar </a>

        </div> 
      </div>
    </nav> <!-- // FIM DO MENU -->
    <!-- // FIM DO CABEÇALHO -->

    <!-- AREA FAVORITOS -->
    <nav class="conteiner cadastro">
        <!-- FAVORITOS -->
      <div class="page-header">
        <p>CADASTRE SEU ESTABELECIMENTO</p>
      </div>

      <div class="row">
        <form method="post" class="form-group" action="valida_dados_bar.php">  
          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Insira um login*</b></label>
              <input id="name" type="text" class="form-control" placeholder="Login" name="login" minlength="5" maxlength="10" pattern="[a-zA-Z0-9_]+" required>
              <label>
                <?php
                    if ($erro_login == 1) {
                      echo "<font style: color= red>Este login ja está em uso!</font>";
                    }
                ?>
              </label>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Insira uma senha*</b></label>
              <input id="senha" type="password" class="form-control" placeholder="Senha" name="senha" minlength="8" maxlength="10" pattern="[a-zA-Z0-9!@&]+" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Insira um e-mail*</b></label>
              <input id="email" type="email" class="form-control" placeholder="email@gobeer.com.br" name="email" pattern="[a-zA-Z0-9_-@]+" required>
              </div>
              <label>
                <?php
                  if ($erro_email) {
                    echo "<font style: color= red>Este E-mail já está em uso!</font>";
                  }
                ?>
              </label>                                   
          </div>

          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Insira o nome do estabelecimento*</b></label>
              <input id="nome" type="text" class="form-control" placeholder="Nome do bar" name="nome" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Insira o telefone do estabelecimento*</b></label>
              <input type="tel" class="form-control" placeholder="Telefone" name="telefone" minlength="8" maxlength="15" pattern="[0-9]+" required> 
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Insira o CNPJ do estabelecimento*</b></label>
              <input type="text" class="form-control cpf_cnpj" placeholder="CNPJ" name="cnpj" minlength="14" required>
              <label>
                <?php
                  if ($erro_cnpj) {
                    echo "<font style: color= red>Este CNPJ ja está em uso!</font>";
                  }
                ?>
              </label>
            </div>
            
          </div>

          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Insira o endereço do bar*</b></label>
              <input type="text" class="form-control" placeholder="Endereço" name="endereco" required>
            </div>
          </div>
  <script type="text/javascript">
  function mostrarSenha(){
      var tipo =document.getElementById("senha");
        if(tipo.type =="password"){
          tipo.type = "text"
          document.getElementById('imagem').style.display = 'none';
          document.getElementById('imagem2').style.display = 'block';
          
        
        }else{
          tipo.type = "password"
          document.getElementById('imagem').style.display = 'block';
          document.getElementById('imagem2').style.display = 'none';
        }
      }

</script>


          <div class="form-group">
            <div class="col-sm-8 col-md-offset-2">
              <label class="texto"><b>Descreva o bar</b></label>
              <textarea type="text" class="form-control" placeholder="Descreve o bar" name="descricao"></textarea>
            </div>
          </div>  

                <div class="col-sm-1 col-md-offset-2">
          <div class="form-group"><img type="submit" id="imagem" onclick="mostrarSenha()" width="30px" height="30px" src="imagens/eye.png"/>
            <img type="submit" id="imagem2" style="display: none;" onclick="mostrarSenha()" width="30px" height="30px" src="imagens/eye2.png"/>
          </div>
        </div>

          
          <div class="col-sm-8 col-md-offset-2">
            <button class="btn btn-default" type="submit">Inscreva-se</button>
          </div>
        </form> 
      </div>

    </nav>  
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>