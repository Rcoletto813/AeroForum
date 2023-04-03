<?php

include 'conectar.php';

$username = $_POST["usuarioRegistro"];
$email = $_POST["emailRegistro"];
$senha = $_POST["senhaRegistro"];
$senha_confirma = $_POST["confirmaSenhaRegistro"];

//verificar se as senhas são iguais
if ($senha != $senha_confirma) {
    header('Location: ../login e registrar/registro.html?erro=true&titulo=Dado inválido&mensagem=As senhas não correspondem&tipo=btn-danger');
}
?>