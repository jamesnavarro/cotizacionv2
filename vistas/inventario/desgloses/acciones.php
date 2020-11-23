<?php
include('../../../modelo/conexionv1.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $cod=$_GET['cod'];
            $cot=$_GET['cot'];
            $ref=$_GET['ref'];
            $per=$_GET['per'];
            $pre=$_GET['pre'];
            $und=$_GET['und'];
            $iva=$_GET['iva'];
             $c=$_GET['c'];
            $query = mysqli_query($con2,"update desgloses_material set existefom='$c', codigo_sel='$cod', precio='$pre', unidad='$und', iva='$iva' where id_cot='$cot' and referencia='$ref' and perfil='$per'  ");
            
            echo 'Se actualizo con exito'. mysqli_error($con2);
            break;
        case 11:
            $cod=$_GET['cod'];
            $cot=$_GET['cot'];
            $ref=$_GET['ref'];
            $per=$_GET['per'];
            $pre=$_GET['pre'];
            $und=$_GET['und'];
            $iva=$_GET['iva'];
            $color=$_GET['color'];
             $c=$_GET['c'];
            $query = mysqli_query($con2,"update desgloses_material set existefom='$c', codigo_sel='$cod', precio='$pre', unidad='$und', iva='$iva', color='$color' where id_cot='$cot' and codigo_pro='$cod'   ");
            
            echo 'Se actualizo con exito'. mysqli_error($con2);
            break;
            case 2:
               
                $cot=$_GET['cot'];
                $result = mysqli_query($con2,"select * from cotizacion where id_cot='$cot' ");
                $r = mysqli_fetch_array($result);
                echo $obs = 'Cotizacion: '.$r['numero_cotizacion'].'.'.$r['version'].', Obra:'.$r['obra'];
               
               //$obs = 'Cotizacion Id: '.$cot;
               
            break;
            case 3:
         
                $cot=$_GET['cot'];
                $ref=$_GET['ref'];
                $per=$_GET['per'];
                $query = mysqli_query($con2,"update desgloses_material set solicitud='1' where id_cot='$cot' and referencia='$ref' and perfil='$per'  ");
                echo 'Se actualizo con exito'. mysqli_error($con2);
            break;
        case 4:
                 
            break;
            }


