<?php

//Serve pra guardar informações do usuário
session_start();

//Chama a conexão com o banco de dados
require 'conexao.php';

$erro = "";

//Verificar se o formulario foi enviado pelo método POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //Cria váriaveis para os termos colocados nos campos
    $nome = trim($_POST['nome_usuario']);
    $email = trim($_POST['email_usuario']);
    $senha = $_POST['senha_usuario'];
    $confirmar_senha = $_POST['confirmar_senha'];

    //Verifica se algum campo ficou vazio
    if(empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)){

        $erro = "Preencha todos os campos.";

    //Ve se a senha e o confirmar senha tem a mesma coisa
    } elseif ($senha !== $confirmar_senha) {

        $erro = "Senhas são diferentes.";

    //Verifica se o email é possível de existir
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 

        $erro = "Insira um email válido.";

    //Verifica se o email tem a capacidade de receber mensagens, verificando se o DNS do domínio possui um registo MX
    } elseif (!checkdnsrr(substr(strrchr($email, "@"), 1), "MX")) {

        $erro = "O domínio deste email não pode receber emails.";

    } else {

        //Prepara uma ordem para o banco consultar o id por meio do email inserido
        $sql_verifica = "SELECT id FROM usuario WHERE email = ?";
        $stmt_verifica = $conexao->prepare($sql_verifica);

        //Pega o email inserido e executa a consulta
        $stmt_verifica->bind_param("s",  $email);
        $stmt_verifica->execute();

        //Pega os resultados
        $resultado = $stmt_verifica->get_result();

        //Ve se há um usuário com esse email
        if($resultado->num_rows > 0){

            $erro = "Este email já existe.";

        } else {

            //Criptografia via hash da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            //Comando para inserção dos dados no banco
            $sql = "INSERT INTO usuario
                    (nome, email, senha)
                    VALUES (?, ?, ?)";

            //Prepara ele para executar
            $stmt = $conexao->prepare($sql);

            //Insere as variáveis na ordem que ficarão no banco
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            //Se ele conseguir executar ele envia pro login
            if($stmt->execute()){

                header('Location: login.php');
                exit;

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
    <title>Página de Cadastro</title>
</head>

<body>
    <header>
        <nav>
            <!-- Menu futuramente -->
        </nav>
    </header>
    <main>
        <div class="bloco vidro liquido estrutura">
            <h1>Criar conta</h1>

            <p class="subtitulo">Preencha seus dados para começar.</p>

            <form method="POST">
                <input type="text" name="nome_usuario" placeholder="Nome" autocomplete="name"/>

                <input type="email" name="email_usuario" placeholder="Email" autocomplete="email"/>

                <input type="password" name="senha_usuario" placeholder="Senha" autocomplete="new-password"/>

                <input type="password" name="confirmar_senha" placeholder="Confirmar senha" autocomplete="new-password"/>

                <a href="login.php">Já tem uma conta?</a>

                <p class="erro">
                    <?= !empty($erro) ? htmlspecialchars($erro) : '' ?>
                </p>

                <input type="submit" value="Cadastrar" />
            </form>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>