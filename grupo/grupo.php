<?php
include '../php/conectar.php';
include '../php/paginaProtegida.php';

//$idGrupo = $_GET["IdGrupo"];
$idGrupo = 1;
$idSubcanal = 0;

//grupo atual
$query = "SELECT nome from grupo WHERE id_Grupo = $idGrupo";
$resultado = mysqli_query($conexao, $query);
$linha = mysqli_fetch_assoc($resultado);
$nomeGrupo = $linha["nome"];

//subcanal atual
$query = "SELECT subcanais.nome FROM subcanais
INNER JOIN grupo ON grupo.id_Grupo = subcanais.Id_Grupo
WHERE subcanais.Id_Subcanal = $idSubcanal AND grupo.Id_Grupo = $idGrupo";

$resultado = mysqli_query($conexao, $query);
$linha = mysqli_fetch_assoc($resultado);
$nomeSubcanal = $linha["nome"];

function listaSubcanais($conexao, $idGrupo)
{
    $query = "SELECT subcanais.nome, subcanais.Id_Subcanal FROM subcanais
    INNER JOIN grupo ON 
    grupo.id_Grupo = subcanais.Id_Grupo
    WHERE grupo.id_Grupo = $idGrupo";

    $resultado = mysqli_query($conexao, $query);

    while ($row = mysqli_fetch_assoc($resultado)) {
        echo '
        <div class="sub-canal">
            <a href="grupo.php?idGrupo=' . $idGrupo . '&idSubcanal=' . $row["Id_Subcanal"] . '"><div class="nome-subcanal">- ' . $row["nome"] . '</div></a>
        </div>
        ';
    }
}
function listaMembros($conexao, $idGrupo)
{
    $query = "SELECT usuário.Username FROM usuariogrupo
    INNER JOIN grupo ON 
    usuariogrupo.Grupo_id_Grupo = grupo.id_Grupo
    INNER JOIN usuário ON
    usuário.Id_User = usuariogrupo.Usuário_Id_User
    WHERE grupo.id_Grupo = $idGrupo";

    $resultado = mysqli_query($conexao, $query);

    while($row = mysqli_fetch_assoc($resultado)) {
        echo '
        <div class="user-item">
            <div class="user-avatar">
                <img src="../imagens/imgPerfilDefault.svg">
            </div>
            <div class="user-name">'. $row["Username"] . '</div>
        </div>
    ';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="grupo.css">
    <title>Nome do grupo aqui</title>
</head>

<body>
    <div id="topo">
        <header>
            <h1>AeroForum</h1>
        </header>
        <nav style="--bs-breadcrumb-divider: '>'; display: flex; text-align: center; justify-content: space-around;"
            aria-label="breadcrumb">
            <ol class="breadcrumb" style="--bs-breadcrumb-margin-bottom: unset;">
                <li class="breadcrumb-item"><a href="../main/main.php">Retornar para página principal</a></li>
                <li class="breadcrumb-item">Grupo</li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo $nomeGrupo; ?>
                </li>
            </ol>
            <div class="usuario">
                <img src="../imagens/imgPerfilDefault.svg" alt="imagem de perfil" id="perfilImgagem" width="3%">
                <span>
                    <a href="#">
                        <?php echo $_SESSION["Username"]; ?>
                    </a>
                </span>
            </div>
        </nav>
        <div class="info-grupo">
            <h3>
                <?php echo $nomeGrupo; ?>
            </h3>
            <button type="button" class="btn btn-danger">Sair do grupo</button>
        </div>
    </div>
    <main>
        <section class="recursos-grupo">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Membros
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="user-list">
                                <?php listaMembros($conexao, $idGrupo);?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Subcanais de comunicação
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="canais-list">
                                <?php listaSubcanais($conexao, $idGrupo); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 style="margin-left: 10px;">Canal atual: <a href="#" style="text-decoration: underline; cursor: pointer;"><?php echo $nomeSubcanal;?></a></h4>
        </section>
        <section class="bate-papo">
            <div class="conversa">
                <iframe
                    src="mensagens.html?IdGrupo=<?php echo $idGrupo; ?>&IdSubcanal=0&username=<?php echo $_SESSION["Username"]; ?>&idUsername=<?php echo $_SESSION["Id"]; ?>"
                    style="width: 100%;" id="iframe"></iframe>
            </div>
            <div class="escrever" id="escrever">
                <input type="text" placeholder="Digite sua mensagem" id="msg">
                <button id="enviar">Enviar</button>
            </div>
        </section>
        <input type="hidden" id="idGrupo" value="1">
        <input type="hidden" id="idSubcanal" value="0">
        <input type="hidden" id="username" value="Username">
        <input type="hidden" id="idUsername" value="idUsername">
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script src="app.js"></script>
<script src="enviarMsg.js"></script>
<script>
    //height do main
    const elemento = document.getElementById("topo");
    const areaOcupada = elemento.getBoundingClientRect().height;

    const alturaTela = window.innerHeight;

    let container = document.getElementsByTagName("main")[0];
    container.style.height = (alturaTela - areaOcupada) + "px";

    //height do iframe
    const alturaMain = alturaTela - areaOcupada;

    const escrever = document.getElementById("escrever");
    const alturaEscrever = escrever.getBoundingClientRect().height;

    let iframe = document.getElementById("iframe");
    iframe.addEventListener("load", function () {
        iframe.style.height = (alturaMain - alturaEscrever) + "px";
        setTimeout(function () {
            iframe.contentWindow.scrollTo(0, iframe.contentWindow.document.body.scrollHeight);
        }, 900);
    });
    // define a função para dar scroll down no iframe
    function scrollDown() {
        iframe.contentWindow.scrollTo(0, iframe.contentWindow.document.body.scrollHeight);
    }

    // define o intervalo para chamar a função scrollDown()
    let scrollInterval = setInterval(scrollDown, 1000); // define o intervalo de 1 segundo

</script>

</html>