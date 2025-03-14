<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ferramental";

try {
    // Tentando estabelecer a conexão com MariaDB
    $conexao = new mysqli($servername, $username, $password, $dbname);

    // Verificando se houve erro na conexão
    if ($conexao->connect_error) {
        throw new Exception("Falha ao se conectar: (" . $conexao->connect_errno . ") " . $conexao->connect_error);
    }

} catch (Exception $e) {
    // Exibe mensagem de erro se ocorrer
    echo $e->getMessage();
}
?>