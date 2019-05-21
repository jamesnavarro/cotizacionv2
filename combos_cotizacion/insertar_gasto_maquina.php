<?php
    
    include '../modelo/conexion.php';
    include '../clases/clases.php'; 
    
    $clases = new general;
    
    $codigo = $_GET['codigo'];
    $ref = $_GET['refe'];
    
    $sql = "INSERT INTO `producto_rep_ma` (`id_ref_ma`, `id_p`)";
    $sql.= "VALUES ('".$ref."', '".$codigo."')";
    mysql_query($sql, $conexion);
    
    $clases->mostrarItems9($codigo); 
?>
