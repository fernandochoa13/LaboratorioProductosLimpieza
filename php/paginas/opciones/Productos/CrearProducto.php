<?php
ob_start();
include "../../../Database/dbconexion.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
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
                <li><a href="../Ordenes de Compra Insumos/nombreOrdenInsumo.php">Crear Orden de Compra de Insumos</a></li>
                <li><a href="../Ordenes de Compra Insumos/verOrdenes.php">Ver Órdenes de Compra Insumos</a> </li>
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
            <li><a href="CrearProducto.php">Crear Producto</a></li>
            <li><a href="verProductos.php">Ver Productos</a></li>
            <li><a href="verGraficosMasVendidos.php">Ver Más Vendidos</a></li>
            <li><a href="verGraficosMasFabricados.php">Ver Más Fabricados</a></li>
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
        <label for="">Ingrese nombre del producto:</label> <br>
        <input type="text" class="form-control" placeholder="Nombre del producto" name="nombreField" required> <br>
</div>
<div class="form-group">
        <label for="">Ingrese el precio del producto:</label> <br>
        <input type="text" class="form-control" placeholder="Precio" name="precioField" required> <br>
</div>
<div class="form-group">
        <label for="">Estatus Producción:</label> <br> <br>
        <select name="estatus"> <br>
            <option value="Produciendo">En Producción</option>
            <option value="NoProduciendo">Fuera de Producción</option>
        </select> <br>
</div>
<div class="form-group"> <br>
        <label for="">Cantidad en Stock:</label> <br>
        <input type="number" class="form-control" name="inputStock" required> <br>
</div>
<div class="form-group">
        <label for="">Insumos</label> <br>
        <textarea class="form-control" name="inputField" placeholder="Ej. Dióxido de Carbono, Agua" rows="6" cols="90"></textarea> <br> <br>
</div>
        <input type="submit" value="Registrar" name="botonRegistro" class="btn">
    </form>
</div>
</section>
<footer>
    <img src="../../../../img/logo.jpg" class="LogoQuimicaroma"></img>
    <p>Copyright © 2023. Todos los derechos reservados. Pagina hecha por Fernando Ochoa</p>
    <a href="../../../../cerrarsesion.php">Cerrar Sesion</a>
</footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
<?php 
if(isset($_POST['botonRegistro']) && !empty($_POST['nombreField']) && !empty($_POST['precioField']) && !empty($_POST['inputStock'])) {
    $nombreProducto = $_POST['nombreField'];
    $precioProducto = $_POST['precioField'];
    $estatus = $_POST['estatus'];
    $stock = $_POST['inputStock'];
    $insumos = $_POST['inputField'];
    $estatusProduccion = 0;
    if($estatus == "Produciendo") {
        $estatusProduccion = 1;
    } else {
        $estatusProduccion = 0;
    }
    $resultadoQuery = mysqli_query($conn,"INSERT INTO producto(nombreProducto, precio, ventas, estatusProduccion, stock, Insumos ) VALUES ('$nombreProducto', '$precioProducto', 0, '$estatusProduccion', '$stock', '$insumos' )");
    if(!$resultadoQuery) {
        echo "Hubo un fallo en el registro";
    } else {
        echo "Se logro";
        header("Location:verProductos.php");
    }
}




ob_end_flush();
?>

<style>
    *{
      box-sixing: border-box;  
    }
    
    section {
    min-height: 100vh;
    background: url('../../../../img/product.jpg')no-repeat;
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
        width: 100%;
        height: 40px;
        background: white;
        border-radius: 4px;
        border: 1px solid silver;
        margin: 10px 0 18px 0;
        padding: 0 10px;
        text-align: center;
    }


    .container form .btn {
        
        transform; translateX(-50%);
        width: 120px;
        height: 34px;
        color: white;
        border: none;
        outline: none;
        background: rgb(83, 184, 180);
        cursor: pointer;
        font-size: 14px;
        text-transform: uppercase;
    }


</style>