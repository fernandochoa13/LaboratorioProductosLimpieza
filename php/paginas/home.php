<?php
include "../Database/dbconexion.php";
if(session_start() == null) {
    echo "<script>alert('Necesitas Iniciar Sesion primero');</script>";
    header("Location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../css/home.css">
</head>
<body>
    <header class="header_Quimicaroma">
   <img class="LogoQuimicaroma" src="../../img/logo.jpg"></img>
</header>
    </header>
    <nav>
        <ul>
            <li> 
           <a href="#" class="dropdownNombre"> Ordenes de Compra de Insumos ▼</a>
            <ul class="dropdown">
                <li><a href="opciones/Ordenes de Compra Insumos/nombreOrdenInsumo.php">Crear Orden de Compra de Insumos</a></li>
                <li><a href="opciones/Ordenes de Compra Insumos/verOrdenes.php">Ver Órdenes de Compra Insumos</a> </li>
            </ul>
            </li>
            <li> 
           <a href="#" class="dropdownNombre"> Ordenes de Compra de Productos ▼</a>
            <ul class="dropdown">
            <li><a href="opciones/Ordenes de Compra Productos/nombreOrdenProducto.php">Crear Orden de Compra de Productos</a></li>
                <li><a href="opciones/Ordenes de Compra Productos/verOrdenes.php">Ver Órdenes de Compra Producto</a> </li>
            </ul>
            </li>
            <li>
            <a href="#" class="dropdownNombre"> Productos ▼</a>
            <ul class="dropdown">
            <li><a href="opciones/Productos\CrearProducto.php">Crear Producto</a></li>
            <li><a href="opciones/Productos\verProductos.php">Ver Productos</a></li>
            <li><a href="opciones/Productos/verGraficosMasVendidos.php">Ver Gráficos</a></li>
            </ul>
            </li>
        
        <li>
        <a href="#" class="dropdownNombre"> Insumos ▼</a>
        <ul class="dropdown">
        <li><a href="opciones/Insumos/registrarInsumo.php">Registrar Insumo</a></li>
            <li><a href="opciones/Insumos/verInsumos.php">Ver Insumos</a></li>
            <li><a href="opciones/Insumos/verGraficos.php">Ver Gráficos</a></li>
        </ul>
    </li>
    </ul>
    </nav>
    <main>
        <h1>Laboratorio de Productos de Limpieza</h1>
        <p>Tu mejor opcion en químicos</p>
    </main>
    <footer>
    <img src="../../img/logo.jpg" class="LogoQuimicaroma"></img>
    <p>Copyright © 2023. Todos los derechos reservados. Pagina hecha por Fernando Ochoa</p>
    <a href="../../cerrarsesion.php">Cerrar Sesión</a>
</footer>
</body>

</html>
