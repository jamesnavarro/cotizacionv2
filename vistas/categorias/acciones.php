<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idcatcosc'];
            $nombre_c=$_GET['nomcatec'];
        
            if($id==''){
                $ver=mysql_query("insert into categoria_costo (`nombre`) values ('$nombre_c')") or die(mysql_error());
                
                $query = mysql_query("select max(id_catecos) from categoria_costo");
                $m = mysql_fetch_array($query);
                $ultimo = $m['max(id_catecos)'];
                echo $ultimo;
            }
            else{
                mysql_query("update categoria_costo set nombre='$nombre_c' where id_catecos='$id'");
                echo $id;
            }
        
          
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysql_query("SELECT * FROM categoria_costo where id_catecos='$id'"); //consultA modificada por navabla
                 $fila = mysql_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_catecos']; 
                 $p[1]=$fila['nombre'];
        
        
            echo json_encode($p); 
            exit();
            
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysql_query("delete from categoria_costo where id_catecos='$id' ");
            break;
        
}

