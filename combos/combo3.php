<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido2"])) {
 $rpta2= $rpta2.' <select name="lado"  id="select2_1"  required> 
     <option value="">Seleccione</option> <option value="N/A">N/A</option>
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>';
     $rpta2= $rpta2.'</select>';

}	
echo $rpta2;