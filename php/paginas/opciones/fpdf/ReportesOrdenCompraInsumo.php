<?php
$id = $_GET['id'];
require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include "../../../Database/dbconexion.php";//llamamos a la conexion BD

     // $consulta_info = $conn->query(" select * from usuario where idusuario=$id ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();

      $this->Image('logo.jpg', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('Quimicaroma'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Maracaibo"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : +58 4246531518"), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : fernandojochoa@hotmail.com"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : Maracaibo"), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(83, 184, 180);
      $this->Cell(45); // mover a la derecha
      $this->SetFont('Arial', 'B', 12);
      $this->Cell(100, 10, utf8_decode("REPORTE DE ORDEN DE COMPRA DE INSUMOS "), 0, 1, 'C', 0);
      $this->Ln(8);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(83, 184, 180); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 8);
      $this->Cell(10, 10,  utf8_decode('Id'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Estatus'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('nombreOrden'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('presupuesto'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('fechaCreacion'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Insumo'), 1,0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Cantidad'), 1, 1, 'C', 1);
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
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include "../../../Database/dbconexion.php";


$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_orden = $conn->query("SELECT * from orden INNER JOIN insumo_has_orden ON orden.idorden = insumo_has_orden.orden_idorden where idorden=$id ");
$consulta_reporte_insumos = $conn->query("SELECT * from insumo");
$arrayInsumos = mysqli_fetch_array($consulta_reporte_insumos);

while ($datos_reporte = $consulta_reporte_orden->fetch_object()) {
   $i = $i + 1;     
   $estatus = "No procesado";
   if($datos_reporte->estatus == 1) {
      $estatus = "Procesado";
   } 
$pdf->Cell(10, 10, utf8_decode($datos_reporte->idorden), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($estatus), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($datos_reporte->nombreOrden), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($datos_reporte->presupuesto), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($datos_reporte->fechaCreacion), 1, 0, 'C', 0);
$consulta_reporte_insumos = $conn->query("SELECT nombreInsumo from insumo where idInsumo=$datos_reporte->insumo_idinsumo");
$row = mysqli_fetch_array($consulta_reporte_insumos);
$pdf->Cell(50, 10, utf8_decode($row[0]), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($datos_reporte->cantidad), 1, 1, 'C', 0);
//$pdf->Cell(40,10,  utf8_decode($datos_reporte->Insumos), 1, 1, 'C', 0);
   }



   

/* TABLA */



$pdf->Output('Prueba.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
