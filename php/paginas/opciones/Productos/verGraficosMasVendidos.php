<?php
ob_start();
include "../../../Database/dbconexion.php";
$peticion = "SELECT * FROM producto";
$resultado = mysqli_query($conn,$peticion);
$id = [];
$nombreProducto = [];
$ventas = [];
$stock = [];


if(mysqli_num_rows($resultado) > 0) {
    while($array = mysqli_fetch_array($resultado)) {
       array_push($nombreProducto, $array['nombreProducto']);
       array_push($ventas, $array['ventas']);
       array_push($stock, $array['stock']);
    }
} else {
    echo "No hay suficientes registros";
}

$Masvendidos = array(0,0,0,0,0);
$ProductosMasVendidos = array("","","","","");
$stock = array(0,0,0,0,0);
//Mas vendidos
$longitud = count($ventas);
    for ($i = 0; $i < $longitud; $i++) {
        for ($j = 0; $j < $longitud - 1; $j++) {
            if ($ventas[$j] < $ventas[$j + 1]) {
                $temporal = $ventas[$j];
                $nombreTemporal = $nombreProducto[$j];
                $ventas[$j] = $ventas[$j + 1];
                $nombreProducto[$j] = $nombreProducto[$j + 1];
                $ventas[$j + 1] = $temporal;
                $nombreProducto[$j + 1] = $nombreTemporal;
        }
    } } 

    for($i = 0;$i < 5;$i++){
            $Masvendidos[$i] = $ventas[$i];
            $ProductosMasVendidos[$i] = $nombreProducto[$i];
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos</title>
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
    <div class="container-Valvulas">
    <h1 class="titulo-Seccion">Los 5 productos más pedidos</h1> <br><br>
    </div>
    <div class="container">
    <canvas id = "lineChart" height = "400" width = "400"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const CHART = document.getElementById("lineChart");
        console.log(CHART);
        let lineChart = new Chart(CHART, {
            type: "line",
            data: {
                labels: [<?php echo '"'.implode('","',  $ProductosMasVendidos ).'"' ?>],
                datasets: [{
                    label: 'Ventas',
                    data: [<?php echo '"'.implode('","',  $Masvendidos ).'"' ?>],
                    fill: false,
                    borderColor: 'rgb(139,0,0)',
                    tension: 0.1,
                    backgroundColor: 'rgb(139,0,0,1)',
                }]
        }
    })
    </script>
    </div> <br>
    <div class="line"></div>
    <footer>
    <img src="../../../../img/logo.jpg" class="LogoQuimicaroma"></img>
    <p>Copyright © 2023. Todos los derechos reservados. Pagina hecha por Fernando Ochoa</p>
    <a href="../../../../cerrarsesion.php">Cerrar Sesión</a>
</footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
<?php
ob_end_flush();
?>

<style>
    .titulo-Seccion {
        text-align: center;
        padding-top: 5%;
    }

    .container {
        width: 50%;
    }

    .line {
        border: 1px solid rgb(83, 184, 180);
    }


</style>
