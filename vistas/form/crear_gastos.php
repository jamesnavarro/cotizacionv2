<?php $request=mysql_query('select count(*) from referencia_admin');if($request){	$request = mysql_fetch_row($request);	$num_items = $request[0];}else{	$num_items = 0;}$rows_by_page = 10;$last_page = ceil($num_items/$rows_by_page);if(isset($_GET['page'])){	$page = $_GET['page'];}else{	$page = 1;} if(isset($_GET['up_1'])){ $sql21 = "SELECT * FROM referencia_admin where id_ref_ad=".$_GET['up_1'];            $fila21 =mysql_fetch_array(mysql_query($sql21));            $ref= $fila21["referencia_ad"];            $des= $fila21["descripcion_ad"];            $por= $fila21["porcentaje_ad"];                    }?>                               <div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                            <header>                                <h4 class="title">Configuracion de gastos administrativo por producto</h4>                                <!-- START Toolbar -->                                <ul class="toolbar pull-left">                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>                                </ul>                                <!--/ END Toolbar -->                            </header>                            <section id="collapse1" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                <ul class="nav nav-tabs">                                    <li class="active"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span>Gastos</a></li>                                    <?php  if($crear_conf=='Habilitado'){echo '<li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar</a></li>';}  ?>                                                                  </ul>                                <div class="tab-content">                                    <div class="tab-pane active" id="tab3">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                                        <section class="body">                                <div class="body-inner no-padding"><?phpif(isset($_GET['up_1'])){ ?>            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_1'])){echo '../modelo/referencia_adm.php?up='.$_GET['up_1'].'';}else{echo '../modelo/referencia_adm.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                                                    <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                            <label></label><div class="controls"> </div>                                               <label class="control-label">Referencia</label>                                            <div class="controls"><input type="text" name="ref" value="<?php if(isset($_GET['up_1'])){echo $ref; } ?>" class="span6" placeholder=" " required></div>                                                                                         <label></label><div class="controls"> </div>                                               <label class="control-label">Descripcion</label>                                            <div class="controls"><input type="text" name="desc" value="<?php if(isset($_GET['up_1'])){echo $des;} ?>" class="span6" placeholder=" " required></div>                                             <label></label><div class="controls"> </div>                                               <label class="control-label">Porcentaje de Utilidad</label>                                            <div class="controls"><input type="text" name="codigo" value="<?php if(isset($_GET['up_1'])){echo $por;} ?>" class="span6" placeholder=" " required></div>                                                                                                                                                                       <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Agregar';} ?></button>                                        <button type="button" class="btn">Cancelar</button>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                                                              <?php }else{if($page>1){?>	<a href="../vistas/?id=add_gastos&page=1"><img src="../images/a1.png"></a>	<a href="../vistas/?id=add_gastos&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a><?php}else{	?><img src="../images/ant.png"><?php}?>(Pagina <?php echo $page;?> de <?php echo $last_page;?>)<?phpif($page<$last_page){?>	<a href="../vistas/?id=add_gastos&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>	<a href="../vistas/?id=add_gastos&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a><?php}else{	?><img src="../images/nex.png">  <?php}?><?php//Esta es la cadena limit que anexaremos a nuestra consulta$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;$request_ac=mysql_query("SELECT * FROM referencia_admin ".$limit);     if($request_ac){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="20%">'.'Items'.'</th>';               $table = $table.'<th width="20%">'.'referencia'.'</th>';                           $table = $table.'<th width="40%">'.'Descripcion'.'</th>';              $table = $table.'<th width="10%">'.'% Utilidad'.'</th>';              $table = $table.'<th width="10%"></th>';                      $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysql_fetch_array($request_ac))	{        if($editar_conf=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';} if($eliminar_conf=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}            $table = $table.'<tr><td width="20%">'.$row['id_ref_ad'].'</a></td><td width="20%">'.$row['referencia_ad'].'</a></td><td width="10%">'.$row['descripcion_ad'].'</font></td><td width="10%">'.$row["porcentaje_ad"].'%<font></a></td>               <td  width="10%"><a href="../vistas/?id=add_gastos&&up_1='.$row["id_ref_ad"].'"">'.$ver.'</a>  <a href="../vistas/?id=add_gastos&del_1='.$row["id_ref_ad"].'">'.$del.'</a></font></td></tr>';              		               	} 	$table = $table.'</table>';        	echo $table;  }} ?>                                </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                    <div class="tab-pane" id="tab4">                                        <div class="row-fluid">                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_adm.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/referencia_adm.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                                                    <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                            <label></label><div class="controls"> </div>                                               <label class="control-label">Referencia</label>                                            <div class="controls"><input type="text" name="ref" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></div>                                                                                         <label></label><div class="controls"> </div>                                               <label class="control-label">Descripcion</label>                                            <div class="controls"><input type="text" name="desc" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></div>                                             <label></label><div class="controls"> </div>                                               <label class="control-label">Porcentaje de Utilidad</label>                                            <div class="controls"><input type="text" name="codigo" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></div>                                                                                                                                                                       <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Agregar';} ?></button>                                        <button type="button" class="btn">Cancelar</button>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                        <!--/ END Form Wizard -->                    </div>                                    </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div><?php  if(isset($_GET['del_1'])){$sql = "DELETE FROM referencia_admin WHERE id_ref_ad=".$_GET['del_1']."";mysql_query($sql, $conexion);echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=add_gastos'";echo "</script>";}