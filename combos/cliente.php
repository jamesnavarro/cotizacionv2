<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["elegido"])) {
   if($_POST["elegido"]=='Empresarial'){
       $con= "SELECT * FROM `sis_empresa`";
    $res=  mysql_query($con);
    $rpta2= $rpta2.'<option value="">Seleccione la empresa</option>';
    while($f=  mysql_fetch_array($res)){
    $id=$f['id_empresa'];
    $empresa=$f['nit_emp'].' - '.$f['nombre_emp'];

    
    $rpta2= $rpta2.'<option value="'.$id.'">'.$empresa.'</option>';
    }
   }else{
       $con= "SELECT * FROM `sis_contacto`";
    $res=  mysql_query($con);
    $rpta2= $rpta2.'<option value="">Seleccione la persona</option>';
    while($f=  mysql_fetch_array($res)){
    $id=$f['id_contacto'];
    $contacto=$f['cedula_cont'].' - '.$f['nombre_cont'].' '.$f['apellido_cont'];

    
    $rpta2= $rpta2.'<option value="'.$id.'">'.$contacto.'</option>';
    }
   }
   
  
}	
echo $rpta2;