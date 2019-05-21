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
   
            $request = mysql_query("SELECT count(*), sum(vtotal_obra) FROM  seguimientos_cot where borrador='0' and numero_cotizacion_s like '%".$ccotn."%' and concat(nom_temp,' ',nombre_cliente,' ',nombre_obra) like '%".$cnom."%' and vendedor_cli like '%".$asesr."%' $est and linea_s like '%".$linssa."%' $valores $fb ");
            if($request){
                    $request = mysql_fetch_row($request) or die(mysql_error());
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
                echo 'Cantidad de registro ('.$num_items.') | Total en valores: $<b>'.number_format($request[1]).' </h3>'; 
                 ?>  
                        <br>                         
  <table style="width: 100%" class="table table-hover" border="0">
     
    <tr class="table-hover bg-info">
        <th>COTIZACION</th>
        <th nowrap style="text-align:center">CLIENTE</th> 
        <TH style="text-align:center">INFORMACION DE LA OBRA</TH>
        <TH></TH>
       <th style="text-align:center">$ VALOR</th>
        <th style="text-align:center">DESCARTAR</th>
    </tr>
    
    <?php
    $query = mysql_query("SELECT * FROM  seguimientos_cot  where borrador='0' and  numero_cotizacion_s like '%".$ccotn."%' and concat(nom_temp,' ',nombre_cliente,' ',nombre_obra) like '%".$cnom."%'  and vendedor_cli like '%".$asesr."%' $est and linea_s like '%".$linssa."%' $valores $fb order by id_s desc ".$limit);

 
    while ($fila = mysql_fetch_array($query)){
        if($fila['nombre_cliente']=='CLIENTES VARIOS')
                        {
                        $nombre_n=$fila['nom_temp'];    
                        }else{
                        $nombre_n=$fila['nombre_cliente'];   
                        }  
                        $query2 = mysql_query("select observacion,fecha_registros from seguimientos where id_s =".$fila['id_relacion']." ");             
                        $seguimiento = '';
                        while($s = mysql_fetch_array($query2)){
                            $seguimiento = $seguimiento.''.$s[0].'. ';
                        }
        echo '<tr>' 
        . '<td style="width:180px"><button class="boton_1" style="background-color: #D6EAF8;"  onclick="cot('.$fila['id_relacion'].')"><h4><b>'.$fila['numero_cotizacion_s'].'.'.$fila['version_s'].'</b></button> <img src="../../images/costo.png" width=35px onclick="m_costo('.$fila['id_relacion'].','.$fila['vtotal_obra'].')"><br>'.$fila['fec_sistema'].'<br><b>POR:</b>'.$fila['analista_obra'].'<br><b>'.$fila['vendedor_cli'].'</td>'
         . '<td title="'.$seguimiento.'">'.$nombre_n.'</td>'
       . '<td nowrap colspan="2" style="width: 50px"><h4>'.$fila['nombre_obra'].'<br>'.$fila['ciudad_obra'].'<br>'.$fila['direccion_obra'].'<br>'.$fila['tel_cliente'].'<br>'.$fila['tel_obra'].'</td>'
        . '<td style="text-align:center"><h3>$ <B>'.number_format($fila['vtotal_obra']).'</td>'
         
      
        . '<td style="text-align:center"><img src="../../imagenes/no.png" onclick="papelera('.$fila['id_s'].')" width=19px></td>';
         
    }
   ?>
    
    
    
    
    
    
 
  </table>  
  <style type="text/css">
  .boton_1{
    text-decoration: none;
    padding: 3px;
    padding-left: 5px;
    padding-right: 5px; 
    font-weight: 20;
    font-size: 5px;
    background-color: #D6EAF8;
    border-radius: 9px;
  }
  .boton_1:hover{
    opacity: 0.3;
    text-decoration: none;
  }
</style>
<?php
}else {
    header("location:../index.php"); 
}  
?>
