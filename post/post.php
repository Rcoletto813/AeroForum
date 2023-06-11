<?php

include '../php/paginaProtegida.php';
include '../php/conectar.php';

$idPost = $_GET["id"];

function comentario($conexao, $idPost)
{
    $query = "SELECT comentario_post.Conteúdo, usuário.Username
    FROM comentario_post 
    INNER JOIN usuário ON usuário.Id_User = comentario_post.Id_User
    INNER JOIN post ON post.id_Post = comentario_post.id_Post 
    WHERE post.id_Post = '$idPost'";

    $resultado = mysqli_query($conexao, $query);

    //$numLinhas = mysqli_num_rows($resultado);

    while ($row = mysqli_fetch_assoc($resultado)) {
        echo '
        <div class="comentario">
            <span>' . $row["Conteúdo"] . '</span>
            <a href="#">- ' . $row["Username"] . '</a>
        </div>';
    }

}

function checarAvaliacao($conexao, $idPost)
{ //ver se o usuário já avaliou o post alguma vez
    $idUser = $_SESSION['Id'];
    $query = "SELECT * FROM `avaliacao_post` WHERE Id_User = '$idUser' and Id_Post = '$idPost'";

    $resultado = mysqli_query($conexao, $query);
    if (mysqli_num_rows($resultado) > 0) { //o user já fez uma avaliação aqui
        $linha = mysqli_fetch_assoc($resultado);
        $nota = $linha["nota"]; //checar se a nota era +1 ou -1

        if ($nota == 1) {
            echo "
            <script>
                const notaHTML = document.getElementById('notaUser');
                const avaliaPositivo = document.getElementById('avalia1');
                avaliaPositivo.style.fill = '#fa9214';
                notaHTML.textContent = 1;
            </script>";
        }
        if ($nota == -1) {
            echo "
            <script> 
                const notaHTML = document.getElementById('notaUser');
                const avaliaNegativo = document.getElementById('avalia-1');
                avaliaNegativo.style.fill = '#fa9214';
                notaHTML.textContent = -1;
            </script>";
        }
    }
}

function listarCategorias($conexao, $idPost)
{
    $query = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(post.Categoria, '#', n.digit+1), '#', -1) as categoria
    FROM post
    INNER JOIN
    (
        SELECT 0 digit UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 
        UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 
        UNION ALL SELECT 8 UNION ALL SELECT 9
    ) n
    ON LENGTH(post.Categoria) - LENGTH(REPLACE(post.Categoria, '#', '')) >= n.digit
    WHERE post.id_Post = '$idPost';"; // selecionar cada uma das categorias do post. Retorna tudo numa coluna nomeada categoria

    $resultado = mysqli_query($conexao, $query);

    while ($linha = mysqli_fetch_assoc($resultado)) {
        $categorias = explode("#", $linha["categoria"]);
        foreach ($categorias as $categoria) {
            if (!empty($categoria)) {
                echo '<a href="#">#' . $categoria . '</a>';
            }
        }
    }

}

$query = "SELECT usuário.Username, usuário.Patente, post.Título, post.Conteúdo
FROM post
INNER JOIN usuário ON post.Id_User = usuário.Id_User
WHERE post.id_Post = '$idPost'";

$resultado = mysqli_query($conexao, $query);
$valores = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="post.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <title>
        <?php echo $valores["Título"]; ?>
    </title>
</head>

