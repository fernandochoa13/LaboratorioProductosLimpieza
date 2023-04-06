<?php
$id = $_GET['id'];
include "../../../Database/dbconexion.php";
$queryResult = mysqli_query($conn, "UPDATE orden set estatus = 1 where idorden =$id ");
$message = "Orden de compra procesada";
                                echo "<script>
                                alert('$message');
                                window.location= 'verOrdenes.php'
                                </script>";
?>