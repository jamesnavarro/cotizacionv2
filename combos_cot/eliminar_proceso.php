<?php
include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $idpt = $_GET['idpt'];
    $codigo = $_GET["codigo"];
    $linea = $_GET["linea"];

    $sql = "DELETE FROM pt_procesos WHERE id_pt = ".$idpt."";
    mysql_query($sql, $conexion);

    $clases->mostrarItems5($codigo,$linea); 

?>