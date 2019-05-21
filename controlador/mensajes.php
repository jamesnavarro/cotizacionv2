<?php
include "../modelo/conexion.php";
if(isset($_SESSION['k_username'])){

     if($_GET['id']=='msg'){include '../club/mensajes/index.php';}
}else {header("location:../index.php");} 
?>