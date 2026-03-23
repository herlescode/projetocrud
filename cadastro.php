<?php

session_start();

    require_once 'config.php';

    //inicializar as variaveis
    $erroNome = false;
    $erroSenha = false;
    $mensagem = "";

    //captura os dados do login
    if(count($_POST) >  0 ){
        $nomeDigitado = $_POST['nome'];
        $senhaDigitada = $_POST['password'];

        if(!filter_input(INPUT_POST, 'nome' )){//verifica se o campo nome foi preenchido
                $erroNome = true;
               // echo"campo nome é obrigatório <br>"; de
            }
            if(!filter_input(INPUT_POST, 'password' )){
                $erroSenha = true;
               // echo'campo senha é obrigatório <br>';
            }
            if(!$erroNome && !$erroSenha){
                $sql = "INSERT INTO usuarios (nome, senha) VALUES ('$nomeDigitado', '$senhaDigitada')";
                $resultado = $conn->query($sql);
                //var_dump($usuario);
                //exit();

                if($resultado === TRUE){
                    $mensagem = "<div class='alert alert-danger text-center py-4'>Cadastro realizado com sucesso! <br> <a href='login.php' class='alert-link'>Faça login</a></div>";
                } else {
                    $mensagem = "Erro ao cadastrar usuário: " . $conn->error;
                }
            }
    };
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

     <div class="d-flex justify-content-center align-items-center vh-100">

         <form action = "#" method="POST" class="container mt-5 col-md-4">
            <?= $mensagem ?>
            <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                <h3>Novo Cadastro</h3>
                <a href="login.php" class="btn btn-secondary">Sair / Voltar</a>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Nome</label>
                <input type="nome" name="nome" class="form-control <?= $erroNome ? 'is-invalid' : '' //deixa os campos vermelhos ?>" id="Inputnome" aria-describedby="nomeHelp" placeholder="nome">
                <div class="invalid-feedback">
                    <?= $erroNome ? 'Campo nome é obrigatório' : '' //inseri uma informação do campo invalidado ?>
                </div>
                </div>
                <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" name = "password" class="form-control <?= $erroSenha ? 'is-invalid' : '' ?>" id="InputPassword" placeholder="senha">
                    <div class="invalid-feedback">
                        <?= $erroSenha ? 'Campo senha é obrigatório' : '' ?>
                    </div>
                <div class="mb-3 form-check">
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-primary w-50 me-2">Cadastrar</button>
                    <a href="login.php" class="btn btn-secondary w-50">Voltar</a>
                </div>
            </form>
     </div>

</body>
</html>
