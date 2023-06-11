<?php
include '../php/conectar.php';

session_start();

$id_grupo = $_GET["IdGrupo"];
$id_user = $_SESSION["Id"];

$query = "SELECT `Usuário_Id_User`, `Grupo_id_Grupo` FROM
`usuariogrupo` WHERE `Usuário_Id_User` = '$id_user' AND `Grupo_id_Grupo` = $id_grupo"; //verificar se o usuário ja faz parte do grupo

$resultado = mysqli_query($conexao, $query);
if (mysqli_fetch_assoc($resultado) > 1) { //já fa parte
    header('Location: ../grupo/grupo.php?IdGrupo=' . $id_grupo . '&IdSubcanal=0');
} else {
    $query = "INSERT INTO `usuariogrupo`(`Usuário_Id_User`, `Grupo_id_Grupo`) VALUES ('$id_user', $id_grupo)";
    mysqli_query($conexao, $query);

    $query = "UPDATE `grupo` SET `Membros`=`Membros`+1 WHERE `id_Grupo` = $id_grupo";
    mysqli_query($conexao, $query);

    header('Location: ../grupo/grupo.php?IdGrupo=' . $id_grupo . '&IdSubcanal=0');
}
?>