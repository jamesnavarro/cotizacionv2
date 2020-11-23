<?php
include('../../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        
        case 1:
               $id=$_GET['cod'];
                 $query = mysqli_query($conexion,"SELECT * FROM referencias where codigo='$id'");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo']; 
                 $p[1]=$fila['referencia'];
                 $p[2]=$fila['descripcion'];
                 $p[3]=$fila['grupo']; 
                 $p[4]=$fila['colores'];
                 $p[5]=$fila['medida'];
                 $p[6]=$fila['und_medida']; 
                 $p[7]=$fila['dado']; 
                 $p[8]=$fila['area'];
                 $p[9]=$fila['peso'];
                 $p[10]=$fila['cantidad_e']; 
                 $p[11]=$fila['cantidad_r'];
                 $p[12]=$fila['costo_mt'];
                 $p[13]=$fila['costo_fom'];
                 $p[14]=$fila['observaciones'];
             
        
            echo json_encode($p); 
            exit();
            break;
        case 2:
            $id = $_GET['cod'];
            $result = mysqli_query($conexion,"SELECT count(codigo) FROM referencias where codigo='$id' ");
            $r = mysqli_fetch_array($result);
            if($r[0]==0){
                $QUERY = mysqli_query($conexion,"SELECT * FROM referencias where referencia='".$_GET['ref']."' ");
                $f = mysqli_fetch_array($QUERY);
            
//                if($_GET['cla']!='03'){
                $sql=mysqli_query($conexion,"INSERT INTO `referencias`(`codigo`, `descripcion`, `referencia`, `colores`, `ancho`, `alto`, `espesor`, `area`, `peso`, `observaciones`,`estado_cr`,`modificado`, `cod_empresa`, `cantidad_e`, `cantidad_r`, `stock_seg`, `clase`, `grupo`, `aplicaiva`, `iva`, `costo_mt`, `costo_fom`, `und_medida`, `medida`)"
                        . " VALUES ('".$_GET['cod']."','".$_GET['nom']."','".$_GET['ref']."','".$_GET['col']."','".$_GET['anc']."','".$_GET['alt']."','".$_GET['lar']."','".$f['area']."','".$f['peso']."','Sincronizado de Fomplus','1','".$_GET['use']."','".$_GET['emp']."','0','0','0','".$_GET['cla']."','Perfileria','".$_GET['iva']."','".$_GET['aiva']."','".$f['costo_mt']."','".$f['costo_fom']."','".$_GET['und']."','".$_GET['med']."')") ;
                 echo  'exito'.$sql;
                 
                 
//                }else{
//                   echo 'error: '.$id; 
//                }
            }else{
                echo 'existe: '.$id;
            }
        
            
            break;
        
            }

