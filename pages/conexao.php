<?php

//Variáveis de conexão com o banco
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'sistema_cadastro';

//Varivel que se conecta com o banco.
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

//Se houver um erro ele vai avisar que deu uma falha na conexao e informar qual foi ela
if($conexao->connect_error){
    die("Falha na conexão: ". $conexao->connect_error);
}

//Permite caracteres diferentes
$conexao->set_charset('utf8mb4');

?>