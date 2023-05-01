<?php

include 'conectar.php';

session_start();

$titulo = $_POST["tituloConfirma"];
$conteudo = $_POST["conteudoConfirma"];
$tags = $_POST["tagsConfirma"];
$resumo = $_POST["resumoConfirma"];
$idUser = $_SESSION["Id"];

publicarPost($titulo, $conteudo, $tags, $resumo, $idUser, $conexao);

function publicarPost($titulo, $conteudo, $tags, $resumo, $idUser, $conexao)
{
    //obter a data do post
    $date = new DateTime();
    $date_str = $date->format('Y-m-d H:i:s'); //converter para o formato que o mysql aceita -> Ano-mês-dia hora-minuto-segundo

    $query = "INSERT INTO `post`(`Id_User`, `Título`, `Conteúdo`, `Categoria`, `Avaliação`, `Resumo`, `Data_Criação`)
    VALUES ('$idUser','$titulo','$conteudo','$tags', 0,'$resumo','$date_str')";

    if (mysqli_query($conexao, $query)) {
        $query = "SELECT id_Post FROM `post` 
        ORDER BY id_Post DESC"; //id do post do usuário --> id mais recente

        $resultado = mysqli_query($conexao, $query);
        $primeira_linhaID = mysqli_fetch_array($resultado);
        $idPost = $primeira_linhaID[0];

        header('Location: ../post/post.php?id= ' . $idPost . '');
    }
}

?>