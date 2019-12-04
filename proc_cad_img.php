<?php

session_start();
include_once(conexao.php);


 $msg = false;
    if(isset($_FILES['arquivo'])){
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novo_nome =md5(time()) . $extensao;
        $diretorio = "imagens/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'],  $diretorio. $novo_nome);
        $sql_code= "INSERT INTO imagem (codigo, arquivo, data) VALUES(null, '$novo_nome', NOW())";
        if($conn->query($sql_code)){
            $msg="arquivo enviado";
        }else{
            $msg="arquivo nao enviado";
        }
    }

    ?>