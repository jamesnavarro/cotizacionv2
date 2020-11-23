<?php
include "../modelo/conexion.php";
session_start();
if(isset($_GET['editar'])){

         $tiempo = $_POST["time"];
         
      $sql = "UPDATE `pt_procesos` SET `orden`='".$_POST["secuencia"]."', `id_subpro`='".$_POST["p2"]."', `tiempo_esp`='".$tiempo."' WHERE  `id_pt`='".$_GET['editar']."';";
      mysqli_query($conexion,$sql);
      

 
     echo "<script language='javascript' type='text/javascript'>";
      echo "location.href='../vistas/?id=procesos&cod=".$_GET['cod']."&linea=".$_GET['linea']."'";
        echo "</script>";
}else{

 include "../modelo/conexion.php";
    $sql21 = "SELECT max(orden) FROM pt_procesos where id_proceso='".$_GET['cod']."'";
        $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
        $max= $fila21["max(orden)"]+1;
        $time = $_POST["time"];
	$subpro = $_POST["p2"];
	$sql = "INSERT INTO `pt_procesos`(`tiempo_esp`,`orden`,`id_proceso`, `id_subpro`, `fecha_reg`, `sede_pt`)";
        $sql.= "VALUES ('".$time."','".$max."','".$_GET['cod']."','".$subpro."',  '".date("Y-m-d")."', '".$_GET['linea']."')";
        mysqli_query($conexion,$sql);

        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=procesos&cod=".$_GET['cod']."&linea=".$_GET['linea']."'";
        echo "</script>";
}
?>