<?php
session_start();
require("conexion.php");
$dado= $_GET["dado"];
$peso= $_GET["peso"];
$area= $_GET["area"];
$query = mysql_query("select referencia, costo_fom, grupo from referencias where `id_referencia` = ".$_GET["id"]." ");
$r = mysql_fetch_row($query);
$ref = $r[0];
$costo = $r[1];
$grupo = $r[2];
$precio = $peso * $costo;
//if($grupo=='Perfileria'){
//    $sql = "UPDATE `referencias` SET `area`='".$area."', `peso`='".$peso."',`dado`='".$dado."',`costo_mt`='".$precio."' WHERE `referencia` = '".$ref."';";
//                 mysql_query($sql, $conexion);
//}else{
    $sql = "UPDATE `referencias` SET `area`='".$area."', `peso`='".$peso."',`dado`='".$dado."',`costo_mt`='".$precio."' WHERE `id_referencia` = ".$_GET["id"]." ;";
                 mysql_query($sql, $conexion);
//}
                
                 
 $maxi = mysql_fetch_array(mysql_query("select max(id_dolar) from dolares"));
	$max = $maxi['max(id_dolar)'];
       
$con = mysql_query("select id_referencia from referencias where referencia='$ref' ");
while($d = mysql_fetch_row($con)){
    $id = $d[0];
    mysql_query("update dolar_relaciones set precio_actual = '$precio' where id_referencia='$id' and id_dolar='$max' ");
}