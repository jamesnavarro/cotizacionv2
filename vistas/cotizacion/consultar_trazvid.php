<?php
$con= "SELECT * FROM `producto` where  id_p=".$idtraz." ";
$res=  mysqli_query($conexion,$con);
$f=  mysqli_fetch_array($res);
$nombre_trazabilidad = $f['producto'];

