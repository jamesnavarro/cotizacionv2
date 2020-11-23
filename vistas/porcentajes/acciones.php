<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idporc'];
            $linporc=$_GET['linporc'];
            $unoporc=$_GET['unoporc'];
            $dosporc=$_GET['dosporc'];
            $tresporc=$_GET['tresporc'];
            $gruppor=$_GET['gruppor'];
            $divporc=$_GET['divporc'];
            if($id==''){
                $ver=mysqli_query($conexion, "insert into porcentajes (`area_por`,`p1`,`p2`,`p3`,`grupo`,`division`) "
                       . "values ('$linporc','$unoporc','$dosporc','$tresporc','$gruppor','$divporc')");
                echo mysqli_error();
                $query = mysqli_query($conexion,"select max(id_por) from porcentajes");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_por)'];
                echo $ultimo;
            }
            else{
                mysqli_query($conexion,"update porcentajes set area_por='$linporc', p1='$unoporc', p2='$dosporc', p3='$tresporc', grupo='$gruppor', division='$divporc' where id_por='$id' ");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($conexion,"SELECT * FROM porcentajes where id_por='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_por'];
                 $p[1]=$fila['descripcion_ad'];
                 $p[2]=$fila['area_por'];
                 $p[0]=$fila['p1'];
                 $p[1]=$fila['p2'];
                 $p[2]=$fila['p3'];
                 $p[2]=$fila['grupo'];
                 $p[2]=$fila['division'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from porcentajes where id_por='$id' ");
            break;
           
         
}