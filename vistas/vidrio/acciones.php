<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $codvid=$_GET['codvid'];
            $colorvid=$_GET['colorvid'];
            $refvid=$_GET['refvid'];
            $espvid=$_GET['espvid'];
            $cosvid=$_GET['cosvid'];
            $monvid=$_GET['monvid'];
            $cosusd=$_GET['cosusd'];
        
            if($id==''){
                $ver=mysqli_query($conexion, "insert into tipo_vidrio (`codigo_vid`,`color_v`,`referencia_vid`,`espesor_v`,`costo_v`,`moneda`,`costo_usd`) "
                       . "values ('$codvid','$colorvid','$refvid','$espvid','$cosvid','$monvid','$cosusd')");
                echo mysqli_error();
                $query = mysqli_query($conexion,"select max(id_vidrio) from tipo_vidrio");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_vidrio)'];
                echo $ultimo;
            }
            else{
                mysqli_query($conexion,"update tipo_vidrio set codigo_vid='$codvid', color_v='$colorvid', referencia_vid='$refvid', espesor_v='$espvid', costo_v='$cosvid', moneda='$monvid', costo_usd='$cosusd' where id_vidrio='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($conexion,"SELECT * FROM tipo_vidrio where id_vidrio='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_vidrio'];
                 $p[1]=$fila['codigo_vid'];
                 $p[2]=$fila['color_v'];
                 $p[3]=$fila['referencia_vid'];
                 $p[4]=$fila['espesor_v'];
                 $p[5]=$fila['costo_v'];
                 $p[6]=$fila['moneda'];
                 $p[7]=$fila['costo_usd'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from tipo_vidrio where id_vidrio='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($conexion,"SELECT * FROM tipo_vidrio where codigo_vid='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_vidrio'];
                 $p[1]=$fila['codigo_vid'];
                 $p[2]=$fila['color_v'];
                 $p[3]=$fila['referencia_vid'];
                 $p[4]=$fila['espesor_v'];
                 $p[5]=$fila['costo_v'];
                 $p[6]=$fila['moneda'];
                 $p[7]=$fila['costo_usd'];
            echo json_encode($p); 
            exit();
            break;
         
}