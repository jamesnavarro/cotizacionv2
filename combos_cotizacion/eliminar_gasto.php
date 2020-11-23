<?php
include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

$idgasto = $_GET["idgasto"];
$codigo = $_GET["codigo"];

$sql = "DELETE FROM producto_rep_ad WHERE id_rep_ad = ".$idgasto."";
mysqli_query($conexion,$sql);

$clases->mostrarItems11($codigo); 

?>