<?php
include_once'conexao.php';

if (isset($_POST['login_entrar'])){//define se é nula ou não 
    $nome = $_POST['nv_nome'];
    $email = $_POST['nv_email'];
    $senha = $_POST['nv_senha'];
    
    
    // Execute uma consulta para verificar se o nome de usuário e a senha correspondem a um usuário válido
    $query_verifica_email = "SELECT * FROM usuarios WHERE email_usuario ='$email'";
    $result_verifica_email = mysqli_query($conn, $query_verifica_email);

    if (mysqli_num_rows($result_verifica_email) > 0) {//ja está cadastrado 
        ?>
            <script>alert("Usuário ja cadastrado!, volte e faça login");</script>
        <?php
    }else{
        if($nome==="" OR $email==="" OR $senha===""){
            ?>
                <script>alert("Todos os campos são obrigatórios!");</script>
            <?php
        }else{
            $query_cadastro_usuario = "INSERT INTO usuarios (nome_usuario, email_usuario,senha_usuario) VALUES ('$nome','$email','$senha')";
            $result_cadastro_usuario = mysqli_query($conn, $query_cadastro_usuario);
            
            ?>
            <script>alert("Usuário cadastrado. Direcionando...");</script>
            <?php
            
            header('Location: login.php');
            exit;
        }
    }
} 



?>

<html>
  <head>
        <title>Bloco de notas simples</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta charset="utf-8">
        <style>
            .conteiner{
                background-color:rgb(230, 230, 230);
                width:500px;
                height:auto;
                display:flex;
                flex-direction: column;
                position: absolute; /* define a posição absoluta */
                top: 50%; /* define a posição vertical */
                left: 50%; /* define a posição horizontal */
                transform: translate(-50%, -50%); /* centraliza a div */
                border-radius: 20px;
            }
            #icone{
                position: relative;
                justify-content: center;
                left: 50%;
                transform: translateX(-50%);
                margin: 10px;
            }
            .form-group{
                margin:30px;
            }
            #titulo{
                margin:30px;
            }
            #bt_enviar{
                width:200px;
                margin:20px;
            }
        </style>
    </head>
    <body>
        <div class="conteiner" role="alert">
            <img id="icone" src="novo_usuario.png" width="100px" heigth="100px">
            <h4 id="titulo">Cadastre-se: </h4>
            <form method="POST">
                <div class="form-group">
                    <label for="nv_nome">Nome:</label>
                    <input type="text" class="form-control" id="nv_nome" aria-describedby="emailHelp" placeholder="Seu nome" name="nv_nome" requered><br><br>
                    <label for="exampleInputEmail1">Endereço de email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email" name="nv_email" requered>
                    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Senha</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="nv_senha" requered>
                </div>
                <button type="submit" id ="bt_enviar" class="btn btn-primary" name="login_entrar">Enviar</button>
        </div>
    </body>
</html>