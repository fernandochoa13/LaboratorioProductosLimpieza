<?php
include "../../../Database/dbconexion.php";
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre Orden</title>
    <link rel="stylesheet" href="../../../../css/home.css"></link>
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
                <li><a href="../Ordenes de Compra Insumos/nombreOrdenInsumo.php">Crear Orden de Compra de Insumos</a></li>
                <li><a href="../Ordenes de Compra Insumos/verOrdenes.php">Ver Órdenes de Compra Insumos</a> </li>
            </ul>
            </li>
            <li> 
           <a href="#" class="dropdownNombre"> Ordenes de Compra de Productos ▼</a>
            <ul class="dropdown">
            <li><a href="nombreOrdenProducto.php">Crear Orden de Compra de Productos</a></li>
                <li><a href="verOrdenes.php">Ver Órdenes de Compra Producto</a> </li>
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
    <label for="">Ingrese nombre para la orden:</label>
    <input type="text" name="botonProducto" class="form-control" placeholder="Nombre de la orden" required>
    </div>
    <input type="submit" class="btn" name="nombreOrden">
    </form>
    </div>
</section>
    <footer>
    <img src="../../../../img/logo.jpg" class="LogoQuimicaroma"></img>
    <p>Copyright © 2023. Todos los derechos reservados. Pagina hecha por Fernando Ochoa</p>
    <a href="../../../../cerrarsesion.php">Cerrar Sesion</a>
</footer>
</body>
</html>

<?php
if(isset($_POST['nombreOrden']) && !empty('botonProducto')) {
    $nombreOrden = $_POST['botonProducto'];
    $queryResult = mysqli_query($conn, "INSERT INTO orden (nombreorden, tipoOrden) VALUES ('$nombreOrden', 1)");
    $nombreResult = mysqli_query($conn, "SELECT idorden from orden where nombreorden='$nombreOrden'");
    $row = mysqli_fetch_array($nombreResult);
    header("Location:crearOrdenCompraProducto.php?id=".$row[0]);
}
ob_end_flush();
?>

<style>
    *{
      box-sixing: border-box;  
    }
    
    section {
    min-height: 100vh;
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
        width: 120px;
        height: 34px;
        border: none;
        outline: none;
        background: rgb(83, 184, 180);
        cursor: pointer;
        font-size: 16px;
        text-transform: uppercase;
    }


</style>