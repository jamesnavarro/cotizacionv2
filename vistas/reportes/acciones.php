<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
switch ($_GET['sw']) {
      
    case 1:
             $id=$_GET['id'];
             $c=$_GET['c'];
                mysqli_query($conexion,"update cotizacion set seguimiento='2' where id_cot='$id' ");
                mysqli_query($conexion,"update seguimientos_cot set borrador='$c' where id_relacion='$id' ");
            
        break;
    case 2:
        $rel=$_GET['rel'];
        $des=$_GET['des'];
        $id_sg=$_GET['id_sg'];
        if ($id_sg==''){
             $ver = mysqli_query($conexion,"insert into seguimientos (id_s,observacion,usuario_seg) value('$rel','$des','$usuario')");
             echo 'Se guardo con exito.';
        }else{
             $ver = mysqli_query($conexion,"update seguimientos set observacion='$des' where id_seguimiento=$id_sg");
             echo 'se edito con exito';
        }
       
      
        break;
    case 3:
        $cot=$_GET['cot'];
        $est=$_GET['est'];
        if($est=='true'){
            mysqli_query($conexion,"update seguimientos_cot set borrador='0' where id_relacion='$cot' ");
        }else{
            mysqli_query($conexion,"update seguimientos_cot set borrador='1' where id_relacion='$cot' ");
        }
        
        break;
        case 4:
        $cot=$_GET['cot'];
        $est=$_GET['est'];
      
        $ver = mysqli_query($conexion,"UPDATE `seguimientos_cot` SET `estado_cot_s` = '$est' WHERE `id_relacion` ='$cot' ") ;
  
        
        
        break;
        
      
}

