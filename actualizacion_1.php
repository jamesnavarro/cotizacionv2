<?php
include "modelo/conexion.php";
echo 'ola'.$conexion;
ini_set('max_execution_time', 1000);
$query = mysqli_query($conexion,"select color,id_referencia from conf_referencias where id_linea_ref=1 ");
$c = 0;
while($q = mysqli_fetch_row($query)){
    $c +=1;
    $color = $q[0];
    $id_p = $q[1];
    //mysqli_query($conexion,"insert into producto_rep_ad (id_p, id_ref_ad) values ('$id_p', '15') ");
    mysqli_query($conexion,"update relacion_referencias set color='".$color."' where id_referencia='$id_p' and cargado='1' ");
    
}
echo $c;


