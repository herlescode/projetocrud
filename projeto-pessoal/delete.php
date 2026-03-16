<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM usuarios WHERE id = " . $_SESSION['id'];
                $resultado = $conn->query($sql);
$usuario = $resultado->fetch_assoc();

if ($usuario['adm'] == 0) {
    header("Location: consultar.php");
    exit();
}

if(isset($_GET['excluir'])){
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['excluir']);//bind_param() é um método da classe mysqli_stmt que é usado para vincular os parâmetros de uma consulta preparada. O primeiro argumento é uma string que especifica os tipos de dados dos parâmetros (neste caso, "i" para inteiro), e os argumentos subsequentes são as variáveis que contêm os valores a serem vinculados aos parâmetros da consulta.
    
    $stmt->execute();
    
    header("Location: delete.php");
    exit();
    // if($stmt->execute() === TRUE){
    //     echo "Registro excluído com sucesso!";
    // } else {
    //     echo "Erro ao excluir registro: " . $conn->error;
    // }
}
if (isset($_GET['atualizar'])) {
    $sql = "UPDATE usuarios SET nome = ?, senha = ? WHERE id = ?";
    $stmt = $

}
$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql); //retorna um objeto do tipo mysqli_result, que possui o método num_rows para verificar a quantidade de registros retornados e o método fetch_assoc() para obter os dados dos registros em forma de array associativo
$registros = [];

if($resultado->num_rows > 0 ) {//verifica se a consulta retornou algum registro
    while($row = $resultado->fetch_assoc()) { //fetch_assoc() retorna um array associativo com os dados do registro
       $registro[] = $row;
    }
    } elseif ($conn->error) { //verifica se houve um erro na consulta
            echo "Nenhum registro encontrado" . $conn->error;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
    <div class="container mt-3 d-flex justify-content-center align-items-center vh-100">
         <h3>Usuários</h3>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($registro as $row): ?><!--foreach para percorrer o array de registros e exibir os dados em uma tabela HTML-->
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['senha']; ?></td>
                            <td>
                                <a href="?excluir=<?php echo $row['id']; ?>" class="btn btn-danger">Excluir</a>
                                <a href="?excluir=<?php echo $row['id']; ?>" class="btn btn-danger">Atualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>    
    </div>
</body>
</html>