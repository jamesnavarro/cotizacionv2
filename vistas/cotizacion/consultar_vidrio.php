<?php
$sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio;
$fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
$color_vidrio = $fila["color_v"].' - ('.$fila["espesor_v"].')mm';

