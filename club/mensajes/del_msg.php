<?php
include '../../modelo/conexion.php';
$sql2m = mysqli_query($conexion,"update mensajes set borrado=1 WHERE id=".$_GET['id']." ");

?>
  

                         