<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegid"])) {
    //consulata de hojas 
    $cons= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$_POST["id"]." ";
        $h=  mysqli_query($conexion,$cons);
        $hoja = $h['hoja'];
    if($_POST["elegid"]=='Aluminio' || $_POST["elegid"]=='Fachada' || $_POST["elegid"]=='Vidrio'){
        
    if($_POST["elegid"]=='Vidrio'){
        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$_POST["id"]." ";
        $res=  mysqli_query($conexion,$con);
    $f=  mysqli_fetch_array($res);
                    $idco=$f['id_p'];
                    $nombre1=$f['producto'];
                    $rpta2= $rpta2.'<option  value="'.$idco.'">'.$nombre1.'</option>';
                    
    }else{
        $con= "SELECT * FROM `producto` where linea='Vidrio'";
        $res=  mysqli_query($conexion,$con);
    $rpta2= $rpta2.'<option value="">Seleccione la trazabilidad</option>';
    $rpta2= $rpta2.'<option value="0">No tiene vidrio</option>'; 
    while($f=  mysqli_fetch_array($res)){
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