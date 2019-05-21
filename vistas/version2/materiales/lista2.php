<?php 
include '../../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $est=$_GET['est'];
    $ref=$_GET['ref'];
    $col=$_GET['col'];
    $page= $_GET['page'];
    $request = mysql_query("SELECT count(*) FROM referencias where codigo like '%".$cod."%' and descripcion like '%".$des."%' and referencia like '%".$ref."%'  and estado_cr = '".$est."'  and colores like '%".$col."%' ");

            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysql_query("SELECT * FROM referencias where  codigo like '%".$cod."%' and descripcion like '%".$des."%' and referencia like '%".$ref."%'  and estado_cr = '".$est."'  and colores like '%".$col."%' " .$limit );
 $total2=0;

	while($fila=mysql_fetch_array($request_ac))
	{  
 if ($fila['estado_cr']== '0') {
  $estado='../images/icn_alert_warning.png';
}else{
  $estado='../images/ok.png';
}
$cod = "'".trim($fila['codigo'])."'".','."'".trim($fila['referencia'])."'".','."'".trim($fila['descripcion'])."'".','."'".trim($fila['grupo'])."'".','."'".trim($fila['colores'])."'".','."'".$fila['ancho']."'".','."'".$fila['alto']."'".','."'".trim($fila['espesor'])."'".','."'".$fila['area']."'".','."'".$fila['peso']."'".','."'".trim($fila['observaciones'])."'".','."'".trim($fila['costo_promedio'])."'".','.$fila['stock_max'].','.$fila['stock_min'].','.$fila['stock_seg'].','."'".trim($fila['clase'])."'".','."'".trim($fila['grupo'])."'".','."'".trim($fila['aplicaiva'])."'".','."'".trim($fila['iva'])."'";
        echo '<tr>'
        . '<td>'.$fila['codigo'].'</td>'
	. '<td>'.$fila['referencia'].'</td>'
        . '<td>'.$fila['descripcion'].'</td>'
        . '<td>'.$fila['colores'].'</td>'
        . '<td>'.number_format($fila['costo_mt']).'</td>'
        . '<td><img src="'.$estado.'"></td>'
        . '<td>-'
        . '</td>';
  }
   echo '<tr><td colspan="6">';
                if($page>1){?>
                        <img src="../images/a1.png"  onclick="mostrar_line2(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="mostrar_line2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/ant.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_line2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_line2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png"> <?php
                }
                
                echo 'Cantidad de registro '.$ref; 
                 echo '</td></tr>';
?>
 </div>
</div>
<?php  }else {
   
      echo 'error';
    
}  ?>
