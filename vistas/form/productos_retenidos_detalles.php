<?php  $request=mysql_query("SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f where f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and f.estado='Terminado' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p group by f.id_orden_d ");   if($request){        $cont1 =0;	while($row=mysql_fetch_array($request))	{                          $cont1 = $cont1 + 1;	} 	$num_items = $cont1;      }else{	$num_items = 0;}$rows_by_page = 20;$last_page = ceil($num_items/$rows_by_page);if(isset($_GET['page'])){	$page = $_GET['page'];}else{	$page = 1;}?>                             <div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                        <header>                                <h4 class="title">Productos Retenidos por Cartera</h4>    <form  action="" method="post" id="" enctype="multipart/form-data"><input type="text" name="numero1" placeholder="# Referencia" value=""> <input type="text" name="numero2" placeholder="# Pedido" value=""> <input type="text" name="numero3" placeholder="# de OP" value=""><input type="submit" value="Buscar"></form>                                                    </header>                             <section id="collapse1" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                                            <div class="tab-content">                                    <div class="tab-pane <?php if(!isset($_GET['ped'])){echo 'active';} ?>" id="tab3">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                                        <section class="body">                                <div class="body-inner no-padding">                                    <form name="buscarA" action="<?php echo '../vistas/?id=pt&fact' ?>" method="post" enctype="multipart/form-data"><?php//Esta es la cadena limit que anexaremos a nuestra consulta$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;if(isset($_POST['numero1'])){    if($_POST['numero1']=="" || $_POST['numero2']=="" || $_POST['numero3']==""){         $request=mysql_query("SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f where f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and f.estado='Terminado' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p group by f.id_orden_d ");    }        if($_POST['numero1']!=""){        $request=mysql_query("SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f where f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and f.estado='Terminado' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p and a.referencia_p='".$_POST['numero1']."'  group by f.id_orden_d ");    }    if($_POST['numero2']!=""){        $request=mysql_query("SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f where f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and f.estado='Terminado' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p and  c.orden='".$_POST['numero2']."' group by f.id_orden_d ");    }    if($_POST['numero3']!=""){        $request=mysql_query("SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f where f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and f.estado='Terminado' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p and e.codigo='".$_POST['numero3']."' group by f.id_orden_d ");    }     }else{ $request=mysql_query("SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f, orden_produccion g, cotizacion h where h.id_cot=c.id_cot and e.codigo=g.id_orden and f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and f.estado='Terminado' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p group by g.id_orden ");}     if($request){//    echo'<hr>';      $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';             $table = $table.'<thead >';             $table = $table.'<tr bgcolor="#D1EEF0">';             $table = $table.'<th width="5%">'.'# O.P'.'</th>';              $table = $table.'<th width="5%">'.'Pedido'.'</th>';                            $table = $table.'<th width="20%">'.'Cliente'.'</th>';              $table = $table.'<th width="20%">'.'Nombre de la Obra'.'</th>';              $table = $table.'<th width="8%">'.'Fecha Inicial'.'</th>';              $table = $table.'<th width="8%">'.'Fecha Final'.'</th>';             $table = $table.'<th width="10%">'.'Fecha/Hora entregado'.'</th>';              $table = $table.'<th width="8%">'.'Estado'.'</th>';             $table = $table.'<th width="8%">'.'Detalle'.'</th>';                              $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $cont=0;	while($row=mysql_fetch_array($request))	{                   $cont= $cont + 1;              if($row['tipo_cli']=='Empresarial'){              $sql='select * from sis_empresa where id_empresa="'.$row['id_cliente'].'"';$fil =mysql_fetch_array(mysql_query($sql));$nombre= $fil["nombre_emp"];          }else{              $sql='select * from sis_contacto where id_contacto="'.$row['id_cliente'].'"';$fil =mysql_fetch_array(mysql_query($sql));$nombre= $fil["nombre_cont"].' '. $fil["apellido_cont"];          }          if($ver_op=='Habilitado'){$ver='<img src="../imagenes/ojo.png">';}else{$ver='';}            $table = $table.'<tr><td width="5%">'.$row["numero"].'</a></td><td width="5%">'.$row["referencia"].'</td>                 <td width="20%">'.$nombre.'</td><td width="20%">'.$row['proyecto'].'</td><td width="8%">'.$row['fecha_i'].'</td></td>               <td width="10%">'.$row['fecha_f'].'</td><td width="8%">'.$row['entregado'].' '.$row['hora'].'</td><td width="8%">'.$row['estado_o'].'</td>                        <td  width="8%"><a href="../vistas/?id=pt_detalles&cot='.$row["ref"].'&cli='.$row["id_cliente"].'&op='.$row["numero"].'&tipo='.$row["tipo"].'" title="Ver detalle de la orden de produccion">'.$ver.'</a></td>                         </tr>';                               		               	} 	$table = $table.'</table>';        	echo $table;  } ?>                                            <table>                <tr>                    <td><label><i>Total de Productos terminados: </i></label>                        <input type="text" name="cant"  style="width:20px;height:20px;" readonly value="<?php echo $cont; ?>">                        <?php if($crear_ret=='Habilitado'){   ?><input type="submit" name="buscar" value="Aprobar" class="alt_btn"><?php  }  ?></td>                </tr>                            </table>                                 </form></div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                                            </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div>     <?php if(isset($_GET['fact'])){     include "../modelo/conexion.php";$sql1 = "SELECT MAX(numero_factura) as id_inc FROM facturas";$fila1 =mysql_fetch_array(mysql_query($sql1));$factura = $fila1["id_inc"]+1;    if(isset($_POST["cant"]))    {        $n = $_POST["cant"];        $total = 0;        for($x=1; $x<=$n; $x=$x+1){            if(isset($_POST["valor$x"])){                include "../modelo/conexion.php";                                               $insu = "UPDATE `procesos_activos` SET estado='Remisionar' WHERE  `barra`='".$_POST["valor$x"]."'";                        mysql_query($insu);                                                                                echo 'El Items No. :'.$_POST["valor$x"].' ha sido Aprobado por cartera.<br>';                             }                     }             }if($total!=0){$cambio = valorEnLetras($total);         $forma_pago = '30 DIAS';        $meses = '1';        $pago_pendiente = 'Si';                $copagos = 0;        $fecha_reg= date("Y-m-d H:i:s");              	$sql = "INSERT INTO `facturas`(`copagos`,`letras`,`fechai`, `fechaf`,`numero_factura`, `id_cliente`, `forma_pago`, `meses`, `pago_pendiente`, `total`, `fecha_registro`, `detalle`, `descuento`, `tipo_cliente`, `numero_pedido`, `cotizacion`, `registrado_por`, `asesor`)";        $sql.= "VALUES ('".$copagos."','".$cambio."','".$fecha."', '".$fecha_reg."','".$factura."', '".$id_cliente."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$total."', '".$fecha_reg."', '".$_POST['obs']."', '".$descuento."', '".$tipo."', '".$_GET['ped']."', '".$_GET['cot']."', '".$_SESSION['nombre']."', '".$fila21["registrado"]."')";	mysql_query($sql);}    echo '<a href="../vistas/?id=pt">Presione aqui para confirmar</a>';}