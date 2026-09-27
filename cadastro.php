<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="global.css" />
    <title>Cadastro</title>
</head>

<body>
    <header>
        <nav>
            <!-- Menu futuramente -->
        </nav>
    </header>
    <main>
        <div class="cadastro bloco vidro liquido">
            <h1>Criar conta</h1>

            <p class="subtitulo">Preencha seus dados para começar.</p>

            <form method="POST">
                <input type="text" name="nome_usuario" placeholder="Nome" autocomplete="name"/>

                <input type="email" name="email_usuario" placeholder="Email" autocomplete="email"/>

                <input type="password" name="senha_usuario" placeholder="Senha" autocomplete="new-password"/>

                <input type="password" name="confirmar_senha" placeholder="Confirmar senha" autocomplete="new-password"/>

                <?php if(!empty($erro)): ?>
                    <p class="erro">
                        <?= htmlspecialchars($erro) ?>
                    </p>
                <?php endif; ?>

                <input type="submit" value="Cadastrar" />
            </form>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>