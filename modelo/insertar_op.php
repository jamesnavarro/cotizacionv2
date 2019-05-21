<?php
require("conexion.php");
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$status = "";

     if(isset($_POST["pedido"])){
       $pedido = $_POST["pedido"];
       $cliente = $_POST['id_cli'];      
       $observaciones =$_POST["obs"];

       $sql = "SELECT * FROM cotizacion where orden=".$pedido."";
            $fila2 =mysql_fetch_array(mysql_query($sql));
            $estado= $fila2["estado"];
            $orden= $fila2["orden"];
            $ubicacion= $fila2["ubicacion"];
            $obra= $fila2["obra"];
            $id_cliente= $fila2["id_cliente"];
            $asesor= $fila2["registrado"];
            $responsable= $fila2["responsable"];
            $tel_obra= $fila2["tel_responsable"];
            $ciudad_obra= $fila2["ciudad"];
             $fecha= $fila2["fecha_reg_c"];
             $cotizacion= $fila2["id_cot"];

        $s = "SELECT max(numero) FROM orden_produccion";
        $fix =mysql_fetch_array(mysql_query($s));
        $maximo= $fix["max(numero)"]+1;
        
        $op = $maximo;
  
                $f1 = date("Y-m-d");
                $fi = date("Y-m-d");
                $ff = date("Y-m-d");
                
                
                $sqlo = "INSERT INTO `orden_produccion`(`tipo_cli`, `referencia`,`ref`, `sede_op`,`proyecto`, `numero`, `fecha_registro`, `fecha_i`, `fecha_f`, `id_cliente`, `estado_o`, `observaciones`)";
                $sqlo.= "VALUES ('".$_GET['tipo']."','".$pedido."','".$cotizacion."','Vidrio','".$obra."', '".$op."', '".$f1."', '".$fi."', '".$ff."', '".$id_cliente."', 'En proceso', '".$observaciones."')";
                mysql_query($sqlo);
        
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=detalle_op&cot=".$cotizacion."&cli=".$id_cliente."&op=".$op." '";
        echo "</script>";
     }
        


?>