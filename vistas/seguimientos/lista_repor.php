<?php 
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){ 
   $ccotn= $_GET['ncotc'];
   $cnom= $_GET['nomc'];
   $cfecha= $_GET['fecc'];
   $cfin= $_GET['ffinn'];
   $asesr= $_GET['asee'];
   $estd= $_GET['estc'];
   if($estd!=''){
       $est = ' and estado_cot_s in ('.$estd.')';
   }else{
       $est = '';
   }
   $linssa= $_GET['linss'];
   $mostrar= $_GET['mostrar'];
   $page= $_GET['page'];
   if($_GET['valor']==''){
   $valores = '';
   }else if($_GET['valor']=='mayor'){
   $valores = ' and b.vtotal_obra>=60000000' ;
   }else{
   $valores = ' and b.vtotal_obra<60000000';
   }
   if($_GET['fecc']=='' && $_GET['ffinn']==''){
   $fb ='';
   }else{
   $fb =' and fec_sistema >= "'.$cfecha.'" and fec_sistema <= "'.$cfin.'" ';
   }
   
            $request = mysqli_query($conexion,"SELECT count(*), sum(vtotal_obra) FROM  seguimientos_cot b where  numero_cotizacion_s like '%".$ccotn."%' and concat(nom_temp,' ',nombre_cliente,' ',nombre_obra) like '%".$cnom."%'   and vendedor_cli like '%".$asesr."%' $est and linea_s like '%".$linssa."%' and borrador like '%".$mostrar."%'  $valores $fb ");
            if($request){
                    $request = mysqli_fetch_row($request) ;
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = $_GET['filtro'];

            $last_page = ceil($num_items/$rows_by_page);
echo '<h3>';
                if($page>1){?>
                         <img src="../../images/a1.png" onclick="mostrar_reportes(1)" style="cursor: pointer;">
                         <img src="../../images/a11.png" onclick="mostrar_reportes(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
               }else{
                        ?><img src="../../images/a1.png"> <img src="../../images/a11.png"><?php
               }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../../images/p1.png"  onclick="mostrar_reportes(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../images/p11.png" onclick="mostrar_reportes(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/p1.png"> <img src="../../images/p11.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro ('.$num_items.') | Total en valores: $ '.number_format($request[1]); 
                ?>  <br>   
  <table style="width: 100%" class="table table-hover">
    <tr class="table-hover">
        <th style="background-color: #d6e9c6" nowrap># COTIZACION</th>
        <th style="background-color: #d6e9c6" nowrap>$ VALOR</th>  
        <th style="background-color: #d6e9c6" nowrap>CLIENTE</th>
        <th style="background-color: #d6e9c6" nowrap>DATOS DEL PROYECTO</th>
        <th style="background-color: #d6e9c6" nowrap>ESTADO</th>
        <th style="background-color: #d6e9c6 ;width: 400px" nowrap>SEGUIMIENTOS</th>
        <th style="background-color: #d6e9c6" nowrap>OPCIONES</th>
    </tr>
    <?php
    $query = mysqli_query($conexion,"SELECT * FROM  seguimientos_cot b where numero_cotizacion_s like '%".$ccotn."%' and concat(nom_temp,' ',nombre_cliente,' ',nombre_obra) like '%".$cnom."%'  and vendedor_cli like '%".$asesr."%' $est and linea_s like '%".$linssa."%' and borrador like '%".$mostrar."%'  $valores $fb order by id_s desc ".$limit);

  
    while ($fila = mysqli_fetch_array($query)){
        if($fila['nombre_cliente']=='CLIENTES VARIOS'){
                        $nombre_n=$fila['nom_temp'];    
                        }else{
                        $nombre_n=$fila['nombre_cliente'];   
                        }  
                        $query2 = mysqli_query($conexion,"select observacion,fecha_registros from seguimientos where id_s =".$fila['id_relacion']." ");
                        $seguimiento = '<ul>';
                        while($s = mysqli_fetch_array($query2)){
                            $seguimiento = $seguimiento.'<li>'.$s[0].'<br><font color="red"> Reg:'.$s[1].'</font>';
                        }
        echo '<tr>' 
        . '<td nowrap><button class="btn btn-success" onclick="cot('.$fila['id_relacion'].')">'.$fila['numero_cotizacion_s'].'.'.$fila['version_s'].'</button><br>'.$fila['fec_sistema'].'<br><b>Por: </b>'.$fila['analista_obra'].'<br>'.$fila['vendedor_cli'].'</td>'
        . '<td style="text-align:right">'.number_format($fila['vtotal_obra']).'</td>'
        . '<td style="text-align:right">'.['$nombre_n'].'</td>'
        . '<td nowrap>'.$fila['nombre_obra'].'<br>'.$fila['direccion_client'].'<br>'.$fila['tel_cliente'].'<br>'.$fila['tel_obra'].'</td>'
        
        . '<td nowrap>'.$fila['estado_cot_s'].'<br>'.$fila['linea_s'].'</td>'
        . '<td style="width: 400px">'.$seguimiento.'</td>'
        . '<td nowrap><a href="#" data-toggle="tab"><button class="btn btn-success" onclick="ver('.$fila['id_relacion'].')"><img src="../../imagenes/modificar.png" width=19px></button></a>'
        . ' <button class="btn btn-success" onclick="borrar('.$fila['id_s'].','.$fila['id_relacion'].')"><img src="../../imagenes/no.png" width=19px></button>'
        . ' <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="pasar('.$fila['id_relacion'].','.$fila['id_s'].')">+</button></td>';
         
    }
   ?>
  </table>      
<?php
}else {
    header("location:../index.php"); 
}  
?>
