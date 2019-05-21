<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["id"])) {
   $con= "SELECT * FROM `producto` where id_p='".$_POST["id"]."'";
    $res=  mysql_query($con);
   
    while($f=  mysql_fetch_array($res)){
 
    $nombre1=$f['ruta'];
    
    if($nombre1==''){
         $rpta2 = $rpta2.'<div align="center"><img src="../producto/no.jpg" width=120px heigth=120px></div>';
    }else{
         $rpta2 = $rpta2.'<div align="center"><img src="../producto/'.$nombre1.'"  width=120px heigth=120px></div>';
    }
   
        
    }
    
}	
echo $rpta2;