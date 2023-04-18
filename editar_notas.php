<?php
include_once'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' OR $_SERVER['REQUEST_METHOD'] === 'POST') {
    //pegando o id do usuário 
    $id_usuario_atual = $_GET['id_usuario_atual'];
    $id_nota_atual = $_GET['id_nota'];
    
}else{
    ?>
    <script>alert("erro");</script>
    <?php
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
                    <button id="bt_sair" class="botoes">Sair</button>
                    <hr>
                </div><!--fechando a classe que mostra o usuário e o botão de sair-->

                <div id="mostrar_notas">
                    <div class="menu_nsei">
                        <button class="botoes" id="bt_lista_de_notas">Notas Salvas</button>
                        <div class="menu_mostrar">
                            <?php
                                $sql_mostrar_notas = "SELECT * FROM notas WHERE usuario_id ='$id_usuario_atual'";
                                $result_mostar_nota = mysqli_query($conn, $sql_mostrar_notas);
                                while ($row_mostrar_notas = mysqli_fetch_assoc($result_mostar_nota)) : ?>
                                    <a class="link_nota"><?php echo $row_mostrar_notas['titulo']; ?></a><br><hr>
                                <?php endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <div id="principal">
                <form method="POST" id="form_nv_nota">
                    <p id="h1">Nota:</p>
                    <label id="info_titulo" class="info">Escreva o titulo:</label><br>
                    <input type="text" name="titulo" id="campo_titulo"><br>
                    <label id="info_nota" class="info">Escreva a nota:</label><br>
                    <textarea type="text" id="campo_nota" name="nota"></textarea><!-- que permite ao usuário inserir várias linhas de texto--><br> <br>
                    <!--Bt de salvar-->
                    <button type="submit" class="btn btn-info" name="salvar_nota" id="sv">Salvar nota</button>
                    <!--Bt de sair-->
                    <button class="btn btn-info" name="sair">Sair</button>
                    <!--Bt de limpar-->
                    <button class="btn btn-info" id="bt_limpar_campos">Limpar campos</button>
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