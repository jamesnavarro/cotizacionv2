<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegid"])) {
    //consulata de hojas 
    $cons= "SELECT * FROM `producto` where linea='VIDRIO' and id_p=".$_POST["id"]." ";
        $h=  mysql_query($cons);
        $hoja = $h['hoja'];
    if($_POST["elegid"]=='ALUMINIO' || $_POST["elegid"]=='FACHADA' || $_POST["elegid"]=='VIDRIO'){
        
    if($_POST["elegid"]=='Vidrio'){
        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$_POST["id"]." ";
        $res=  mysql_query($con);
    $f=  mysql_fetch_array($res);
                    $idco=$f['id_p'];
                    $nombre1=$f['producto'];
                    $rpta2= $rpta2.'<option  value="'.$idco.'">'.$nombre1.'</option>';
                    
    }else{
        $con= "SELECT * FROM `producto` where linea='VIDRIO'";
        $res=  mysql_query($con);
    $rpta2= $rpta2.'<option value="">Seleccione la trazabilidad</option>';
    $rpta2= $rpta2.'<option value="0">No tiene vidrio</option>'; 
    while($f=  mysql_fetch_array($res)){
                    $idco=$f['id_p'];
                    $nombre1=$f['producto'];
                    $rpta2= $rpta2.'<option value="'.$idco.'">'.$nombre1.'</option>';
                    }
    }
                    }else{
                      $rpta2= $rpta2.'<option value="0">Ya tiene</option>';  
                    }
}	
echo $rpta2;