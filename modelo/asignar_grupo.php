<?php
	session_start();
	require '../modelo/conexion.php';
	$id_spm = $_GET['id_spm'];
	$id_g = $_POST['asignar'];
	$id_subpro = $_POST['id_subpro'];
	//echo "<script>alert('" . $id_spm . " - " . $id_g . "');</script>";
	mysql_query("UPDATE subproceso_maq SET id_g = '" . $id_g . "' WHERE id_spm = '" . $id_spm . "'");
	mysql_query("INSERT INTO asignacion_grupo (id_area, id_spm, id_g) VALUES ('" . $id_subpro . "', '" . $id_spm . "', '" . $id_g . "')");
	echo "<script>";
	echo "self.close();window.opener.document.location.reload();";
	echo "</script>";
?>