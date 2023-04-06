<?php
session_start();
$id = $_GET['id'];
$totalC = 0;
include "../../../Database/dbconexion.php";
//Obteniendo Productos de la Base de Datos
$resultadoNumeroInsumo = mysqli_query($conn,"Select * from insumo");
$dataInsumos = array();


if(!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
}
    if(mysqli_num_rows($resultadoNumeroInsumo) > 0) {
        while($row = mysqli_fetch_assoc($resultadoNumeroInsumo)) {
            $dataInsumos[] = $row;
        }
    }

    if(!isset($_SESSION['ids']) && !isset($_SESSION['cantidades'])){
        $_SESSION['ids'] = array ();
        $_SESSION['cantidades'] = array ();
    }

    if(!isset($_SESSION['nombre'])){
        $_SESSION['nombre'] = array();
    }

    if(!isset($_SESSION['precios'])){
        $_SESSION['precios'] = array();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra de Insumos</title>
    <link rel="stylesheet" href="../../../../css/home.css"></link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
<a href="../../home.php"><header class="header_Quimicaroma">
   <img class="LogoQuimicaroma" src="../../../../img/logo.jpg"></img>
</header></a>
<nav>
        <ul>
            <li> 
           <a href="#" class="dropdownNombre"> Ordenes de Compra de Insumos ▼</a>
            <ul class="dropdown">
                <li><a href="nombreOrdenInsumo.php">Crear Orden de Compra de Insumos</a></li>
                <li><a href="verOrdenes.php">Ver Órdenes de Compra Insumos</a> </li>
            </ul>
            </li>
            <li> 
           <a href="#" class="dropdownNombre"> Ordenes de Compra de Productos ▼</a>
            <ul class="dropdown">
            <li><a href="../Ordenes de Compra Productos/nombreOrdenProducto.php">Crear Orden de Compra de Productos</a></li>
                <li><a href="../Ordenes de Compra Productos/verOrdenes.php">Ver Órdenes de Compra Producto</a> </li>
            </ul>
            </li>
            <li>
            <a href="#" class="dropdownNombre"> Productos ▼</a>
            <ul class="dropdown">
            <li><a href="../Productos\CrearProducto.php">Crear Producto</a></li>
            <li><a href="../Productos\verProductos.php">Ver Productos</a></li>
            <li><a href="../Productos/verGraficosMasVendidos.php">Ver Más Vendidos</a></li>
            <li><a href="../Productos/verGraficosMasFabricados.php">Ver Más Fabricados</a></li>
            </ul>
            </li>
        
        <li>
        <a href="#" class="dropdownNombre"> Insumos ▼</a>
        <ul class="dropdown">
        <li><a href="../Insumos/registrarInsumo.php">Registrar Insumo</a></li>
            <li><a href="../Insumos/verInsumos.php">Ver Insumos</a></li>
            <li><a href="../Insumos/verGraficos.php">Ver Gráficos</a></li>
        </ul>
    </li>
    </ul>
    </nav>
    <section>
    <div class="container">
    <form action="" method="POST">
    <div class="form-group">
        <label for="">Seleccione insumos:</label> <br>
        <select name="nombreInsumos" id="nombreInsumos">
            <?php 
            for($i=0;$i<mysqli_num_rows($resultadoNumeroInsumo);$i++){
                ?>
                <option value="<?php echo $dataInsumos[$i]['idInsumo']?>"><?php echo $dataInsumos[$i]['nombreInsumo']?></option>
                <?php }  ?>
        </select> 
        </div> <br>
        <div class="form-group">
        <label for="">Cantidad:</label> 
        <input type="number" required name="cantidad" id="cantidadNumero">
        </div> <br>
        <input type="submit" class="btn" value="Agregar insumo" name="lolAsu"> 
        </form>
    </div>
</section>
   

<br><br>
       
<br><br>

</body>
</html>
<?php  
        if(isset($_POST['cantidad']) && isset($_POST['nombreInsumos'])) {
            $idInsumo = $_POST['nombreInsumos'];
            $cantidad = $_POST['cantidad'];
            $resultadoPrecio = mysqli_query($conn,"SELECT nombreInsumo, precio from insumo where idInsumo=$idInsumo");
            $arregloDatos = mysqli_fetch_array($resultadoPrecio);
            $queryInsumos = mysqli_query($conn, "INSERT into insumo_has_orden(orden_idorden, insumo_idinsumo, cantidad) VALUES ('$id', '$idInsumo', $cantidad)");
            $queryVentas = mysqli_query($conn, "SELECT ventas from insumo where idInsumo='$idInsumo'");
            $row = mysqli_fetch_array($queryVentas);
            $nuevasVentas = $row[0] + $cantidad;
            $queryUpdateVentas = mysqli_query($conn, "UPDATE insumo set ventas = $nuevasVentas where idInsumo=$idInsumo");
            if(isset($_SESSION['ids']) && isset($_SESSION['cantidades']) && isset($_SESSION['nombre'])  && isset($_SESSION['precios'])){
                array_push($_SESSION['nombre'], $arregloDatos['nombreInsumo']);
                array_push($_SESSION['ids'], $idInsumo);
                array_push($_SESSION['cantidades'], $cantidad);
                array_push($_SESSION['precios'], $arregloDatos['precio']);
                echo "<div>
                <table id='datatables' class='table'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>";

    for ($i=0; $i<count($_SESSION['ids']); $i++){
        $precioTotal = $_SESSION['precios'][$i] * $_SESSION['cantidades'][$i];
        echo "<tr>
            <td>".$_SESSION['ids'][$i]."</td>
            <td>".$_SESSION['nombre'][$i]."</td>
            <td>".$_SESSION['cantidades'][$i]."</td>
            <td>".$precioTotal."</td>
            </tr>";
    }
    echo "</tbody>
        </table>
        </div>";
        $_SESSION['total'] += $precioTotal;
}
}
?>  <br> <br>
<h3 class="totalOrden"> Total de la Orden: <?php echo  $_SESSION['total']?></h3>

<form action="#" method="post">
<div class="botones">
    <input type="submit" name="ordenar" value="Realizar Orden" class="btn btn-dark">

    <input type="submit" name="btn-cancel" value="Cancelar Orden" class="btn btn-danger">
</form>
</div>

<?php
                            if(isset($_POST['ordenar'])){

                                for ($i=0; $i<count($_SESSION['ids']); $i++){
                                    

                                    $totalC += $_SESSION['cantidades'][$i] * $_SESSION['precios'][$i];
                                }
                                
                                $query5 = "UPDATE orden set estatus=0, presupuesto='$totalC' WHERE idorden = '$id'"; 
                                $rs5 = mysqli_query($conn, $query5) or die("Error: " . mysqli_error($conn));

                                $_SESSION['ids'] = array ();
                                $_SESSION['nombre'] = array ();
                                $_SESSION['cantidades'] = array ();
                                $_SESSION['precios'] = array ();
                                $_SESSION['total'] = 0;

                                $message = "Orden de compra registrada con exito";
                                echo "<script>
                                alert('$message');
                                window.location= 'verOrdenes.php'
                                </script>";

                            }elseif (isset($_POST['btn-cancel'])) {

                                $query6 = "DELETE FROM orden WHERE idorden=$id";
                                $rs6 = mysqli_query($conn, $query6) or die("Error: " . mysqli_error($conn));

                                $_SESSION['ids'] = array ();
                                $_SESSION['nombre'] = array ();
                                $_SESSION['cantidades'] = array ();
                                $_SESSION['precios'] = array ();
                                $_SESSION['total'] = 0;

                                $message = "Orden de compra cancelada";
                                echo "<script>
                                alert('$message');
                                window.location= 'verOrdenes.php'
                                </script>";
                            }
                            ?>
                        </div>
                        <html>
<footer>
    <img src="../../../../img/logo.jpg" class="LogoQuimicaroma"></img>
    <p>Copyright © 2023. Todos los derechos reservados. Pagina hecha por Fernando Ochoa</p>
    <a href="../../../../cerrarsesion.php">Cerrar Sesion</a>
</footer>
</html>

<style>
    *{
      box-sixing: border-box;  
    }
    
    section {
    background: url('../../../../img/cleaning.jpg')no-repeat;
    background-position: center;
    background-size: cover;
    display: flex;
    }
    .container {
        margin: auto;
        width: 500px;
        max-width: 90%;
    }

    .container form {
        width: 100%;
        height: 200%;
        padding: 20px;
        background: white;
        border-radius: 4px;
        box-shadow: 0 8px 16px rgba(0,0,0,.3);
        text-align: center;

    }

    .container form .form-control {
        width: 80%;
        height: 40px;
        background: white;
        border-radius: 4px;
        border: 1px solid silver;
        margin: 10px 0 18px 0;
        padding: 0 10px;
        text-align: center;
    }

    .container form .btn {
        margin-left: 5%;
        transform; translateX(-50%);
        color: white;
        width: 120px;
        height: 34px;
        border: none;
        outline: none;
        background: rgb(83, 184, 180);
        cursor: pointer;
        font-size: 10px;
        text-transform: uppercase;
    }

    .container form .btn:hover {
        background-color: black;
    }

    .totalOrden {
        text-align: center;
        color:rgb(83, 184, 180);
    }

    .botones {
        text-align: center;
    }

    .table {
        text-align: center;
    }


</style>











