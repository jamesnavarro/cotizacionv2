<?php
include '../../modelo/conexion.php';
mysqli_query($conexion,"delete from producto where id_p=".$_GET['id']." ");
echo $_GET['id'];

