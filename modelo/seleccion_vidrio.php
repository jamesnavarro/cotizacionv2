<?php
include "../modelo/conexion.php";
$rpta2="";$mod = "";
if (isset($_POST["elegid"])) {
    //consulata de hojas 
    if ($_POST["id"]=='') {
         echo '<font color="red">Por Favor seleccione una referencia</font>';
    }else{
    $cons= mysqli_query($conexion,"SELECT * FROM `producto` where id_p=".$_POST["id"]." ");
        $h=  mysqli_fetch_array($cons);
        $hoja = $h['hoja'];
        
        if($_POST["linea"]=='VIDRIO' || $_POST["linea"]=='Vidrio'){
        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$_POST["id"]." ";
        $res=  mysqli_query($conexion,$con);
    $f=  mysqli_fetch_array($res);
                    $idco=$f['id_p'];
                    $nombre1=$f['producto'];
                    $rpta2= $rpta2."<input type='hidden' name='traz_vid' value='$idco'  required>"
                            . "<input type='text' readonly='readonly' name='xxxnv' value='$nombre1' id='xxx1'  required  onclick='vidrio()'><input type='hidden' name='modulo' value='1'  required >  ";
                     
               
    }else{

        if($hoja >=1){
$rpta2= $rpta2."<input type='hidden' name='traz_vid' id='valo1'  required>"
        . "<input type='text' readonly='readonly' placeholder='Vidrios del modulo 1' name='xxxnv' id='valo2'  required onclick='vidrio()'>";
}
        if($hoja >=2){
$rpta2= $rpta2."<input type='hidden' name='traz_vid2' id='valo3'  required>"
        . "<input type='text' readonly='readonly' placeholder='Vidrios del modulo 2' name='xxxnv2' id='valo4'  required onclick='vidrio2()'>";
}
        if($hoja >=3){
$rpta2= $rpta2."<input type='hidden' name='traz_vid3' id='valo5'  required>"
        . "<input type='text' readonly='readonly' placeholder='Vidrios del modulo 3' name='xxxnv3' id='valo6'  required onclick='vidrio3()'>";
}
        if($hoja >=4){
$rpta2= $rpta2."<input type='hidden' name='traz_vid4' id='valo7'  required>"
        . "<input type='text' readonly='readonly' placeholder='Vidrios del modulo 4' name='xxxnv4' id='valo8'  required onclick='vidrio4()'>";
}
                                  
    }               
                  
    }         
}	
echo $rpta2;