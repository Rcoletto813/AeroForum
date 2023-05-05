<?php 

include '../php/paginaProtegida.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="criarPost.css">
    <title>Escrever um post</title>
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
                Escrever post
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
        <form action="revisarPost.php" method="post" class="form">
            <div class="campos">
                <span class="campoNome">Título<sup title="Campo obrigatório">*</sup></span>
                <input type="text" name="titulo" placeholder="Toda boa publicação precisa de um título" required
                    autofocus class="input titulo form-control">
            </div>
            <div class="campos">
                <span class="campoNome">Conteúdo<sup title="Campo obrigatório">*</sup></span>
                <span class="dica">
                    <b>Dica:</b> Esse campo pode funcionar como um editor <a target="_blank"
                        href="https://developer.mozilla.org/pt-BR/docs/Web/HTML">HTML</a> então se você souber usar tags
                    de formatação de texto e estilo em linha <b>use e abuse desse recurso</b>
                </span>
                <span class="dica">
                    <b>Dica:</b> Se você quiser aumentar o tamanho dessa caixa de texto utilize seu mouse na canto
                    inferior direito desta caixa
                </span>
                <textarea style="height: 200px;" name="conteudo" class="input conteudo form-control" required
                    placeholder="Para fazer uma boa publicação você precisa escrever um conteúdo adequado e bem organizado. Faça isso aqui"></textarea>
            </div>
            <div class="campos">
                <span class="campoNome">Tags<sup title="Campo obrigatório">*</sup></span>
                <span class="dica">
                    <b>Dica:</b> Para as suas <i>tags</i> funcionarem corretamente escreva uma de cada vez e as separando por espaços e # <br>
                    <code>#tag1 #tag2</code>
                </span>
                <input type="text" name="tags" class="input tag form-control" required placeholder="E se adicionarmos algumas tags no seu post? Assim fica mais fácil de colocá-lo em categorias e fará ele atingir seu público-alvo">
            </div>
            <div class="campos">
                <span class="campoNome">Resumo</span>
                <input type="text" maxlength="115" placeholder="Aqui você pode adicionar um breve resumo de seu post. Não é obrigatório, mas pode ser útil" name="resumo" class="input tag form-control">
            </div>
            <div class="campos revisar">
                <button type="submit" class="btn btn-success revisarBtn">Revisar sua publicação</button>
            </div>
        </form>
    </main>
    <footer>
        <div class="sobre">
            <h4>Sobre nós</h4>
            <p>AeroForum é uma comunidade online para entusiastas da aviação compartilharem suas experiências e conhecimentos.</p>
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

</html>