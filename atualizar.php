<?php
session_start();

require_once 'config.php';

// Se NÃO existe uma sessão (usuário não logou), chuta para o login
if (!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM usuarios WHERE id = ? ";
    $resultado = $conn->prepare($sql); //prepara a consulta SQL para evitar ataques de injeção de SQL
    $resultado->bind_param("i", $_GET['id']);
    $resultado->execute();
    $resultado = $resultado->get_result();
    $registro = $resultado->fetch_assoc();
} else {
    header("Location: consultar.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $novoNome = $_POST['nome'];
    $novaSenha = $_POST['senha'];

    $id_usuario = $_GET['id'];

    $sql = "UPDATE usuarios SET nome = ?, senha = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $novoNome, $novaSenha, $id_usuario);

    if($stmt->execute()) {
        header("Location: delete.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container mt-3 d-flex justify-content-center align-items-center vh-100">
        <form action="" method="POST">
            <input type="hidden" name="atualizar" value="<?php echo $registro['id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $registro['nome']; ?>">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="text" class="form-control" id="senha" name="senha" value="<?php echo $registro['senha']; ?>">
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="delete.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
