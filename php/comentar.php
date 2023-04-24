<?php 
include 'conectar.php';

session_start();

//obter a data do comentário
$date = new DateTime();
$date_str = $date->format('Y-m-d H:i:s'); //converter para o formato que o mysql aceita -> Ano-mês-dia hora-minuto-segundo

$comentario = $_POST["comentarioUser"]; //conteúdo do comentário
$idUser = $_SESSION["Id"]; //id do usuário que fez o comentário
$idPost = trim($_POST["postID"]); //id do post que está recebendo o comentário

$query = "INSERT INTO
comentario_post(Id_User, id_Post, Conteúdo, Data_Criação) VALUES 
('$idUser','$idPost','$comentario','$date_str')";

$resultado = mysqli_query($conexao, $query);

header('Location: ../post/post.php?id='. $idPost .'?sucesso=1');
?>