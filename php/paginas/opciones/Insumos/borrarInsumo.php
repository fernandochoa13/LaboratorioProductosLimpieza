<?php
include "../../../Database/dbconexion.php";
$idInsumo = $_GET['id'];
$resultadoQuery = mysqli_query($conn,"DELETE from insumo where idInsumo=$idInsumo");
header("Location:verInsumos.php");


?>