<?php
	session_start();
	require("conexion.php");
	$status = "";
	$descripcion = $_POST["descripcion"];
	$asignacion = $_POST['asignacion'];
	$precio = $_POST["precio"];
	$medida = $_POST["medida"];
	$linea = $_POST["linea"];
	$precio_a = $_POST["precio_a"];
	if (isset($_GET['editar'])) {
		$sql = "UPDATE `subproceso` SET `sede_sub` = '" . $linea . "', `asignacion` = '" . $asignacion . "', `nombre_subpro` = '" . $descripcion . "', `precio` = '" . $precio . "', `precio_adicional` = '" . $precio_a . "', `medida` = '" . $medida . "' WHERE `id_subpro` = " . $_GET["editar"] . ";";
		mysql_query($sql, $conexion);
		echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente el precio");location.href="../vistas/?id=precios_area"</script>';
	} else {
		$sql = "INSERT INTO `subproceso` (`nombre_subpro`, `asignacion`, `precio`, `precio_adicional`, `medida`, `sede_sub`)";
		$sql.= "VALUES ('" . $descripcion . "', '" . $asignacion . "', '" . $precio . "', '" . $precio_a . "', '" . $medida . "', '" . $linea . "')";
		mysql_query($sql, $conexion);
		$status = "ok";
		echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el Precio");location.href="../vistas/?id=precios_area"</script>';
	}
?>