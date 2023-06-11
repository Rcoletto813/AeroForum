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
    <link rel="stylesheet" href="criarGrupo.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <title>Criar comunidade</title>
</head>

<body>
    <header>
        <h1>AeroForum</h1>
    </header>
    <nav style="--bs-breadcrumb-divider: '>'; display: flex; text-align: center; justify-content: space-around;"
        aria-label="breadcrumb">
        <ol class="breadcrumb" style="--bs-breadcrumb-margin-bottom: unset;">
            <li class="breadcrumb-item"><a href="../main/main.php">Retornar para página principal</a></li>
            <li class="breadcrumb-item">Criação</li>
            <li class="breadcrumb-item active" aria-current="page">
                Criar comunidade
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
        <form action="registrarGrupo.php" method="post" class="form" enctype="multipart/form-data">
            <div class="campos">
                <span class="campoNome">Nome<sup title="Campo obrigatório">*</sup></span>
                <input type="text" name="nome" placeholder="Coloque aqui o nome da sua comunidade" required autofocus
                    class="input titulo form-control">
            </div>
            <hr>
            <div class="campos" id="subcanais">
                <span class="campoNome">Subcanais<sup title="Campo obrigatório">*</sup></span>
                <span class="dica"><b>-></b>Insira quantos subcanais de comunicação o seu grupo terá</span>
                <input type="number" id="numSubcanal" required>
                <!--<input style="margin-top: 10px;" type="text" name="titulo" placeholder="Nome do subcanal" required autofocus class="input titulo form-control">-->
            </div>
            <hr>
            <div class="campos">
                <span class="campoNome">Tags<sup title="Campo obrigatório">*</sup></span>
                <span class="dica">
                    <b>Dica:</b> Para as suas <i>tags</i> funcionarem corretamente escreva uma de cada vez e as
                    separando por espaços e # <br>
                    <code>#tag1 #tag2</code>
                </span>
                <input type="text" name="tags" class="input tag form-control" required
                    placeholder="Vamos adicionar algumas tags no seu grupo? Assim fica mais fácil de colocá-lo em categorias e fará ele atingir seu público-alvo">
            </div>
            <div class="campos">
                <span class="campoNome">Imagem</span>
                <span class="dica">
                    <b>-></b> Selecione uma imagem para a logo do seu grupo. Se não quiser não tem problema, mas pode
                    ser interessante ter uma.
                </span>
                <label for="imagemGrupoArquivo" class="drop-container">
                    <span class="drop-title">Jogue a imagem aqui</span>
                    ou
                    <input type="file" accept="image/*" id="imagemGrupoArquivo" name="imagem">
                </label>
            </div>
            <div class="campos">
                <span class="campoNome">Descrição</span>
                <input type="text" maxlength="115"
                    placeholder="Aqui você pode adicionar uma breve descrição da sua comunidade. Não é obrigatório, mas pode ser útil"
                    name="descricao" class="input tag form-control">
            </div>
            <input type="hidden" value="" id="inputSubcanal" name="subcanais">
            <div class="campos revisar">
                <button type="submit" class="btn btn-success revisarBtn">Criar comunidade</button>
            </div>
        </form>
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
<script>
    function subcanaisString() {
        var subcanaisNome = "";
        const subcanais = document.querySelectorAll(".subCanalNome");
        subcanais.forEach(element => {
            subcanaisNome = subcanaisNome + element.value + ", ";
        });
        subcanaisNome = subcanaisNome.slice(0, -2); // remove a última vírgula e espaço
        const inputSubcanal = document.getElementById("inputSubcanal");
        inputSubcanal.value = subcanaisNome;
    }

    numSubcanal.addEventListener("change", function () {
        const antigosSubcanais = document.querySelectorAll(".subCanalNome");
        antigosSubcanais.forEach(element => {
            element.remove();
        });
        for (let i = 0; i < numSubcanal.value; i++) {
            //<input style="margin-top: 10px;" onchange="subcanaisString" type="text" name="titulo" placeholder="Nome do subcanal" required autofocus class="input titulo form-control subCanalNome">
            const input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("name", "titulo");
            input.setAttribute("placeholder", "Nome do subcanal");
            input.setAttribute("required", "");
            input.setAttribute("autofocus", "");
            input.setAttribute("class", "input titulo form-control subCanalNome");
            input.style.marginTop = "10px";
            input.onchange = subcanaisString; // define a função subcanaisString para ser executada quando o valor do input for alterado


            const elemPai = document.getElementById("subcanais");
            elemPai.appendChild(input);
        }
    })
    const fileInput = document.getElementById('imagemGrupoArquivo');

    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0];

        if (file && file.type.startsWith('image/')) {
            // O arquivo selecionado é uma imagem
        } else {
            // O arquivo selecionado não é uma imagem
            alert("Selecione um arquivo de imagem válido!");
            fileInput.value = "";
        }
    });

</script>

</html>