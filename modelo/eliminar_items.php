<?php 
    include '../modelo/conexion.php';

    $res = 'select * from cotizaciones a, producto b  where a.id_referencia=b.id_p and a.id_cotizacion='.$_GET['idcotizacion'].' ';
    $f =mysql_fetch_array(mysql_query($res));
    $a = $f['producto'];

    $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
    $sqlr.= "VALUES ('Se Elimino el producto ".$a." ', '".$_GET['cotizacion']."', '".$_SESSION['k_username']."', 'Cotizacion')";
    mysql_query($sqlr, $conexion);

    $sql = "DELETE FROM cotizaciones WHERE id_cotizacion=".$_GET['idcotizacion']."";
    mysql_query($sql, $conexion);
                       
?>