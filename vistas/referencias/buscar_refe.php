<?php
@session_start();
include('../../modelo/conexion.php');
include "../../modelo/consultar_permisos.php";
    $request=mysql_query("SELECT count(*) FROM conf_referencias where "
            . "codigo like '%".$_GET['codigo']."%' and "
            . "descripcion like '%".$_GET['descripcion']."%' and "
            . "referencia like '%".$_GET['referencia']."%' and "
            . "grupo like '%".$_GET['grupo']."%' and "
            . "color like '%".$_GET['color']."%' and "
            . "id_linea_ref like '%".$_GET['linea']."%' ");
        if($request){
            $request = mysql_fetch_row($request);
            $num_items = $request[0];
        }else{
            $num_items = 0;
        }
        $rows_by_page = 10;
        $last_page = ceil($num_items/$rows_by_page);
            if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }

if($page>1){?>
	<a href="javascript:void();" onclick="mostrar_referencias(1);"><img src="../images/a1.png"></a>
	<a href="javascript:void();" onclick="mostrar_referencias(<?php echo $page - 1;?>);"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void();" onclick="mostrar_referencias(<?php echo $page + 1;?>);"><img src="../images/p1.png"></a>
	<a href="javascript:void();" onclick="mostrar_referencias(<?php echo $last_page;?>);"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
echo '<input type="hidden" id="page" value="'.$page.'">';
  $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
  
    
        if($_GET['linea']!=''){
            $linea = 'and id_linea_ref = '.$_GET['linea'].' ';
        }else{
            $linea = '';
        }
    
        $con= "SELECT *,(select linea from lineas where id_linea = id_linea_ref) as linea, (select valor_esp from espesor where id_esp=espesor) as esp FROM conf_referencias where "
                . "codigo like '%".$_GET['codigo']."%' and "
                . "descripcion like '%".$_GET['descripcion']."%' and "
                . "referencia like '%".$_GET['referencia']."%' and "
                . "grupo like '%".$_GET['grupo']."%' and "
                . "color like '%".$_GET['color']."%' ".$linea." order by codigo asc ".$limit;
        $res=  mysql_query($con);
   
    
    ?>

    <table class="table table-bordered table-striped table-hover">
         <thead>
            <tr bgcolor="#D1EEF0">
                <th width="5%">Items</th>   
                <th width="5%">Codigo</th>
                <th width="30%">Descripcion</th>
                <th width="10%">Referencia</th>
                <th width="10%">Dado</th>
                <th width="10%">Color</th>
                
                <th width="10%">Stock.</th>
                <th width="10%">Esp/Long</th>
                
                <th width="10%">Linea</th>
                <th width="10%">Grupo</th>
                <th width="10%">Tipo Art.</th>
                <th>Estado</th>
                <th>Imagen</th>
                <th>Editar</th>
            </tr>
        </thead>
	
    <?php
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($res))
	{               
            
                $ver2='';
                $verref = strtoupper($row['descripcion']);
         
        
            if($editar_conf=='Habilitado'){
                $ver='<img src="../imagenes/modificar.png">';
            }else{
                $ver='';
            }

            if ($row['estado_cr']=='1') {
                $imagene = '../imagenes/no.png';
            }else{
                $imagene = '../imagenes/ok.png';
            }

            if($row["grupo"] == 'VIDRIOS'){
                $medida = $row["ancho"].'X'.$row["alto"];
            }else{
                $medida = $row["med_mc"];
            }
        if($row["imagenes"]==''){
            $imagen = '<button id="img'.$row['id_referencia'].'" onclick="cargar_imagen('.$row['id_referencia'].')">Agregar</button>';
        }else{
            $imagen = '<img src="../archivos/'.$row["imagenes"].'" onclick="cargar_imagen('.$row['id_referencia'].')">';
        }
        if($_SESSION['admin']=='Si'){
            $dis = '';
        }else{
            $dis = 'disabled';
        }
    ?>
            
        <tr>
             <td width="5%" style="text-align:center"><?php echo $row['id_referencia']; ?></td>
            <td width="10%"><input type="text" id="cod<?php echo $row['id_referencia']; ?>"  onchange="cambiar(<?php echo $row['id_referencia']; ?>)" value="<?php echo $row["codigo"]; ?>" style="width: 90%" <?php echo $dis; ?>> <?php echo $dis; ?></td>
            <td width="30%"><textarea id="descr<?php echo $row['id_referencia']; ?>" <?php echo $dis; ?> onchange="cambiar(<?php echo $row['id_referencia']; ?>)"  style="width: 80%"><?php echo $verref; ?></textarea><br><b id="msg<?php echo $row['id_referencia']; ?>">Mod: <?php echo $row['actualizado']; ?></b></td>
            <td width="5%"><input type="text" id="ref<?php echo $row['id_referencia']; ?>" disabled  value="<?php echo $row['referencia']; ?>" style="width: 90%"></td>
            <td width="10%" style="text-align:center"><input type="text" id="dado<?php echo $row['id_referencia']; ?>"  onchange="cambiar(<?php echo $row['id_referencia']; ?>)"  value="<?php echo $row['dado']; ?>" style="width: 90%"></td>
            <td width="10%" style="text-align:center"><?php echo $row['color']; ?></td>
            <td width="10%" style="text-align:center"><?php echo $row["cantidad_e"]; ?><font></a></td>
            <td width="10%"><input type="number" id="med<?php echo $row['id_referencia']; ?>" onchange="cambiar(<?php echo $row['id_referencia']; ?>)" disabled value="<?php echo $row["ancho"]; ?>" style="width: 80%"></td>
            
            <td width="10%"><?php echo strtoupper($row["linea"]); ?><font></a></td>
            <td width="10%"><?php echo strtoupper($row["grupo"]); ?><font></a></td>
            <td width="10%"><?php echo strtoupper($row["tipo_articulo"]); ?><font></a></td>
            <td width="10%"><img src=<?php echo $imagene; ?>></font></td>
            <td id="img<?php echo $row['id_referencia']; ?>"> <?php echo $imagen ?> </td>
            <td><a href="#tab2" data-toggle="tab" onclick="ver_referencia('<?php echo $row["codigo"]; ?>')"><?php echo $ver; ?></a> </td>   
      
    <?php   }   ?>
        </table>


