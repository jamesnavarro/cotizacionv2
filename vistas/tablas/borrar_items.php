<?php
include '../../modelo/conexion.php';
mysql_query("delete from producto where id_p=".$_GET['id']." ");
echo $_GET['id'];

