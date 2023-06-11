<?php

include '../php/paginaProtegida.php';
include '../php/conectar.php';

$pesquisa = $_GET["pesquisa"];

function posts($conexao, $pesquisa)
{
    $query = "SELECT * FROM post WHERE Categoria LIKE '%$pesquisa%' OR Título LIKE '%$pesquisa%'";
    $resultado = mysqli_query($conexao, $query);

    if (mysqli_fetch_assoc($resultado) > 1) {
        $query = "SELECT post.Título, post.Resumo, post.Avaliação, post.id_Post, usuário.Username
        FROM post 
        INNER JOIN usuário ON usuário.Id_User = post.Id_User WHERE post.Título LIKE '%$pesquisa%' OR post.Categoria LIKE '%$pesquisa%'
        ORDER BY post.Avaliação DESC";

        $resultado = mysqli_query($conexao, $query);

        while ($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo '
            <section class="post section">
                <h2 id="tituloPost">' . $linha["Título"] . '</h2>
                <p id="descricaoPost">' . $linha["Resumo"] . '</p>
                <div class="info">
                    <div class="container">
                        <a href="../post/post.php?id= ' . $linha["id_Post"] . '"><button type="button" class="btn btn-outline-info">Acessar</button></a>
                        <div class="avaliacao">';
            for ($aval = 0; $aval < $linha["Avaliação"]; $aval++) {
                echo '<span class="fa fa-star checked"></span>';
            }
            for ($avalRestante = 0; $avalRestante < 5 - $aval; $avalRestante++) {
                echo '<span class="fa fa-star"></span>';
            }
            echo '
                    </div>
                </div>
                <div class="autor">
                    <a href="#">Autor: ' . $linha["Username"] . '</a>
                </div>
                </div>
            </section>';
        }
    } else {
        echo "<code style='font-size: 1.5rem;'>Vixi... Não encontramos nada</code>";
    }
}

function grupos($conexao, $pesquisa)
{
    $query = "SELECT * FROM grupo WHERE Categoria LIKE '%$pesquisa%' OR Nome LIKE '%$pesquisa%' OR Descrição LIKE '%$pesquisa%'";
    $resultado = mysqli_query($conexao, $query);

    if (mysqli_fetch_assoc($resultado) > 1) {
        $query = "SELECT Nome, Categoria, Membros, Foto, id_Grupo FROM grupo
        WHERE Categoria LIKE '%$pesquisa%' OR Nome LIKE '%$pesquisa%' OR Descrição LIKE '%$pesquisa%' 
        ORDER BY Membros DESC";

        $resultado = mysqli_query($conexao, $query);

        while ($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo '
        <section class="grupo section">
            <div class="detalhesGrupo">
                <div class="esquerda">
                    <img src="' . $linha["Foto"] . '" alt="imagem grupo" width="100" height="100">
                </div>
                <div class="central">
                    <div class="infoGrupo">
                        <h2 id="tituloGrupo">' . $linha["Nome"] . '</h2>
                        <p id="marcadoresGrupo">' . $linha["Categoria"] . '</p>
                        <span class="participantes">Membros: ' . $linha["Membros"] . '</span>
                    </div>
                </div>
                <div class="direita">
                    <a href="../php/adicionarMembro.php?IdGrupo=' . $linha["id_Grupo"] . '"><button type="button" class="btn btn-success entrar">Participar desse grupo</button></a>
                </div>
            </div>
        </section>';
        }
    } else {
        echo "<code style='font-size: 1.5rem;'>Vixi... Não encontramos nada</code>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="pesquisa.css">
    <title>Pesquisa - <?php echo $pesquisa ?></title>
</head>

<body>
    <header>
        <h1>AeroForum</h1>
    </header>
    <nav style="--bs-breadcrumb-divider: '>'; display: flex; text-align: center; justify-content: space-around;"
        aria-label="breadcrumb">
        <ol class="breadcrumb" style="--bs-breadcrumb-margin-bottom: unset;">
            <li class="breadcrumb-item"><a href="../main/main.php">Retornar para página principal</a></li>
            <li class="breadcrumb-item">Pesquisa</li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $pesquisa ?>
            </li>
        </ol>
        <div class="usuario">
            <img src="../imagens/imgPerfilDefault.svg" alt="imagem de perfil" id="perfilImgagem" width="3%"  style="opacity: 0;">
            <span>
                <a href="#">
                    <?php echo $_SESSION["Username"] ?>
                </a>
            </span>
        </div>
    </nav>
    <main>
        <div class="posts">
            <h2>Posts relacionados a sua pesquisa</h2>
            <?php posts($conexao, $pesquisa) ?>
        </div>
        <div class="grupos">
            <h2>Grupos relacionados a sua pesquisa</h2>
            <?php grupos($conexao, $pesquisa) ?>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</html>