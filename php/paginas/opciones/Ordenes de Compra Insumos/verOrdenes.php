<?php 
ob_start();
include "../../../Database/dbconexion.php";
$queryOrdenes = mysqli_query($conn,"SELECT * from orden");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Ordenes de Insumos</title>
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
<table class="table">
        <thead>
            <th>ID</th>
            <th>Estatus</th>
            <th>Nombre</th>
            <th>Presupuesto</th>
            <th>Fecha Solicitud</th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <?php while($rows = mysqli_fetch_array($queryOrdenes)){ 
            if($rows['tipoOrden'] == 0) {
            $estatus = "";
            if($rows['estatus'] == 0) {
                $estatus = "No procesada";
            } else {
                $estatus = "Procesada";
            }
            ?>
          
        <tr>
            <td><?php echo $rows['idorden'];?></td>
            <td><?php echo $estatus;?></td>
            <td><?php echo $rows['nombreOrden'];?></td>
            <td><?php echo $rows['presupuesto'];?></td>
            <td><?php echo $rows['fechaCreacion'];?></td>
            <?php if($rows['estatus'] == 0) { ?>
                <td><a href="procesarOrden.php?id=<?php echo $rows['idorden']?>"><input type="submit" name="btn-Procesar" value="Procesar" class="btn btn-dark"></a></td>
            <td><a href="borrarOrdenCompraInsumo.php?id=<?php echo $rows['idorden']?>" style="color: rgb(83, 184, 180)"><ion-icon name="trash-outline"></ion-icon></a></td>
          <?php  }  ?>
          <td><a href="../fpdf/ReportesOrdenCompraInsumo.php?id=<?php echo $rows['idorden']?>" target="_blank">Reporte PDF</a></td>

        </tr>
  <?php    }   }?>
    </table> <br>
    <form action="" method="POST">
    <div class="botonesForm">
    <input type="submit" class="btn btn-dark" value="Ingresar nuevo Registro" name="nuevoRegistro"> 
    <input type="submit" class="btn btn-dark" value="Volver a menu inicio" name="botonInicio"> <br>
    </div>
    </form>
    <footer>
    <img src="../../../../img/logo.jpg" class="LogoQuimicaroma"></img>
    <p>Copyright © 2023. Todos los derechos reservados. Pagina hecha por Fernando Ochoa</p>
    <a href="../../../../cerrarsesion.php">Cerrar Sesion</a>
</footer>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>


<?php   
if(isset($_POST['nuevoRegistro']))  {
    header("Location:nombreOrdenInsumo.php");
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

    </style>