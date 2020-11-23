<?php
 
//Configuracion de la conexion a base de datos
  $bd_host = "localhost"; 
  $bd_usuario = "samplevi_templa"; 
  $bd_password = "20031123003"; 
  $bd_base = "samplevi_templados"; 
 
$con = mysqli_connect($bd_host, $bd_usuario, $bd_password); 
mysqli_select_db($bd_base, $con); 
 
//variables POST
  $id=$_POST['id'];
  $valor=$_POST['valor'];

 
//registra los datos del empleados
  $sql="UPDATE `referencias` SET `costo_mt`='".$valor."' WHERE `id_referencia` = ".$id.";";
mysqli_query($conexion,$sql,$con) or die('Error. '.mysqli_error());
 

?>
