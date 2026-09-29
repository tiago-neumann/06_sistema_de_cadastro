<?php

//Serve pra guardar informações do usuário
session_start();

//Chama a conexão com o banco de dados
require 'conexao.php';

$erro = "";

//Verificar se o formulario foi enviado pelo método POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //Cria váriaveis para os termos colocados nos campos
    $email = trim($_POST['email_usuario']);
    $senha = $_POST['senha_usuario'];

    //Verifica se algum campo ficou vazio
    if(empty($email) || empty($senha)){

        $erro = "Preencha todos os campos.";

    } else {

        //Cria o comando sql para pedir um email
        $sql = "SELECT * FROM usuario WHERE email = ? LIMIT 1";

        //Prepara o comando
        $stmt = $conexao->prepare($sql);

        //Altera a variável no código pelo email digitado e executa o comando em busca desse email
        $stmt->bind_param("s", $email);
        $stmt->execute();

        //Pega o resultado dess busca e transforma em variavel
        $resultado = $stmt->get_result();

        //Pega todos os dados do usuário e transforma em uma array
        $usuario = $resultado->fetch_assoc();

        //Verifica se o usuário existe
        if(!$usuario) {

            $erro = "Usuário ou senhas incorretas.";

        } else {

            //Pega a senha digitada e a guardada no banco e compara as duas
            if(password_verify($senha, $usuario['senha'])){

                //Adiciona os dados no session a fim de utilizar futuramente
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['email_usuario'] = $usuario['email'];
                $_SESSION['nome_usuario'] = $usuario['nome'];

                //Manda para a pagina inicial.php
                header("Location: inicial.php");
                exit;

            } else {

                $erro = "Usuário ou senha incorretas.";

            }

        }
    
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="global.css" />
    <title>Página de Login</title>
</head>

<body>
    <header>
        <nav>
            <!-- Menu futuramente -->
        </nav>
    </header>
    <main>
        <div class="bloco vidro liquido estrutura">
            <h1>Entrar</h1>

            <p class="subtitulo">Preencha seus dados para começar.</p>

            <form method="POST">

                <input type="email" name="email_usuario" placeholder="Email" autocomplete="email"/>

                <input type="password" name="senha_usuario" placeholder="Senha" autocomplete="new-password"/>

                <a href="cadastro.php">Criar conta?</a>

                <p class="erro">
                    <?= !empty($erro) ? htmlspecialchars($erro) : '' ?>
                </p>

                <input type="submit" value="Logar" />
            </form>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>