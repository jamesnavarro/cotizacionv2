<?php
	include '../modelo/conexion.php';
	if ($_GET['tipo'] == 'vidrio') {
		$table_vidrio = "";
		$id_cot = $_POST['id_cot'];
		$id_servicio = $_POST['servicio_hidden'];
		$id_vidrio_servicio = $_POST['id_vidrio_servicio'];
		$valor_vidrio_hidden = $_POST['valor_vidrio_hidden'];
		$porcentaje_servicio_vidrio = $_POST['porcentaje_servicio_vidrio'];
		$ancho_vidrio_servicio = $_POST['ancho_vidrio_servicio'];
		$alto_vidrio_servicio = $_POST['alto_vidrio_servicio'];
		$id_espesor_servicio = $_POST['id_espesor_servicio'];
		$perforacion_vidrio_servicio = $_POST['perforacion_vidrio_servicio'];
		$boquete_vidrio_servicio = $_POST['boquete_vidrio_servicio'];
		$cant_vidrio = $_POST['cant_vidrio'];
		$query_select_vidrio = mysql_query("SELECT * FROM producto WHERE id_p = " . $id_vidrio_servicio);
		$row_vidrio = mysql_fetch_array($query_select_vidrio);
		$query_select_espesor = mysql_query("SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $id_espesor_servicio);
		$row_espesor = mysql_fetch_array($query_select_espesor);
		mysql_query("INSERT INTO info_servicios (id_cot, id_servicio, linea, id_prod, perforacion, boquete, cantidad_prod, precio_unitario, porcentaje, medida1, medida2, medida3, color_prod, guardado, fecha_registro, usuario)
										 VALUES ('" . $id_cot . "', '0', 'Vidrio', '" . $id_vidrio_servicio . "', '" . $perforacion_vidrio_servicio . "', '" . $boquete_vidrio_servicio . "', '" . $cant_vidrio . "', '0', '" . $porcentaje_servicio_vidrio .
										 		  "', '" . $ancho_vidrio_servicio . "', '" . $alto_vidrio_servicio . "', '" . $row_espesor['espesor_v'] . "', '" . $row_espesor['color_v'] .
										 		  "', '0', '" . date('Y-m-d H:i:s') . "', '" . $_SESSION['k_username'] . "')");
		$table_vidrio = $table_vidrio . "<tr>";
		$table_vidrio = $table_vidrio . "<td>" . $row_vidrio['producto'] . "</td>";
		$table_vidrio = $table_vidrio . "<td>" . $ancho_vidrio_servicio . "</td>";
		$table_vidrio = $table_vidrio . "<td>" . $alto_vidrio_servicio . "</td>";
		$table_vidrio = $table_vidrio . "<td>" . $row_espesor['color_v'] . "</td>";
		$table_vidrio = $table_vidrio . "<td>" . $cant_vidrio . "</td>";
		$table_vidrio = $table_vidrio . "</tr>";
		echo $table_vidrio;
	} else {
		$table_accesorio = "";
		$id_cot = $_POST['id_cot'];
		$id_cli = $_POST['id_cli'];
		$id_servicio = $_POST['servicio_hidden'];
		$id_accesorio_servicio = $_POST['id_accesorio_servicio'];
		$valor_accesorio_hidden = $_POST['valor_accesorio_hidden'];
		$valor_porcentaje_hidden = $_POST['valor_porcentaje_hidden'];
		$grupo_hidden = $_POST['grupo_hidden'];
		$porcentaje_servicio_accesorio = $_POST['porcentaje_servicio_accesorio'];
		$ancho_accesorio_servicio = $_POST['ancho_accesorio_servicio'];
		$alto_accesorio_servicio = $_POST['alto_accesorio_servicio'];
		$color_aluminio = $_POST['color_aluminio'];
		$cant_accesorio = $_POST['cant_accesorio'];
		$query_select_color = mysql_query("SELECT * FROM tipo_aluminio WHERE id_ta = " . $color_aluminio);
		$row_color = mysql_fetch_array($query_select_color);
		$query_select_porcentaje = mysql_query("SELECT * FROM porcentajes WHERE area_por = 'MP' AND grupo = '" . $grupo_hidden . "'");
		$row_porcentaje = mysql_fetch_array($query_select_porcentaje);
		if ($porcentaje_servicio_accesorio == "p1") {
			$porcentaje = $row_porcentaje["p1"] / 100;
		} else {
			if ($porcentaje_servicio_accesorio == "p2") {
				$porcentaje = $row_porcentaje["p2"] / 100;
			} else {
				if ($porcentaje_servicio_accesorio == "p3") {
					$porcentaje = $row_porcentaje["p3"] / 100;
				}
			}
		}
		$valor_venta = $valor_porcentaje_hidden / $porcentaje;
		mysql_query("INSERT INTO info_servicios (id_cot, id_servicio, linea, id_prod, perforacion, boquete, cantidad_prod, precio_unitario, precio_porcentaje, porcentaje, medida1, medida2, medida3, color_prod, guardado, fecha_registro, usuario)
										 VALUES ('" . $id_cot . "', '0', 'Accesorio', '" . $id_accesorio_servicio . "', '0', '0', '" . $cant_accesorio . "', '" . $valor_accesorio_hidden . "', '" . $valor_venta . "', '" . $porcentaje_servicio_accesorio .
										 		  "', '" . $ancho_accesorio_servicio . "', '" . $alto_accesorio_servicio . "', '0', '" . $row_color['color_a'] .
										 		  "', '0', '" . date('Y-m-d H:i:s') . "', '" . $_SESSION['k_username'] . "')");
		$query_select_info_accesorios = mysql_query("SELECT * FROM info_servicios WHERE id_cot = " . $id_cot . " AND linea = 'Accesorio'");
		while ($row_info_accesorios = mysql_fetch_assoc($query_select_info_accesorios)) {
			$query_select_accesorio = mysql_query("SELECT * FROM referencias WHERE id_referencia = " . $row_info_accesorios['id_prod']);
			$row_accesorio = mysql_fetch_array($query_select_accesorio);
			$table_accesorio = $table_accesorio . "<tr>";
			$table_accesorio = $table_accesorio . "<td>" . $row_accesorio['descripcion'] . "</td>";
			$table_accesorio = $table_accesorio . "<td>" . $row_info_accesorios['medida1'] . "</td>";
			$table_accesorio = $table_accesorio . "<td>" . $row_info_accesorios['medida2'] . "</td>";
			$table_accesorio = $table_accesorio . "<td>" . $row_info_accesorios['color_prod'] . "</td>";
			$table_accesorio = $table_accesorio . "<td>" . $row_info_accesorios['cantidad_prod'] . "</td>";
			$table_accesorio = $table_accesorio . "<td>" . number_format($row_info_accesorios['precio_unitario']) . "</td>";
			$table_accesorio = $table_accesorio . "<td>" . number_format($row_info_accesorios['precio_porcentaje']) . "</td>";
			//$table_accesorio = $table_accesorio . "<td><a href='../vistas/?id=new_fac&up_acce=" . $row_info_accesorios['id_info_servicio'] . "&cot=" . $id_cot . "&cli=" . $id_cli . "'><img src='../imagenes/modificar.png'></a></td>";
			$table_accesorio = $table_accesorio . "<td><a href='../vistas/?id=new_fac&del_acce=" . $row_info_accesorios['id_info_servicio'] . "&cot=" . $id_cot . "&cli=" . $id_cli . "'><img src='../imagenes/eliminar.png'></a></td>";
			$table_accesorio = $table_accesorio . "</tr>";
		}
		echo $table_accesorio;
	}
?>