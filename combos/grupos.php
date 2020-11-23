<?php
include "../modelo/conexion.php";
$rpta="";
if ($_POST["elegidoc"]=='Perfileria') {
   $con= "SELECT * FROM `referencias` where grupo='Perfileria'  group by codigo";
    $res=  mysqli_query($conexion,$con);
    
    while($fila=  mysqli_fetch_array($res)){
    $valorp1=$fila['id_referencia'];
    $valorp2=$fila['descripcion'];
    $valor3=$fila['codigo'];
    
    $rpta= $rpta.'<option value="'.$valorp1.'">'.$valor3.' '.$valorp2.'</option>
        
        ';
    }
  	
}
if ($_POST["elegidoc"]=='Vidrieria') {
   $con= "SELECT * FROM `tipo_vidrio`";
    $res=  mysqli_query($conexion,$con);
    
    while($fila=  mysqli_fetch_array($res)){
    $valor1=$fila['id_vidrio'];
    $valor2=$fila['color_v'];
 $valor3=$fila['codigo_v'];
    
    $rpta= $rpta.'<option value="'.$valor1.'">'.$valor3.' '.$valor2.'</option>
        
        ';
    }
  	
}
if ($_POST["elegidoc"]=='Accesorios') {
   $con= "SELECT * FROM `referencias` where grupo='Accesorios'  group by codigo";
    $res=  mysqli_query($conexion,$con);
    
    while($fila=  mysqli_fetch_array($res)){
    $valor1=$fila['id_referencia'];
    $valor2=$fila['descripcion'];
   $valor3=$fila['codigo'];
    $rpta= $rpta.'<option value="'.$valor1.'">'.$valor3.' '.$valor2.'</option>
        
        ';
    }
  	
}
if ($_POST["elegidoc"]=='Fachada') {
   $con= "SELECT * FROM `referencias` where grupo='Fachada'  group by codigo";
    $res=  mysqli_query($conexion,$con);
    
    while($fila=  mysqli_fetch_array($res)){
    $valor1=$fila['id_referencia'];
    $valor2=$fila['descripcion'];
 $valor3=$fila['codigo'];
    
    $rpta= $rpta.'<option value="'.$valor1.'">'.$valor3.' '.$valor2.'</option>
        
        ';
    }
  	
}
echo $rpta;
?>