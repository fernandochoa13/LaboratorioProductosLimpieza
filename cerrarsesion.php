<?php

$_SESSION["Usuario"] = "";
$_SESSION["clave"] = "";
$message = "Se cerro la sesion exitosamente";
session_destroy();
header("Location:index.php?message=".$message);




?>