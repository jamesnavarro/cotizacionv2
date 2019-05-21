<?php
include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegido2"])) {
   
    
    if($_POST["elegido2"]=='Vidrio'){
        $rpta= $rpta.'<option value="No">No</option>';
    }else{
         if($_POST["elegido2"]=='Aluminio'){
            $rpta= $rpta.'<option value="Si">Si</option><option value="No">No</option>';
        }else{
            $rpta= $rpta.'<option value="Si">Si</option><option value="No">No</option>';
        }
    }
 
}	
echo $rpta;
?>