<?php
include "../modelo/conexion.php";
$rptart="";
if (isset($_POST["buscar"])) {
   $con= "SELECT * FROM `referencias` where id_referencia=".$_POST["buscar"];
    $res=  mysqli_query($conexion,$con);
    
    while($f=  mysqli_fetch_array($res)){
    $nombre1t=$f['descripcion'];
     $reft=$f['id_referencia'];
    $rptart= $rptar.'<option value="'.$reft.'">'.$nombre1t.'</option>';
    }
    
  	
}	
echo $rptart;
?>