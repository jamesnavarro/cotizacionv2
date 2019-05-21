<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["servicio"];
    $cant = $_GET["cant"];
    $desc = $_GET["desc"];
    
    $sql = "INSERT INTO `cotizaciones_servicios` (`id_cotizacion`, `id_servicio`, `cantidad_serv`, `descuento_serv`)";
    $sql.= "VALUES ('".$cotizacion."', '".$servicio."', '".$cant."', '".$desc."')";
    mysql_query($sql, $conexion);
    $status = "ok";
            
    $clases->mostrarItems6($cotizacion,$cliente); 
?>