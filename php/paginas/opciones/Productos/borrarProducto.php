<?php
include "../../../Database/dbconexion.php";
$idProducto = $_GET['id'];
$resultadoQuery = mysqli_query($conn,"DELETE from PRODUCTO where idProducto=$idProducto");
header("Location:verProductos.php");


?>