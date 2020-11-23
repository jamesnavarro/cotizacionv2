<?php
include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

$idservi = $_GET["idservi"];
$cotizacion = $_GET["cotizacion"];
$cliente = $_GET["cliente"];

$sql = "DELETE FROM cotizaciones_servicios WHERE id_cot_serv = ".$idservi."";
mysqli_query($conexion,$sql);

$clases->mostrarItems6($cotizacion,$cliente); 

?>