<body>
    <header>
        <h1>AeroForum</h1>
    </header>
    <nav style="--bs-breadcrumb-divider: '>'; display: flex; text-align: center; justify-content: space-around;"
        aria-label="breadcrumb">
        <ol class="breadcrumb" style="--bs-breadcrumb-margin-bottom: unset;">
            <li class="breadcrumb-item"><a href="../main/main.php">Retornar para página principal</a></li>
            <li class="breadcrumb-item">Leitura</li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $valores["Título"]; ?>
            </li>
        </ol>
        <div class="usuario">
            <img src="../imagens/imgPerfilDefault.svg" alt="imagem de perfil" id="perfilImgagem" width="3%"  style="opacity: 0;">
            <span>
                <a href="#">
                    <?php echo $_SESSION["Username"]; ?>
                </a>
            </span>
        </div>
    </nav>
    <div id="liveAlertPlaceholder"></div>
    <main>
        <section class="post">
            <h2>
                <?php echo $valores["Título"]; ?>
            </h2>
            <?php echo $valores["Conteúdo"] ?>
        </section>
        <section class="infos">
            <h2>Detalhes da postagem</h2>
            <hr>
            <div class="infoUser">
                <span>Autor: <a href="#">
                        <?php echo $valores["Username"] ?>
                    </a></span> <br>
                <span>Patente: <a href="#">
                        <?php echo $valores["Patente"] ?>
                    </a></span> <br>
            </div>
            <hr>
            <div class="tags">
                <div class="input-group form__input-group">
                    <div class="input-group-text">Tags</div>
                    <span>
                        <?php listarCategorias($conexao, $idPost) ?>
                    </span>
                </div>
            </div>
            <div class="avaliar">
                <button class="avaliacaoBtn" id="avalia1" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip"
                    data-bs-title="Se este post foi útil, isto é, foi informativo, adequado e coerente avalie esse post positivamente"
                    onclick="avalia(1)">
                    <svg aria-hidden="true" class="svg-icon iconArrowUpLg" width="45" height="45" viewBox="0 0 36 36">
                        <path d="M2 25h32L18 9 2 25Z"></path>
                    </svg>
                </button>
                <span id="notaUser">0</span>
                <button class="avaliacaoBtn" id="avalia-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-custom-class="custom-tooltip"
                    data-bs-title="Se este post não foi útil ou apresenta conteúdo inapropriado ou falso avalie esse post negativamente"
                    onclick="avalia(-1)">
                    <svg aria-hidden="true" class="svg-icon iconArrowDownLg" width="45" height="45" viewBox="0 0 36 36">
                        <path d="M2 11h32L18 27 2 11Z"></path>
                    </svg>
                </button>
                <!--fa-shake-->
                <button class="toast btn popup btn-comentario" role="alert" aria-live="assertive" aria-atomic="true"
                    style="display: block; bottom: 0; position: fixed; left: 0; width: 10rem; height: 3rem; background-color: #81e5e5;">
                    <a href="#coments" data-bs-toggle="offcanvas" aria-controls="offcanvasExample"
                        style="color: black;">Acessar comentários</a>
                </button>
            </div>
            <a href="../main/main.php"><button type="button" class="btn btn-primary">Voltar para a página
                    principal</button></a>
        </section>
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="coments" aria-labelledby="offcanvasBottomLabel"
            style="height: 75%;">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title" id="offcanvasBottomLabel">Comentários</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small comentariosCampos">
                <?php comentario($conexao, $idPost); ?>
                <div class="publiComent">
                    <form action="../php/comentar.php" method="post">
                        <div class="input-group form__input-group">
                            <div class="input-group-text">Fazer um comentário</div>
                            <input type="text" class="form-control form__input" placeholder="Comentário" required
                                name="comentarioUser" style="background-color: white;" autocomplete="off">
                            <div class="input-group-text">
                                <button style="background-color: unset; border: none;">Publicar</button>
                            </div>
                        </div>
                        <?php echo '<input type="hidden" value="' . $idPost . '" name="postID">' ?>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="sobre">
            <h4>Sobre nós</h4>
            <p>AeroForum é uma comunidade online para entusiastas da aviação compartilharem suas experiências e
                conhecimentos.</p>
        </div>
        <div class="contato">
            <h4>Contato</h4>
            <ul>
                <li>contato@aeroforum.com</li>
                <li>(11) 1234-5678</li>
                <li>Rua alguma coisa, 123, São Paulo, SP</li>
            </ul>
        </div>
    </footer>
    <div class="direitos">
        <p>&copy; 2023 AeroForum. Todos os direitos reservados.</p>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="post.js"></script>r
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
    //console.log(alertPlaceholder)

    const alert = (msg) => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = [
            `<div class="alert alert-success alert-dismissible" role="alert">`,
            `   <div>${msg}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('');
        alertPlaceholder.append(wrapper);
    }
    if (window.location.search.includes('sucesso=1')) { //comentário feito com sucesso
        alert("Seu comentário foi publicado com sucesso!");
    }
    if (window.location.search.includes("sucesso=2")) { //post publicado com sucesso
        alert("Seu post foi publicado com sucesso!");
    }
</script>

</html>

<?php

//ver se o usuário já avaliou o post alguma vez
$idUser = $_SESSION['Id'];
$query = "SELECT * FROM `avaliacao_post` WHERE Id_User = '$idUser' and Id_Post = '$idPost'";

$resultado = mysqli_query($conexao, $query);
if (mysqli_num_rows($resultado) > 0) { //o user já fez uma avaliação aqui
    $linha = mysqli_fetch_assoc($resultado);
    $nota = $linha["nota"]; //checar se a nota era +1 ou -1

    if ($nota == 1) {
        echo "
        <script>
            const notaHTML = document.getElementById('notaUser');
            const avaliaPositivo = document.getElementById('avalia1');
            avaliaPositivo.style.fill = '#fa9214';
            notaHTML.textContent = 1;
        </script>";
    }
    if ($nota == -1) {
        echo "
        <script> 
            const notaHTML = document.getElementById('notaUser');
            const avaliaNegativo = document.getElementById('avalia-1');
            avaliaNegativo.style.fill = '#fa9214';
            notaHTML.textContent = -1;
        </script>";
    }
}

?>