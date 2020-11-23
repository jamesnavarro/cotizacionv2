<?php
//Desarrollado por Jesus Li��n
//webmaster@ribosomatic.com
//ribosomatic.com
//Puedes hacer lo que quieras con el c�digo
//pero visita la web cuando te acuerdes

//Configuracion de la conexion a base de datos
$bd_host = "localhost"; 
$bd_usuario = "samplevi_templa"; 
$bd_password = "20031123003"; 
$bd_base = "samplevi_cotizacion"; 
$con = mysqli_connect($bd_host, $bd_usuario, $bd_password); 
mysqli_select_db($bd_base, $con); 

//variables POST
$idemp=$_POST['id_referencia'];
$nom=$_POST['descripcion'];
$suel=$_POST['costo_mt'];

//actualiza los datos del empleados
$sql="UPDATE referencias SET descripcion='$nom', costo_mt='$suel' WHERE id_referencia=$idemp";

mysqli_query($conexion,$sql,$con);

include '../form/precios.php';
?>