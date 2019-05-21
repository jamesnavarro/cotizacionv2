<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $idmate = $_GET["idmate"];
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["idrefe"];
    $cant= $_GET["cant"];
    $desc= $_GET["desc"];
    $color= $_GET["color"];
    $mp= $_GET["mp"];
    $med= $_GET["medida"];

    $sql = "UPDATE `cotizaciones_materiales` SET `color_ma`='".$color."', `med`='".$med."', `pe`='".$mp."', `id_material`='".$servicio."',`cantidad_mat`='".$cant."',`descuento_mat`='".$desc."' WHERE `id_cot_mat` = ".$idmate.";";
    mysql_query($sql, $conexion);
    
    $clases->mostrarItems7($cotizacion,$cliente); 
    
    
    
?>

