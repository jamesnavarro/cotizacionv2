<?php
include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

$idmaq = $_GET["idmaq"];
$codigo = $_GET["codigo"];

$sql = "DELETE FROM producto_rep_ma WHERE id_rep_ma = ".$idmaq."";
mysql_query($sql, $conexion);

$clases->mostrarItems9($codigo); 

?>