<?php 
include '../../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){
     $nom= $_GET['nom'];
      $categorias= $_GET['categorias'];
       $est_k= $_GET['est_k'];
   $page= $_GET['page'];
           $request = mysql_query("SELECT count(*) FROM receta_kits  where descripcion like '%".$nom."%' and modulo like '%".$categorias."%' and estado like '%".$est_k."%' ");
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);
            
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
                echo '</td>';


$request_a = mysql_query("SELECT * FROM receta_kits where descripcion like '%".$nom."%' and modulo like '%".$categorias."%' and estado like '%".$est_k."%' ".$limit );

  while ($fila = mysql_fetch_array($request_a)){
        if($fila['estado']=='0'){
            $stilo = 'ACTIVO</b>';
            $gra = 'ok-circle';
            $plan += 1; 
        }else{
             $stilo = 'INACTIVO</b>';
             $gra = 'lock';
             $com += 1;
        }
        
        echo '<tr>'
        . '<td>'.'<b>'.$fila['idkit'].'</td>'
        . '<td>'.$fila['descripcion'].'</td>'
        . '<td>'.$fila['modulo'].'</td>'

        . '<td>$ '.number_format($fila['valor']).'</td>'
                
        . '<td>'.$stilo.'</td>'
        . '<td><a data-toggle="tab" href="#agregar"><img onclick="editar('.$fila['idkit'].')"  data-toggle="tab" href="#agregar" src="../imagenes/modificar.png"></a>'
        . '&nbsp;&nbsp;<button onclick="borrar('.$fila['idkit'].')" class="glyphicon glyphicon-remove"> - </button>'
                . ' <button onclick="cam('.$fila['idkit'].','.$fila['estado'].')" class="glyphicon glyphicon-'.$gra.'"> Est</td>';
  }
echo '<tr><td colspan="5">';

                if($page>1){?>
                        <img src="../images/a1.png"  onclick="mostrar_kits(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="mostrar_kits(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/ant.png"> <?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_kits(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_kits(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }
  }else {
   
    header("location:../index.php");
    
}  ?>
