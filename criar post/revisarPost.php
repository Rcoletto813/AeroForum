<?php
include '../php/paginaProtegida.php';

$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];
$tags = $_POST["tags"];
$resumo = $_POST["resumo"];

$conteudo = str_replace("'", "\"", $conteudo);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="revisarPost.css">
    <title>Revise seu post</title>
</head>

<body>
    <header>
        <h1>AeroForum</h1>
    </header>
    <nav style="--bs-breadcrumb-divider: '>'; display: flex; text-align: center; justify-content: space-around;"
        aria-label="breadcrumb">
        <ol class="breadcrumb" style="--bs-breadcrumb-margin-bottom: unset;">
            <li class="breadcrumb-item">Criação</li>
            <li class="breadcrumb-item active" aria-current="page">
                Revisar post
            </li>
        </ol>
        <div class="usuario">
            <img src="../imagens/imgPerfilDefault.svg" alt="imagem de perfil" id="perfilImgagem" width="3%">
            <span>
                <a href="#">
                    <?php echo $_SESSION["Username"] ?>
                </a>
            </span>
        </div>
    </nav>
    <main>
        <h2>Seu post ficará assim após a sua publicação:</h2>
        <h3>Título: <code><?php echo $titulo; ?></code></h3>
        <div class="postCompleto">
            <?php echo $conteudo; ?>
        </div>
        <div class="tags">
            <h5>Tags: <code><?php echo $tags; ?></code></h5>
        </div>
        <div class="resumo">
            <h5>Resumo: </h5>
            <div class="postCompleto">
                <?php echo $resumo; ?>
            </div>
        </div>
        <div class="btnsAcao">
            <form action="../php/publicarPost.php" method="post">
                <button type="submit" class="btn btn-success">Está tudo ótimo! Publicar</button>
                <input type="hidden" value="<?php echo $titulo ?>" name="tituloConfirma">
                <input type="hidden" value='<?php echo $conteudo ?>' name="conteudoConfirma">
                <input type="hidden" value="<?php echo $tags ?>" name="tagsConfirma">
                <input type="hidden" value="<?php echo $resumo ?>" name="resumoConfirma">
            </from>
                <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Voltar para a
                        edição</button></a>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</html>