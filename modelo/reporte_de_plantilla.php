<?php
require("conexion.php");
$cot = $_GET['cot'];
 mysqli_query($conexion,"DELETE FROM `costo_totales` WHERE `id_cot` = '".$cot."'");
 
$query_cot = mysqli_query($conexion,"select id_cotizacion,id_compuesto from cotizaciones where id_cot='$cot' ");
$c = 0;
while ($cr = mysqli_fetch_array($query_cot)){
   
    $id_items = $cr[0];
    $_GET['item'] = $cr[0];
    $id_comp = $cr[1];
   
    include '../vistas/cotizacion/calculo_producto_reporte.php';
    if($cr['id_compuesto']==0){
        $c++;
    }
}
echo $c;

