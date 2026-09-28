<div align="center">

# 🔐 Sistema de Cadastro e Login

Sistema simples de **cadastro, login e área do usuário** feito em PHP + MySQL, com interface em estilo *liquid glass* (vidro translúcido sobre gradiente animado).

</div>

---

## 📋 Sumário

- [Funcionalidades](#-funcionalidades)
- [Tecnologias](#-tecnologias)
- [Estrutura do projeto](#-estrutura-do-projeto)
- [Banco de dados](#-banco-de-dados)
- [Instalação local](#-instalação-local)
- [Hospedagem](#-hospedagem)
- [Segurança](#-segurança)
- [Melhorias futuras](#-melhorias-futuras)

---

## ✨ Funcionalidades

- **Cadastro** com validação de campos vazios, confirmação de senha, formato de e-mail e verificação de registro MX do domínio.
- **Verificação de e-mail duplicado** antes de inserir no banco.
- **Login** com verificação de senha via `password_verify`.
- **Sessão de usuário** (`id`, `nome` e `email`) guardada em `$_SESSION`.
- **Página inicial** exibindo os dados do usuário logado.
- **Layout responsivo** com efeito de vidro, gradiente animado e suporte a `prefers-reduced-motion`.

## 🛠️ Tecnologias

| Camada    | Tecnologia                                |
|-----------|-------------------------------------------|
| Back-end  | PHP 8+ (MySQLi com *prepared statements*) |
| Banco     | MySQL / MariaDB                           |
| Front-end | HTML5 + CSS3 (sem frameworks)             |
| Ícones    | Font Awesome 7 (CDN)                      |

## 📁 Estrutura do projeto

```
📦 projeto/
├── conexao.php    # Conexão com o banco (MySQLi, utf8mb4)
├── cadastro.php   # Formulário e lógica de cadastro
├── login.php      # Formulário e lógica de login
├── index.php      # Página inicial (dados do usuário)
└── global.css     # Estilos globais (liquid glass)
```

## 🗄️ Banco de dados

Crie o banco `sistema_cadastro` e a tabela `usuario`:

```sql
CREATE DATABASE IF NOT EXISTS sistema_cadastro
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE sistema_cadastro;

CREATE TABLE usuario (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    nome  VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL  -- guarda o hash gerado por password_hash()
);
```

## 🚀 Instalação local

1. Instale o [XAMPP](https://www.apachefriends.org/) (ou WAMP/Laragon).
2. Copie os arquivos do projeto para a pasta `htdocs` (XAMPP).
3. Inicie o **Apache** e o **MySQL**.
4. Importe o SQL acima pelo phpMyAdmin (`http://localhost/phpmyadmin`).
5. Confira as credenciais em `conexao.php`:

   ```php
   $servidor = 'localhost';
   $usuario  = 'root';
   $senha    = '';
   $banco    = 'sistema_cadastro';
   ```
6. Acesse `http://localhost/NOME-DA-PASTA/cadastro.php`.

## 🌍 Hospedagem

| Item              | Informação                          |
|-------------------|-------------------------------------|
| Provedor          | _preencher_                         |
| URL do site       | _preencher_                         |
| Versão do PHP     | _preencher_                         |
| Banco de dados    | _preencher (host, nome do banco)_   |

> ⚠️ Em produção, **não use** `root` sem senha. Crie um usuário do MySQL exclusivo para o projeto e atualize o `conexao.php` com as credenciais fornecidas pela hospedagem.

## 🔒 Segurança

- Senhas armazenadas com `password_hash()` (nunca em texto puro).
- Consultas com *prepared statements* (proteção contra SQL Injection).
- Saída escapada com `htmlspecialchars()` (proteção contra XSS).

## 🧭 Melhorias futuras

- [ ] Proteger o `index.php`: redirecionar para o login se não houver sessão ativa.
- [ ] Botão de **logout** (`session_destroy()`).
- [ ] Chamar `session_regenerate_id(true)` após o login.
- [ ] Trocar `autocomplete="new-password"` por `current-password` no formulário de login.
- [ ] Recuperação de senha por e-mail.
- [ ] Menu de navegação (já há `<nav>` reservado nas páginas).
- [ ] Mover as credenciais do banco para variáveis de ambiente.

---

<div align="center">

Feito com 💙 em PHP

</div>