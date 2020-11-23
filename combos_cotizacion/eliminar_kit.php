<?php
include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

$idkit = $_GET["idkit"];
$cotizacion = $_GET["cotizacion"];
$cliente = $_GET["cliente"];

$sql = "DELETE FROM cotizaciones_kit WHERE id_ck = ".$idkit."";
mysqli_query($conexion,$sql);

$clases->mostrarItems8($cotizacion,$cliente); 

?>