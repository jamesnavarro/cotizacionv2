<?php  if(isset($_GET['cod'])){ $sql21 = "SELECT * FROM movimientos a, contactos b, tipos_movimientos c, almacenes d where d.id_alm=a.id_alm and c.id_tm=a.tipo_comprobante and a.id_contacto=b.id_contacto and a.id_movimiento=".$_GET['cod'];            $fila21 =mysql_fetch_array(mysql_query($sql21));            $proveedor= $fila21["nombre"];            $fr= $fila21["fecha_registro"];            $rp= $fila21["recibido_por"];            $nit= $fila21["nitcc"];             $save= $fila21["save_mo"];            $comprobante= $fila21["movimiento"];            $codigo= $fila21['codigo_tm'];             }?> <div class="row-fluid">                        <?php if($_GET['tipo']=='Ingreso'){$in = 'Ingreso'; $us = 'Proveedor';}else{$in = 'Salida'; $us = 'Cliente';}  ?>    <form class="span12 widget shadowed dark form-horizontal" action="<?php if(isset($_GET['edit'])){echo '../modelo/ingreso.php?tipo='.$in.'&cod='.$_GET['cod'].'&editar ';}else{echo '../modelo/ingreso.php?tipo='.$in.' ';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                            <header><h4 class="title">Ingreso de Mercancias</h4></header>                         <?php  if(isset($_GET['cod'])){                             if(isset($_GET['edit'])){                                 echo '<button type="submit"><img src="../imagenes/guardar.jpg"> Guardar Cambios</button>';                             }else{                          echo '<a href="../vistas/?id=movimientos&cod='.$_GET['cod'].'&edit&tipo='.$_GET['tipo'].'"><button type="button"><img src="../imagenes/modificar.png"> Editar Encabezado</button></a>   <a href="../vistas/?id=movimientos&tipo='.$_GET['tipo'].'"><button type="button"><img src="../imagenes/mas.gif"> Nuevo Ingreso</button></a>';                             }                         }else{                            echo '<button type="submit"><img src="../imagenes/guardar.jpg"> Guardar datos basico</button>';                              } ?>                                <div class="body-inner">                                    <table>                                        <tr>                                            <td>Fecha de Registro</td>                                            <td><input type="text" name="fr" value="<?php if(isset($_GET['cod'])){echo $fr;}else{echo date("Y-m-d H:i:s");} ?>" readonly  placeholder=" " required></td>                                            <td></td>                                            <td></td>                                            <td><?php if(isset($_GET['cod'])){echo '<h4>Comprobante No.</h4>';} ?></td>                                            <td><?php if(isset($_GET['cod'])){echo '<h4><font color="red">'.$_GET['cod'].'</font></h4>';} ?></td>                                        </tr>                                        <tr>                                            <td><?php echo $us; ?></td>                                            <td>                                                <select name="contacto" <?php if(isset($_GET['cod']) && !isset($_GET['edit'])){echo 'readonly';} ?> id="select2_1" required>                                                       <?php                         require '../modelo/conexion.php';                          if(isset($_GET['cod'])){echo"<option value='".$fila21['id_contacto']."'>".$fila21['nombre']."</option>"; }                        else{echo '<option value="">Seleccione el '.$us.'</option>';}                        $consulta= "SELECT * FROM contactos where tipo='".$us."'";                         $result=  mysql_query($consulta);                                                                               while($fila=  mysql_fetch_array($result)){                             $empre=$fila['nombre'];                                  $id_empre=$fila['id_contacto'];                                 echo"<option value='".$id_empre."'>".$fila['nitcc']." - ".$empre."</option>";                         }                                                       ?>                                                                               </select>                                            </td>                                            <td>Seleccione el almacen</td>                                            <td><select name="alm" <?php if(isset($_GET['cod']) && !isset($_GET['edit'])){echo 'readonly';} ?> id="select2_2" required>                                                 <?php                         require '../modelo/conexion.php';                            $consulta3= "SELECT * FROM almacenes";                         $result3=  mysql_query($consulta3);                          if(isset($_GET['cod'])){echo"<option value='".$fila21['id_alm']."'>".$fila21['nombre_alm']."</option>"; }                        else{echo '<option value="">Seleccione el almacen</option>';}                        while($fila=  mysql_fetch_array($result3)){                             $empre=$fila['nombre_alm'];                                  $id_empre=$fila['id_alm'];                                 echo"<option value='".$id_empre."'>".$fila['codigo_alm']." - ".$empre."</option>";                         }                                                       ?>                                                       </select></td>                                            <td>Numero de Doc. </td>                                            <td><input type="text" <?php if(isset($_GET['cod']) && !isset($_GET['edit'])){echo 'readonly';} ?> name="numero" placeholder="# del Doc."  style="width: 80px" value="<?php if(isset($_GET['cod'])){echo $fila21['numero']; }  ?>"></td>                                        </tr>                                        <tr>                                            <td>Periodo Contable</td>                                            <td> <select <?php if(isset($_GET['cod']) && !isset($_GET['edit'])){echo 'readonly';} ?> name="mes" style="width: 60px">                                                        <?php if(isset($_GET['cod'])){echo '<option value="'.$fila21['month'].'">'.$fila21['month'].'</option>';}                                                          ?>                                                        <option value="01"<?php if(date('m')=='01'){echo 'selected';} ?>>01</option>                                                        <option value="02"<?php if(date('m')=='02'){echo 'selected';} ?>>02</option>                                                        <option value="03"<?php if(date('m')=='03'){echo 'selected';} ?>>03</option>                                                        <option value="04"<?php if(date('m')=='04'){echo 'selected';} ?>>04</option>                                                        <option value="05" <?php if(date('m')=='05'){echo 'selected';} ?>>05</option>                                                        <option value="06"<?php if(date('m')=='06'){echo 'selected';} ?>>06</option>                                                        <option value="07"<?php if(date('m')=='07'){echo 'selected';} ?>>07</option>                                                        <option value="08"<?php if(date('m')=='08'){echo 'selected';} ?>>08</option>                                                        <option value="09"<?php if(date('m')=='09'){echo 'selected';} ?>>09</option>                                                        <option value="10"<?php if(date('m')=='10'){echo 'selected';} ?>>10</option>                                                        <option value="11"<?php if(date('m')=='11'){echo 'selected';} ?>>11</option>                                                        <option value="12"<?php if(date('m')=='12'){echo 'selected';} ?>>12</option>                                                                                                            </select>:                                                    <input type="text"  readonly name="ano"  style="width: 40px" value="<?php if(isset($_GET['cod'])){echo $fila21['year']; }else{echo date('Y');}  ?>"></td>                                            <td> Tipo de Comprobante.</td>                                            <td>  <select name="comprobante" <?php if(isset($_GET['cod']) && !isset($_GET['edit'])){echo 'readonly';} ?> required>                                                     <?php                          if(isset($_GET['cod'])){echo"<option value='".$fila21['id_tm']."'>".$fila21['codigo_tm']." - ".$fila21['movimiento']."</option>"; }                        else{echo '<option value="">Seleccione Comprobante</option>';}                        require '../modelo/conexion.php';                            $consulta2= "SELECT * FROM comprobantes";                         $result2=  mysql_query($consulta2);                                                while($fila=  mysql_fetch_array($result2)){                             $emp=$fila['comprobante'];                                  $id=$fila['id_comprobante'];                                 echo"<option value='".$id."'>".$fila['codigo_c']." - ".$emp."</option>";                         }                                                       ?>                                                       </select></td>                                            <td>V.Total de Doc. </td>                                            <td><input type="text" <?php if(isset($_GET['cod']) && !isset($_GET['edit'])){echo 'readonly';} ?> name="total" placeholder="$ valor total" style="width: 80px" value="<?php  if(isset($_GET['cod'])){echo $fila21['total_mov'];} ?>"></td>                                        </tr>                                                                            </table>                                    <textarea  name="obs" <?php if(isset($_GET['cod']) && !isset($_GET['edit'])){echo 'readonly';} ?> placeholder="Digite algunas observaciones aqui." class="span7" rows="3"><?php  if(isset($_GET['cod'])){echo $fila21['observaciones'];}else{} ?></textarea>                                    <br><?php if(isset($_GET['cod'])){echo 'Registrado Por: '.$fila21['recibido_por'];} ?>                                                                                                                       <br><br>                                                                                                                 </form>                        <!--/ END Form Wizard -->                        <!-- START Form Wizard -->                                        <?phpif(isset($_GET['cod'])){ ?>                                   <?php      ?>                               <section class="body">                                <div class="body-inner">                                                                   <section id="collapse2" class="body collapse in">                                <div class="body-inner">                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                <ul class="nav nav-tabs">                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span> Materiales</a></li>                                  <?php  if($crear_conf=='Habilitado'){echo '<li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar</a></li>';}  ?>                                                                  </ul>                                <div class="tab-content">                                    <div class="tab-pane active" id="tab1">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                                        <section class="body">                                <div class="body-inner no-padding"> <form class="span12 widget shadowed dark form-horizontal bordered" action="../vistas/?id=movimientos&cod=<?php echo $_GET['cod'].'&tipo='.$_GET['tipo'] ?>&save" method="post" id="form_validate_html" enctype="multipart/form-data">                                        <?php if($save==0){ ?>                                    <button type="submit"><img src="../imagenes/guardar.jpg"> Guardar Cambios</button>                                    <i><font color="red">Nota:Primero agregue los materiales, luego guarde todos los cambios para qu realize los calculos de las cantidades y de los precios promedio.</font></i>                                                               <?php }else{ ?>                                                                        <a href="../vistas/?id=movimientos&cod=<?php echo $_GET['cod'] ?>&print"><button type="button"><img src="../imagenes/printer.png"> Imprimir</button></a>                                        <?php } $request=mysql_query("SELECT * FROM referencias a, movimientos c, movimientos_items d where d.id_insumo=a.id_referencia and c.id_movimiento=d.id_movimiento and d.id_movimiento=".$_GET['cod']." ");     if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="5%">'.'Items'.'</th>';                  $table = $table.'<th width="5%">'.'Codigo'.'</th>';               $table = $table.'<th width="30%">'.'Descripcion'.'</th>';              $table = $table.'<th width="10%">'.'Tipo Mov'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Tipo Operacion'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Cantidad Inicial'.'</th>';               $table = $table.'<th class="hidden-phone">'.'Cantidad Disponible'.'</th>';                 $table = $table.'<th class="hidden-phone">'.'Stock'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Entrada'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Costo Promedio'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Valor Unidad'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Valor Total'.'</th>';                           $table = $table.'<th>Eliminar</th>';               $table = $table.'<th width="10%">'.'Registro de Movimiento'.'</th>';              $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysql_fetch_array($request))	{        if($row["tipo_mov"]=='Ingreso'){            $color= '<font color="green">';            $ca= '+'.$row["cantidad_compra"];        }else{            $color= '<font color="red">';            $ca= '-'.$row["cantidad_compra"];        }        $total2 += $row["costo_compra"]*$row["cantidad_compra"];            $disponible = $row["cantidad_e"] - $row["cantidad_r"];if($editar_conf=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';} if($eliminar_conf=='Habilitado'){if($row["save_items"]==0){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}}else{$del='';}            $table = $table.'<tr><td width="5%">'.$row['id_referencia'].'</a></td>'                    . '<td width="5%">'.$row['codigo'].'</font></td><td width="30%">'.$row['descripcion'].'</font></td>'                    . '<td width="10%">'.$color.' '.$row["tipo_mov"].'<font></a></td></td>               <td class="hidden-phone">0'.$row["id_operacion"].'</font></td>'                    . '<td  class="hidden-phone">'.$row["cantidad_e"].'<font></a></td>'                    . '<td  class="hidden-phone">'.$disponible.'<font></a></td>'                    . '<td  class="hidden-phone">'.$row["stock"].'<font></a></td>'                    . '<td  class="hidden-phone">'.$ca.'<font></a></td>'                    . '<td width="10%">$'.number_format($row["costo_mt"]).'<font></a></td>'                    . '<td width="10%">'.number_format($row["costo_compra"]).'<font></a></td>                        <td width="10%">'.number_format($row["costo_compra"]*$row["cantidad_compra"]).'<font></a></td>                        <td> <a href="../vistas/?id=movimientos&del='.$row["id_mi"].'&cod='.$_GET['cod'].'">'.$del.'</a></td>'                    . '<td width="10%">'.$row["fecha_de_ingreso"].'<font></a></td></tr>';              		               	} 	$table = $table.'</table>';        	echo $table;        echo '<P ALIGN=RIGHT>TOTAL DEL DOCUMENTO: <input type="text" readonly name="t" value="'.$total2.'"></P>';        if($_GET['tipo']=='Ingreso'){                if($fila21['total_mov']==$total2){                   echo '<P ALIGN=RIGHT>Ya puede guardar todos los cambios</P>';                }else{                    echo '<P ALIGN=RIGHT><font color="red">Advertencia: el total de los items no concuerda con el total del encabezado</font></P>';                }        }else{                    }  }     ?>                           </form>                                                           </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                    <div class="tab-pane" id="tab2">                                        <div class="row-fluid">                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="../modelo/ingreso_items.php?idm=<?php echo $_GET['cod'].'&tipo='.$_GET['tipo'] ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                                                    <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                                                                                                         <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Descripcion</label>                                            <div class="controls">                                                 <select name="referencia" id="select2_3"  required>                                                                                                              <?php                                                          echo '<option value="">Seleccione</option>';                                                           require '../modelo/conexion.php';                                                          $consulta= "SELECT * FROM `referencias`";                                                                                 $result=  mysql_query($consulta);                                                            while($fila=  mysql_fetch_array($result)){                                                            $valor1=$fila['descripcion'];                                                            $v1=$fila['id_referencia'];                                                                                                                        echo"<option value='".$v1."'>".$v1." - ".$valor1."</option>";                                                                                                                        }                                                                                                                       ?>                                                               </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                          <label></label><div class="controls"> </div>                                               <label class="control-label">Stock Disponible</label>                                               <div class="controls">                                                   <div id="sd"><input type="text" name="stock" value="" class="span2"></div>                                              </div>                                               <label></label><div class="controls"> </div>                                               <label class="control-label">Precio Promedio</label>                                               <div class="controls">                                                   <div id="precio"><input type="text" name="precio" value="" class="span2" ></div>                                              </div>                                               <label></label><div class="controls"> </div>                                               <label class="control-label"><?php if($fila21["tipo_mov"]=='Ingreso'){echo 'Cantidad a Ingresar';}else{echo 'Cantidad a despachar';}  ?></label>                                            <div class="controls"><input type="text" name="cant" value="<?php if(isset($_GET['up_1'])){echo $stock;} ?>" class="span2" placeholder="" required>                                              </div>                                               <label></label><div class="controls"> </div>                                               <label class="control-label"><?php if($fila21["tipo_mov"]=='Ingreso'){echo 'Precio de Compra (Und)';}else{echo 'Precio de Venta (Und)';}  ?></label>                                            <div class="controls"><input type="text" name="pc" value="<?php if(isset($_GET['up_1'])){echo $stock;} ?>" class="span2" placeholder="" required>                                              </div>                                                  <label></label><div class="controls"> </div>                                               <label class="control-label">Tipo de Operación</label>                                            <div class="controls">                                                <select name="operacion"  required>                                                                                                              <?php                                                                                                                     require '../modelo/conexion.php';                                                           if($fila21["tipo_mov"]=='Ingreso'){                                                          $consulta2= "SELECT * FROM `operaciones` order by id_operacion desc";                                                           }else{                                                               $consulta2= "SELECT * FROM `operaciones` order by id_operacion asc";                                                                                                                     }                                                            $result2=  mysql_query($consulta2);                                                            while($fila=  mysql_fetch_array($result2)){                                                            $valor1=$fila['id_operacion'];                                                          $valor2=$fila['orden'];                                                           $valor3=$fila['descripcion'];                                                            echo"<option value='".$valor1."'>".$valor2." - ".$valor3."</option>";                                                                                                                        }                                                                                                                       ?>                                                               </select>                                               </div>                                                                                        <label></label><div class="controls"> </div>                                                                                                                                                                                                                                                                                                                                                               <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>                                        <a href="../vistas/?id=materiales"><button type="button" class="btn">Cancelar</button></a>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                        <!--/ END Form Wizard -->                    </div>                                    </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </section></div><?php } if(isset($_GET['save'])){$request=mysql_query("SELECT * FROM referencias a, categorias_mat b, movimientos c, movimientos_items d where d.id_insumo=a.id_referencia and c.id_movimiento=d.id_movimiento and a.cod_cat=b.cod_cat and d.id_movimiento=".$_GET['cod']." ");while($row=mysql_fetch_array($request))	{            $limi = mysql_query("select avg(costo_compra) from movimientos_items where id_insumo=".$row['id_referencia']." ");            $lim = mysql_fetch_array($limi);            $cost = $lim['avg(costo_compra)'];                        $sql2 = "UPDATE `movimientos_items` SET `save_items`='1' WHERE `id_movimiento` = ".$_GET['cod'].";";            mysql_query($sql2, $conexion);            $sql3 = "UPDATE `movimientos` SET `save_mo`='1' WHERE `id_movimiento` = ".$_GET['cod'].";";            mysql_query($sql3, $conexion);            if($row["tipo_mov"]=='Ingreso'){            $cant= ($row["cantidad_e"] - $row["cantidad_r"]) + $row["cantidad_compra"];             $sql3 = "UPDATE `referencias` SET `costo_mt`='".$cost."',`cantidad_e`='".$cant."' WHERE `id_referencia` = ".$row['id_referencia'].";";            }else{                $cant= ($row["cantidad_r"]) + $row["cantidad_compra"];                 $sql3 = "UPDATE `referencias` SET `cantidad_r`='".$cant."' WHERE `id_referencia` = ".$row['id_referencia'].";";            }                      mysql_query($sql3, $conexion);            }echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el movimiento");location.href="../vistas/?id=movimientos&cod='.$_GET['cod'].'&tipo='.$_GET['tipo'].'"</script>'; }                        if(isset($_GET['del'])){$sql = "DELETE FROM movimientos_items WHERE id_mi=".$_GET['del']."";mysql_query($sql, $conexion);echo '<script lanquage="javascript">alert("Se ha Eliminado Satisfactoriamente el movimiento");location.href="../vistas/?id=movimientos&cod='.$_GET['cod'].'"</script>'; }                               