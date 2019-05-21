<?php
include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegido"])) {
   $con= "SELECT * FROM `cotizaciones` where id_cotizacion='".$_POST["elegido"]."'";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $cant=$f['cantidad_c'];
    $cantp=$f['cant_restante'];
    $tr = $cant - $cantp;
    $ancho=$f['ancho_c'];
    $alto=$f['alto_c'];
    
//    $rpta= $rpta.'<option value="'.$cant.'">'.$cant.'</option>';
  
    $rpta=$rpta.'<div class="controls">
                                                   <input type="text" name="cantidadu" value='.$cantp.' readonly>
                                               </div><label></label><div class="controls"> </div>
                                             
                                                 <label class="control-label">Ancho Real</label>
                                               <div class="controls">
                                                   <input type="text" name="ancho1" value='.$ancho.'>
                                               </div><label></label><div class="controls"> </div>
                                                 <label></label><div class="controls"> </div>
                                                 <label class="control-label">Alto Real</label>
                                               <div class="controls">
                                                   <input type="text" name="alto1" value='.$alto.'>
                                               </div><label></label><div class="controls"> </div>';
    }
  	
}

	
echo $rpta;
?>