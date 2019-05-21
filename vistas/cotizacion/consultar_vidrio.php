<?php
$sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio;
$fila =mysql_fetch_array(mysql_query($sql));
$color_vidrio = $fila["color_v"].' - ('.$fila["espesor_v"].')mm';

