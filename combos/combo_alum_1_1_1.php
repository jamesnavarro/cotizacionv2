<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido2"])) {
    if($_POST["elegido2"]=="Vidrio" || $_POST["elegido2"]=="Fachada"){
     
        if($_POST["elegido2"]=="Fachada"){
            $rpta2= $rpta2.'<label class="control-label">Digite la cantidad de verticales y horizontales</label>
            <div class="controls"><input type="text" name="vert"  value="" placeholder="Verticales" style="width: 70px;">
            <input type="text" name="hori"  value="" placeholder="Horizontales" style="width: 70px;"></div><br>
            <label class="control-label">Digite la Distacia entre secciones en Milimetros</label>
            <div class="controls"><input type="text" name="d1"  value="1000" placeholder="Distancia ancho" style="width: 70px;">
            <input type="text" name="d2"  value="1000" placeholder="Distacia alto" style="width: 70px;"></div>';
        }else{
            $rpta2= $rpta2.'<input type="hidden" name="cuerpo"  value="0" placeholder="" readonly>';
        }
        
    }else{
        $rpta2= $rpta2.'<label class="control-label">Si tiene Cuerpo fijo o rejilas por favor digite la medida</label>
            <div class="controls"><input type="text" name="cuerpo"  value="0" placeholder=""  style="width:60px;"></div>';
}}	
echo $rpta2;