<?php
include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegidoc"])) {
   $con= "SELECT * FROM `tipo_vidrio` where id_vidrio='".$_POST["elegidoc"]."'";
    $res=  mysqli_query($conexion,$con);
    
    while($f=  mysqli_fetch_array($res)){
    $cant=$f['costo_v'];
   
    
    
//    $rpta= $rpta.'<option value="'.$cant.'">'.$cant.'</option>';
    $rpta= $rpta.'<input type="text" name="costo"  value="'.$cant.'"  style="width: 60px;">';
    }
  	
}

	
echo $rpta;
?>