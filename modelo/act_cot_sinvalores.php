<?php
	session_start();
	require '../modelo/conexion.php';
	$id_cot = $_GET['id_cot'];
	$op = $_GET['op'];
	$cli = $_GET['cli'];
	$id_cotizacion = $_GET['id_cotizacion'];
	$cuerpo = $_POST['cuerpo'];
	$ladomm = $_POST['ladomm'];
	if (isset($_POST['per'])) {
		$per = $_POST['per'];
	} else {
		$per = 0;
	}
	if (isset($_POST['boq'])) {
		$boq = $_POST['boq'];
	} else {
		$boq = 0;
	}
	$query_update_cotizaciones = "UPDATE cotizaciones SET cuerpo = '" . $cuerpo . "', lado = '" . $ladomm . "', per = '" .
													   $per . "', boq = '" . $boq . "' " .
								  "WHERE id_cot = '" . $id_cot . "' AND id_cotizacion = '" . $id_cotizacion . "'"; 
	mysqli_query($conexion,$query_update_cotizaciones);
	echo "<script>";
	echo "window.opener.document.location.reload();self.close();";
	echo "</script>";
?>