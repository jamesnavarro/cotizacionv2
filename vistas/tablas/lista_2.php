<?php 
if(isset($_POST['buscar'])){
    if($_POST['c']!=''){
                $id = ' and id_p='.$_POST['c'].' ';
            }else{
                $id = ' ';
            }
    $request=mysql_query("SELECT count(*) FROM producto where estado_producto=1 and revisado=0 and  concat(producto, ' ', codigo,' ',referencia_p) like '%".$_POST['b']."%' and linea like '%".$_POST['linea']."%' $id ");

}else{
    if(isset($_GET['linea'])){
            $_POST['b'] = $_GET['b'];
            $_POST['linea'] = $_GET['linea'];
            $_POST['c'] = $_GET['c'];
            if($_POST['c']!=''){
                $id = ' and id_p='.$_POST['c'].' ';
            }else{
                $id = ' ';
            }
            
    $request=mysql_query("SELECT count(*) FROM producto where estado_producto=1 and  concat(producto, ' ', codigo,' ',referencia_p) like '%".$_GET['b']."%' and linea like '%".$_GET['linea']."%' $id ");

}else{
    $request=mysql_query('select count(*) from producto where estado_producto=1 and   revisado=0 and aprobado=1');
}
}  

if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 30;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
?> 
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Listado Productos Sin Revisar</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                            

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">
<form class="span12 widget shadowed dark form-horizontal bordered" action="" method="post" enctype="multipart/form-data">
    <section class="body">
        
        <select name="linea" class="span2">
            <?php if(isset($_POST['linea'])){echo '<option value="'.$_POST['linea'].'">'.$_POST['linea'].'</option>';}  ?>
            <option value="">Seleccione</option>
           <?php
                            require '../modelo/conexion.php';
                      $consulta2= "SELECT * FROM `lineas`";                     
                       $result2=  mysql_query($consulta2);
                        while($fila=  mysql_fetch_array($result2)){
                        $valor1=$fila['linea'];
                         $valor3=$fila['linea'];
                         echo"<option value='".$valor1."'>".$valor3."</option>";
                     }
            ?>
        </select>  
        <input name="b" type="text" value="<?php if(isset($_POST['b'])){echo $_POST['b'];}  ?>" class="span3" autocomplete="off" placeholder="Buscar por Codigo, Descripcion, Referencia">
        <select name="rev" class="span2">
            <?php if(isset($_POST['rev'])){echo '<option value="'.$_POST['rev'].'">'.$_POST['rev'].'</option>';}  ?>
            <option value="">Revisados?</option>
            <option value="1">Actualizado</option>
            <option value="0">Sin Actualizar</option>
        </select>
        <select name="des" class="span2">
            <?php if(isset($_POST['des'])){echo '<option value="'.$_POST['des'].'">'.$_POST['des'].'</option>';}  ?>
            <option value="">Desgloses</option>
            <option value="1">Si</option>
            <option value="0">No</option>
        </select>
        <input name="c" type="text" value="<?php if(isset($_POST['c'])){echo $_POST['c'];}  ?>" class="span1" autocomplete="off" placeholder="Id"> 
        <input type="submit" value="Buscar" name="buscar"> 
    </section>
</form>
                            

                            <section class="body">

                                <div class="body-inner no-padding">


