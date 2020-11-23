<?php
include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

$idmate = $_GET["idmate"];
$cotizacion = $_GET["cotizacion"];
$cliente = $_GET["cliente"];

$sql = "DELETE FROM cotizaciones_materiales WHERE id_cot_mat = ".$idmate."";
mysqli_query($conexion,$sql);

$clases->mostrarItems7($cotizacion,$cliente); 

?>