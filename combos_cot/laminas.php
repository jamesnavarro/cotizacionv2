<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["linea"])) {
    if ($_POST["id"]=='') {
        echo '<font color="red">Por Favor seleccione una referencia</font>';
    }else{
    $cons= mysql_query("SELECT * FROM `producto` where id_p=".$_POST["id"]." ");
    $h=  mysql_fetch_array($cons);
        $hoja = $h['hoja'];
            if($_POST["linea"]=="Vidrio"){
                $rpta2= $rpta2.'<select name="laminas" id="laminax"  style="width: 80px;" required>                                                       
                                    <option value="">Cantidad</option>                                                        
                                    <option value="1">1</option>    
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>';
            }else{
                if($_POST["linea"]=='Acero'){
                    $rpta2= $rpta2.'<select name="laminas" id="laminax" required>
                                        <option value="">Cantidad de laminas vidrio #1</option> 
                                        <option value="0">N/A</option> 
                                    </select>';
                }else{
                    $rpta2= $rpta2.'<select name="laminas" id="laminax" required>
                                        <option value="">Cantidad de laminas vidrio #1</option> 
                                        <option value="0">N/A</option> 
                                        <option value="1">1</option>  
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>'; 
                }
            }
    }
}	
echo $rpta2;