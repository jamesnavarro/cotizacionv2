<?php
include "../modelo/conexion.php";
$rpta3="";
if (isset($_POST["elegido2"])) {
   
  $consulta2= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_POST["elegido2"].'"';                     
$result2=  mysql_query($consulta2);
$cont = 0;
         $sql212 = "SELECT * FROM producto where id_p=".$_POST["elegido2"];
            $fila212 =mysql_fetch_array(mysql_query($sql212));
            $producto= $fila212["producto"];
$rpta3 = $rpta3.'<ul><li><i><b><h6>PRODUCTO : "'.$producto.'"</h6></b></i><br>';

while($fila=  mysql_fetch_array($result2)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];

$cont= $cont + 1;

   $rpta3= $rpta3."<input type='checkbox' checked name='cod$cont' value='".$valor1."'> - ".$valor1."- ".$valor2."<br>";
    }
    $rpta3 = $rpta3.'</ul></li>';
}	

echo $rpta3;