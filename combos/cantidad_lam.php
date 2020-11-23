<?php
include "../modelo/conexion.php";
$mod = "";
if (isset($_POST["elegid"])) {
    //consulata de hojas 
    if ($_POST["id"]=='') {
         echo '<font color="red">Por Favor seleccione una referencia</font>';
    }else{
        $cons= mysqli_query($conexion,"SELECT * FROM `producto` where id_p=".$_POST["id"]." ");
        $h=  mysqli_fetch_array($cons);
        echo $h['laminas'];
        
    }
}

