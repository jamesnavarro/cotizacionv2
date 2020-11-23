<?php
session_start();
require("conexion.php");
$dado= $_GET["dado"];
$peso= $_GET["peso"];
$area= $_GET["area"];
$query = mysqli_query($conexion,"select referencia, costo_fom, grupo from referencias where `id_referencia` = ".$_GET["id"]." ");
$r = mysqli_fetch_row($query);
$ref = $r[0];
$costo = $r[1];
$grupo = $r[2];
$precio = $peso * $costo;
//if($grupo=='Perfileria'){
//    $sql = "UPDATE `referencias` SET `area`='".$area."', `peso`='".$peso."',`dado`='".$dado."',`costo_mt`='".$precio."' WHERE `referencia` = '".$ref."';";
//                 mysqli_query($conexion,$sql);
//}else{
    $sql = "UPDATE `referencias` SET `area`='".$area."', `peso`='".$peso."',`dado`='".$dado."',`costo_mt`='".$precio."',`modificado`='".$_SESSION['k_username']."' WHERE `id_referencia` = ".$_GET["id"]." ;";
                 mysqli_query($conexion,$sql);
//}
                
                 
 $maxi = mysqli_fetch_array(mysqli_query($conexion,"select max(id_dolar) from dolares"));
	$max = $maxi['max(id_dolar)'];
       
$con = mysqli_query($conexion,"select id_referencia from referencias where referencia='$ref' ");
while($d = mysqli_fetch_row($con)){
    $id = $d[0];
    mysqli_query($conexion,"update dolar_relaciones set precio_actual = '$precio' where id_referencia='$id' and id_dolar='$max' ");
}