<?php
session_start();
date_default_timezone_set("America/Bogota" ) ; 
        $hora = date('h:i a',time() - 3600*date('I'));
include 'modelo/conexion.php';
$sql = "delete from control_ip where `ip` = ".$_SESSION["id_user"].";";
    mysql_query($sql, $conexion);
if(!isset($_SESSION['k_username'])){

header("location:../principal/index.php");
} else {

session_unset();
session_destroy();
header("location:../principal/index.php");
}
?>
