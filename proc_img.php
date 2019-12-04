<?php

session_start();
include_once './conexao.php';
$id_bar = $_GET['id_bar'];
$id_bar1 = intval($id_bar);

$nome = $_SESSION['usuario'];

$idUsu = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);
//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $nome_imagem = $_FILES['imagem']['name'];
    
        $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
        $novo_nome =md5(time()) . $extensao;

    $result_img = "INSERT into albumbar(codAlbum, data_albBar, foto_bar, idBar) values (null, NOW(), '$novo_nome', $id_bar1)";
    $insert_msg = $conn->prepare($result_img);
    
  

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        

        //Diretório onde o arquivo vai ser salvo
        $diretorio = 'imagensBar/';

        
        
        
        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome)){
            $_SESSION['msg'] = "<p style='color:green;'>Dados salvo com sucesso e upload da imagem realizado com sucesso</p>";
            header("Location: fotosBar.php?id_bar=".$id_bar1);
        }else{
            $_SESSION['msg'] = "<p><span style='color:green;'>Dados salvo com sucesso. </span><span style='color:red;'>Erro ao realizar o upload da imagem</span></p>";
            header("Location: fotosBar.php?id_bar=".$id_bar1);
        }        
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
        header("Location: fotosBar.php?id_bar=".$id_bar1);
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
    header("Location: fotosBar.php?id_bar=".$id_bar1);
}
    ?>