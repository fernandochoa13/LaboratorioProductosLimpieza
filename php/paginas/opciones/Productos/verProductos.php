<?php
ob_start();
include "../../../Database/dbconexion.php";
$queryResultado = mysqli_query($conn,"SELECT * FROM producto");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Productos</title>
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
    <table class="table">
        <thead>
            <th style='color: rgb(83, 184, 180)'>ID</th>
            <th style='color: rgb(83, 184, 180)'>Nombre del Producto</th>
            <th style='color: rgb(83, 184, 180)'>Precio</th>
            <th style='color: rgb(83, 184, 180)'>Ventas</th>
            <th style='color: rgb(83, 184, 180)'>Estatus Producción</th>
            <th style='color: rgb(83, 184, 180)'>Stock</th>
            <th style='color: rgb(83, 184, 180)'>Insumos</th>
        </thead>
        <?php while($rows = mysqli_fetch_array($queryResultado)){ 
            $estatus = "";
            if($rows['estatusProduccion'] == 1) {
                $estatus = "En Producción";
            } else {
                $estatus = "Fuera de Producción";
            }
            ?>
          
        <tr>
            <td><?php echo $rows['idProducto'];?></td>
            <td><?php echo $rows['nombreProducto'];?></td>
            <td><?php echo $rows['precio'];?></td>
            <td><?php echo $rows['ventas'];?></td>
            <td><?php echo $estatus;?></td>
            <td><?php echo $rows['stock'];?></td>
            <td><?php echo $rows['Insumos'];?></td>
            <td><a href="editarProducto.php?id=<?php echo $rows['idProducto']?>"style="color: rgb(83, 184, 180)"><ion-icon name="create-outline"></ion-icon></a></td>
            <td><a href="borrarProducto.php?id=<?php echo $rows['idProducto']?>" style="color: rgb(83, 184, 180)"><ion-icon name="trash-outline"></ion-icon></a></td>
        </tr>
  <?php    } ?>
    </table> <br>
    <div class="botonesForm">
    <form action="" method="POST">
    <input type="submit" class="btn btn-dark" value="Ingresar nuevo Registro" name="nuevoRegistro"> 
    <input type="submit" class="btn btn-dark" value="Volver a menu inicio" name="botonInicio"> <br>
    </div> <br> <br>
    <div class="botonReporte">
    <a href="../fpdf/ReportesProductos.php" class="btn btn-danger" target="_blank" >Generar Reporte <ion-icon name="document-text-outline"></ion-icon></a>
    </div>
    </form>
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
if(isset($_POST['nuevoRegistro']))  {
    header("Location:CrearProducto.php");
}

if(isset($_POST['botonInicio'])) {
    header("Location:../../home.php");
}


ob_end_flush();
?>

<style>

.table {
    text-align: center;
}

.table a {
    color: rgb(83, 184, 180);
}

.botonesForm {
    text-align: center;
}

.botonReporte {
    text-align: center;
}
    </style>