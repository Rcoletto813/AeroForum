<?php 
include '../php/conectar.php';

session_start();

$id_grupo = $_GET["IdGrupo"];
$id_user = $_SESSION["Id"];

$query = "DELETE FROM `usuariogrupo` WHERE `Usuário_Id_User` = '$id_user' AND `Grupo_id_Grupo` = $id_grupo";
mysqli_query($conexao, $query);

$query = "UPDATE `grupo` SET `Membros`=`Membros`-1 WHERE `id_Grupo` = $id_grupo";
mysqli_query($conexao, $query);

header('Location: ../main/main.php');
?>