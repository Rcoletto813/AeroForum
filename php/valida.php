<?php

include 'conectar.php';
$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "SELECT * FROM usuario WHERE email='$email'";
$resultado = mysqli_query($conexao, $query);

if (mysqli_num_rows($resultado) == 0) { //usuario nem possui cadastro
    header('Location: loginInterface.php?erro=1');
}

$usuario = mysqli_fetch_assoc($resultado);

if(!password_verify($senha, $user["senha"])) {
    echo "Senha incorreta";
    exit();
}

//autenticar o usuario caso esteja tudo correto
session_start();
$_SESSION["nome_usuario"] = $user["username"];
header('Location: inicioForum.php');
?>