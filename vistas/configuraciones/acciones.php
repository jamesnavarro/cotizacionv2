<?php
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){
switch ($_GET['sw']){
    case 1:
        $unidad = $_GET['unidad'];
        $unidad2 = $_GET['unidad2'];
        $unidad3 = $_GET['unidad3'];
        $valor = $_GET['valor'];
        $valor2 = $_GET['valor2'];
        $valor3 = $_GET['valor3'];
        $des = $_GET['des'];
        $id = $_GET['id'];
        $query = mysql_query("update referencia_mo set"
                . " unidad_cobro='$unidad' ,"
                . " valor_mo='$valor',"
                . " unidad_cobro2='$unidad2' ,"
                . " valor_mo2='$valor2',"
                . " unidad_cobro3='$unidad3' ,"
                . " valor_mo3='$valor3' ,"
                . " descripcion_mo='$des' "
                . "where id_ref_mo='$id' ") or die(mysql_error());
        echo $query;
  
        break;
 
}}else{
    echo 'tu session caduco! .. vuelve a loguearte';
}


