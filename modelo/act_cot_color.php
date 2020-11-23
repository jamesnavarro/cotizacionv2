<?php
require '../modelo/conexion.php';
$m = mysqli_query($conexion,"update cotizaciones set color_ta='".$_POST['col']."' where id_cot='".$_POST['cot']."' ") ;
echo $m;

