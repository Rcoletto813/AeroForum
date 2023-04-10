<?php

session_start();
session_destroy();
header("Location: ../login e registrar/login.html");

?>