<script language="JavaScript" type="text/javascript" src="../js/ajax.js"></script><div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                            <header>                                <h4 class="title">Soporte</h4>                                <!-- START Toolbar -->                                <ul class="toolbar pull-left">                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>                                </ul>                                <!--/ END Toolbar -->                            </header>                            <section id="collapse2" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                <ul class="nav nav-tabs">                                    <li class="active"><a href="#tab10" data-toggle="tab"><span class="icon icone-eye-open"></span> Casos / Incidencias</a></li>                                    <li class=""><a href="#tab8" data-toggle="tab"><span class="icon icon-briefcase"></span> Nuevo Caso</a></li>                                    <li class=""><a href="#tab9" data-toggle="tab"><span class="icon icon-fire"></span> Nueva Incidencia</a></li>                                                                                                    </ul>                                <div class="tab-content">                                    <div class="tab-pane <?php if(isset($_GET['up1'])){}else{echo 'active';}  ?>" id="tab10">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                                        <section class="body">                                <div class="body-inner no-padding"><?php  echo '<hr>';echo '<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">INCIDENCIAS</font></th></tr></table>';$request=mysql_query("SELECT * FROM sis_incidencias WHERE id_empresa=".$_GET['cod']."  ");       if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="5%">'.'Radicado'.'</th>';                           $table = $table.'<th width="20%">'.'Asunto'.'</th>';              $table = $table.'<th width="20%">'.'Tipo'.'</th>';              $table = $table.'<th width="10%">'.'Prioridad'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Asignado a'.'</th>';              $table = $table.'<th>'.'Editar..'.'</th>';              $table = $table.'<th>'.'Eliminar'.'</th>';                            $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysql_fetch_array($request))	{                      $table = $table.'<tr><td width="5%"><a href="../vistas/?id=ver_incidencias&cod='.$row['id_incidencia'].'">'.$row['id_incidencia'].'</a></td>                <td width="20%"><a href="../vistas/?id=ver_incidencias&cod='.$row['id_incidencia'].'">'.$row['asunto_inc'].'</a></td><td width="20%">'.$row['tipo_inc'].'</td>                    <td width="10%">'.$row["prioridad_inc"].'<font></a></td>               <td class="hidden-phone">'.$row["estado_inc"].'</font></td>                   <td class="hidden-phone">'.$row["asignado_inc"].'</font></td>                                <td><a href="../vistas/?id=incidencia&cod='.$row["id_incidencia"].'"><img src="../imagenes/modificar.png"></a></td>                                    <td><a href="../vistas/?id=incidencias&del='.$row["id_incidencia"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';         	}                	$table = $table.'</table>';        	echo $table;             }  echo '<hr>';echo '<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">CASOS</font></th></tr></table>';$request=mysql_query("SELECT * FROM sis_casos a, sis_empresa b where a.id_empresa=b.id_empresa and a.id_empresa=".$_GET['cod']." ");       if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="5%">'.'Radicado'.'</th>';                           $table = $table.'<th width="20%">'.'Asunto'.'</th>';              $table = $table.'<th width="20%">'.'Empresa'.'</th>';              $table = $table.'<th width="10%">'.'Prioridad'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Asignado a'.'</th>';              $table = $table.'<th>'.'Editar..'.'</th>';              $table = $table.'<th>'.'Eliminar'.'</th>';                            $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysql_fetch_array($request))	{                      $table = $table.'<tr><td width="5%"><a href="../vistas/?id=ver_casos&cod='.$row['id_caso'].'">'.$row['id_caso'].'</a></td>                <td width="20%"><a href="../vistas/?id=ver_casos&cod='.$row['id_caso'].'">'.$row['asunto_caso'].'</a></td><td width="20%"><a href="../vistas/?id=ver_empresa&cod='.$row['id_empresa'].'">'.$row['nombre_emp'].'<font></a></td>                    <td width="10%">'.$row["prioridad_caso"].'<font></a></td>               <td class="hidden-phone">'.$row["estado_caso"].'</font></td>                   <td class="hidden-phone">'.$row["asignado_caso"].'</font></td>                                <td><a href="../vistas/?id=caso&cod='.$row["id_caso"].'"><img src="../imagenes/modificar.png"></a></td>                                    <td><a href="../vistas/?id=casos&del='.$row["id_caso"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';         	}                	$table = $table.'</table>';        	echo $table;             } ?>                                </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>   <div class="tab-pane <?php if(isset($_GET['up1'])){echo 'active';}  ?>" id="tab8">                                     <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/casos_add.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                            <header><h4 class="title"><?php if(isset($_GET['a'])){echo 'Editar Caso';}else{echo 'Casos';} ?></h4></header>                            <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                        <label></label><div class="controls"> </div>                                                                                       <label class="control-label">Prioridad</label>                                            <div class="controls"><select name="prioridad" class="span6">                                                 <?php if(isset($_GET['a'])){echo '<option value="'.$prioridad_cas.'">'.$prioridad_cas.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                 <option value="Alta">Alta</option>                                                 <option value="Media">Media</option>                                                 <option value="Baja">Baja</option>                                                                                             </select></div>                                            <label></label><div class="controls"> </div>                                                                                         <label class="control-label">Estado</label>                                            <div class="controls"><select name="estado" class="span6">                                                 <?php if(isset($_GET['a'])){echo '<option value="'.$estado_cas.'">'.$estado_cas.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                <option value="nuevo">Nuevo</option>                                                 <option value="asignado">Asignado</option>                                                 <option value="Cerrado">Cerrado</option>                                                 <option value="Pendiente">Pendiente de informaciòn</option>                                                 <option value="rechazado">Rechazado</option>                                                <option value="duplicado">Duplicado</option>                                                                                                                                             </select></div>                                             <label></label><div class="controls"> </div>                                            <label class="control-label">Tipos</label>                                            <div class="controls"><select name="tipo" class="span6">                                                 <?php if(isset($_GET['a'])){echo '<option value="'.$tipo_cas.'">'.$tipo_cas.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                <option value="Administracion">Administracion</option>                                                 <option value="Producto">Producto</option>                                                 <option value="Usuario">Usuario</option>                                                 <option value="Cliente">Cliente</option>                                                 <option value="Empresa">Empresa</option>                                                                                            </select></div>                                                                                                                        <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Asunto</label>                                            <div class="controls"><input type="text" name="asunto" value="<?php if(isset($_GET['a'])){echo $asunto_cas;} ?>" class="span6" placeholder=" " required></div>                                            <label></label><div class="controls"> </div>                                                                                                          <label></label><div class="controls"> </div>                                            <label class="control-label">Descripcion</label>                                            <div class="controls"><textarea name="descripcion" class="span6" rows="6"><?php if(isset($_GET['a'])){echo $descripcion_cas;} ?></textarea></div>                                                                                        <label></label><div class="controls"> </div>                                            <label class="control-label">Resolucion</label>                                            <div class="controls"><textarea name="resolucion" class="span6" rows="6"><?php if(isset($_GET['a'])){echo $resolucion_cas;} ?></textarea></div>                                                                                          <label></label><div class="controls"> </div><label class="control-label">Asignado a</label>                                            <div class="controls"><select name="area" class="span2" id="area">                              <?php                                                                   if(isset($_GET['a'])){echo '<option value="'.$area.'">'.$area.'</option>';}else{echo '<option value="">..Area..</option>';}                                                                   require '../modelo/conexion.php';                                                           $consulta= "SELECT * FROM `areas`";                                                                                 $result=  mysql_query($consulta);                                                            while($fila=  mysql_fetch_array($result)){                                                                                                                      $area=$fila['area'];                                                                                                                       echo"<option value='".$area."'>".$area."</option>";                                                                                                                        }                                                            ?>                                                     </select>                                          <select name="usuario" class="span2" id="user">                              <?php                                       echo '<option value="'.$_SESSION['k_username'].'">'.$_SESSION['k_username'].'</option>';                                                                                                                             $consulta2= "SELECT * FROM `usuarios`";                                                                                 $result2=  mysql_query($consulta2);                                                            while($fila2=  mysql_fetch_array($result2)){                                                                                                                      $usuario=$fila2['usuario'];                                                                                                                       echo"<option value='".$usuario."'>".$usuario."</option>";                                                                                                                        }                                                            ?>                                                     </select>                                                                                   </div>                                                                                                                                   </div>                                    <div class="control-group">                                            <label class="control-label">Empresa</label>                                            <div class="controls"><select name="empresa" class="span4" id="select2_1" required>                              <?php                                                                echo '<option value="'.$_GET['cod'].'">'.$nombre_emp.'</option>';                                                                   require '../modelo/conexion.php';                                                           $consulta= "SELECT * FROM `sis_empresa`";                                                                                 $result=  mysql_query($consulta);                                                            while($fila=  mysql_fetch_array($result)){                                                                                                                      $empre=$fila['nombre_emp'];                                                            $id_empre=$fila['id_empresa'];                                                            echo"<option value='".$id_empre."'>".$empre."</option>";                                                                                                                        }                                                            ?>                                                     </select>                                                                                        </div><br></div>                                      <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['a'])){echo 'Guardar Cambio';}else{echo 'Guardar';} ?></button>                                        <a href="../vistas/?id=casos"><button type="button" class="btn">Cancelar</button></a>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                                    </div>                                    <div class="tab-pane <?php if(isset($_GET['up1'])){echo 'active';}  ?>" id="tab9">                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/incidencia_add.php?empr='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                            <header><h4 class="title"><?php if(isset($_GET['a'])){echo 'Editar Incidencia';}else{echo 'INCIDENCIAS';} ?></h4></header>                            <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                        <label></label><div class="controls"> </div>                                                                                       <label class="control-label">Prioridad</label>                                            <div class="controls"><select name="prioridad" class="span6">                                                 <?php if(isset($_GET['a'])){echo '<option value="'.$prioridad_i.'">'.$prioridad_i.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                  <option value="Alta">Alta</option>                                                 <option value="Media">Media</option>                                                 <option value="Baja">Baja</option>                                                                                             </select></div>                                            <label></label><div class="controls"> </div>                                            <label class="control-label">Tipo</label>                                            <div class="controls"><select name="tipo" class="span6">                                                 <?php if(isset($_GET['a'])){echo '<option value="'.$tipo_i.'">'.$tipo_i.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                 <option value="defecto">Defecto</option>                                                 <option value="caracteristica">Caracteristica</option>                                                                                                                                              </select></div>                                                                                                                        <label></label><div class="controls"> </div>                                                                                          <label class="control-label">Fuente</label>                                            <div class="controls"><select name="fuente" class="span6">                                                 <?php if(isset($_GET['a'])){echo '<option value="'.$fuente_i.'">'.$fuente_i.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                 <option value="interno">Interno</option>                                                 <option value="foro">Foro</option>                                                 <option value="web">Web</option>                                                 <option value="email">Email</option>                                                                                                                                              </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                         <label class="control-label">Categoria</label>                                            <div class="controls"><select name="categoria" class="span6">                                                  <?php if(isset($_GET['a'])){echo '<option value="'.$categoria_i.'">'.$categoria_i.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                 <option value="cuentas">Cuentas</option>                                                 <option value="actividades">Actividades</option>                                                 <option value="seguimiento de incidencias">Seguimiento de incidencias</option>                                                 <option value="calendario">Calendario</option>                                                 <option value="llamadas">LLamadas</option>                                                 <option value="campañas">Campañas</option>                                                 <option value="casos">Casos</option>                                                <option value="contactos">Contactos</option>                                                 <option value="monedas">Monedas</option>                                                 <option value="cuadro de mando">Cuadro de mando</option>                                                <option value="Documentos">Documentos</option>                                                 <option value="email">Email</option>                                                 <option value="fuente rss">Fuente RSS</option>                                                <option value="previsiones">Previsiones</option>                                                 <option value="ayuda">Ayuda</option>                                                 <option value="inicio">Inicio</option>                                                <option value="clientes ptenciales">Clientes potenciales</option>                                                 <option value="reuniones">Reuniones</option>                                                 <option value="notas">Notas</option>                                                <option value="oportunidades">Oportunidades</option>                                                 <option value="plugin de outlook">Plugin de Outlook</option>                                                 <option value="catalogos de producto">Catalogos de producto</option>                                                <option value="productos">Productos</option>                                                 <option value="proyectos">Proyectos</option>                                                 <option value="presupuestos">Presupuestos</option>                                                <option value="lanzamiento">Lanzamiento</option>                                                 <option value="estudio">Estudio</option>                                                 <option value="actualizacion">Actualizacion</option>                                                <option value="usuarios">Usuarios</option>                                                                                                                                             </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                          <label class="control-label">Encontrado en lanzamiento</label>                                            <div class="controls"><select name="lanzamiento" class="span6">                                                  <?php if(isset($_GET['a'])){echo '<option value="'.$lanzamiento_i.'">'.$lanzamiento_i.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                <option value="Si">Si</option>                                                 <option value="No">No</option>                                                                                                                                              </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Asunto</label>                                            <div class="controls"><input type="text" name="asunto" value="<?php if(isset($_GET['a'])){echo $asunto_i;} ?>" class="span6" placeholder=" " required></div>                                                                                        <label></label><div class="controls"> </div>                                            <label class="control-label">Descripcion</label>                                            <div class="controls"><textarea name="descripcion" class="span6" rows="6"><?php if(isset($_GET['a'])){echo $descripcion_i;} ?></textarea></div>                                                                                        <label></label><div class="controls"> </div>                                            <label class="control-label">Registro de actividad</label>                                            <div class="controls"><textarea name="registro" class="span6" rows="6"><?php if(isset($_GET['a'])){echo $registro_i;} ?></textarea></div>                                            <label></label><div class="controls"> </div>                                                                                                                                                                               <label></label><div class="controls"> </div>                                                                                                                                                                                  <label class="control-label">Estado</label>                                            <div class="controls"><select name="estado" class="span6">                                                  <?php if(isset($_GET['a'])){echo '<option value="'.$estado_i.'">'.$estado_i.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                 <option value="nuevo">Nuevo</option>                                                 <option value="asignado">Asignado</option>                                                 <option value="Cerrado">Cerrado</option>                                                 <option value="Pendiente">Pendiente</option>                                                 <option value="rechazado">Rechazado</option>                                                                                                                                             </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Resolucion</label>                                            <div class="controls"><select name="resolucion" class="span6">                                                  <?php if(isset($_GET['a'])){echo '<option value="'.$resolucion_i.'">'.$resolucion_i.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                 <option value="aceptado">Aceptado</option>                                                 <option value="duplicado">Duplicado</option>                                                 <option value="coregido">Corregido</option>                                                 <option value="caducado">Caducado</option>                                                 <option value="no valido">No valido</option>                                                <option value="pospuesto">Pospuesto</option>                                                </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Corregido en lanzamiento</label>                                            <div class="controls"><select name="corregido" class="span6">                                                  <?php if(isset($_GET['a'])){echo '<option value="'.$correg.'">'.$correg.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>                                                                                                 <option value="Si">Si</option>                                                 <option value="No">No</option>                                                                                                </select></div>                                               <label></label><div class="controls"> </div><label class="control-label">Asignado a</label>                                            <div class="controls"><select name="area" class="span2" id="area">                              <?php                                                                   if(isset($_GET['a'])){echo '<option value="'.$area.'">'.$area.'</option>';}else{echo '<option value="">..Area..</option>';}                                                                   require '../modelo/conexion.php';                                                           $consulta= "SELECT * FROM `areas`";                                                                                 $result=  mysql_query($consulta);                                                            while($fila=  mysql_fetch_array($result)){                                                                                                                      $area=$fila['area'];                                                                                                                       echo"<option value='".$area."'>".$area."</option>";                                                                                                                        }                                                            ?>                                                     </select>                                          <select name="usuario" class="span2" id="user">                              <?php                                                          echo '<option value="'.$_SESSION['k_username'].'">'.$_SESSION['k_username'].'</option>';                                                                                                                             $consulta2= "SELECT * FROM `usuarios`";                                                                                 $result2=  mysql_query($consulta2);                                                            while($fila2=  mysql_fetch_array($result2)){                                                                                                                      $usuario=$fila2['usuario'];                                                                                                                       echo"<option value='".$usuario."'>".$usuario."</option>";                                                                                                                        }                                                            ?>                                                     </select>                                                                                   </div>                                                                                                                                                                                <label></label><div class="controls"> </div>                                                                                                                                                                                  <label></label><div class="controls"> </div>                                                                                                                        </div>                                      <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['a'])){echo 'Guardar Cambios';}else{echo 'Guardar';} ?></button>                                        <button type="button" class="btn">Cancelar</button>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                                                                          </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div><?php  if(isset($_GET['del'])){$sql = "DELETE FROM sis_proyecto_tarea WHERE id_tp=".$_GET['del']."";mysql_query($sql, $conexion);echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=ver_proyectos&cod=".$_GET['cod']."";echo "</script>";}                                                              