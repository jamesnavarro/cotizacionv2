<?php
include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

$id_cotizacion = $_GET['idcotizacion'];
$cotizacion = $_GET['cotizacion'];
$cliente = $_GET['cliente'];

$sql = "DELETE FROM cotizaciones WHERE id_cotizacion = ".$id_cotizacion."";
mysql_query($sql, $conexion);

$clases->mostrarItems5($cotizacion,$cliente); 

?>