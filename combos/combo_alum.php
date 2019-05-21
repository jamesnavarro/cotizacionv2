<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido2"])) {
    if($_POST["elegido2"]=="Vidrio"){
        $rpta2= $rpta2.'<input type="text" name="alum"  value="N/A" placeholder="" readonly>';
    }else{
   $con= "SELECT * FROM `tipo_aluminio`";
    $res=  mysql_query($con);
    $rpta2 = $rpta2.'<select name="alum"  required style="width: 120px;">';
    while($f=  mysql_fetch_array($res)){
    $idco=$f['color_a'];
    $nombre1=$f['color_a'];
    
    $rpta2= $rpta2.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }
     $rpta2 = $rpta2.'</select>';
}}	
echo $rpta2;