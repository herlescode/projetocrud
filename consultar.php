<?php
session_start();

require_once 'config.php';

// Se NÃO existe uma sessão (usuário não logou), chuta para o login
if (!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

// if ($_SESSION['usuario'] !== "herles"){
//     header("Location: login.php");
//     exit();
// }

$sql = "SELECT nome, senha FROM usuarios";
//retorna um objeto do tipo mysqli_result, que possui o método num_rows para verificar a quantidade de registros retornados e o método fetch_assoc() para obter os dados dos registros em forma de array associativo
$resultado = $conn->query($sql);

$registro = [];
if($resultado->num_rows > 0){//verifica se a consulta retornou algum registro
    while($row = $resultado->fetch_assoc()){ //fetch_assoc() retorna um array associativo com os dados do registro
        $registro[] = $row;
    }
} elseif($conn->error){ //verifica se houve um erro na consulta
    echo "Nenhum registro" . $conn->error;
}

//print_r($registro);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container mt-4 d-flex flex-column justify-content-center vh-100">

        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <h3>Consultar</h3>
            <a href="login.php" class="btn btn-secondary">Sair / Voltar</a>
        </div>

        <table class="table table-hover table-bordered w-100">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Senha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registro as $row): ?><!--foreach para percorrer o array de registros e exibir os dados em uma tabela HTML-->
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['senha']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
