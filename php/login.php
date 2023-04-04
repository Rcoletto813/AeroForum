<?php

include 'conectar.php';

if (isset($_POST['registro-submit'])) {
    criarUsuario($conexao);
} else {
    logarUsuario($conexao);
}

function logarUsuario($conexao)
{
    $email = $_POST["emailLogin"];
    $senha = $_POST["senhaLogin"];

    $query = "SELECT * FROM usuário WHERE email='$email'";
    $resultado = mysqli_query($conexao, $query);
    if (mysqli_num_rows($resultado) > 0) { // Verificar se o usuário existe e se a senha está correta
        //echo "<script>console.log('Hello world!');</script>";
        $usuario = mysqli_fetch_assoc($resultado);
        if ($senha == $usuario['Senha']) { //password_verify($senha, $usuario['Senha']) ---- nao funciona
            // Autentica o usuário
            session_start();
            $_SESSION["nome_usuario"] = $usuario;
            header('Location: ../main/main.html');
            exit();
        }
    }
    //credenciais inválidas
   header('Location: ../login e registrar/login.html?erro=true&titulo=Dado inválido&mensagem=Usuário ou senha inválido&tipo=btn-danger&btn-msg=Entendido!');

    /*$email = $_POST["email"];
    $senha = $_POST["senha"];
    $query = "SELECT * FROM usuario WHERE email='$email'";
    $resultado = mysqli_query($conexao, $query);
    if (mysqli_num_rows($resultado) == 0) { //usuario nem possui cadastro
    header('Location: loginInterface.php?erro=1');
    }
    $usuario = mysqli_fetch_assoc($resultado);
    $loginAutorizado = password_verify($senha, $usuario["senha"]);
    if ($loginAutorizado == false) {
    header('Location: ../login e registrar/login.html?erro=true&titulo=Dado inválido&mensagem=Usuário ou senha inválido&tipo=btn-danger&btn-msg=Entendido!');
    } else {
    //autenticar o usuario caso esteja tudo correto
    session_start();
    $_SESSION["nome_usuario"] = $usuario["username"];
    header('Location: inicioForum.php');
    }*/
}

function criarUsuario($conexao)
{
    $username = $_POST["usuarioRegistro"];
    $email = $_POST["emailRegistro"];
    $senha = $_POST["senhaRegistro"];
    $senha_confirma = $_POST["confirmaSenhaRegistro"];

    if (strlen($senha) == 0) {
        header('Location: ../login e registrar/registro.html?erro=true&titulo=Dado inválido&mensagem=Não deixe a senha em branco&tipo=btn-danger&btn-msg=Entendido!');
    }

    //verificar se as senhas são iguais
    if ($senha != $senha_confirma) {
        echo "hello world";
        header('Location: ../login e registrar/registro.html?erro=true&titulo=Dado inválido&mensagem=As senhas não correspondem&tipo=btn-danger&btn-msg=Entendido!');
    }
    //verificar se a conta já existe
    $query = "SELECT * FROM usuário WHERE email='$email'";
    $resultado = mysqli_query($conexao, $query);
    if (mysqli_num_rows($resultado) != 0) {
        header('Location: ../login e registrar/registro.html?erro=true&titulo=Dado inválido&mensagem=Já existe uma conta com este email&tipo=btn-danger&btn-msg=Entendido!');
    }

    //verificar se o nome de usuário já existe
    $query = "SELECT * FROM usuário WHERE username='$username'";
    $resultado = mysqli_query($conexao, $query);
    if (mysqli_num_rows($resultado) != 0) {
        header('Location: ../login e registrar/registro.html?erro=true&titulo=Dado inválido&mensagem=Já existe uma conta com este nome de usuário&tipo=btn-danger&btn-msg=Entendido!');
    } else {
        //tudo correto a conta é criada:
        $query = "INSERT INTO usuário (username, email, senha) VALUES ('$username', '$email', '$senha')";
        $criarConta = mysqli_query($conexao, $query);
        header('Location: ../login e registrar/registro.html?erro=true&titulo=Conta criada!&mensagem=Sua conta na AeroForum foi criada com sucesso. Agora é só fazer login&tipo=btn-success&btn-msg=Eba!');
    }
}
?>