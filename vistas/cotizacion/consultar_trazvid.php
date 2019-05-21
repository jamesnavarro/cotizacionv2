<?php
$con= "SELECT * FROM `producto` where  id_p=".$idtraz." ";
$res=  mysql_query($con);
$f=  mysql_fetch_array($res);
$nombre_trazabilidad = $f['producto'];

