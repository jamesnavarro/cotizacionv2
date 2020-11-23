<?php
include '../modelo/conexion.php';
session_start();
$sql2m = "SELECT count(*) FROM mensajes where visto=0 and id_receptor=".$_SESSION['id_user']." ";
$fi =mysqli_fetch_array(mysqli_query($conexion,$sql2m));
$mx = $fi[0];
echo $mx;
?>
  

                         