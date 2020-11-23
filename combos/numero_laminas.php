<?php
include "../modelo/conexion.php";
$rpta2="";
if($_GET['codigo']==0){
$rpta2= $rpta2.'<option value="">Seleccione</option>                                                        
                                    <option value="0">N/A</option>';
}else{
    if($_GET['codigo']==1){
$rpta2= $rpta2.'<option value="">Seleccione</option>                                                        
                                    <option value="1">1</option>';
}else{
   $rpta2= $rpta2.'<option value="">Cantidad</option>                                                        
                                    <option value="1">1</option>    
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>'; 
}}
echo $rpta2;