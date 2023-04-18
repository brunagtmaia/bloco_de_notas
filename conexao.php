<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloco_de_notas";

// Cria a conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica a conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>