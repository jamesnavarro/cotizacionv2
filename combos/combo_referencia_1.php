<?php
include "../modelo/conexion.php";
$rptarr="";
if (isset($_POST["buscar"])) {
   $con= "SELECT * FROM `referencias` where id_referencia=".$_POST["buscar"];
    $res=  mysqli_query($conexion,$con);
    
    while($f=  mysqli_fetch_array($res)){
    $nombre1=$f['id_referencia'];
     $ref=$f['referencia'];
    $rptarr= $rpta.'<option value="'.$nombre1.'">'.$ref.'</option>';
    }
    
  	
}	
echo $rptarr;
?>