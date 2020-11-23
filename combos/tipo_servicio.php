<?php
	session_start();
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
	    <title>Tipo Servicios - Templado S.A</title>
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
	    <link rel="stylesheet" href="../assets/icheck/css/jquery.icheck.min.css">
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
	    <script src="../js/ajax.js" type="text/javascript"></script>
	    <script>
			$(document).ready(function(){
				$('#tabla').dataTable();
			});
		</script>
		<script>
			function cerrar() {
				window.close();
			}
		</script>
		<script language="javascript" type="text/javascript">
			function pasarTipoServicio() {
				window.opener.infoTipoServicio(document.getElementById('datos1').value,
											   document.getElementById('datos2').value,
											   document.getElementById('datos3').value,
											   document.getElementById('datos4').value);
				window.close();
			}
		</script>
	</head>
	<body onload="javascript:pasarTipoServicio();">
		<?php
			include "../modelo/conexion.php";
		?>
		<div class="row-fluid">
			<!-- START Datatable 2 -->
			<div class="span12 widget lime">
				<section class="body">
					<div class="body-inner no-padding">
						<?php
							if (isset($_GET['codigo'])) {
								if ($_GET['codigo'] == 0) {
						?>
							<input type="text" name="datos1" id="datos1" readonly value="No tiene vidrio" />
							<input type="text" name="datos2" id="datos2" readonly value="0" />
							<input type="text" name="datos3" id="datos3" readonly value="0" />
							<input type="text" name="datos4" id="datos4" readonly value="0" />
						<?php
							} else {
								$request = mysqli_query($conexion,'SELECT * FROM `referencia_mo` WHERE id_ref_mo = "' . $_GET['codigo'] . '"');
								while ($row = mysqli_fetch_array($request)) {
									$x = $row["id_ref_mo"];
									$y = $row["descripcion_mo"];
									$w = $row["valor_mo"];
									$request2 = mysqli_query($conexion,"SELECT * FROM gastos_serv a, referencia_admin c WHERE a.id_administrativo = c.id_ref_ad AND a.id_ref = " . $row["id_ref_mo"]);
									while ($row2 = mysqli_fetch_assoc($request2)) {
										$tota = $tota + ($row["valor_mo"] * $row2["porcentaje_ad"] / 100);
									}
									$pr = (100 - $row["utilidad"]) / 100;
									$fr = ($row["valor_mo"] + $tota) / $pr;
									$des = ($row['descuento_serv']/100) * $fr;
									$z = ($fr + $des);
									//$z = $row["valor_mo"];
							?>
								<input type="text" name="datos1" id="datos1" readonly value="<?php echo $x ?>" />
								<input type="text" name="datos2" id="datos2" readonly value="<?php echo $y ?>" />
								<input type="text" name="datos3" id="datos3" readonly value="<?php echo $z ?>" />
								<input type="text" name="datos4" id="datos4" readonly value="<?php echo $w ?>" />
								<a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>
							<?php
									}
								}
							} else {
							?>
						<?php
							//$consulta= "select * from sis_contacto WHERE `nombre_cont`='".$_POST["bus_nombre"]."'";
							$request = mysqli_query($conexion,"SELECT * FROM `referencia_mo` WHERE instalacion = 'Si' ORDER BY id_ref_mo ASC");
							if ($request) {
								//echo'<hr>';
								$table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
								$table = $table.'<thead>';
								$table = $table.'<tr>';
								$table = $table.'<th>'.'#'.'</th>';
								$table = $table.'<th>'.'Referencia'.'</th>';
								$table = $table.'<th>'.'Descripción del Servicio'.'</th>';
								$table = $table.'</tr>';
								$table = $table.'</thead>';
								$c = 0;
								while ($row = mysqli_fetch_array($request)) {
									$c += 1;
									$table = $table.'<tr><td>'.$c.'</td>'
											. '<td>'.$row["referencia"].'</td>'
											. '<td><a href="../combos/tipo_servicio.php?codigo='.$row["id_ref_mo"].'">'.$row["descripcion_mo"].'</a></td>
                                    </tr>';
								}
								$table = $table . '</table>';
								echo $table;
							}
						?>
					</div>
				</div>
			</div>           
			<?php
				}
			?>
			<?php
				require '../vistas/script.php';
			?>
	</body>
</html>