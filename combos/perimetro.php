<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["nombre"])) {
    if($_POST["nombre"]=='Und'){
        $rpta2= $rpta2.'<input type="text" name="cant_acc"  value="" placeholder="">';
    }else{
        $rpta2= $rpta2.'<input type="text" name="cant_acc"  value="1" placeholder="" readonly>';
}}	
echo $rpta2;