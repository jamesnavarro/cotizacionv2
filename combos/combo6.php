<?php
include "../modelo/conexion.php";
$rptam="";
if (isset($_POST["elegido3"])) {

if($_POST["elegido3"]=='Vertical'){
    $rptam= $rpta.'<option value="Alto">Alto</option>';
}  else {
    $rptam= $rpta.'<option value="Ancho">Ancho</option>';
}
    
    
    
  	
}	
echo $rptam;