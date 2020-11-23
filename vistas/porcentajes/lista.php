<?php 
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $page= $_GET['page'];
            $request = mysqli_query($conexion,"SELECT count(*) FROM porcentajes where area_por like '%".$cod."%' and grupo like '%".$des."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($conexion,"SELECT * FROM porcentajes where area_por like '%".$cod."%' and grupo like '%".$des."%' " .$limit );
$total2=0;
	while($fila=mysqli_fetch_array($request_ac)){ 
        echo '<tr>'
        . '<td>'.$fila['id_por'].'</td>'
        . '<td>'.$fila['area_por'].'</td>'
        . '<td>'.$fila['p1'].'</td>'
        . '<td>'.$fila['p2'].'</td>'
        . '<td>'.$fila['p3'].'</td>'
        . '<td>'.$fila['grupo'].'</td>'
        . '<td><a data-toggle="tab" href="#lin2"><img onclick="editar_gas('.$fila['id_por'].')" src="../images/modificar.png"> </a>'
        . '</td>';
       
  }
   echo '<tr><td colspan="5">';
                if($page>1){?>
                        <img src="../images/a1.png"  onclick="mostrar_porc(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="mostrar_porc(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/a1.png"> <img src="../images/a11.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_porc(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_porc(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/p1.png"> <img src="../images/p11.png"> <?php
                }
                
                echo 'Cantidad de registro '.$num_items; 
                 echo '</td></tr>';
?>
                        
 
<?php  }else {
   
      echo 'error';
    
}  ?>
