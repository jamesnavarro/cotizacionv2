<?php        if(isset($_GET['up'])){        $sql21 = "SELECT a.*, b.* FROM pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_pt='".$_GET['up']."'";        $fila21 =mysql_fetch_array(mysql_query($sql21));        $subpro = $fila21["nombre_subpro"];        $tiempo = $fila21["tiempo_esp"];        $id = $fila21["id_subpro"];        $orden = $fila21["orden"];} $sql = "SELECT * FROM producto where id_p='".$_GET['cod']."'";        $fila21 =mysql_fetch_array(mysql_query($sql));        $pro = $fila21["producto"];$ref = $fila21["codigo"];                 $sqls = 'select max(orden) from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$_GET['cod'].' order by a.orden asc';        $fila21s =mysql_fetch_array(mysql_query($sqls));        $paso = $fila21s["max(orden)"] + 1;?><script language="JavaScript" type="text/javascript" src="../js/ajax.js"></script><div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                            <header>                                <?php $cod = $_GET['cod']-1;$cod2 = $_GET['cod']+1; ?>                                <h4 class="title">Procesos del Producto <i>"<?php echo $ref.' - '.$pro;  ?>" </i></h4>                                                                <!-- START Toolbar -->                                <ul class="toolbar pull-left">                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>                                </ul>                                <!--/ END Toolbar -->                            </header>                            <a href="<?php echo '../vistas/?id=procesos&cod='.$cod.'&linea='.$_GET['linea']; ?>"><button> << Atras</button></a> --                                <a href="<?php echo '../vistas/?id=procesos&cod='.$cod2.'&linea='.$_GET['linea']; ?>"><button>Siguiente >></button></a>                            <section id="collapse2" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                <div class="tab-content">                                    <div class="tab-pane active" id="tab1">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up'])){echo '../modelo/procesos.php?editar='.$_GET['up'].'&cod='.$_GET['cod'].'&linea='.$_GET['linea'].'';}else{echo '../modelo/procesos.php?cod='.$_GET['cod'].'&linea='.$_GET['linea'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                                                    <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                                                                                                                                                      <label></label><div class="controls"> </div>                                               <label class="control-label">Procesos</label>                                               <div class="controls">                                                   <select name="p2" id="linea" required  class="span2">                                                    <?php if(isset($_GET['up'])){echo "<option value='".$id."'>".$subpro."</option>";}else{echo "<option value=''>.:Seleccione:.</option>"; } ?>                                                                  <?php                                                                                                                                       include "../modelo/conexion.php";                                                           $consulta= "SELECT * FROM subproceso";                                                                                 $result=  mysql_query($consulta);                                                            while($fila=  mysql_fetch_array($result)){                                                            $valor1=$fila['id_subpro'];                                                            $valor2=$fila['nombre_subpro'];                                                            echo"<option value=".$valor1.">".$valor2."</option>";                                                                                                                        }                                                            ?>                                                               </select>                                               </div>                                             <label></label><div class="controls"> </div>                                               <label class="control-label">Secuencia</label>                                            <div class="controls"><input type="number" name="secuencia" value="<?php if(isset($_GET['up'])){echo $orden;}else{echo $paso;} ?>" class="span2" placeholder="Digite el porcentaje" required></div>                                            <label></label><div class="controls"> </div>                                               <label class="control-label">Tiempo maximo esperado para comenzar subproceso</label>                                               <div class="controls"><input type="text"  name="time" value="<?php if(isset($_GET['up'])){echo $tiempo;}else{echo '00:00:00';} ?>" class="span2" placeholder="Digite el porcentaje" required></div>                                                                                                                          <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>                                        <button type="button" class="btn">Cancelar</button>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                                              </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                    <div class="tab-pane" id="tab2">                                        <div class="row-fluid">                        <!--/ END Form Wizard -->                    </div>                                    </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div>                                                                        <div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                            <header>                                <h4 class="title">Procesos del Producto</h4>                                <!-- START Toolbar -->                                <ul class="toolbar pull-left">                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>                                </ul>                                <!--/ END Toolbar -->                            </header>                            <section id="collapse2" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                <div class="tab-content">                                    <div class="tab-pane active" id="tab1">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                                        <section class="body">                                <div class="body-inner no-padding"><?php $request=mysql_query('select a.*, b.* from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$_GET['cod'].' order by a.orden asc ');        if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th>'.'Secuencia'.'</th>';              $table = $table.'<th>'.'SubProceso'.'</th>';              $table = $table.'<th>'.'Tiempo de espera'.'</th>';              $table = $table.'<th>'.'Fecha_registro'.'</th>';              $table = $table.'<th>'.'Editar'.'</th>';              $table = $table.'<th>'.'Eliminar'.'</th>';              $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;        if($editar_conf == 'Habilitado'){            $up = '<img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px">';        }else{            $up = '';        }                if($eliminar_conf == 'Habilitado'){            $del = '<img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px">';        }else{            $del = '';        }        	while($row=mysql_fetch_array($request))	{                          $table = $table.'<tr>'                  . '<td>'.$row["orden"].'</a></td>'                  . '<td>'.$row["nombre_subpro"].'</a></td>'                  . '<td>'.$row['tiempo_esp'].'</td>                    <td>'.$row['fecha_reg'].'</td>'                  . '<td><a href="../vistas/?id=procesos&up='.$row["id_pt"].'&cod='.$_GET['cod'].'&linea='.$_GET['linea'].'"><button>'.$up.'</button></a></td>                   <td><a href="../vistas/?id=procesos&del='.$row["id_pt"].'&cod='.$_GET['cod'].'&linea='.$_GET['linea'].'" onclick="return confirmar()"><button>'.$del.'</button></a></td></tr>';               	} 	$table = $table.'</table>';        	echo $table;  }  ?>                                </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                                           </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div><?php   if(isset($_GET['del']))    {           $Codigo=$_GET['del'];        $sql = "DELETE FROM pt_procesos WHERE id_pt='$Codigo'";        mysql_query($sql, $conexion);       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=procesos&cod='.$_GET['cod'].'&linea='.$_GET['linea'].'"</script>';     }                                                               