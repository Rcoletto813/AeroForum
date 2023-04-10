<?php

session_start();
if (!isset($_SESSION["Username"])) {
    header("Location: ../login e registrar/login.html");
    exit();
}

?>