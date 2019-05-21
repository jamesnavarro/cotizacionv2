<?php
include('../../modelo/conexion.php');
session_start();
switch ($_POST['sw']) {
        case 1:
            $sql21 = "SELECT * FROM referencias where codigo='".$_POST['cod']."' ";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $p = array();
            $p[0] = $ref= $fila21["referencia"];
            $p[1] = $des= $fila21["descripcion"];
            $p[2] = $cod= $fila21["codigo"];
            $p[3] = $cos= $fila21["costo_mt"];
            $p[4] = $med= $fila21["medida"];
            $p[5] = $und_med= $fila21["und_medida"];
            $p[6] = $cant= $fila21["cantidad_e"];
            $p[7] = $linea= $fila21["grupo"];
            $p[8] = $dolar= $fila21["act_dolar"];
            $p[9] = $peso= $fila21["peso"];
            $p[10] = $aumento= $fila21["aumento"];
            $p[11] = $uti= $fila21["utilidad"];
            $p[12] = $max= $fila21["max_desc"];
            $p[13] = $dado= $fila21["dado"];
            $p[14] = $cos2= $fila21["costo_fom"];
            $p[15] =  $fila21["area"];
            $p[16] =  $fila21["id_referencia"];
            
            
            echo json_encode($p);
        
          
            break;
           
        
}

