<?php 
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){ 
 
    $nombres= $_GET['nombb'];
    $page= $_GET['page'];
            $request = mysqli_query($conexion,"SELECT count(*) FROM sistemas where nombre_sistema like '%".$nombres."%' ");
            if($request){
                    $request = mysqli_fetch_row($request) ;
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                         <img src="../images/a1.png" onclick="mostrar_sistemas(1)" style="cursor: pointer;">
                         <img src="../images/a11.png" onclick="mostrar_sistemas(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/a1.png"> <img src="../images/a11.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_sistemas(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_sistemas(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/p1.png"> <img src="../images/p11.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?> 
<div class="table-responsive">  
    <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
  <table class="table table-hover">
    <tr class="bg-info">
        <th>ITEMS</th>
        <th>Nombre Del sistema</th> 
        <th>.....OPCIONES</th>
    </tr>
   
    <?php
 
    $query = mysqli_query($conexion,"SELECT * FROM sistemas where nombre_sistema like '%".$nombres."%' ".$limit );

  
    while ($fila = mysqli_fetch_array($query)){
       
        echo '<tr>' 
        . '<td>'.$fila['id_sistema'].'</td>'
        . '<td>'.$fila['nombre_sistema'].'</td>'
       
        . '<td><a href="#tab2" data-toggle="tab"><button onclick="editar('.$fila['id_sistema'].')"> <img src="../imagenes/modificar.png"> Editar </button></a>'
        . '<button onclick="borrar('.$fila['id_sistema'].')"> <img src="../imagenes/borrar.png"> Borrar </button></td>';
    }
    
    ?>
     
  </table> 
</div> 
  </div>
                        
                        
                        
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
