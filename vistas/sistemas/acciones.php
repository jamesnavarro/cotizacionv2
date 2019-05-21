<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idsists'];
            $nombre_sis=$_GET['nomsiss'];
        
            if($id==''){
                $ver=mysql_query("insert into sistemas (`nombre_sistema`) values ('$nombre_sis')") or die(mysql_error());
                
                $query = mysql_query("select max(id_sistema) from sistemas");
                $m = mysql_fetch_array($query);
                $ultimo = $m['max(id_sistema)'];
                echo $ultimo;
            }
            else{
                mysql_query("update sistemas set nombre_sistema='$nombre_sis' where id_sistema='$id'");
                echo $id;
            }
        
          
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysql_query("SELECT * FROM sistemas where id_sistema='$id'"); //consultA modificada por navabla
                 $fila = mysql_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_sistema']; 
                 $p[1]=$fila['nombre_sistema'];
        
        
            echo json_encode($p); 
            exit();
            
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysql_query("delete from sistemas where id_sistema='$id' ");
            break;
        
}

