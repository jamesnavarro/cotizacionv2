<?php $request=mysql_query('select count(*) from referencia_otro');if($request){	$request = mysql_fetch_row($request);	$num_items = $request[0];}else{	$num_items = 0;}$rows_by_page = 10;$last_page = ceil($num_items/$rows_by_page);if(isset($_GET['page'])){	$page = $_GET['page'];}else{	$page = 1;}?>                               <div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                            <header>                                <h4 class="title">Lista de Otros Gastos</h4>                                <!-- START Toolbar -->                                <ul class="toolbar pull-left">                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>                                </ul>                                <!--/ END Toolbar -->                            </header>                            <section id="collapse1" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                <ul class="nav nav-tabs">                                    <li class="active"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span>Lista</a></li>                                    <?php  if($crear_conf=='Habilitado'){echo '<li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar</a></li>';}  ?>                                                                  </ul>                                <div class="tab-content">                                    <div class="tab-pane active" id="tab3">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                                        <section class="body">                                <div class="body-inner no-padding"><?phpif($page>1){?>	<a href="../vistas/?id=add_otro&page=1"><img src="../images/a1.png"></a>	<a href="../vistas/?id=add_otro&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a><?php}else{	?><img src="../images/ant.png"><?php}?>(Pagina <?php echo $page;?> de <?php echo $last_page;?>)<?phpif($page<$last_page){?>	<a href="../vistas/?id=add_otro&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>	<a href="../vistas/?id=add_otro&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a><?php}else{	?><img src="../images/nex.png">  <?php}?><?php//Esta es la cadena limit que anexaremos a nuestra consulta$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;$request_ac=mysql_query("SELECT * FROM referencia_otro ".$limit);     if($request_ac){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="20%">'.'Items'.'</th>';               $table = $table.'<th width="20%">'.'referencia'.'</th>';                           $table = $table.'<th width="40%">'.'Descripcion'.'</th>';              $table = $table.'<th width="40%">'.'Cantidad'.'</th>';              $table = $table.'<th width="10%">'.'Valor'.'</th>';                $table = $table.'<th width="10%">'.'Editar'.'</th>';                $table = $table.'<th width="10%">'.'Eliminar'.'</th>';              $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysql_fetch_array($request_ac))	{        if($editar_conf=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';} if($eliminar_conf=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}            $table = $table.'<tr><td width="20%">'.$row['id_ref_ot'].'</a></td><td width="20%">'.$row['referencia_ot'].'</a></td><td width="10%">'.$row['descripcion_ot'].'</font></td><td width="10%">'.$row['cantidad_ot'].'</font></td><td width="10%">$'.number_format($row["valor_ot"]).'<font></a></td>               <td width="10%"><a href="../vistas/?id=add_otro&up='.$row['id_ref_ot'].'">'.$ver.'</a> </td><td width="10%"><a href="../vistas/?id=add_otro&del='.$row['id_ref_ot'].'">'.$del.'</a></td></tr>';              		               	} 	$table = $table.'</table>';        	echo $table;  } ?>                                </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                    <div class="tab-pane" id="tab4">                                        <div class="row-fluid">                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_otro.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/referencia_otro.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                                                    <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                            <label></label><div class="controls"> </div>                                               <label class="control-label">Referencia</label>                                            <div class="controls"><input type="text" name="ref" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></div>                                                                                         <label></label><div class="controls"> </div>                                               <label class="control-label">Descripcion</label>                                            <div class="controls"><input type="text" name="desc" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></div>                                               <label></label><div class="controls"> </div>                                               <label class="control-label">Cantidad</label>                                            <div class="controls"><input type="text" name="cant" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></div>                                                                                         <label></label><div class="controls"> </div>                                               <label class="control-label">Valor</label>                                            <div class="controls"><input type="text" name="valor" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></div>                                                                                                                                                                       <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Agregar';} ?></button>                                        <button type="button" class="btn">Cancelar</button>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                        <!--/ END Form Wizard -->                    </div>                                    </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div><?php if(isset($_GET['del'])){$sql = "DELETE FROM referencia_otro WHERE id_ref_ot=".$_GET['del']."";mysql_query($sql, $conexion);echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=add_otro'";echo "</script>";}                        