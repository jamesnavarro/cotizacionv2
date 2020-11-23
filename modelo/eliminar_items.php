<?php 
    include '../modelo/conexion.php';

    $res = 'select * from cotizaciones a, producto b  where a.id_referencia=b.id_p and a.id_cotizacion='.$_GET['idcotizacion'].' ';
    $f =mysqli_fetch_array(mysqli_query($conexion,$res));
    $a = $f['producto'];

    $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
    $sqlr.= "VALUES ('Se Elimino el producto ".$a." ', '".$_GET['cotizacion']."', '".$_SESSION['k_username']."', 'Cotizacion')";
    mysqli_query($conexion,$sqlr);

    $sql = "DELETE FROM cotizaciones WHERE id_cotizacion=".$_GET['idcotizacion']."";
    mysqli_query($conexion,$sql);
                       
?>