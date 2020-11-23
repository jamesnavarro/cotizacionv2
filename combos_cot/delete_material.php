<?php
include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $mas = $_GET["mas"];
    $por = $_GET["por"];
    $idmaterial = $_GET["idmaterial"];
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];

    $sql = "DELETE FROM referencia_acce WHERE id_ref_acce = ".$idmaterial."";
    mysqli_query($conexion,$sql);

    $clases->mostrarItems6($cotizacion,$cliente,$mas,$por); 

?>