<?php
ob_start();
$idProducto = $_GET['id'];
include "../../../Database/dbconexion.php";
$queryResultado = mysqli_query($conn,"SELECT * FROM producto where idProducto='$idProducto'");
$rows = mysqli_fetch_array($queryResultado);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
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
    <section> <br>  <br>  <br>
    <div class="container">
   <form action="" method="POST">
   <div class="form-group">
   <label for="">Nombre del producto:</label>
   <input type="text" class="form-control" placeholder="<?php echo $rows['nombreProducto'] ?>" name="nombreField" required> <br> <br> </div>

   <div class="form-group">
   <label for="">Precio:</label>
   <input type="number" class="form-control" placeholder="<?php echo $rows['precio']?>" name="precioField" required> <br> <br> </div>

   <div class="form-group">
   <label for="">Ventas: </label>
   <input type="text" class="form-control" placeholder="<?php echo $rows['ventas']?>"> <br> <br> </div>

   <div class="form-group">
   <label for="">Estatus Produccion:</label>
   <select name="estatus" class="form-control"> <br> <br>
            <option value="Produciendo">En Producción</option>
            <option value="NoProduciendo">Fuera de Producción</option>
        </select><br> <br></div>

        <div class="form-group">
   <label for="">Stock:</label>
   <input type="number" name="inputStock" class="form-control" required placeholder="<?php echo $rows['stock']?>"> <br>
   </div>
   <div class="form-group">
   <label for="">Insumos</label> <br>
        <textarea class="form-control" name="inputField" placeholder="<?php echo $rows['Insumos']?>" rows="4" cols="50"></textarea> <br> <br>
</div>
   <input type="submit" name="botonUpdate" class="btn">
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
if(isset($_POST['botonUpdate']) && !empty($_POST['nombreField']) && !empty($_POST['precioField']) && !empty($_POST['inputStock'])) {
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
    $resultadoQuery = mysqli_query($conn,"UPDATE producto SET nombreProducto = '$nombreProducto', precio = '$precioProducto', estatusProduccion = $estatusProduccion, stock = $stock, Insumos = '$insumos' WHERE idProducto = $idProducto");
    if(!$resultadoQuery) {
        echo "Hubo un fallo en la actualizacion";
    } else {
        echo "Se logro";
        header("Location:../../verProductos.php");
    }
}
ob_end_flush();
?>

<style>
    *{
      box-sixing: border-box;  
    }
    
    section { 
        padding-top: 10%;
        padding-bottom: 10%;
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