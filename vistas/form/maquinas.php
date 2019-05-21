<?php
	$sql21 = "SELECT * FROM subproceso WHERE id_subpro = " . $_GET['cod'];
	$fila21 = mysql_fetch_array(mysql_query($sql21));
	$nombre = $fila21["nombre_subpro"];
	if (isset($_GET['up_1'])) {
		$sql21 = "SELECT * FROM subproceso_maq WHERE id_spm = " . $_GET['up_1'];
		$fila21 = mysql_fetch_array(mysql_query($sql21));
		$linea = $fila21["nombre_maq"];
		$estado = $fila21["estado_maq"];
		$id_grupo = $fila21["id_g"];
                $alto = $fila21["altom"];
                $ancho = $fila21["anchom"];
                $esp1 = $fila21["esp1"];
                $esp2 = $fila21["esp2"];
		$observaciones = $fila21["observaciones"];
	}
?>
<script language="JavaScript" type="text/javascript" src="../js/ajax.js"></script>
<div class="row-fluid">
	<!-- START Form Wizard -->
	<!-- START Widget Collapse -->
	<section class="body">
		<div class="body-inner">
			<div class="span12 widget dark stacked">
				<header>
					<h4 class="title">Maquinas de la Área de <?php echo $nombre; ?></h4>
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
								<li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span> Maquinas</a></li>
								<?php
									if ($crear_conf == 'Habilitado') {
										echo '<li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar</a></li>';
									}
								?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab1">
									<!-- START Row -->
									<div class="row-fluid">
										<!-- START Datatable 2 -->
										<div class="span12 widget lime">
											<section class="body">
												<div class="body-inner no-padding">
													<?php
														if (isset($_GET['up_1'])) { ?>
															<div class="tab-pane" id="tab2">
																<div class="row-fluid">
																	<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/maquina.php?editar='.$_GET['up_1'].'&cod='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
																		<section class="body">
																			<div class="body-inner">
																				<div class="control-group">
																					<label></label><div class="controls"></div>
																					<label class="control-label">Descripción de la Maquina</label>
																					<div class="controls"><input type="text" name="maquina" value="<?php if(isset($_GET['up_1'])){echo $linea;} ?>" class="span6" placeholder="" required></div>
																					<label></label><div class="controls"></div>
																					<input type="hidden" name="id_grupo" id="id_grupo" value="<?php echo $id_grupo; ?>" />
																					<label class="control-label">Estado de la Maquina</label>
																					<div class="controls">
																						<select name="estado">
																							<?php
																								if (isset($_GET['up_1'])) {
																									echo '<option value="' . $estado . '">' . $estado . '</option>';
																									echo '<option value="Desactivo">Desactivo</option>';
																								}
																							?>
																							<option value="Activo">Activo</option>
																						</select>
																					</div>
                                                                                                                                                                        <label></label><div class="controls"></div>
														<label class="control-label">Ancho Maximo</label>
															<div class="controls">
                                                                                                                            <input type="number" name="ancho"  step="any" value="<?php echo $ancho; ?>" class="span2" placeholder="" required>
                                                                                                                        </div>
                                                                                                                <label></label><div class="controls"></div>
														<label class="control-label">Alto Maximo</label>
															<div class="controls">
                                                                                                                            <input type="number" step="any" name="alto" value="<?php echo $alto; ?>" class="span2">
                                                                                                                        </div>
                                                                                                                 <label></label><div class="controls"></div>
														<label class="control-label">Espesor Max</label>
															<div class="controls">
                                                                                                                            <input type="number" step="any" name="esp1" value="<?php echo $esp1; ?>" class="span2" placeholder="Maximo" required> Min
                                                                                                                            <input type="number" step="any" name="esp2" value="<?php echo $esp2; ?>" class="span2" placeholder="Minino" required>
                                                                                                                        </div>
																					<label></label><div class="controls"></div>
																					<label class="control-label">Observaciones de la Maquina</label>
																					<div class="controls"><textarea class="span6" name="observaciones" id="observaciones"><?php if(isset($_GET['up_1'])){echo $observaciones;} ?></textarea></div>
																					<!-- Form Action -->
																					<div class="form-actions">
																						<button type="submit" class="btn btn-primary"><?php if(isset($_GET['up_1'])){echo 'Guardar Cambios';}else{echo 'Guardar';} ?></button>
																						<a href="../vistas/?id=maq&cod=<?php echo $_GET['cod']; ?>"><button type="button" class="btn">Cancelar</button></a>
																					</div>
																					<!--/ Form Action -->
																				</div>
																			</div>
																		</section>
																	</form>
																	<!--/ END Form Wizard -->
																</div>
															</div>
														<?php
															} else {
																$request = mysql_query("SELECT * FROM subproceso_maq WHERE id_subproceso = " . $_GET['cod'] . " ");
																if ($request) {
																	//echo'<hr>';
																	$table = '<table class="table table-bordered table-striped table-hover" id="">';
																	$table = $table . '<thead >';
																	$table = $table . '<tr bgcolor="#D1EEF0">';
																	$table = $table . '<th width="5%">' . 'Items' . '</th>';
																	$table = $table . '<th width="20%">' . 'Descripción' . '</th>';
																	$table = $table . '<th width="20%">' . 'Grupo Asignado' . '</th>';
																	$table = $table . '<th width="20%">' . 'Observaciones' . '</th>';
																	$table = $table . '<th width="10%">' . 'Disponibilidad' . '</th>';
																	$table = $table . '<th width="5%">' . 'Estado' . '</th>';
																	$table = $table . '<th width="5%">' . 'Grupos' . '</th>';
																	$table = $table . '<th width="5%">Editar</th>';
																	$table = $table . '<th width="5%">' . 'Eliminar' . '</th>';
																	$table = $table . '</tr>';
																	$table = $table . '</thead>';
																	//Por cada resultado pintamos una linea
																	$total2 = 0;
																	while ($row = mysql_fetch_array($request)) {
																		$total2 += 1;
																		if ($editar_conf == 'Habilitado') {
																			$ver = '<button><img src="../imagenes/modificar.png"></button>';
																		} else {
																			$ver = '';
																		}
																		if ($crear_conf == 'Habilitado') {
																			$add = '<a href="javascript:void(0);" onClick="asignarGrupo(' . $row['id_spm'] . ',' . $_GET['cod'] . ')">';
																		} else {
																			$add = '';
																		}
																		if ($eliminar_conf == 'Habilitado') {
																			$del = '<button><img src="../imagenes/eliminar.png"></button>';
																		} else {
																			$del='';
																		}
																		$table = $table . '<tr>
                                                                                                                                                <td width="5%">' . $total2 . '</td>
                                                                                                                                                <td width="20%">' . $row["nombre_maq"] . '<br><ul><li>Ancho Max. ' . $row['anchom'] . '(mm)'
                                                                                                                                            . ' <li>Alto Max. ' . $row['altom'] . '(mm)'
                                                                                                                                            . ' <li>Espesor Max. ' . $row['esp1'] . '(mm) <li> Espesor Min. ' . $row['esp2'] . '(mm)</td>';
																		$query_select_grupo = mysql_query("SELECT * FROM grupo WHERE id_g = '" . $row['id_g'] . "'");
																		$row_grupo = mysql_fetch_array($query_select_grupo);
																		$table = $table . '<td width="20%">' . $row_grupo['name'] . '</td>';
																		$table = $table . '<td width="20%">' . $row['observaciones'] . '</td>';
																		if ($row['ocupado'] == 0) {
																			$table = $table . '<td width="10%">Desocupado</td>';
																		} else {
																			$table = $table . '<td width="10%">Ocupado</td>';
																		}
																		$table = $table . '<td width="5%">' . $row['estado_maq'] . '</td>';
																		if ($row['estado_maq'] == 'Activo') {
																			$table = $table . '<td width="5%">' . $add . '<button><img src="../imagenes/user_group.png"></button></a></td>';
																		} else {
																			$table = $table . '<td width="5%"><button style="cursor:not-allowed;" disabled><img src="../imagenes/user_group.png"></button></td>';
																		}
																		$table = $table . '<td width="5%"><a href="../vistas/?id=maq&up_1=' . $row["id_spm"] . '&cod=' . $_GET['cod'] . '"">' . $ver . '</a></td>
																				<td width="5%"><a href="../vistas/?id=maq&del=' . $row["id_spm"] . '&cod=' . $_GET['cod'] . '"">' . $del . '</a></td>
																				</tr>';
																	}
																	$table = $table . '</table>';
																	echo $table;
																}
															}
														?>
												</div>
											</section>
										</div>
										<!--/ END Datatable 2 -->
									</div>
									<!--/ END Row -->
								</div>
								<div class="tab-pane" id="tab2">
									<div class="row-fluid">
										<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/maquina.php?cod='.$_GET['cod'].' '; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
											<section class="body">
												<div class="body-inner">
													<div class="control-group">
														<label></label><div class="controls"></div>
														<label class="control-label">Descripcion de Maquina</label>
														<div class="controls"><input type="text" name="maquina" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder="Digite la descripción de la maquina" required></div>
														<label></label><div class="controls"></div>
														<label class="control-label">Ancho Maximo</label>
															<div class="controls">
                                                                                                                            <input type="number" name="ancho"  step="any" value="<?php if(isset($_GET['cod'])){} ?>" class="span2" placeholder="" required>
                                                                                                                        </div>
                                                                                                                <label></label><div class="controls"></div>
														<label class="control-label">Alto Maximo</label>
															<div class="controls">
                                                                                                                            <input type="number" step="any" name="alto" value="<?php if(isset($_GET['cod'])){} ?>" class="span2">
                                                                                                                        </div>
                                                                                                                 <label></label><div class="controls"></div>
														<label class="control-label">Espesor</label>
															<div class="controls">
                                                                                                                            <input type="number" step="any" name="emax" value="<?php if(isset($_GET['cod'])){} ?>" class="span2" placeholder="Maximo" required> Min
                                                                                                                            <input type="number" step="any" name="emin" value="<?php if(isset($_GET['cod'])){} ?>" class="span2" placeholder="Minino" required>
                                                                                                                        </div>
														
														<!-- Form Action -->
														<label></label><div class="controls"></div>
														<label class="control-label">Observaciones de la Maquina</label>
														<div class="controls"><textarea class="span6" name="observaciones" id="observaciones"></textarea></div>
														<div class="form-actions">
															<button type="submit" class="btn btn-primary"><?php if(isset($_GET['up_1'])){echo 'Guardar Cambios';}else{echo 'Guardar';} ?></button>
															<a href="../vistas/?id=maq&cod=<?php echo $_GET['cod']; ?>"><button type="button" class="btn">Cancelar</button></a>
														</div>
														<!--/ Form Action -->
													</div>
												</div>
											</section>
										</form>
										<!--/ END Form Wizard -->
									</div>
								</div>
							</div>
						</div>
						<!--/ Normal Tabs -->
					</div>
				</section>
			</div>
		</div>
	</section>
</div>
<?php
	if (isset($_GET['del'])) {
		$sql = "DELETE FROM subproceso_maq WHERE id_spm = " . $_GET['del'] . "";
		mysql_query($sql, $conexion);
		echo "<script language='javascript' type='text/javascript'>";
			echo "location.href='../vistas/?id=maq&cod=".$_GET['cod']." '";
		echo "</script>";
	}
?>