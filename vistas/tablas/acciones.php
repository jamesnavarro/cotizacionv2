<?php
include '../../modelo/conexion.php';
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $c=$_GET['c'];

               $ver =  mysqli_query($conexion,"update producto set ptfom='$c' where id_p='$id'") ;
                echo $ver;
            
            
            break;
            case 2:
                  $id=$_GET['id'];
            $c=$_GET['sis'];

               $ver =  mysqli_query($conexion,"update producto set sistemas='$c' where id_p='$id'") ;
                echo $ver;
        
           
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $request=mysqli_query($conexion,"SELECT * FROM producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia  and b.id_p=".$id);
               while($fila=mysqli_fetch_array($request))
               { 
                   echo '<tr>'
                   . '<td><input type="text" class="form-control" id="upcod'.$fila['id_r_a'].'" style="width: 80%" onclick="buscarref('.$fila['id_r_a'].')" value="'.$fila['codigo'].'"></td>'
                   . '<td>'.$fila['descripcion'].'<input type="hidden" class="form-control" id="upida'.$fila['id_r_ac'].'" style="width: 80%" value="'.$fila['id_ref_alum'].'"></td>'
                    . '<td><input type="text" class="form-control" id="uplad'.$fila['id_r_a'].'" style="width: 80%" onchange="updatereferencia('.$fila['id_r_a'].')"  value="'.$fila['lado'].'"></td>'
                    . '<td><input type="text" class="form-control" id="upcan'.$fila['id_r_a'].'" style="width: 80%" onchange="updatereferencia('.$fila['id_r_a'].')"  value="'.$fila['cantidad'].'"></td>';
               }
            break;
        case 4:
               $id=$_GET['id'];
               $request=mysqli_query($conexion,"SELECT * FROM producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia  and b.id_p=".$id);
               while($fila=mysqli_fetch_array($request))
               { 
                   echo '<tr>'
                   . '<td><input type="text" class="form-control" id="upcoda'.$fila['id_r_ac'].'" style="width: 80%" onclick="buscarref2('.$fila['id_r_ac'].')" value="'.$fila['codigo'].'"></td>'
                   . '<td>'.$fila['descripcion'].'<input type="hidden" class="form-control" id="upida'.$fila['id_r_ac'].'" style="width: 80%" value="'.$fila['id_ref_acc'].'"></td>'
                    . '<td><input type="text" class="form-control" id="uplada'.$fila['id_r_ac'].'" onchange="updatereferencia2('.$fila['id_r_ac'].')" style="width: 80%"  value="'.$fila['lado'].'"></td>'
                    . '<td><input type="text" class="form-control" id="upcana'.$fila['id_r_ac'].'" onchange="updatereferencia2('.$fila['id_r_ac'].')" style="width: 80%"  value="'.$fila['cantidad_acc'].'"></td>';
               }
            break;
            case 5:
                  $id=$_GET['id'];
            $c=$_GET['item'];

               $ver =  mysqli_query($conexion,"update producto_rep_alu set id_ref_alum='$id' where id_r_a='$c'") ;
                echo $ver;
        
            break;
        case 6:
                  $id=$_GET['item'];
                  $lad=$_GET['lad'];
                  $can=$_GET['can'];

               $ver =  mysqli_query($conexion,"update producto_rep_alu set cantidad='$can',lado='$lad' where id_r_a='$id'") ;
                echo $ver;
        
            break;
        case 7:
                  $id=$_GET['id'];
            $c=$_GET['item'];

               $ver =  mysqli_query($conexion,"update producto_rep_acc set id_ref_acc='$id' where id_r_ac='$c'") ;
                echo $ver;
        
            break;
        case 8:
                  $id=$_GET['item'];
                  $lad=$_GET['lad'];
                  $can=$_GET['can'];

               $ver =  mysqli_query($conexion,"update producto_rep_acc set cantidad_acc='$can',lado='$lad' where id_r_ac='$id'") ;
                echo $ver;
        
            break;
        case 9:
                  $id=$_GET['id'];
                  $est=$_GET['est'];

               $ver =  mysqli_query($conexion,"update producto set estado_producto='$est' where id_p='$id'") ;
               if($est==0){
                   echo 'Se ha activado el producto';
               }else{
                   echo 'Se ha desactivado el producto';
               }
        
           
            exit();
            break;
            }

