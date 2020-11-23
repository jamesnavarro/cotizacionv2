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
    $page= $_GET['page'];
    $e = explode(" ", $des);
$bus1 = $e[0];
$bus2 = $e[1];
$bus3 = $e[2];
$bus4 = $e[3];
$bus5 = $e[4];
if($bus2!=''){
    $b1 = " and producto like '%".$bus2."%' ";
}else{
    $b1 = "";
}
if($bus3!=''){
    $b2 = " and producto like '%".$bus3."%' ";
}else{
    $b2 = "";
}
if($bus4!=''){
    $b3 = " and producto like '%".$bus4."%' ";
}else{
    $b3 = "";
}
if($bus5!=''){
    $b4 = " and producto like '%".$bus5."%' ";
}else{
    $b4 = "";
}
            $request = mysqli_query($conexion,"SELECT count(*) FROM producto where estado_producto=0  and ptfom=1 and id_p like '%".$item."%' and codigo like '%".$cod."%' and referencia_p like '%".$ref."%'  and producto like '%".$bus1."%' $b1 $b2 $b3 $b4   and linea like '%".$lin."%'  and sistemas like '%".$sis."%' and ptfom like '%".$per."%' ");
            if($request){
                    $request = mysqli_fetch_row($request) ;
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;

            $last_page = ceil($num_items/$rows_by_page);
            echo '<tr><td colspan="5">';
                if($page>1){?>
                         <img src="../images/a1.png" onclick="mostrar_master1(1)" style="cursor: pointer;">
                         <img src="../images/a11.png" onclick="mostrar_master1(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/a1.png"> <img src="../images/a11.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_master1(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_master1(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/p1.png"> <img src="../images/p11.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items.' '; 

 
    $query = mysqli_query($conexion,"SELECT * FROM producto where estado_producto=0 and ptfom=1 and id_p like '%".$item."%' and codigo like '%".$cod."%' and referencia_p like '%".$ref."%'  and producto like '%".$bus1."%'  $b1 $b2 $b3 $b4 and linea like '%".$lin."%'  and sistemas like '%".$sis."%' and ptfom like '%".$per."%' ".$limit );

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
       if($fila['ok']==0){
                        $s = 'style="color:black"';
                    }else{
                        $s = 'style="color:green"';
                    }  
       $id = $fila["id_p"];
              $ref = "'".$fila["referencia_p"]."'";
              $pro = "'".$fila["producto"]."'";
              $an = $fila["ancho_maximo"];
              $al = $fila["alto_maximo"];
              
              $rie = "'".$fila["rieles"]."'";
              $alf = "'".$fila["alfajia"]."'";
              $cie = "'".$fila["cierres"]."'";
              $rod = "'".$fila["rodajas"]."'";
              
       $descr = "'".$fila['producto']."'";
       $pertenece = 'M1<input type="radio" name="it" id="ma" '.$che.' onclick="uppertenece('.$fila['id_p'].')"> |M2<input type="radio" name="it" id="mb" '.$che2.'  onclick="uppertenece('.$fila['id_p'].')">';
        echo '<tr>' 
        . '<td '.$s.'>'.$fila['id_p'].'</td>'
        
                . '<td '.$s.'>'.$fila['codigo'].'</td>'
                . '<td '.$s.'>'.$fila['referencia_p'].'</td>'
                . '<td><a href="javascript:void(0);" onclick="pasare('.$ref.','.$id.','.$pro.','.$an.','.$al.','.$rie.','.$alf.','.$cie.','.$rod.')">'.$fila['producto'].'</a></td>'
                . '<td>'.$ima.'</td>';
    }
    
  }else {
   
    header("location:../index.php");
    
}  ?>
