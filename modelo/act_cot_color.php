<?php
require '../modelo/conexion.php';
$m = mysql_query("update cotizaciones set color_ta='".$_POST['col']."' where id_cot='".$_POST['cot']."' ") or die(mysql_error());
echo $m;

