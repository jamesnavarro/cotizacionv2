<?php
include('../../../modelo/conexion.php');
session_start();
  $ref = $_GET['ref'];
  $des = $_GET['des'];
  $par = $_GET['par'];

  $usuario=$_SESSION['k_username'];
  //echo 'ref:'.$ref.', cod:'.$cod.', par:'.$par.'&sel:'.$sel;
    $ver = mysqli_query($conexion,"select count(*) from grupos_referencia where referencia='$ref' and modulo='$par' ");
    $v = mysqli_fetch_row($ver);
  
  if($v[0]==0){
           mysqli_query($conexion,"insert into grupos_referencia (modulo,referencia,descuento) "
                   . "values ('$par','$ref','$des')");
         
           echo 'Se agrego con exito. ';
  }else{

            mysqli_query($conexion,"update grupos_referencia set descuento='$des' where  referencia='$ref' and modulo='$par'  ");
            echo 'Se edito con exito';
  }

