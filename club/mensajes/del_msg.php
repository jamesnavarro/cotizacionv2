<?php
include '../../modelo/conexion.php';
$sql2m = mysql_query("update mensajes set borrado=1 WHERE id=".$_GET['id']." ");

echo 'ola';
?>
  

                         