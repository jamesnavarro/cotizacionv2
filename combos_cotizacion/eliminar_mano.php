<?php
include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

$idmano = $_GET["idmano"];
$codigo = $_GET["codigo"];

$sql = "DELETE FROM producto_rep_mo WHERE id_rep_mo = ".$idmano."";
mysqli_query($conexion,$sql);

$clases->mostrarItems10($codigo); 

?>