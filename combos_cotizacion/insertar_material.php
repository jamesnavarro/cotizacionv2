<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["idrefe"];
    $cant= $_GET["cant"];
    $desc= $_GET["desc"];
    $color= $_GET["color"];
    $mp= $_GET["mp"];
    $med= $_GET["medida"];
    
    $sql = "INSERT INTO `cotizaciones_materiales` (`color_ma`, `med`, `pe`, `id_cotizacion`, `id_material`, `cantidad_mat`, `descuento_mat`)";
    $sql.= "VALUES ('".$color."', '".$med."', '".$mp."','".$cotizacion."', '".$servicio."', '".$cant."', '".$desc."')";
    mysqli_query($conexion,$sql);
    $status = "ok";
            
    $clases->mostrarItems7($cotizacion,$cliente); 
?>