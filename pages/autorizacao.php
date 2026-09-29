<?php

//Inicia a sessão para puxar os dados das outras páginas
session_start();

//Pega o arquivo da conexao com o banco de dados
require 'conexao.php';

//Se não existir um id_usuario na sessão ele entende que ainda não foi logado e manda pro login
if(!isset($_SESSION['id_usuario'])) {

    header('Location: login.php');
    exit;

}

//Se existir ele transforma o id_usuario em uma varivel
$id = $_SESSION['id_usuario'];

//Prepara um comando para o banco de dados onde busca o id e o nome da tabela usuario pelo id informado
$stmt = $conexao->prepare("SELECT id FROM usuario WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

//Com o resultado da pesquisa ele faz uma variavel
$resultado = $stmt->get_result();

//Joga todos os dados daquele id em uma array e transforma em uma variavel
$usuario = $resultado->fetch_assoc();

//Se o usuário nçao existir é porque ele foi removido
if(!$usuario) {

    //Limpa e destroi a sessão, fazendo o usuário voltar pra página de cadastro
    session_unset();
    session_destroy();

    header("Location: cadastro.php");
    exit;

}

?>