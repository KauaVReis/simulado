<?php
// Configurações de acesso ao banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "simulado";

// Cria a conexão utilizando a extensão MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>