<script language="JavaScript" type="text/javascript" src="../js/ajax.js"></script>
<div class="row-fluid">  
    <!-- START Form Wizard -->   
    <!-- START Widget Collapse --> 
    <section class="body">     
        <div class="body-inner">    
            <div class="span12 widget dark stacked"> 
                <header>      
                    <h4 class="title">Proyectos y Campañas</h4>     
                    <!-- START Toolbar --> 
                    <ul class="toolbar pull-left">   
                        <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>  
                    </ul>    
                    <!--/ END Toolbar -->    
                </header>  
                <section id="collapse2" class="body collapse in">   
                    <div class="body-inner">    
                        <!-- Normal Tabs -->        
                        <div class="tabbable" style="margin-bottom: 25px;">  
                            <ul class="nav nav-tabs">   
                                <li class="active"><a href="#tab11" data-toggle="tab"><span class="icon icone-eye-open"></span>Lista </a></li>   
                                <li class=""><a href="#tab12" data-toggle="tab"><span class="icon icon-wrench"></span> Nuevo Proyecto</a></li>         
                                <li class=""><a href="#tab13" data-toggle="tab"><span class="icon icon-bullhorn"></span> Nueva Campaña</a></li>      
                            </ul>           
                            <div class="tab-content">     
                                <div class="tab-pane <?php if(isset($_GET['up1'])){}else{echo 'active';}  ?>" id="tab11">    
                                    <!-- START Row -->  
                                    <div class="row-fluid">   
                                        <!-- START Datatable 2 -->      
                                        <div class="span12 widget lime">       
                                            <section class="body">   
                                                <div class="body-inner no-padding">
                                                    <?php  echo '<hr>';echo '<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">PROYECTOS</font></th></tr></table>';$request=mysqli_query($conexion,"SELECT * FROM sis_proyecto a, sis_proyecto_mas b where a.id_proyecto=b.id_proyecto and b.id_contacto=".$_GET['cod']."");     
                                                    if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="20%">'.'Nombre'.'</th>';                           $table = $table.'<th width="10%">'.'Fecha Inicio'.'</th>';              $table = $table.'<th width="10%">'.'Fecha Fin'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Asignado a'.'</th>';              $table = $table.'<th>'.'Editar..'.'</th>';              $table = $table.'<th>'.'Eliminar'.'</th>';                            $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysqli_fetch_array($request))	{                      $table = $table.'<tr><td width="20%"><a href="../vistas/?id=ver_proyectos&cod='.$row['id_proyecto'].'">'.$row['nombre_pro'].'</a></td>                <td width="10%">'.$row['fecha_inicial'].'</a></td><td width="20%">'.$row['fecha_final'].'<font></a></td>                    <td width="10%">'.$row["estado_pro"].'<font></a></td>                        <td class="hidden-phone">'.$row["usuario"].'</font></td>                                <td><a href="../vistas/?id=proyecto&cod='.$row["id_proyecto"].'"><img src="../imagenes/modificar.png"></a></td>                                    <td><a href="../vistas/?id=proyectos&del='.$row["id_proyecto"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';         	}                	$table = $table.'</table>';        	echo $table;             }  echo '<hr>';echo '<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">CAMPAÑAS</font></th></tr></table>';$request=mysqli_query($conexion,"SELECT * FROM sis_campana  where id_contacto=".$_GET['cod']."");     if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="20%">'.'Campaña'.'</th>';                           $table = $table.'<th width="10%">'.'Estado'.'</th>';              $table = $table.'<th width="10%">'.'Tipo'.'</th>';              $table = $table.'<th width="10%">'.'Fecha Inicio'.'</th>';              $table = $table.'<th width="10%">'.'Fecha Fin'.'</th>';                           $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';              $table = $table.'<th>'.'Editar..'.'</th>';              $table = $table.'<th>'.'Eliminar'.'</th>';                            $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysqli_fetch_array($request))	{                      $table = $table.'<tr><td width="20%"><a href="../vistas/?id=ver_campanas&cod='.$row['id_campana'].'">'.$row['nombre_cam'].'</a></td>                <td width="10%">'.$row['estado_cam'].'</a></td><td width="10%">'.$row['tipo_cam'].'</td>                    <td width="10%">'.$row["fecha_inicio_cam"].'<font></a></td>               <td width="10%">'.$row["fecha_fin_cam"].'</font></td>                   <td class="hidden-phone">'.$row["asignado_cam"].'</font></td>                                <td><a href="../vistas/?id=campana&cod='.$row["id_campana"].'"><img src="../imagenes/modificar.png"></a></td>                                    <td><a href="../vistas/?id=campanas&del='.$row["id_campana"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';         	}                	$table = $table.'</table>';        	echo $table;             } ?>        
                                                </div>            
                                            </section> 
                                        </div>      
                                        <!--/ END Datatable 2 -->           
                                    </div>            
                                    <!--/ END Row -->    
                                </div>     
                                <div class="tab-pane <?php if(isset($_GET['up1'])){echo 'active';}  ?>" id="tab12">
                                    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/proyecto_add.php?cont='.$_GET['cod'].'';?>" method="post" id="form_validate_html" enctype="multipart/form-data">         
                                        <header><h4 class="title"><?php if(isset($_GET['a'])){echo 'Editar Proyecto';}else{echo 'Crear Proyecto';} ?></h4></header>       
                                        <section class="body">     
                                            <div class="body-inner">    
                                                <div class="control-group">         
                                                    <label></label><div class="controls"> </div> 
                                                    <label class="control-label">Nombre del Proyecto</label>     
                                                    <div class="controls"><input type="text" name="nombre" value="<?php if(isset($_GET['a'])){echo $nombre_pro;} ?>" class="span6" placeholder=" " required></div>
                                                    <label></label><div class="controls"> </div>    
                                                    <label class="control-label">Fecha de inicio</label>       
                                                    <div class="controls">
                                                        <input name="fecha_inicial" value="<?php if(isset($_GET['a'])){echo $fecha_i;} ?>" type="text" id="datepicker1" placeholder="fecha registro" required> </div>    
                                                        <label></label><div class="controls"> </div>  
                                                        <label></label><div class="controls"> </div>  
                                                        <label class="control-label">Prioridad</label>    
                                                        <div class="controls"><select name="prioridad" class="span6" required>       
                                         <?php if(isset($_GET['a'])){echo '<option value="'.$estado_pro.'">'.$estado_pro.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>  
                                                                <option value="alta">Alta</option>     
                                                                <option value="media">Media</option>     
                                                                <option value="baja">Baja</option>         
                                                            </select></div>                           
                                                        <label></label><div class="controls"> </div>        
                                                        <label class="control-label">Descripcion</label>           
                                                        <div class="controls"><textarea name="descripcion" class="span6" rows="6" required><?php if(isset($_GET['a'])){echo $descripcion_pro;} ?></textarea></div>       
                                                        <label></label><div class="controls"> </div>      
                                                        <label class="control-label">Estado</label>   
                                                        <div class="controls"><select name="estado" class="span6">        
                                          <?php if(isset($_GET['a'])){echo '<option value="'.$estado_pro.'">'.$estado_pro.'</option>';}else{echo '<option value=" ">Seleccione</option> ';} ?>
                                                                <option value="borrador">Borrador</option>   
                                                                <option value="revision">Revision</option>  
                                                                <option value="publicado">Publicado</option>
                                                            </select></div>     
                                                        <label></label><div class="controls"> </div> 
                                                        <label class="control-label">Fecha Fin</label>  
                                                        <div class="controls">
                                                            <input name="fin"  value="<?php if(isset($_GET['a'])){echo $fecha_f;} ?>" type="text" id="datepicker2" placeholder="fecha registro" required> </div>     
                                                </div><div class="control-group">     
                                                    <label class="control-label">Asignado a</label>   
                                                    <div class="controls"><select name="area" class="span2" id="area">       
                       <?php         
                       if(isset($_GET['a'])){echo '<option value="'.$area.'">'.$area.'</option>';}else{echo '<option value="">..Area..</option>';}     
                       require '../modelo/conexion.php';                     
                       $consulta= "SELECT * FROM `areas`";        
                       $result=  mysqli_query($conexion,$consulta);    
                       while($fila=  mysqli_fetch_array($result)){   
                           $area=$fila['area'];                
                           echo"<option value='".$area."'>".$area."</option>";    
                           }                                                            ?>
                                                        </select>                                          <select name="usuario" class="span2" id="user">   
                           <?php        
                           if(isset($_GET['a'])){echo '<option value="'.$_SESSION['k_username'].'">'.$_SESSION['k_username'].'</option>';}else{echo '<option value="">..Usuario..</option>';}     
                           $consulta2= "SELECT * FROM `usuarios`";              
                           $result2=  mysqli_query($conexion,$consulta2);        
                           while($fila2=  mysqli_fetch_array($result2)){       
                               $usuario=$fila2['usuario'];   
                               echo"<option value='".$usuario."'>".$usuario."</option>";         
                               }     
                               ?>              
                                                        
                                                        </select>               
                                                    </div>                     
                                                    <!-- Form Action --> 
                                                    <div class="form-actions">          
                                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['a'])){echo 'Guardar Cambios';}else{echo 'Guardar';} ?></button>    
                                                        <button type="button" class="btn">Cancelar</button>   
                                                    </div><!--/ Form Action -->   
                                                </div>   
                                        </section>    
                                    </form>    
                                </div>                       
                                            <div class="tab-pane <?php if(isset($_GET['up1'])){echo 'active';}  ?>" id="tab13">
                                                <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/campana_add.php?cont='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">        
                                                    <header><h4 class="title"><?php if(isset($_GET['a'])){echo 'Editar Campaña';}else{echo 'Campañas';} ?></h4></header>     
                                                    <section class="body">           
                                                        <div class="body-inner">      
                                                            <div class="control-group">               
                                                                <label class="control-label">Nombre :</label>   
                                                                <div class="controls">
                                                                    <input type="text" name="nombre_cam" value="<?php if(isset($_GET['a'])){echo $nombre_ca;} ?>" class="span6" placeholder=" " required>
                                                                </div>       
                                                                <label></label><div class="controls"> </div>   
                                                                <label class="control-label">Estado<b></b></label>    
                                                                <div class="controls"><select name="estado_cam" class="span2" required>  
                                              <?php  if(isset($_GET['a'])){echo '<option value="'.$estado_ca.'">'.$estado_ca.'</option>';}else{echo '<option value="">.Seleccione..</option>';}  ?>   
                                                                        <option value="Planificacion">Planificacion</option>      
                                                                        <option value="Activa">Activa</option>       
                                                                        <option value="Inactiva">Inactiva</option>        
                                                                        <option value="Completa">Completa</option>         
                                                                        <option value="En cola">En cola</option>     
                                                                        <option value="En envio">En envio</option>        
                                                                    </select></div>   
                                                                <label></label><div class="controls"> </div><label class="control-label">Fecha de inicio</label>  
                                                                <div class="controls"><input name="fecha_inicio_c"  value="<?php  if(isset($_GET['a'])){echo $fecha_i_ca;}else{echo date("m/d/Y"); } ?>"  class="span3" type="text" id="datepicker1" placeholder="">   
                                                                </div>      
                                                                <label></label><div class="controls"> </div>       
                                                                <label></label><div class="controls"> </div><label class="control-label">Fecha de Vencimiento</label>     
                                                                <div class="controls">
                                                                    <input name="fecha_fin_c"  value="<?php  if(isset($_GET['a'])){echo $fecha_f_ca;}else{echo date("m/d/Y"); } ?>" class="span3" type="text" id="datepicker2" placeholder="">  
                                                                </div>                                          
                                                                <label class="control-label">Tipo<b></b></label>   
                                                                <div class="controls"><select name="tipo_cam" class="span2" required> 
                                               <?php  if(isset($_GET['a'])){echo '<option value="'.$tipo_ca.'">'.$tipo_ca.'</option>';}else{echo '<option value="">.Seleccione..</option>';}  ?>    
                                                                        <option value="Televenta">Televenta</option>
                                                                        <option value="Correo">Correo</option>        
                                                                        <option value="Imprenta">Imprenta</option>        
                                                                        <option value="Web">Web</option>    
                                                                        <option value="Radio">Radio</option>   
                                                                        <option value="Television">Television</option>     
                                                                        <option value="Noticias">Noticias</option>      
                                                                        <option value="Puerta a puerta">Puerta a puerta</option>       
                                                                        <option value="Calle">Calle</option>     
                                                                        <option value="Locales">Locales</option>   
                                                                    </select></div>                 
                                                                <label></label><div class="controls"> </div> 
                                                                <label class="control-label">Moneda</label>    
                                                                <div class="controls"><select name="moneda_cam" class="span4">  
                                               <?php  if(isset($_GET['a'])){echo '<option value="'.$moneda_ca.'">'.$moneda_ca.'</option>';}else{echo '<option value="">.Seleccione..</option>';}  ?> 
                                                                        <option value="Pesos Colombiano">Pesos Colombiano</option>  
                                                                        <option value="Us Dollar">Us Dollar</option>   
                                                                    </select></div>     
                                                                <label></label><div class="controls"> </div>  
                                                                <label class="control-label">Presupuesto :</label>    
                                                                <div class="controls">
                                                                    <input type="text" name="presupuesto_cam" value="<?php if(isset($_GET['a'])){echo $presupuesto_ca;} ?>" class="span6" placeholder=" " required></div> 
                                                                    <label></label><div class="controls"> </div>
                                                                    <label></label><div class="controls"> </div>   
                                                                    <label class="control-label">Ingresos esperados :</label>    
                                                                    <div class="controls"><input type="text" name="ingresos" value="<?php if(isset($_GET['a'])){echo $ingreso_ca;} ?>" class="span6" placeholder=" " required></div>    
                                                                    <label></label><div class="controls"> </div>  
                                                                    <label></label><div class="controls"> </div>       
                                                                    <label class="control-label">Impresiones:</label>      
                                                                    <div class="controls"><input type="text" name="impresiones" value="<?php if(isset($_GET['a'])){echo $imp;} ?>" class="span6" placeholder=" " required></div>
                                                                    <label></label><div class="controls"> </div>      
                                                                    <label></label><div class="controls"> </div>       
                                                                    <label class="control-label">Coste Real:</label>            
                                                                    <div class="controls"><input type="text" name="costo" value="<?php if(isset($_GET['a'])){echo $costo_r;} ?>" class="span6" placeholder=" " required></div>    
                                                                    <label></label><div class="controls"> </div>             
                                                                    <label></label><div class="controls"> </div>  
                                                                    <label class="control-label">Coste Esperado:</label>      
                                                                    <div class="controls"><input type="text" name="costo_esp" value="<?php if(isset($_GET['a'])){echo $costo_e;} ?>" class="span6" placeholder=" " required></div>     
                                                                    <label></label><div class="controls"> </div>  
                                                                    <label></label><div class="controls"> </div>      
                                                                    <label class="control-label">Objetivo</label>       
                                                                    <div class="controls"><textarea name="objectivo_cam" class="span6" rows="4"><?php  if(isset($_GET['a'])){echo $des;}else{} ?></textarea></div>    
                                                                    <label></label><div class="controls"> </div>          
                                                                    <label></label><div class="controls"> </div>              
                                                                    <label class="control-label">Descripcion</label>   
                                                                    <div class="controls">
                                                                        <textarea name="descripcion_cam" class="span6" rows="4"><?php  if(isset($_GET['a'])){echo $des;}else{} ?></textarea></div>    
                                                                        <label></label><div class="controls"> </div>          
                                                                        <label class="control-label">Asignado a</label>          
                                                                        <div class="controls"><select name="area" class="span2" id="area"> 
                             <?php       
                             if(isset($_GET['a'])){echo '<option value="'.$area.'">'.$area.'</option>';}else{echo '<option value="">..Area..</option>';}        
                             require '../modelo/conexion.php';    
                             $consulta= "SELECT * FROM `areas`";     
                             $result=  mysqli_query($conexion,$consulta);     
                             while($fila=  mysqli_fetch_array($result)){      
                                 $area=$fila['area'];               
                                 echo"<option value='".$area."'>".$area."</option>";        
                                 }                  
                                 ?>                        
                                                                            </select>           
                                                                            <select name="usuario" class="span2" id="user">    
                          <?php                        
                          if(isset($_GET['a'])){echo '<option value="'.$_SESSION['k_username'].'">'.$_SESSION['k_username'].'</option>';}else{echo '<option value="">..Usuario..</option>';}        
                          $consulta2= "SELECT * FROM `usuarios`";           
                          $result2=  mysqli_query($conexion,$consulta2);            
                          while($fila2=  mysqli_fetch_array($result2)){         
                              $usuario=$fila2['usuario'];                        
                              echo"<option value='".$usuario."'>".$usuario."</option>";          
                              }                 
                              ?>                  
                                                                            </select>       
                                                                        </div>               
                                                                        <label></label><div class="controls"> </div>  
                                                            </div>                                    <!-- Form Action -->                 
                                                            <div class="form-actions">         
                                                                <button type="submit" class="btn btn-primary"><?php if(isset($_GET['a'])){echo 'Guardar Cambios';}else{echo 'Guardar';} ?></button>    
                                                                <button type="button" class="btn">Cancelar</button>          
                                                            </div><!--/ Form Action -->                                </div>                            </section>               
                                                </form>                                                                          </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>    
                </section>                        </div>           
            </div> </section></div>
                <?php  if(isset($_GET['del'])){$sql = "DELETE FROM sis_proyecto_tarea WHERE id_tp=".$_GET['del']."";mysqli_query($conexion,$sql);echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=ver_proyectos&cod=".$_GET['cod']."";echo "</script>";}  
                
            
                       }
                       