<?php 
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){ 
 
    $item= $_GET['item'];
    $cod= $_GET['cod'];
    $ref= $_GET['ref'];
    $des= $_GET['des'];
    $lin= $_GET['lin'];
    $sis= $_GET['sis'];
    $per= $_GET['per'];
    $est= $_GET['est'];
    $page= $_GET['page'];
    //752326
            $request = mysqli_query($conexion,"SELECT count(*) FROM producto where id_p like '%".$item."%' and codigo like '%".$cod."%' and referencia_p like '%".$ref."%'  and producto like '%".$des."%'  and linea like '%".$lin."%'  and sistemas like '%".$sis."%' and ptfom = '".$per."' and estado_producto like '".$est."%' ");
            if($request){
                    $request = mysqli_fetch_row($request) ;
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;

            $last_page = ceil($num_items/$rows_by_page);
            echo '<tr><td colspan="9">';
                if($page>1){?>
                         <img src="../images/a1.png" onclick="mostrar_master(1)" style="cursor: pointer;">
                         <img src="../images/a11.png" onclick="mostrar_master(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/a1.png"> <img src="../images/a11.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_master(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_master(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/p1.png"> <img src="../images/p11.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 

 
    $query = mysqli_query($conexion,"SELECT * FROM producto where id_p like '%".$item."%' and codigo like '%".$cod."%' and referencia_p like '%".$ref."%'  and producto like '%".$des."%'  and linea like '%".$lin."%'  and sistemas like '%".$sis."%' and ptfom = '".$per."' and estado_producto like '".$est."%' ".$limit );

    while ($fila = mysqli_fetch_array($query)){
       if($fila['ruta']==''){
           $ima = '<img src="../producto/nodisponible.jpg" width="50px">';
       }else{
            $ima = '<img src="../producto/'.$fila['ruta'].'" width="50px">';
       }
       if($fila['ptfom']=='1'){
           $che = 'checked';
            $che2 = '';
       }elseif($fila['ptfom']=='2'){
           $che2 = 'checked';
            $che = '';
       }else{
          $che2 = '';
            $che = ''; 
       }
       $res = 'select count(*) from pt_procesos where id_proceso='.$fila['id_p'].' ';
                    $f =mysqli_fetch_array(mysqli_query($conexion,$res));
                    $a = $f['count(*)'];

                    if($a==0){
                        $led = '<img src="../imagenes/warning.png">';
                         if($fila['linea']=='Fachada'){
                            // mysqli_query($conexion,"insert into pt_procesos (id_proceso,id_subpro,orden,fecha_reg,sede_pt) select '".$fila['id_p']."',id_subpro,orden,fecha_reg,sede_pt from pt_procesos where id_proceso='108'  ");
                         }
                    }else{
                        $led = '<img src="../imagenes/ok.png">';
                    }
                    if($fila['estado_producto']=='0'){
                        $font = '';
                    }else{
                        $font = 'red';
                    }
                    
       $descr = "'".$fila['producto']."'";
       $pertenece = 'M1<input type="radio" name="it'.$fila['id_p'].'" id="ma'.$fila['id_p'].'" '.$che.' onclick="uppertenece('.$fila['id_p'].')"> '
               . '|M2<input type="radio" name="it'.$fila['id_p'].'" id="mb'.$fila['id_p'].'"  '.$che2.' onclick="uppertenece('.$fila['id_p'].')">';
        echo '<tr>' 
        . '<td>'.$fila['id_p'].'-' .$per.'</td>'
        . '<td>'.$ima.'</td>'
                . '<td>'.$fila['codigo'].'</td>'
                . '<td>'.$fila['referencia_p'].'</td>'
                . '<td><font color="'.$font.'">'.$fila['producto'].'</font></td>'
                . '<td>'.$fila['linea'].'</td>'
                . '<td><input type="text" class="form-control" id="sis'.$fila['id_p'].'" style="width: 80%" onclick="buscarsis('.$fila['id_p'].')" value="'.$fila['sistemas'].'"></td>'
                . '<td>'.$pertenece.'</td>'
                . '<td>'.$led.' <button class="icon glyphicon glyphicon-cog"  data-toggle="modal" data-target="#myModal" onclick="pasarid('.$fila['id_p'].','.$descr.','.$fila['estado_producto'].')">?</option></td>';
    }
    $che2 = '';
            $che = '';
  }else {
   
    header("location:../index.php");
    
}  ?>
