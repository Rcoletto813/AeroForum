<?php

include 'conectar.php';

session_start();

$idUser = $_GET["uid"]; //id do usuário autenticado
$query = "SELECT * FROM usuário WHERE Id_User = '$idUser'";

$resultado = mysqli_query($conexao, $query);
$info_user = array(); //salvar todos os dados do usuário num dicionário

while ($linha = mysqli_fetch_object($resultado)) {
    $info_user[] = $linha;
}

$_SESSION["Username"] = $info_user[0]->Username;
$_SESSION["Id"] = $info_user[0]->Id_User;

header("Location: ../main/main.php");

?>