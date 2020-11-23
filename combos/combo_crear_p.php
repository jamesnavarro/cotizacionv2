<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido4"])) {

    
    $rpta2 = $rpta2.'<td>Altura Cuerpo Fijo (mm)</td>';
    $rpta2= $rpta2.'<td><input type="text" name="altura"  value="0" style="width:20%;" placeholder="" required></td>';
    $rpta2= $rpta2.'<td>Altura Ventana Corrediza (mm)</td>';
    $rpta2= $rpta2.'<td><input type="text" name="altura_v_c"  value="" style="width:20%;" > # Hojas: <input type="text" style="width:20%;" name="hoja"  value="2" ></td>';
}	
echo $rpta2;
