<?php

include '../php/conectar.php';
include '../php/paginaProtegida.php';

/**
 * Obtém todos os grupos que o usuário faz parte
 * @param mixed $id_user id do usuário
 * @param mixed $conexao a conexão com o banco de dados
 */
function listaGrupo($id_user, $conexao)
{
    $query = "SELECT grupo.Nome, grupo.Descrição, grupo.Categoria, grupo.id_Grupo
        FROM grupo INNER JOIN usuariogrupo ON grupo.id_Grupo = usuariogrupo.Grupo_id_Grupo 
        INNER JOIN usuário ON usuário.Id_User = usuariogrupo.Usuário_Id_User
        WHERE usuário.Id_User = '$id_user'";

    $resultado = mysqli_query($conexao, $query);
    while ($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        echo '
            <div class="card-grupo">
                <h2>' . $linha["Nome"] . '</h2>
                <a href="../grupo/grupo.php?IdGrupo=' . $linha["id_Grupo"] . '&IdSubcanal=0"><button class="btn btn-success" >Dar uma olhada</button></a>
            </div>';
    }
}

/**
 * Listar os grupos
 * @param mixed $conexao a conexão com o banco de dados
 */
function grupos($conexao)
{
    $query = "SELECT Nome, Categoria, Membros, Foto, id_Grupo FROM grupo ORDER BY Membros DESC LIMIT 3";

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
}

function posts($conexao)
{
    $query = "SELECT post.Título, post.Resumo, post.Avaliação, post.id_Post, usuário.Username
    FROM post 
    INNER JOIN usuário ON usuário.Id_User = post.Id_User 
    ORDER BY post.id_Post DESC
    LIMIT 2";

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
}

function notificação($conexao) //trabalhar com as notificações do usuário
{
    $query = "SELECT notificação.conteúdo FROM notificação WHERE id_user = '" . $_SESSION["Id"] . "'
    ORDER BY notificação.data DESC";
    $resultado = mysqli_query($conexao, $query);
    /*try {
        $resultado = mysqli_query($conexao, $query);
    } catch (Exception $e) //o usuário não possui nenhuma notificação
    {
        $num_notifica = 0;
        echo '
        <div class="dropdown">
            <button type="button" class="btn btn-primary position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Caixa de entrada
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                ' . $num_notifica . '
                <span class="visually-hidden">Mensagens não lidas</span>
            </span>
            </button>
            <ul class="dropdown-menu" style="padding: 8px;">
                <li><a class="dropdown-item" href="#"><code>Tudo certo por aqui</code></a></li>
            </ul>
        </div>
        ';
        return;
    }*/

    //número de notifições:
    $num_notifica = mysqli_num_rows($resultado);

    if ($num_notifica == 0) {
        echo '
        <div class="dropdown">
            <button type="button" class="btn btn-primary position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Caixa de entrada
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                ' . $num_notifica . '
                <span class="visually-hidden">Mensagens não lidas</span>
            </span>
            </button>
            <ul class="dropdown-menu" style="padding: 8px;">
                <li><a class="dropdown-item" href="#"><code>Nenhuma notificação até o momento</code></a></li>
            </ul>
        </div>
        ';
    } else {
        echo '
        <div class="dropdown">
            <button type="button" class="btn btn-primary position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Caixa de entrada
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ' . $num_notifica . '
                    <span class="visually-hidden">Mensagens não lidas</span>
                </span>
            </button>
            <ul class="dropdown-menu">';
        while ($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo ''. $linha["conteúdo"] . '';
        }
        echo '</ul></div>';
        //<li><a class="dropdown-item" href="#">conteúdo notificação</a></li>
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
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <h1>AeroForum</h1>
    </header>
    <nav class="menu">
        <ul>
            <li><a href="#" class="linkPrincipal">Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color:#0d6efd;">
                    Categorias
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="../pesquisa/pesquisa.php?pesquisa=foguete">Foguetes</a></li>
                    <li><a class="dropdown-item" href="../pesquisa/pesquisa.php?pesquisa=satélite">Satélites</a></li>
                    <li><a class="dropdown-item" href="../pesquisa/pesquisa.php?pesquisa=avião">Aviões</a></li>
                    <li><a class="dropdown-item" href="../pesquisa/pesquisa.php?pesquisa=helicópteros">Helicópteros</a>
                    </li>
                    <li><a class="dropdown-item"
                            href="../pesquisa/pesquisa.php?pesquisa=aeromodelismo">Aeromodelismo</a></li>
                    <li><a class="dropdown-item"
                            href="../pesquisa/pesquisa.php?pesquisa=foguetemodelismo">Foguetemodelismo</a></li>
                    <li><a class="dropdown-item" href="../pesquisa/pesquisa.php?pesquisa=programação">Programação</a>
                    </li>
                </ul>
            </li>
            <!--<li><a href="#" class="linkPrincipal">Perfil</a></li>-->
            <li><a href="../php/logout.php" class="linkPrincipal">Sair</a></li>
        </ul>
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <form class="d-flex" role="search" method="get" action="../pesquisa/pesquisa.php">
                    <input class="form-control me-2" type="search" placeholder="Buscar algum conteúdo"
                        aria-label="Search" name="pesquisa">
                    <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
                </form>
            </div>
        </nav>
    </nav>
    <div class="conteudoPerfil">
        <div class="user">
            <a href="../criar post/criarPost.php"><button type="button" class="btn btn-info" style="width: 8rem;">Fazer
                    um post</button></a>
            <span>|</span>
            <a href="../criar grupo/criarGrupo.php"><button type="button" class="btn btn-info"
                    style="width: 10rem;">Criar um grupo</button></a>
            <div class="usuario">
                <img src="../imagens/imgPerfilDefault.svg" alt="imagem de perfil" id="perfilImgagem" style="opacity: 0;">
                <span>
                    <a href="#">
                        <?php echo $_SESSION["Username"] ?>
                    </a>
                </span>

                <div class="linhaVertical">|</div>

                <?php echo notificação($conexao); ?>

                <!--<div class="dropdown">
                    <button type="button" class="btn btn-primary position-relative dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Caixa de entrada
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
    <main>
        <div class="principal">
            <div class="posts" id="posts">
                <h1>Últimos posts</h1>
                <?php posts($conexao) ?>
            </div>
            <div class="grupos" id="grupos">
                <h1>Grupos favoritos da comunidade</h1>
                <?php grupos($conexao) ?>
            </div>
        </div>
        <button class="toast btn btn-success popup" role="alert" aria-live="assertive" aria-atomic="true"
            style="display: block; bottom: 0; position: fixed;"><a href="#gruposConexoes" data-bs-toggle="offcanvas"
                aria-controls="offcanvasExample">Ver meus grupos e conexões</a></button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="gruposConexoes"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Meus grupos e conexões</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Meus grupos
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body"> <!--grupos do usuario-->
                                <?php
                                listaGrupo($_SESSION["Id"], $conexao);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Minhas conexões
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body"> <!--conexoes do usuario-->

                            </div>
                        </div>
                    </div>
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
<!--<script src="main.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</html>