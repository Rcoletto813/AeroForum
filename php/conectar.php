<?php
//PARAMETROS CONEXAO NO BANCO DE DADOS
define('host', '127.0.0.1');
define('usuario', 'root');
define('senha', '');
define('bancoDados', 'AeroForum');

//CONEXAO NO BANCO
$conexao = mysqli_connect(host, usuario, senha, bancoDados);
if (!$conexao) { //verificar se a conexao foi feita com exito
    die("Erro ao se conectar no banco de dados --> usuarios: " . mysqli_connect_error());
}
?>