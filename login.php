<?php
include_once'conexao.php';

if (isset($_POST['login_entrar'])){//define se é nula ou não 
    $email = $_POST['login_email'];
    $senha = $_POST['login_senha'];
    
    
    // Execute uma consulta para verificar se o nome de usuário e a senha correspondem a um usuário válido
    $query_verifica_email = "SELECT * FROM usuarios WHERE email_usuario ='$email'";
    $result = mysqli_query($conn, $query_verifica_email);

    if (mysqli_num_rows($result) > 0) { //usuário existe 
        $row = mysqli_fetch_assoc($result);
        if($row['senha_usuario']=== $senha){
            header("Location: home_page.php?id=". $row['id']); // redireciona para a página de notas com o valor do ID na URL
            exit();
        }else{
            ?>
                <script>alert("Senha ou usuário errado");</script>
            <?php
        }
        
    } else {
        ?>
            <script>alert("Usário não cadastrado. Clique em 'cadastre-se'.");</script>
        <?php
    }
}
if(isset($_POST['cadastro'])){
    header("Location: cadastro.php"); // redireciona para a página de notas com o valor do ID na URL
    exit();
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
            <img id="icone" src="icone_notas.png" width="100px" heigth="100px">
            <h4 id="titulo">Bem vindo ao nosso bloco de notas. Faça login:</h4>
                <form method="POST">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email" name="login_email">
                    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="login_senha">
                    </div>
                    <button type="submit" id ="bt_enviar" class="btn btn-primary" name="login_entrar">Enviar</button>
                    <button type="submit" id ="bt_enviar" class="btn btn-primary" name="cadastro">Cadastre-se</button>
                </form>
        </div>
    </body>
</html>