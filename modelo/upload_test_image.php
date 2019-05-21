<?php
	session_start();
	require("conexion.php");
	$rutaEnServidor = 'adicionales';
	$rutaTemporal = $_FILES["prueba_imagen"]["tmp_name"];
	$nombreImagen = $_FILES["prueba_imagen"]["name"];
	if ($nombreImagen == '') {
		$rutaDestino = '../' . $rutaEnServidor . '/' . $nombreImagen;
		$rutaDestino2 = $nombreImagen;
	} else {
		$rutaDestino = '../' . $rutaEnServidor . '/' . $cot . '' . $nombreImagen;
		$rutaDestino2 = $cot . '' . $nombreImagen;
	}
	move_uploaded_file($rutaTemporal, $rutaDestino);
	echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la cotizacion");location.href="../vistas/?id=new_fac&cot='.$cot.'&cli='.$cliente.'"</script>';
?>