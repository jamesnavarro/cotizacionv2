<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido2"])) {
   $con= "SELECT * FROM `producto` where id_p='".$_POST["elegido2"]."'";
    $res=  mysql_query($con);
   
    while($f=  mysql_fetch_array($res)){
 
    $nombre1=$f['ruta'];
    
    if($nombre1==''){
         $rpta2 = $rpta2.'<img src="../producto/no.jpg">';
    }else{
         $rpta2 = $rpta2.'<img src="../producto/'.$nombre1.'">';
    }
   
        
    }
    
}	
echo $rpta2;