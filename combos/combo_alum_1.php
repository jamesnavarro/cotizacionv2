<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido2"])) {
    if ($_POST["id"]=='') {
        echo 'Por Favor seleccione una referencia';
    }else{
 $cons= mysqli_query($conexion,"SELECT * FROM `producto` where id_p=".$_POST["id"]." ");
        $h=  mysqli_fetch_array($cons);
        $hoja = $h['hoja'];
    if($_POST["elegido2"]=="Vidrio"){
        $rpta2= $rpta2.'<input type="text" name="hoja"  value="N/A" placeholder="" readonly>';
    }else{

    $rpta2= $rpta2.'<input type="text" name="hoja" readonly  value="'.$hoja.'" placeholder="" style="width:60px;">';
}}	}
echo $rpta2;