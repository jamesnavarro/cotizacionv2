<?php
include '../../modelo/conexion.php';
$cot = $_GET['iditems'];
$query_cot = mysql_query("select id_cotizacion,id_compuesto from cotizaciones where id_compuesto='$cot'  ");
$c = 0;
while ($cr = mysql_fetch_array($query_cot)){
   
    $id_items = $cr[0];
    $_GET['item'] = $cr[0];
    echo $_GET['item'];
    include 'dt.php';
    $_GET['item'] = '';
    
}
