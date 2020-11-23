<?php
	include '../modelo/conexion.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <link rel="shortcut icon" href="../traz.ico">
	    <title>Templado S.A - Asignar Grupos - Maquina</title>
	    <meta name="description" content="">
	    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
	    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
	    <link rel="stylesheet" href="../css/style.css">
	    <link rel="stylesheet" href="../css/custom.css">
	    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
	    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->
	    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">
	    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">
	    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">
	    <link rel="stylesheet" href="../assets/icheck2/css/jquery.icheck.min.css">
	    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">
	    <link rel="stylesheet" href="../assets/minicolor/css/jquery.minicolors.min.css">
	    <link rel="stylesheet" href="../assets/wysiwyg/CLEditor/css/jquery.cleditor.min.css">
	    <link rel="stylesheet" href="../assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">
	    <link rel="stylesheet" href="../assets/tagit/css/jquery.tagit.min.css">
	    <link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.min.css">
	    <link rel="stylesheet" href="../assets/prettyphoto/css/prettyphoto.min.css">
	    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">
	    <link rel="stylesheet" href="../assets/switch/css/bootstrapSwitch.min.css">
	    <link rel="stylesheet" href="../assets/daterangepicker/css/daterangepicker.min.css">
	    <link rel="stylesheet" href="../assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">
	    <link rel="stylesheet" href="../assets/gritter/css/jquery.gritter.min.css">
	    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">
	    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script>
	<!-- indispensable para cargar municipios-->
	    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
	    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	    <script src="../js/buscadores.js" type="text/javascript"></script>
	    <script src="../js/ajax.js" type="text/javascript"></script>
	</head>
	<script>
		
	</script>
	<body>
		<div class="row-fluid">
			<section class="body">
				<div class="body-inner">
					<div class="span12 widget dark stacked">
						<header>
							<?php
								$query_maquina = mysqli_query($conexion,"SELECT * FROM subproceso_maq WHERE id_spm = '" . $_GET['id_maquina'] . "'");
								$row_maquina = mysqli_fetch_array($query_maquina);
							?>
							<h4 class="title">Asignar Grupo - <?php echo $row_maquina['nombre_maq']; ?></h4>
						</header>
						<section id="collapse2" class="body collapse in">
							<div class="body-inner">
								<div class="tabbable" style="margin-bottom: 25px;">
									<div class="tab-content">
										<div class="tab-pane active" id="tab1">
											<div class="row-fluid">
												<div class="span12 widget lime">
													<section class="body">
														<div class="body-inner no-padding">
															<form class="span12 widget dark form-horizontal bordered" action="<?php echo "../modelo/asignar_grupo.php?id_spm=" . $_GET['id_maquina']; ?>" method="post" id="form_asignar_grupo" enctype="multipart/form-data">
																<input type="hidden" name="id_subpro" id="id_subpro" value="<?php echo $_GET['id_subpro'] ?>" />
																<table class="table table-bordered table-striped table-hover">
																	<thead>
																		<th width="5%">Items</th>
																		<th width="85%">Nombre del Grupo</th>
																		<th width="10%">Asignar</th>
																	</thead>
																	<tbody>
																		<?php
																			$i = 0;
																			$sw = 0;
																			$query_grupos = mysqli_query($conexion,"SELECT * FROM grupo WHERE id_area = '" . $_GET['id_subpro'] . "'");
																			while ($row_grupos = mysqli_fetch_assoc($query_grupos)) {
																				$i = $i + 1;
																				echo "<tr>";
																				echo "<td width='5%'>" . $i . "</td>";
																				$query_verificar_grupo = mysqli_query($conexion,"SELECT * FROM subproceso_maq WHERE id_g = '" . $row_grupos['id_g'] . "'");
																				$row_verificar_grupo = mysqli_fetch_array($query_verificar_grupo);
																				$query_id_g = mysqli_query($conexion,"SELECT * FROM subproceso_maq WHERE id_spm = '" . $_GET['id_maquina'] . "' AND id_g = '" . $row_grupos['id_g'] . "'");
																				$row_id_g = mysqli_fetch_array($query_id_g);
																				if (mysqli_num_rows($query_verificar_grupo) != 0) {
																					echo "<td style='text-decoration: line-through;' width='85%'>" . $row_grupos['name'] . "</td>";
																					if ($row_id_g['id_g'] == 0) {
																						echo "<td width='10%'><input type='radio' name='asignar' value='" . $row_grupos['id_g'] . "' disabled /></td>";
																					} else {
																						$sw = 1;
																						echo "<td width='10%'><input type='radio' name='asignar' value='" . $row_grupos['id_g'] . "' checked /></td>";
																					}
																				} else {
																					echo "<td width='85%'>" . $row_grupos['name'] . "</td>";
																					if ($row_id_g['id_g'] == 0) {
																						echo "<td width='10%'><input type='radio' name='asignar' value='" . $row_grupos['id_g'] . "' /></td>";
																					} else {
																						$sw = 1;
																						echo "<td width='10%'><input type='radio' name='asignar' value='" . $row_grupos['id_g'] . "' checked /></td>";
																					}
																				}
																				echo "</tr>";
																			}
																		?>
																		<tr>
																			<td width="5%"><?php echo $i + 1; ?></td>
																			<td width="85%">SIN GRUPO</td>
																			<?php
																				if ($sw == 0) { ?>
																					<td width="10%"><input type="radio" name="asignar" value="0" checked="checked" /></td>
																				<?php
																				} else { ?>
																					<td width="10%"><input type="radio" name="asignar" value="0" /></td>
																				<?php
																				}
																			?>
																		</tr>
																		<tr>
																			<td colspan="3">&nbsp;</td>
																		</tr>
																		<tr>
																			<td colspan="3">
																				<button type="submit"><img src="../imagenes/guardar.jpg" />Asignar Grupo</button>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</form>
														</div>
													</section>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</section>
		</div>
	</body>
</html>