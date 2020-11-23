<?php
	include "../../modelo/conexion.php";

            
		if ($_POST['cot'] != '') {
			$cot = ' AND a.numero_cotizacion = "' . $_POST['cot'] . '" ';
                        $asc = ' a.version ';
		} else {
			$cot = '';
                        $asc = ' a.numero_cotizacion';
		}
		if ($_POST['nom'] != '') {
			$nom = ' AND CONCAT(b.nom_ter, " ", a.nom_temp) LIKE "%' . $_POST['nom'] . '%" ';
		} else {
			$nom = '';
		}
		if ($_POST['obr'] != '') {
			$obr = ' AND a.obra LIKE "%'.$_POST['obr'].'%" ';
		} else {
			$obr = '';
		}
		if ($_POST['reg'] != '') {
			$reg = ' AND a.registrado = "' . $_POST['reg'] . '" ';
		} else {
			$reg = '';
		}
                if ($_POST['ana'] != '') {
			$ana = ' AND a.presupuesto = "' . $_POST['ana'] . '" ';
		} else {
			$ana = '';
		}
                if ($_POST['est'] != '') {
			$est = ' AND a.estado = "' . $_POST['est'] . '" ';
		} else {
			$est = '';
		}
                
	$request = mysqli_query($conexion,'SELECT COUNT(*) FROM cotizacion a, cont_terceros b WHERE a.id_tercero = b.id_ter  ' . $cot . $nom . $obr . $reg . $ana );
	if ($request) {
		$request = mysqli_fetch_row($request);
		$num_items = $request[0];
	} else {
		$num_items = 0;
	}
	$rows_by_page = 10;
	$last_page = ceil($num_items / $rows_by_page);
	if (isset($_POST['page'])) {
                session_start();
		$page = $_POST['page'];
	} else {
		$page = 1;
	}
	function interval_date($init, $finish) {
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el número entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = "Hace " . floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = "Hace " . floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = "Hace " . floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = "Hace " . floor($diferencia / 86400) . " días";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = "Hace " . floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = "Hace " . floor($diferencia / 31104000) . " años";
		} else {
			$tiempo = "Error";
		}
		return $tiempo;
	}
	function interval_date2($init, $finish) {
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el número entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = floor($diferencia / 86400) . " días";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = floor($diferencia / 31104000) . " años";
		} else {
			$tiempo = "Error";
		}
		return $tiempo;
	}
?>
<?php
	$limit = 'LIMIT ' . ($page - 1) * $rows_by_page . ',' . $rows_by_page;
	if ($page > 1) { ?>
		<a href="#" onclick="mostrarCotA(1)"><img src="../images/a1.png"></a>
		<a href="#" onclick="mostrarCotA(<?php echo $page - 1; ?>)"><img src="../images/a11.png"></a>
<?php
	} else { ?>
		<img src="../images/ant.png">
<?php
	}
?>
	(Pagina <?php echo $page; ?> de <?php echo $last_page; ?>)
<?php
	if ($page < $last_page) { ?>
		<a href="#" onclick="mostrarCotA(<?php echo $page + 1; ?>)"><img src="../images/p1.png"></a>
		<a href="#" onclick="mostrarCotA(<?php echo $last_page ?>)"><img src="../images/p11.png"></a>
<?php
	} else { ?>
		<img src="../images/nex.png">
<?php
	}  echo 'Cantidad de registro: <b>'.$num_items.'</b>';
