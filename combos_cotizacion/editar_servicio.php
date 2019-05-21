<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $idservi = $_GET["idservi"];
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["servicio"];
    $cant = $_GET["cant"];
    $desc = $_GET["desc"];

    $sql = "UPDATE `cotizaciones_servicios` SET `id_servicio`='".$servicio."',`cantidad_serv`='".$cant."',`descuento_serv`='".$desc."' WHERE `id_cot_serv` = ".$idservi.";";
    mysql_query($sql, $conexion);
    
    $clases->mostrarItems6($cotizacion,$cliente); 
    
    
    
?>

