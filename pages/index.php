<?php

//Inicia a sessão para puxar os dados de outras páginas
session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="global.css" />
    <title>Página Inicial</title>
</head>

<body>
    <header>
        <nav>
            <!-- Menu futuramente -->
        </nav>
    </header>
    <main>
        <div class="bloco vidro liquido estrutura">

            <h1>Usuário</h1>
            <p>
                <strong>Nome:</strong> <?= htmlspecialchars($_SESSION['nome_usuario']) ?>
            </p>
            <p>
                <strong>Email:</strong> <?= htmlspecialchars($_SESSION['email_usuario']) ?>
            </p>

        </div>
    </main>

    <footer>

    </footer>
</body>

</html>