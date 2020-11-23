<?php
include "../modelo/conexion.php";
$rptart="";
if (isset($_POST["nombre"])) {
   $con= "SELECT * FROM `referencias` where id_referencia=".$_POST["nombre"];
    $res=  mysqli_query($conexion,$con);
    
    $f=  mysqli_fetch_array($res);
    echo $nombre1t=$f['grupo'];
  
    
  	
}	

?>