<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idalu'];
            $col_alu=$_GET['col_alu'];
            $costo=$_GET['tip_alum']/$_GET['var_alu'];
            $var_alu=$_GET['var_alu'];
            $codigo_alu=$_GET['codigo_alu'];
            $ren_alu=$_GET['ren_alu'];
            $med_alu=$_GET['med_alu'];
        
            if($id==''){
                $ver=mysqli_query($conexion, "insert into tipo_aluminio (`color_a`,`costo_a`,`variable`,`codigo`,`rendimiento`,`medida_max`) "
                       . "values ('$col_alu','$costo','$var_alu','$codigo_alu','$ren_alu','$med_alu')");
                echo mysqli_error();
                $query = mysqli_query($conexion,"select max(id_ta) from tipo_aluminio");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ta)'];
                echo $ultimo;
            }
            else{
                mysqli_query($conexion,"update tipo_aluminio set color_a='$col_alu', costo_a='$costo', variable='$var_alu', codigo='$codigo_alu', rendimiento='$ren_alu', medida_max='$med_alu' where id_ta='$id' ");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($conexion,"SELECT * FROM tipo_aluminio where id_ta='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_ta'];
                 $p[1]=$fila['color_a'];
                 $p[2]=$fila['costo_a']*$fila['variable'];
                 $p[3]=$fila['variable'];
                 $p[4]=$fila['codigo'];
                 $p[5]=$fila['rendimiento'];
                 $p[6]=$fila['medida_max'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from tipo_aluminio where id_ta='$id' ");
            break; 
}