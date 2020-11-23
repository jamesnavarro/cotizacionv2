<?php
include "../modelo/conexion.php";
$rpta3="";
if (isset($_POST["elegido2"])) {
   if ($_POST["id"]=='') {
        echo '<font color="red">Por Favor seleccione una referencia</font>';
    }else{
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_POST["id"].'"';                     
        $result=  mysqli_query($conexion,$consulta);
        $cont = 0;
         $sql21 = "SELECT * FROM producto where id_p=".$_POST["id"];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $producto= $fila21["producto"];
$rpta3 = $rpta3.'<ul><li><i><b>PRODUCTO : "'.$producto.'"</b></i><br>';

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];

$cont= $cont + 1;
if($valor1==4){
       $input = '<input type="number" name="per" id="perx value="'.$fila21["perforacion"].'" style="width:40px">';
   }else{
       $input = '';
   }
   if($valor1==5){
       $input2 = '<input type="number" name="boq" id="boqx" value="'.$fila21["boquete"].'" style="width:40px">';
   }else{
       $input2 = '';
   }
   $rpta3= $rpta3."<input type='checkbox' checked name='cod$cont' value='".$valor1."'> - ".$valor1."- ".$valor2." ".$input." ".$input2."<br>";
    }
    $rpta3 = $rpta3.'</ul></li>';
}	}

echo $rpta3;