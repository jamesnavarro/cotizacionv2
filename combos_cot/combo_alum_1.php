<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido2"])) {
    if ($_POST["id"]=='') {
        echo 'Por Favor seleccione una referencia';
    }else{
 $cons= mysql_query("SELECT * FROM `producto` where id_p=".$_POST["id"]." ");
        $h=  mysql_fetch_array($cons);
        $hoja = $h['hoja'];
    if($_POST["elegido2"]=="VIDRIO"){
        $rpta2= $rpta2.'<input type="text" name="hoja" id="hojax" value="N/A" placeholder="" readonly>';
    }else{

    $rpta2= $rpta2.'<input type="text" name="hoja" id="hojax" readonly  value="'.$hoja.'" placeholder="" style="width:60px;">';
}}	}
echo $rpta2;