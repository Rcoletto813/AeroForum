<?php

include 'conectar.php';

$username = $_POST["username"];
$email = $_POST["email"];
$id = $_POST["uid"];

$query = "INSERT INTO usuário (Username, Email, Id_User) VALUES ('$username', '$email', '$id')";
if (mysqli_query($conexao, $query)) {
    echo "Usuário criado com sucesso";
} else {
    echo "Erro ao criar o usuário: " . mysqli_error($conexao);
}

?>