<?php
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $idpt = $_GET['idpt'];
    $proceso = $_GET["proceso"];
    $secuencia = $_GET["secuencia"];
    $time = $_GET["time"];
    $codigo = $_GET["codigo"];
    $linea = $_GET["linea"];
    
    $tiempo = $time;
         
    $sql = "UPDATE `pt_procesos` SET `orden`='".$secuencia."', `id_subpro`='".$proceso."', `tiempo_esp`='".$tiempo."' WHERE  `id_pt`='".$idpt."';";
    mysqli_query($conexion,$sql);
            
    $clases->mostrarItems5($codigo,$linea); 
?>