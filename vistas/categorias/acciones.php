<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idcatcosc'];
            $nombre_c=$_GET['nomcatec'];
        
            if($id==''){
                $ver=mysqli_query($conexion,"insert into categoria_costo (`nombre`) values ('$nombre_c')") ;
                
                $query = mysqli_query($conexion,"select max(id_catecos) from categoria_costo");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_catecos)'];
                echo $ultimo;
            }
            else{
                mysqli_query($conexion,"update categoria_costo set nombre='$nombre_c' where id_catecos='$id'");
                echo $id;
            }
        
          
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($conexion,"SELECT * FROM categoria_costo where id_catecos='$id'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_catecos']; 
                 $p[1]=$fila['nombre'];
        
        
            echo json_encode($p); 
            exit();
            
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($conexion,"delete from categoria_costo where id_catecos='$id' ");
            break;
        
}

