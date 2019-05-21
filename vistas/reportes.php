<?php 
if($_SESSION['k_username']=='admin'){
    $request=mysql_query("SELECT count(*) FROM requerimientos ");
}else{
    $request=mysql_query("SELECT count(*) FROM requerimientos where usuario='".$_SESSION['k_username']."' ");
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
                                <h4 class="title">Soporte en linea</h4>
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
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span> Reportes</a></li>
                                    <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Reportar </a></li>
                                  
                                </ul>
                                <div class="tab-content">
                                    <?php ?>
                                    <div class="tab-pane <?php if(isset($_GET['up'])){}else{ echo 'active';} ?>" id="tab3">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
<?php if(isset($_GET['up'])){
    $sql='select * from requerimientos where id_r="'.$_GET['up'].'"';
$fil =mysql_fetch_array(mysql_query($sql));
        $link= $fil["link"];
        $desc= $fil["requerimiento"];
        $solu= $fil["solucion"];
        $ruta= $fil["foto"];
        $est= $fil["estado"];
        $fru= $fil["fecharegistro"];
        $fechamod= $fil["fechamod"];
        $usuario= $fil["usuario"];  $correo= $fil["correo"];

 ?>                                  
                                    <?php
    
}
if($page>1){?>
	<a href="../vistas/?id=soporte&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=soporte&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=soporte&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=soporte&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
if($_SESSION['k_username']=='admin'){
    $request_ac=mysql_query("SELECT * FROM requerimientos order by id_r desc ".$limit);
}else{
    $request_ac=mysql_query("SELECT * FROM requerimientos where usuario='".$_SESSION['k_username']."' order by id_r desc  ".$limit);
}

     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Reporte No.'.'</th>'; 
              $table = $table.'<th width="10%">'.'Link del Problema'.'</th>'; 
               $table = $table.'<th width="20%">'.'Requerimiento'.'</th>'; 
                $table = $table.'<th width="20%">'.'Solucion'.'</th>'; 
              $table = $table.'<th width="10%">'.'Registrado por'.'</th>';
               $table = $table.'<th width="10%">'.'Fecha de registro'.'</th>';
               $table = $table.'<th width="5%">'.'Estado.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request_ac))
	{       
            if($row['estado']=='Reportado'){
                $led = '<img src="../imagenes/ledrojo.gif">';
            }else{
                 if($row['estado']=='En proceso'){
                $led = '<img src="../imagenes/amarillo.gif">';
            }else{
                 $led = '<img src="../imagenes/led.gif">';
            }
            }
            $table = $table.'<tr><td width="5%"><a href="../vistas/?id=soporte&up='.$row['id_r'].'">'.$row['id_r'].'</a></td>'
                    . '<td width="10%"><a href="'.$row['link'].'">Ver</a></td>'
                   
                    . '<td width="20%">'.$row['requerimiento'].'</font></td>'
                    . '<td width="20%">'.$row['solucion'].'</font></td>'
                     . '<td width="10%">'.$row['usuario'].'</font></td>'
                    . '<td width="10%">'.$row['fecharegistro'].'</font></td>'
                    . '<td width="5%">'.$row['estado'].' '.$led.'</font></td></tr>';   
           
		
               
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
                                    <div class="tab-pane <?php if(isset($_GET['up'])){ echo 'active';} ?>" id="tab4">
                                        <div class="row-fluid">
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up'])){echo '../modelo/insertar_reporte.php?editar='.$_GET['up'].'';}else{echo '../modelo/insertar_reporte.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                   <div class="control-group">
                                              
                                              <label></label><div class="controls"> </div>
                                           
                                               <label class="control-label">Link del error</label>
                                               <div class="controls">
                                                    <input type="hidden" name="correo" value="<?php if(isset($_GET['up'])){echo $correo; } ?>">
                                                   <input type="text" name="link" value="<?php if(isset($_GET['up'])){echo $link; } ?>" class="span6" placeholder="Por favor copie y pegue el link donde se encuentre el problema" required></div>
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Descripcion del Error </label>
                                               <div class="controls"><textarea name="desc"  rows="4" cols="100"><?php if(isset($_GET['up'])){echo $desc; } ?></textarea></div>
                                               <label></label><div class="controls"> </div>
                                             
                                                <label></label><div class="controls"> </div>
                                               <label class="control-label">Estado</label>
                                               <div class="controls"><select name="estado">
                                                       <?php if(isset($_GET['up'])){echo '<option value="'.$est.'">'.$est.'</option>';
                                                       }else{echo '<option value="Reportado">Reportado</option>';}
                                                        if($_SESSION['k_username']=='admin') {   $yi =''; ?>
                                                       
                                                       <option value="En proceso">En proceso</option>
                                                       <option value="Solucionado">Solucionado</option>
                                                       <?php }else{$yi = 'readonly';} ?>
                                                   </select></div>
                                               <label></label><div class="controls"> </div>
                                                <label></label><div class="controls"> </div>
                                               <label class="control-label">Solución (Campo para el Desarrollador) </label>
                                               <div class="controls"><textarea name="solu" <?php echo $yi ?> rows="4" cols="100"><?php if(isset($_GET['up'])){echo $solu; } ?></textarea></div>
                                               <label></label><div class="controls"> </div>
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Registrado por </label>
                                               <div class="controls"><input type="text" name="user" id="" readonly value="<?php  if(isset($_GET['up'])){ echo $usuario; }else{echo $_SESSION['k_username'];} ?>" class="span2" placeholder="" required></div>
                                               <label></label><div class="controls"> </div>
  
                                                <label></label><div class="controls"> </div>
                                               <label class="control-label">Fecha de Registro</label>
                                               <div class="controls"><input type="text" id="datepicker1" name="fr" readonly  value="<?php if(isset($_GET['up'])){echo $fru; }else{echo date("Y-m-d H:i:s");} ?>" class="span2" placeholder="" required></div>
                                               <label></label><div class="controls"> </div>
                                              
                                            <div class="controls"><div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                               
                                               
                                                <div class="fileupload-new thumbnail" style="width: 800px; height: 400px;"><img src="<?php if(isset($_GET['up'])){if($ruta!=''){echo '../registros/'.$ruta;}else{echo '../registros/no.jpg';}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 800px; height:400px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Suba el pantallazo</span><span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['cod'])){echo '<input name="imagen" type="file" value="'.$ruta.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                                 
                                            </div></div>
                                               <label></label><div class="controls"> </div>
                                               
                                                </div>
                           
                                    <!-- Form Action -->
                                    <br>
                                    <div class="form-actions">
<?php if(isset($_GET['up'])){
                                                                                        echo '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';}else{
                                                                                       echo '<button type="submit" class="btn btn-primary">Agregar</button>';     
                                                                                        } ?>
                                        
                                        <a href="../vistas/?id=producto"> <button type="button" class="btn">Cancelar</button> </a>
                                    </div><!--/ Form Action -->
                               
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
<?php
 if(isset($_GET['del'])){
$sql = "DELETE FROM productos WHERE id_producto=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=producto'";
echo "</script>";
}
                        