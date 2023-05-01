<?php
include 'conectar.php';

session_start();

$userId = $_SESSION["Id"];
//$userId = $_POST["Username"];
$nota = $_POST["nota"];
$postId = $_POST["post"];
$action = $_POST["action"]; //indicar se é para inserir ou deletar na tabela de avaliacao

if ($action == "true") { //inserir na tabela
    //checar se o user já avaliou uma vez
    $query = "SELECT * FROM `avaliacao_post` WHERE Id_User = '$userId' AND Id_Post = '$postId'";
    $resultado = mysqli_query($conexao, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $linha = mysqli_fetch_assoc($resultado);
        $nota = $linha["nota"]; //checar se a nota era +1 ou -1

        if ($nota == 1) {
            $query = "UPDATE `avaliacao_post` SET `nota`= -1 WHERE Id_User = '$userId' AND Id_Post = '$postId'";
            mysqli_query($conexao, $query);

            calculaNovaNota($postId, $conexao);
        } else {
            $query = "UPDATE `avaliacao_post` SET `nota`= 1 WHERE Id_User = '$userId' AND Id_Post = '$postId'";
            mysqli_query($conexao, $query);
            calculaNovaNota($postId, $conexao);
        }

    } else { //primeira vez avaliando
        $query = "INSERT INTO avaliacao_post (Id_Post, Id_User, nota) VALUES ($postId,'$userId', $nota)";
        mysqli_query($conexao, $query);

        calculaNovaNota($postId, $conexao);
    }

} else { //deletar na tabela
    $query = "DELETE FROM avaliacao_post WHERE Id_User = '$userId' AND Id_Post = '$postId'";
    mysqli_query($conexao, $query);

    calculaNovaNota($postId, $conexao);
}

function calculaNovaNota($postId, $conexao)
{
    /*nota de um post (de 1 a 5) -->
    incremento = 5 / quantidadeAvaliacoes
    nota = incremento * somaPositivas
    */

    $query = "SELECT COUNT(Id_Post)
    FROM avaliacao_post
    WHERE Id_Post = $postId"; //contar quantas avaliacoes o post tem

    $resultado = mysqli_query($conexao, $query);
    $linha = mysqli_fetch_row($resultado);
    $quantidadeAvaliacoes = $linha[0];

    $query = "SELECT SUM(nota)
    FROM avaliacao_post
    WHERE nota = 1 AND Id_Post = $postId"; //somar todas as avaliacoes positivas

    $resultado = mysqli_query($conexao, $query);
    $linha = mysqli_fetch_row($resultado);
    $somaPositivas = $linha[0];

    if ($quantidadeAvaliacoes == 0) { //significa que o post não possui nenhuma avaliação (as avaliações foram retiradas)
        $query = "UPDATE `post` SET `Avaliação`= 0 WHERE id_Post = $postId"; //adicionar a nota do post
        mysqli_query($conexao, $query);
    } else {

        $incremento = 5 / floatval($quantidadeAvaliacoes);
        $nota = floatval($incremento) * floatval($somaPositivas);

        if (round($nota) == 0) { //se todas as avaliações forem negativas
            $nota = 1;
        }
        $query = "UPDATE `post` SET `Avaliação`= round($nota) WHERE id_Post = $postId"; //adicionar a nota do post
        mysqli_query($conexao, $query);
    }
}

?>