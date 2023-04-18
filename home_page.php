<?php
include_once'conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' OR $_SERVER['REQUEST_METHOD'] === 'POST') {
    //pegando o id do usuário 
    $id_usuario_atual = $_GET['id'];
    
}else{
    ?>
    <script>alert("erro");</script>
    <?php
}
//salvar nota
if (isset($_POST['salvar_nota'])){
    $nota = $_POST['nota'];
    $titulo_nota = $_POST['titulo'];
    //falando que todos os campos tem que estar preenchidos 
    if($nota==="" OR $titulo_nota === ""){
        ?>
            <script>alert("todos os campos são obrigatórios");</script>
        <?php
    }else{
        //inserindo nota
        $sql_salvar_nota = "INSERT INTO notas (titulo, conteudo, usuario_id) VALUES ('$titulo_nota','$nota','$id_usuario_atual')";
        $result_salvar_nota = mysqli_query($conn, $sql_salvar_nota);
       
        //rediracionando para a página de edição de nota, com o id da nota.
        header('Location: editar_notas.php');
        exit();
    }
}

//sair
if((isset($_POST['sair']))){
    header('Location: login.php');
    exit();
}

//pesquisando o usuário
$sql_pesquisa_usuario = "SELECT * FROM usuarios WHERE id= '$id_usuario_atual'";
$result_pesquisa_usuario = mysqli_query($conn, $sql_pesquisa_usuario);
$row_pesquisa_usuario = mysqli_fetch_assoc($result_pesquisa_usuario);


?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="home_page">
            <div id="menu" class="culuns">

            
                <div id="mostrar_usuario">
                    <img src="usuario.png" width="20px" height="20px" style="margin:10px"><?php echo $row_pesquisa_usuario['nome_usuario']; ?>
                    <hr>
                    <form method="POST"><button id="bt_sair" class="botoes" name="sair">Sair</button></form>
                    <hr>
                </div><!--fechando a classe que mostra o usuário e o botão de sair-->
                
                <div class="menu_nsei">
                    <button class="botoes" id="bt_lista_de_notas" data-bs-toggle="dropdown" aria-expanded="false">Notas Salvas</button>
                    <div class="menu_mostrar">
                        <?php
                            $sql_mostrar_notas = "SELECT * FROM notas WHERE usuario_id ='$id_usuario_atual'";
                            $result_mostar_nota = mysqli_query($conn, $sql_mostrar_notas);
                            while ($row_mostrar_notas = mysqli_fetch_assoc($result_mostar_nota)) : ?>
                                <a class="link_nota" href="editar_notas.php?id_usuario_atual=<?php echo $row_mostrar_notas['usuario_id'];?>&id_nota=<?php echo $row_mostrar_notas['id'];?>"><?php echo $row_mostrar_notas['titulo']; ?></a><br>
                            <?php endwhile;
                        ?>
                    </div>
                </div>
            </div>


            <div id="principal">
                <form method="POST" id="form_nv_nota">
                    <p class="titulos">Nova nota:</p>
                    <label id="info_titulo" class="info">Escreva o titulo:</label><br>
                    <input type="text" name="titulo" id="campo_titulo"><br>
                    <label id="info_nota" class="info">Escreva a nota:</label><br>
                    <textarea type="text" id="campo_nota" name="nota"></textarea><!-- que permite ao usuário inserir várias linhas de texto--><br> <br>
                    <!--Bt de salvar-->
                    <button type="submit" class="botoes" name="salvar_nota" id="bt_salvar_nota">Salvar nota</button>
                    <!--Bt de limpar-->
                    <button class="botoes" id="bt_limpar_campos">Limpar campos</button>
                </form>
            </div>


            
        </div>
        <script>
            function limpar_campos(){
                const campo_titulo = ducument.getElementById('campo_titulo');
                const campo_nota = ducument.getElementById('campo_nota');
                const bt_limpar_campos = ducument.getElementById('bt_limpar_campos');

                bt_limpar_campos.addEventListener('click', funciton() {
                    campo_titulo.value = '';
                    campo_nota.value = '';
                });
            }
        </script>
    </body>
</html>