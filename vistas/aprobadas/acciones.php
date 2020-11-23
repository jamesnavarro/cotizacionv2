<?php
include '../../modelo/conexion.php';
session_start();
if($_GET['sw']=='1'){
    mysqli_query($conexion,"update cotizaciones set estado_item='Aprobado', aprobado_por_user='".$_SESSION['k_username']."', fecha_aprobada='".date("Y-m-d")."' where id_cotizacion='".$_GET['id']."' ");
    echo '<font color="green">Aprobado por: '.$_SESSION['k_username'].'<br>Modificado: '.date("Y-m-d").'</font>';
    
}else{
    mysqli_query($conexion,"update cotizaciones set estado_item='Anulado', aprobado_por_user='".$_SESSION['k_username']."', fecha_aprobada='".date("Y-m-d")."' where id_cotizacion='".$_GET['id']."' ");
    echo '<font color="red">Anulado por: '.$_SESSION['k_username'].'<br>Modificado: '.date("Y-m-d").'</font>';
    
}
