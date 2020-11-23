<?php
@session_start();
include "../modelo/conexion.php";
include "../modelo/consultar_permisos.php";
if($_POST['grupo']=='Perfileria'){
    $grupo = ' group by referencia' ;
}else{
    $grupo = ' ' ;
} 
$request=mysqli_query($conexion,"select referencia from referencias where concat(codigo,' ', descripcion,' ', referencia) like '%".$_POST['buscador']."%'  and grupo like '%".$_POST['grupo']."%' $grupo ");

if($request){
    $request = mysqli_num_rows($request);
    $num_items = $request;
}else{
    $num_items = 0;
}
$rows_by_page = 5;
$last_page = ceil($num_items/$rows_by_page);

$page = $_POST['page'];


if($page>1){ ?>
<a href="javascript:void(0)" ><img src="../images/a1.png" onclick="buscar_referencias(1)"></a>
    <a href="javascript:void(0)" ><img src="../images/a11.png" onclick="buscar_referencias(<?php echo $page - 1;?>)"></a>
<?php }else{ ?>
    <img src="../images/ant.png">
<?php } ?>
    (Pagina <input type="text" disabled id="page" value="<?php echo $page;?>" style="width: 20px; height: 15px">  de <?php echo $last_page;?>)
<?php
if($page<$last_page){ ?>
    <a href="javascript:void(0)" ><img src="../images/p1.png" onclick="buscar_referencias(<?php echo $page + 1;?>)"></a>
    <a href="javascript:void(0)" ><img src="../images/p11.png" onclick="buscar_referencias(<?php echo $last_page;?>)"></a>
<?php }else{ ?>
    <img src="../images/nex.png">  <?php
    }

?>
<?php
        
    $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    
      
        $con = "select * from referencias where "
        . "concat(codigo,' ', descripcion,' ', referencia) like '%".$_POST['buscador']."%'  and "
        . "grupo like '%".$_POST['grupo']."%' $grupo order by id_referencia desc ".$limit;
        
       $res=  mysqli_query($conexion,$con);
  
    
?>
    <hr>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr BGCOLOR="#C3D9FF">
                    <th width="5%">Items</th>    
                    <th width="5%">Codigo</th>
                    <th width="30%">Descripcion</th>
                    <th width="10%">Referencia</th>
                    <th width="10%">Dado</th>
                    <th width="10%">Grupo</th>
      
                    <th class="hidden-phone">Peso (Kg)</th>
                    <th class="hidden-phone">Costo Base</th>
                    <th class="hidden-phone">Costo Real</th>
                    <th class="hidden-phone">Perimetro</th>
                    <th>Historial</th>
                    <th>Editar</th>
                    <th>Relacion</th>
                </tr>
            </thead>
	
    <?php   
        $total2=0;
	while($row=mysqli_fetch_array($res))
	{       
            if($ver_conf=='Habilitado'){$ver2='<center><button><img src="../imagenes/ver.png"></button></center>';}else{$ver2='';}        
            if($editar_conf=='Habilitado'){$ver='<center><button><img src="../imagenes/modificar.png"></button></center>';}else{$ver='';}
            if($eliminar_conf=='Habilitado'){$del='<center><button><img src="../imagenes/eliminar.png"></button></center>';}else{$del='';}
            if($ver_conf=='Habilitado'){$ver3='<center><button><img src="../imagenes/hoja.png"></button></center>';}else{$ver3='';}        
               IF($row["grupo"]=='Perfileria'){
                   $dis = '';
               }ELSE{
                   $dis = 'disabled';
               }
        ?>
                <tr>
                    <td width="5%"><?php echo $row['id_referencia']; ?></td>
                    <td width="5%"><?php echo $row['codigo']; ?></font></td>
                    <td width="30%"><?php echo$row['descripcion']; ?></font></td>
                    <td width="10%"><?php echo $row["referencia"]; ?><font></a></td>
                    <td width="10%"><input type="text" id="dado<?php echo $row['id_referencia']; ?>" <?php echo $dis ?> onchange="dado(<?php echo $row['id_referencia']; ?>)" value="<?php echo $row["dado"]; ?>" style="width: 80%"><span id="d<?php echo $row['id_referencia']; ?>"></span></td>
                    <td width="10%"><?php echo $row["grupo"]; ?><font></a></td>
                 

                    <td width="10%"><input type="text" id="peso<?php echo $row['id_referencia']; ?>" <?php echo $dis ?> onchange="dado(<?php echo $row['id_referencia']; ?>)" value="<?php echo $row["peso"]; ?>" style="width: 80%"></td>
                    <td width="10%">$<?php echo number_format($row["costo_fom"]); ?><font></a></td>
                    <td width="10%">$<?php echo number_format($row["costo_mt"]); ?><font></a></td>
          
                    <td width="10%"><input type="text" id="area<?php echo $row['id_referencia']; ?>" <?php echo $dis ?> onchange="dado(<?php echo $row['id_referencia']; ?>)" value="<?php echo $row["area"]; ?>" style="width: 80%"></td>
                    <td><a href="../vistas/ver_referencia.php?id_refe=<?php echo $row["id_referencia"]; ?>" target="_blank" onClick="window.open(this.href, 'form', 'width=800,height=800'); return false;"><?php echo $ver2; ?></a> </td>
                    <td><a href="../vistas/?id=add_per&up_1=<?php echo $row["id_referencia"]; ?>"><?php echo $ver; ?></a> </td>
                    <td><a href="../vistas/ver_relacion.php?id_refe=<?php echo $row["id_referencia"].'&perfil='.$row["descripcion"]; ?>" target="_blank" onClick="window.open(this.href, 'form2', 'width=900,height=800'); return false;"><?php echo $ver3; ?></a></td>
                </tr>
        <?php } ?> 
	 
	</table>