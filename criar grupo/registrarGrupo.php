<?php
include '../php/conectar.php';

session_start();

$nome = $_POST["nome"];
$subcanais = $_POST["subcanais"];
$tags = $_POST["tags"];
$descricao = $_POST["descricao"];

registrarGrupo($conexao, $nome, $tags, $descricao, $subcanais);

function registrarGrupo($conexao, $nome, $tags, $descricao, $subcanais) //registrar o grupo na base de dados
{
    $subcanaisArray = explode(",", $subcanais); //subcanais separados por ,

    $date = new DateTime();
    $date_str = $date->format('Y-m-d H:i:s');

    $imagem = imgGrupo();

    //adicionar grupo na base de dados
    $query = "INSERT INTO `grupo`
    (`Nome`, `Categoria`, `Descrição`, `Foto`, `data_criação`) VALUES 
    ('$nome', '$tags', '$descricao', '$imagem', '$date_str')";
    mysqli_query($conexao, $query);

    $id_grupo = mysqli_insert_id($conexao); //id do grupo criado

    criarSubcanais($conexao, $subcanais, $id_grupo, $subcanaisArray);
    addMembro($conexao, $id_grupo);
    chatFirebase($id_grupo, $subcanaisArray);
}

function imgGrupo() //imagem do grupo
{
    $imagemFinal = "";
    if ($_FILES["imagem"]["error"] === UPLOAD_ERR_OK) { //TRATAMENTO DA IMAGEM DO GRUPO, SE HOUVER//
        $tempImg = $_FILES["imagem"]; //imagem temporária do servidor
        $destino = '../imagens/grupos/'; //diretório final da imagem

        $nomeIdentificador = uniqid() . '_' . rand(1000, 9999) . '_' . $tempImg["name"]; //gerar um nome único para a imagem enviada

        $imagemFinal = $destino . $nomeIdentificador;

        move_uploaded_file($tempImg['tmp_name'], $imagemFinal);
    } else { //uso da imagem default
        $imagemFinal = '../imagens/grupos/logoGrupoDefault.png'; 
    }
    return $imagemFinal;
}

function criarSubcanais($conexao, $subcanais, $id_grupo, $subcanaisArray) //criar os subcanais de comunicação
{
    //adicionar o canal main
    $query = "INSERT INTO `subcanais`(`Id_Subcanal`, `Id_Grupo`, `nome`) VALUES (0, $id_grupo, 'Principal')";
    mysqli_query($conexao, $query);

    $cont = 1;
    foreach ($subcanaisArray as $subcanal) { //demais subcanais
        $query = "INSERT INTO `subcanais`(`Id_Subcanal`, `Id_Grupo`, `nome`) VALUES ($cont, $id_grupo,'$subcanal')";
        mysqli_query($conexao, $query);
        $cont++;
    }

}

function addMembro($conexao, $id_grupo) //adicionar o criador do grupo no grupo
{
    $id_user = $_SESSION["Id"];
    $query = "INSERT INTO `usuariogrupo`(`Usuário_Id_User`, `Grupo_id_Grupo`) VALUES ('$id_user', $id_grupo)";
    mysqli_query($conexao, $query);

    $query = "UPDATE `grupo` SET `Membros`=`Membros`+1 WHERE `id_Grupo` = $id_grupo";
    mysqli_query($conexao, $query);
}

function chatFirebase($id_grupo, $subcanaisArray) //criar o chat no firebase e redirecionar para a página do grupo criada
{
    $data = array(
        $id_grupo => array()
    );

    for ($i = 0; $i < count($subcanaisArray) + 1; $i++) {
        $data[$id_grupo][$i] = array(
            0 => array(
                'IdUser' => '#####',
                'Username' => '#####',
                'Data' => '#####',
                'Conteudo' => 'Canal criado com sucesso'
            )
        );
    }
    
    echo '
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="../config/app.js"></script>
    <script>
    const data = ' . json_encode($data) . ';
    firebase.database().ref("grupos").child(' . $id_grupo . ').set(data).then(() => {
        window.location.href = "../grupo/grupo.php?IdGrupo=' . $id_grupo . '&IdSubcanal=0";
    })
    .catch((error) => {
        console.error(error);
    });
    </script>
    ';
}

?>