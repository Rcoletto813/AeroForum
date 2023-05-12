<?php 
include '../php/conectar.php';

session_start();

$id_grupo = $_GET["IdGrupo"];
$id_user = $_SESSION["Id"];

$query = "INSERT INTO `usuariogrupo`(`Usuário_Id_User`, `Grupo_id_Grupo`) VALUES ('$id_user', $id_grupo)";
mysqli_query($conexao, $query);

$query = "UPDATE `grupo` SET `Membros`=`Membros`+1 WHERE `id_Grupo` = $id_grupo";
mysqli_query($conexao, $query);

header('Location: ../grupo/grupo.php?IdGrupo=' . $id_grupo . '&IdSubcanal=0');

?>