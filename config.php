<?php
//config do banco de dados
$servidor = "mysql-projeto";
$usuario = "root";
$senha = "Juli@2607";
$banco = "cadastro_user";
//$porta = 3307;

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
//  else {

//     echo "<h1>Conexão com o banco de dados realizada com sucesso!</h1>";
// }


// Configuração para o ambiente de CASA (Docker Desktop)
// $servi = "host.docker.internal"; // Atalho para o Docker acessar o seu Windows
// $usuario = "root";
// $senha = "Juli@2607";
// $banco = "cadastro_user";
// $porta = 3307; // A porta que aparece no seu Docker Desktop

// $conn = new mysqli($servi, $usuario, $senha, $banco, $porta);

// if ($conn->connect_error) {
//     die("Erro na conexão: " . $conn->connect_error);
// }
?>
