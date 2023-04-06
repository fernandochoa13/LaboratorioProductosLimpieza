<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include "../../../Database/dbconexion.php";//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('logo.jpg', 270, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('Quimicaroma'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Maracaibo"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : +58 4246531518"), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : fernandojochoa@hotmail.com"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : Maracaibo"), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetFillColor(83, 184, 180); //colorFondo
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE PRODUCTOS"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(83, 184, 180); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 8);
      $this->Cell(7, 10,  utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Producto'), 1, 0, 'C', 1);
      $this->Cell(10, 10, utf8_decode('Precio'), 1, 0, 'C', 1);
      $this->Cell(12, 10, utf8_decode('Ventas'), 1, 0, 'C', 1);
      $this->Cell(28, 10, utf8_decode('Estatus'), 1, 0, 'C', 1);
      $this->Cell(12, 10, utf8_decode('Stock'), 1, 0, 'C', 1);
      $this->Cell(180, 10, utf8_decode('Insumos'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include "../../../Database/dbconexion.php";
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_producto = $conn->query(" SELECT * from producto");

while ($datos_reporte = $consulta_reporte_producto->fetch_object()) {
   if($datos_reporte->tipoOrden == 0) {     
   $estatus = "";
   if($datos_reporte->estatusProduccion == 0){
      $estatus = "Fuera de produccion";
   } else {
      $estatus = "Produciendo";
   }
   $i = $i + 1;      
$pdf->Cell(7, 10, utf8_decode($datos_reporte->idProducto), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($datos_reporte->nombreProducto), 1, 0, 'C', 0);
$pdf->Cell(10, 10, utf8_decode($datos_reporte->precio), 1, 0, 'C', 0);
$pdf->Cell(12, 10, utf8_decode($datos_reporte->ventas), 1, 0, 'C', 0);
$pdf->Cell(28, 10, utf8_decode($estatus), 1, 0, 'C', 0);
$pdf->Cell(12, 10, utf8_decode($datos_reporte->stock), 1, 0, 'C', 0);
$pdf->Cell(180,10,  utf8_decode($datos_reporte->Insumos), 1, 1, 'C',0);
   } }


$pdf->Output('Prueba2.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
