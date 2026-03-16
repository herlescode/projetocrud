<?php
//config do banco de dados
$servidor = "mysql-server"; 
$usuario = "root";
$senha = "Juli@2607";
$banco = "cadastro_user";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
//  else {

//     echo "<h1>Conexão com o banco de dados realizada com sucesso!</h1>";
// }

?>