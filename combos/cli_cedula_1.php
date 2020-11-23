<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["nombre"])) {
   
     if($_POST["elegido"]=="Empresarial"){
        $con= "SELECT * FROM `sis_empresa` where id_empresa=".$_POST["nombre"]."";
    $res=  mysqli_query($conexion,$con);
    while($f=  mysqli_fetch_array($res)){
   
    $doc=$f['nit_emp'];
    $direccion=$f['direccionr_emp'];
    $telefono_cli=$f['tel_oficina_emp'];
    $contacto=$f['nombre_emp'];
    $tel_cont=$f['celular_emp'];
    $email=$f['email1_emp'];
    
    $rpta2= $rpta2.'<input type="text" name="cedu" value="'.$direccion.'">';
    }
   }else{
        $con= "SELECT * FROM `sis_contacto` where id_contacto=".$_POST["nombre"]."";
    $res=  mysqli_query($conexion,$con);
    while($f=  mysqli_fetch_array($res)){
    $doc=$f['cedula_cont'];
    $direccion=$f['direccionf'];
    $telefono_cli=$f['tel_oficina'];
    $contacto=$f['nombre_cont'].' '.$f['apellido_cont'];
    $tel_cont=$f['celular'];
    $email=$f['email1'];
    
    $rpta2= $rpta2.'<input type="text" name="cedu" value="'.$direccion.'">';
    }
   }
  
}	
echo $rpta2;