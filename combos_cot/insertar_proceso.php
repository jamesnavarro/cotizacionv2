<?php
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $proceso = $_GET["proceso"];
    $secuencia = $_GET["secuencia"];
    $tiempo = $_GET["time"];
    $codigo = $_GET["codigo"];
    $linea = $_GET["linea"];
    
    $sql21 = "SELECT max(orden) FROM pt_procesos where id_proceso='".$codigo."'";
    $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
    $max= $fila21["max(orden)"]+1;
    $time = $tiempo;
    $subpro = $proceso;
	
    $sql = "INSERT INTO `pt_procesos`(`tiempo_esp`,`orden`,`id_proceso`, `id_subpro`, `fecha_reg`, `sede_pt`)";
    $sql.= "VALUES ('".$time."','".$max."','".$codigo."','".$subpro."',  '".date("Y-m-d")."', '".$linea."')";
    mysqli_query($conexion,$sql);
            
    $clases->mostrarItems5($codigo,$linea); 
?>