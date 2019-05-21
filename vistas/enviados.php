<?php
include '../modelo/conexion.php';
session_start();
$sql2m = "SELECT count(*) FROM mensajes where visto=0 and id_receptor=".$_SESSION['id_user']." ";
$fi =mysql_fetch_array(mysql_query($sql2m));
$mx = $fi[0];
echo $mx;
?>
  

                         