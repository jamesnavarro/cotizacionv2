<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["refe"];
    $color = $_GET["color"];
    $cant = $_GET["cant"];
    $desc = $_GET["desc"];
    $mp = $_GET["mp"];
    
    $sql = "INSERT INTO `cotizaciones_kit` (`color_k`, `por_k`, `id_cot`, `id_producto`, `cantidad_k`, `desc_k`)";
    $sql.= "VALUES ('".$color."', '".$mp."','".$cotizacion."', '".$servicio."', '".$cant."', '".$desc."')";
    mysql_query($sql, $conexion);
    $status = "ok";
            
    $clases->mostrarItems8($cotizacion,$cliente); 
?>