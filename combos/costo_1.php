<?php
include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegidoc"])) {
   $con= "SELECT * FROM `referencias` where id_referencia='".$_POST["elegidoc"]."'";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $cant=$f['costo_mt'];
   
    
    
//    $rpta= $rpta.'<option value="'.$cant.'">'.$cant.'</option>';
    $rpta= $rpta.'<input type="text" name="costo"  value="'.$cant.'"  style="width: 60px;">';
    }
  	
}

	
echo $rpta;
?>