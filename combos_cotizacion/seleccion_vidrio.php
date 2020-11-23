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
        
        if($_POST["linea"]=='VIDRIO'){
            $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$_POST["id"]." ";
            $res=  mysqli_query($conexion,$con);
            $f=  mysqli_fetch_array($res);
                $idco=$f['id_p'];
                $nombre1=$f['producto'];
                $rpta2= $rpta2."<input type='hidden' name='traz_vid' id='valo1x' value='$idco' required>"
                . "<input type='text' name='xxx' value='$nombre1' id='valo2x' required >"
                . "<input type='hidden' name='modulo' value='1' required>";

        }else{

            if($hoja >=1){
                $rpta2= $rpta2."<input type='hidden' name='traz_vid' id='valo1x' required>"
                . "<input type='text' placeholder='Vidrios del modulo 1' name='xxx' id='valo2x' required onclick='vidrio12()'>";
            }

            if($hoja >=2){
                $rpta2= $rpta2."<input type='hidden' name='traz_vid2' id='valo3x' required>"
                . "<input type='text' placeholder='Vidrios del modulo 2' name='xxx' id='valo4x' required onclick='vidrio24()'>";
            }

            if($hoja >=3){
                $rpta2= $rpta2."<input type='hidden' name='traz_vid3' id='valo5x' required>"
                . "<input type='text' placeholder='Vidrios del modulo 3' name='xxx' id='valo6x' required onclick='vidrio36()'>";
            }

            if($hoja >=4){
                $rpta2= $rpta2."<input type='hidden' name='traz_vid4' id='valo7x' required>"
                . "<input type='text' placeholder='Vidrios del modulo 4' name='xxx' id='valo8x' required onclick='vidrio48()'>";
            }
                                  
        }               
                  
    }         
}	
echo $rpta2;