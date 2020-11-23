<?php
include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegido"])) {
   $con= "SELECT * FROM `departamentos` where cod_dep='".$_POST["elegido"]."' order by `id`";
    $res=  mysqli_query($conexion,$con);
    
    while($f=  mysqli_fetch_array($res)){
    $idco=$f['cod_mun'];
    $nombre1=$f['nombre_mun'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>
        
        ';
    }
  	
}

	
echo $rpta;
?>