<?php
if(isset($_POST['linea'])){
  
    $lin = '&linea='.$_POST['linea'].'&b='.$_POST['b'].'&rev='.$_POST['rev'].'&des='.$_POST['des'].' ';
}else{
if(isset($_GET['linea'])){
    
      $lin = '&linea='.$_GET['linea'].'&b='.$_GET['b'].'&rev='.$_GET['rev'].'&des='.$_GET['des'].' ';
}else{
    $lin ='';
}
}
if($page>1){?>
	<a href="../vistas/?id=lista_anuladas&page=1<?php echo $lin; ?>"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=lista_anuladas&page=<?php echo $page - 1;?><?php echo $lin; ?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=lista_anuladas&page=<?php echo $page + 1;?><?php echo $lin; ?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=lista_anuladas&page=<?php echo $last_page;?><?php echo $lin; ?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

if(isset($_POST['buscar'])){
    if($_POST['c']!=''){
                $id = ' and id_p='.$_POST['c'].' ';
            }else{
                $id = ' ';
            }
            if($_POST['rev']!=''){
                $rev = ' and revisado='.$_POST['rev'].' ';
            }else{
                $rev = ' ';
            }
            if($_POST['des']!=''){
                $up = ' and actualizado='.$_POST['des'].' ';
            }else{
                $up = ' ';
            }
            
    $request=mysql_query("SELECT * FROM producto where estado_producto=1 and  revisado=0 and  concat(producto, ' ', codigo,' ',referencia_p) like '%".$_POST['b']."%' and linea like '%".$_POST['linea']."%' $id $rev $up order by id_p asc ".$limit);

}else{
   if(isset($_GET['linea'])){
       if($_GET['c']!=''){
                $id = ' and id_p='.$_GET['c'].' ';
            }else{
                $id = ' ';
            }
             if($_GET['rev']!=''){
                $rev = ' and revisado='.$_GET['rev'].' ';
            }else{
                $rev = ' ';
            }
            if($_GET['des']!=''){
                $up = ' and actualizado='.$_GET['des'].' ';
            }else{
                $up = ' ';
            }
    $request=mysql_query("SELECT * FROM producto where estado_producto=1 and  revisado=0 and  concat(producto, ' ', codigo,' ',referencia_p) like '%".$_GET['b']."%' and linea like '%".$_GET['linea']."%' $id order by id_p asc ".$limit);

}else{
    $request=mysql_query("SELECT * FROM producto where estado_producto=1 and  revisado=0 and aprobado=1 order by id_p asc ".$limit);
}
}  
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

               $table = $table.'<thead >';
               $table = $table.'<tr bgcolor="#D1EEF0">';
               $table = $table.'<th width="3%">'.'Item'.'</th>';
               $table = $table.'<th width="3%">'.'DT'.'</th>';
               $table = $table.'<th width="3%">'.'DES'.'</th>';
               $table = $table.'<th width="5%">'.'Diseño'.'</th>';
              
               $table = $table.'<th width="5%">'.'Codigo'.'</th>';             
               $table = $table.'<th width="30%">'.'Producto'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Referencia'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Linea'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Fecha Reg.'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Ultima Modificacion'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Registrado por'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Modificado por'.'</th>';
               $table = $table.'<th>'.'Ver'.'</th>';
               $table = $table.'<th>'.'Areas'.'</th>';
               $table = $table.'<th>'.'Comp.'.'</th>';
               $table = $table.'<th>'.'Copiar'.'</th>';
               $table = $table.'</tr>';
               $table = $table.'</thead>';
	
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
            
            
            $res2 = 'select count(*) FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p='.$row['id_p'].'';
            $f2 =mysql_fetch_array(mysql_query($res2));
            $a2 = $f2['count(*)'];
            
            if($a2==0){
                $led2 = '<img src="../imagenes/warning.png">';
            }else{
                $led2 = '<img src="../imagenes/ojo.png">';
            }
            
            $request2=mysql_query('select count(*) FROM producto a, compuestos b where a.id_p=b.id_prod_comp and b.id_prod='.$row['id_p'].' ');
	    if($request2){
	      $request2 = mysql_fetch_row($request2);
	      $num_items = $request2[0];
              }else{
	      $num_items = 0;
              }

              if($ver_conf == 'Habilitado'){
                    if($row['especial']==1){
                        $x = '<a href="../vistas/?id=add_fac&cod='.$row['id_p'].'">'.$led2.'</a>';
                    }else{
                        $x = '<a href="../vistas/?id=nuevo_producto&cod='.$row['id_p'].'">'.$led2.'</a>';
                    }
                    $res = 'select count(*) from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$row['id_p'].' order by a.orden asc ';
                    $f =mysql_fetch_array(mysql_query($res));
                    $a = $f['count(*)'];

                    if($a==0){
                        $led = '<img src="../imagenes/warning.png">';
                    }else{
                        $led = '<img src="../imagenes/procesos.png">';
                    }
              }else{
                    $x = '';
                    $led = '';
              }  
                    if($row['actualizado']==0){
                        $up = '<img src="../imagenes/stop.png">';
                    }else{
                        $up = '<img src="../imagenes/ok.png">';
                    }
                    if($row['revisado']==0){
                        $rev = '<img src="../imagenes/stop.png">';
                    }else{
                        $rev = '<img src="../imagenes/ok.png">';
                    }
                    if($row['ok']==0){
                        $s = 'style="color:black"';
                    }else{
                        $s = 'style="color:green"';
                    }
            $table = $table.'<tr>'
                    . '<td  width="3%">'.$row['id_p'].' </td>'
                    . '<td  width="3%">'.$rev.' </td>'
                    . '<td  width="3%">'.$up.'</td>'
                    . '<td  width="5%"><img src="../producto/'.$row['ruta'].'"></td>'
                    . '<td width="5%" '.$s.'>'.$row['codigo'].'</td>'
                    . '<td width="30%">'.$row['producto'].'</td>'
                    . '<td  class="hidden-phone">'.$row["referencia_p"].'</td>'
                    . '<td  class="hidden-phone">'.$row["linea"].'<font></a></td>
                    <td  class="hidden-phone">'.$row["registro"].'<font></a></td>
                    <td  class="hidden-phone">'.$row["fecha_adm"].'<font></a></td>
                    <td  class="hidden-phone">'.$row["registrado_por"].'<font></a></td><td  class="hidden-phone">'.$row["modificado"].'<font></a></td>
               <td>'.$x.'</td>'
                    . '<td class="hidden-phone"><a href="../vistas/?id=procesos&cod='.$row['id_p'].'&linea='.$row["linea"].'">'.$led.'</a></td>'
                    . '<td class="hidden-phone"><a href="../vistas/?id=compuestos&cod='.$row['id_p'].'&linea='.$row["linea"].'"><img src="../imagenes/puzzle_3.png"></a>('.$num_items.')</td>'
                    . '<td class="hidden-phone"><a href="../modelo/copiar_producto.php?cod='.$row['id_p'].'&linea='.$row["linea"].'"><img src="../imagenes/copiar.png"></a></td></tr>';   
     
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}

       
                       ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

           

                                    

                                </div>

                            </div><!--/ Normal Tabs -->

                                        

                                </div>

                              

                            </section>

                        </div>
</div>

  

                            </section></div>