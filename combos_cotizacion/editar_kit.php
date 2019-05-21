<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $idkit = $_GET["idkit"];
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["idrefe"];
    $cant= $_GET["cant"];
    $desc= $_GET["desc"];
    $color= $_GET["color"];
    $mp= $_GET["mp"];

    $sql = "UPDATE `cotizaciones_kit` SET `color_k`='".$color."', `por_k`='".$mp."', `id_producto`='".$servicio."',`cantidad_k`='".$cant."',`desc_k`='".$desc."' WHERE `id_ck` = ".$idkit.";";
    mysql_query($sql, $conexion);
    
    $clases->mostrarItems8($cotizacion,$cliente); 
    
    
    
?>

