<?php
$servidorbd = "localhost";
$usuarioBaseDatos = "root";
$claveBaseDatos = "T3mpl@d02o2o*";
$baseDatos = "virtuald_templadosa";

$conexion = @mysqli_connect($servidorbd,$usuarioBaseDatos,$claveBaseDatos,$baseDatos);

if(!$conexion){
        die("imposible conectarse: ".mysqli_error($conexion));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
?>
