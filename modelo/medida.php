<?php
include "../modelo/conexion.php";
$rptart="";
if (isset($_POST["nombre"])) {
   $con= "SELECT * FROM `referencias` where id_referencia=".$_POST["nombre"];
    $res=  mysqli_query($conexion,$con);
    
    while($f=  mysqli_fetch_array($res)){
    $nombre1t=$f['grupo'];
     if($nombre1t=='Perfileria'){
         $rptart= $rptart.'Medida=<input type="number" name="med"  class="span6"  value="" placeholder="En Milimetros" required>';
     }else{
         $rptart= $rptart.'<input type="hidden" name="med"  value="1" placeholder="">';
     }
    
    }
    
  	
}	
echo $rptart;
?>