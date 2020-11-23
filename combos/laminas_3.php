<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["producto"])) {
    if ($_POST["id"]=='') {
        
    }else{
    $cons= mysqli_query($conexion,"SELECT * FROM `producto` where id_p=".$_POST["id"]." ");
        $h=  mysqli_fetch_array($cons);
        $hoja = $h['hoja'];
           if($hoja >=4){
   $rpta2= $rpta2.'<select name="laminas4" id="lamina4"  required>
                                                        <option value="">Cantidad de laminas vidrio #4</option> 
                                                        <option value="0">N/A</option> 
                                                        <option value="1">1</option>  
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        </select>';
}
          
}}
  	
echo $rpta2;