?>
<?php
	$request_ac = mysqli_query($conexion,"SELECT * FROM cotizacion a, cont_terceros b
								WHERE a.id_tercero = b.id_ter  " . $cot . $nom . $obr . $reg . $ana. "
								ORDER BY $asc  DESC " . $limit);
?>
<div>
	<?php   
		if ($request_ac) {
			$table = '<table class="table table-bordered table-striped table-hover" id="">';
			$table = $table . '<thead>';
			$table = $table . '<tr bgcolor="#D1EEF0">';
			$table = $table . '<th width="5%">' . 'Ver' . '</th>';
			$table = $table . '<th width="5%">' . 'Cotización' . '</th>';
			$table = $table . '<th width="5%">' . 'Documento' . '</th>';
			$table = $table . '<th width="15%">' . 'Cliente' . '</th>';
			$table = $table . '<th width="10%">' . 'Nombre de la Obra' . '</th>';
			$table = $table . '<th width="10%">' . 'Fecha Registro' . '</th>';
			$table = $table . '<th width="10%">' . 'Ultima Modificacion' . '</th>';
			$table = $table . '<th width="10%">' . 'Ultima Impresion' . '</th>';
			$table = $table . '<th width="10%">' . 'Guardado' . '</th>';
			$table = $table . '<th width="5%">' . 'Tiempo de Cotizacion' . '</th>';
			$table = $table . '<th width="10%">' . 'Responsables' . '</th>';
			$table = $table . '<th class="hidden-phone">' . 'Estado' . '</th>';

		
			$table = $table . '</tr>';
			$table = $table . '</thead>';
			$cont = 0;
			while($row = mysqli_fetch_array($request_ac)) {
				$cont = $cont + 1;
				$sql = 'SELECT * FROM cont_terceros WHERE id_ter = "' . $row['id_tercero'] . '"';
				$fil = mysqli_fetch_array(mysqli_query($conexion,$sql));
				if ($row["nom_temp"] == '') {
					$nombre = $fil["nom_ter"];
					$documento = $fil["cod_ter"];
				} else {
					$nombre = $row["nom_temp"] . '<sup><font color="red">(temp)</font></sup>';
					$documento = $row["cod_temp"];
				}
				if ($row["estado"] == 'Ordenado') {
					$est = '<font color="red">';
					$v = '';
				} else {
					$est = '<font color="blue">';
					$v = '<button type="button"><img width=20 heigth=20 src="../imagenes/version.png" /></button>';
				}
				if ($row["copia"] == 0) {
					$c = '';
				} else {
					$c = $row["copia"];
				}
				$tiempo1 = interval_date($row['fecha_modificacion'], $fecha_hoy);
				if ($row["impresion"] == '0000-00-00 00:00:00') {
					$tiempo2 = '<font color="red">' . $row['impresion'] . '</font><br>Sin Imprimir';
				} else {
					$tiempos = interval_date($row['impresion'], $fecha_hoy);
					$tiempo2 = '<font color="green">' . $row['impresion'] . '</font><br>' . $tiempos;
				}
				if ($row["fecha_guardado"] == '0000-00-00 00:00:00') {
					$tiempo3 = '<font color="red">' . $row['fecha_guardado'] . '</font><br>Sin Guardar';
					$led = '<img src="../imagenes/ledrojo.gif" />';
				} else {
					$tiempos3 = interval_date($row['fecha_guardado'], $fecha_hoy);
					$tiempo3 = '<font color="green">' . $row['fecha_guardado'] . '</font><br>' . $tiempos3;
					$led = '<img src="../imagenes/ok.png" />';
				}
				if ($row["fecha_guardado"] == '0000-00-00 00:00:00') {
					$tiempo33 = 'Sin Guardar';
				} else {
					$tiempo33 = interval_date2($row['fecha_reg_c'], $row['fecha_guardado']);
				}
				if ($row['id_cot'] == 'Personal') {
					$link = '<a href="../vistas/?id=ver_contacto&cod=' . $row['id_cliente'] . '">';
				} else {
					$link = '<a href="../vistas/?id=ver_empresa&cod=' . $row['id_cliente'] . '">';
				}
				
					$ver = '<img src="../imagenes/view.png" /> Ver';
					$es = $est . '' . $row["estado"];
				$table = $table . '<tr>';
				$table = $table . '<td width="5%"><a href="../vistas/?id=new_fac_aprobadas&cot=' . $row['id_cot'] . '&cli=' . $row['id_tercero'] . '"><button type="button"><img src="../imagenes/view.png" /> Ver</button></a></td>';
				$table = $table . '<td width="5%">' . $row['numero_cotizacion'] . '.' . $row["version"] . '</td>';
				$table = $table . '<td width="5%">' . $documento . '</td>';
				$table = $table . '<td width="15%">' . strtoupper($nombre) . '</td>';
				$table = $table . '<td width="10%">' . strtoupper($row["obra"]) . '<font></td>';
				$table = $table . '<td width="10%">' . $row["fecha_reg_c"] . '<font></td>';
				$table = $table . '<td width="10%">' . $row["fecha_modificacion"] . '<br>' . $tiempo1 . '</a></td>';
				$table = $table . '<td width="10%">' . $tiempo2 . '</td>';
				$table = $table . '<td width="10%">' . $tiempo3 . '</td>';
				$table = $table . '<td width="10%">' . $led . ' ' . $tiempo33 . '</td>';
				$table = $table . '<td class="hidden-phone">Reg: ' . strtoupper($row["presupuesto"]) . '<br>Asesor: ' . strtoupper($row["registrado"]) . '</td>';
				$table = $table . '<td class="hidden-phone">' . $es . '</font></td>';
				$table = $table . '</tr>';
			}
			$table = $table . '</table>';
			echo $table;
		}
	?>
</div>