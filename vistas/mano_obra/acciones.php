<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idmano'];
            $ref_mano=$_GET['ref_mano'];
            $desmano=$_GET['desmano'];
            $instmano=$_GET['instmano'];
            $cobramano=$_GET['cobramano'];
            $costomano=$_GET['costomano'];
            $utimano=$_GET['utimano'];
            $parafmano=$_GET['parafmano'];
        
            if($id==''){
                $ver=mysqli_query($conexion, "insert into referencia_mo (`referencia`,`descripcion_mo`,`instalacion`,`unidad_cobro`,`valor_mo`,`utilidad`,`parafiscales`) "
                       . "values ('$ref_mano','$desmano','$instmano','$cobramano','$costomano','$utimano','$parafmano')");
                echo mysqli_error();
                $query = mysqli_query($conexion,"select max(id_ref_mo) from referencia_mo");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ref_mo)'];
                echo $ultimo;
            }
            else{
                mysqli_query($conexion,"update referencia_mo set referencia='$ref_mano', descripcion_mo='$desmano', instalacion='$instmano', unidad_cobro='$cobramano', valor_mo='$costomano', utilidad='$utimano', parafiscales='$parafmano' where id_ref_mo='$id' ");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($conexion,"SELECT * FROM referencia_mo where id_ref_mo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_ref_mo'];
                 $p[1]=$fila['referencia'];
                 $p[2]=$fila['descripcion_mo'];
                 $p[3]=$fila['instalacion'];
                 $p[4]=$fila['unidad_cobro'];
                 $p[5]=$fila['valor_mo'];
                 $p[6]=$fila['utilidad'];
                 $p[7]=$fila['parafiscales'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from referencia_mo where id_ref_mo='$id' ");
            break;
           
         
}