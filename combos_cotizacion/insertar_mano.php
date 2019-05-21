<?php
    
    include '../modelo/conexion.php';
    include '../clases/clases.php'; 
    
    $clases = new general;
    
    $codigo = $_GET['codigo'];
    $ref = $_GET['refe'];
    
    $sql = "INSERT INTO `producto_rep_mo` (`id_ref_mo`, `id_p`)";
    $sql.= "VALUES ('".$ref."', '".$codigo."')";
    mysql_query($sql, $conexion);

    $status = "ok";
    
    $clases->mostrarItems10($codigo); 
?>
