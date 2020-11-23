<?php
    
    include '../modelo/conexion.php';
    include '../clases/clases.php'; 
    
    $clases = new general;
    
    $codigo = $_GET['codigo'];
    $ref = $_GET['refe'];
    
    $sql = "INSERT INTO `producto_rep_ad` (`id_ref_ad`, `id_p`)";
    $sql.= "VALUES ('".$ref."', '".$codigo."')";
    mysqli_query($conexion,$sql);
    
    $clases->mostrarItems11($codigo); 
?>
