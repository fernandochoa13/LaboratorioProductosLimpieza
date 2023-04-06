<?php
include "../../../Database/dbconexion.php";
$id = $_GET['id'];
$resultadoQuery = mysqli_query($conn,"DELETE from orden where idorden=$id");
$message = "Orden de compra borrada";
                                echo "<script>
                                alert('$message');
                                window.location= 'verOrdenes.php'
                                </script>";




?>