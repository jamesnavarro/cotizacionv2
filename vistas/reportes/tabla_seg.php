<?php
	include "../../modelo/conexion.php";
	include "../../modelo/consultar_permisos.php";
        session_start();
        $nombre_ord = $_POST['ord'];
        if($nombre_ord=='numero_cotizacion'){
            $nombre_ord = 'numero_cotizacion_s';
        }elseif($nombre_ord=='costo_total'){
            $nombre_ord = 'vtotal_obra';
        }elseif($nombre_ord=='fecha_reg_c'){
            $nombre_ord = 'fec_sistema';
        }else{
            $nombre_ord = 'ciudad_obra';
        }
         $asc_desc = $_POST['orden'];
         $ano = $_POST['ano'];
         $mes = $_POST['mes'];
         $vciu = $_POST['vciu'];
         $vest = $_POST['vest'];
         $vopc = $_POST['vopc'];
         $vdir = $_POST['vdir'];
         $vase = $_POST['vase'];
         $vfec = $_POST['vfec'];
         $ver_tip = $_POST['ver_tip'];
         $seg = $_POST['seg'];   
          $bus_tip = $_POST['bus_tip'];
         $sin_lista = $_POST['sin_lista'];
         if($seg==''){
             $qseg = '';
         }else{
             $qseg = ' AND a.seguimiento="'.$seg.'"  ';
         }
          $vcot = $_POST['vcot'];
          if($ano!='' && $mes!=''){
             $fecha = ' and fec_sistema between  "' . $ano . '" and "' . $mes . '" ';
         }else{
             $fecha = '';
         }

		if ($_POST['cot'] != '') {
			$cot = ' AND numero_cotizacion_s in ('. $_POST['cot'] . ') ';
                         $asc = '  version_s ';
		} else {
			$cot = '';
                         $asc = '  numero_cotizacion_s ';
		}
		if ($_POST['cli'] != '') {
			$nom = ' AND CONCAT(nom_temp," ",nombre_cliente) LIKE "%' . $_POST['cli'] . '%" ';
		} else {
			$nom = '';
		}
                if ($_POST['pre'] != '') {
			$valor = ' AND vtotal_obra BETWEEN  "' .$_POST['pre'] .'" and "' .$_POST['pref'] .'" ';
		} else {
			$valor = '';
		}
		if ($_POST['obr'] != '') {
			$obr = ' AND nombre_obra LIKE "%'.$_POST['obr'].'%" ';
		} else {
			$obr = '';
		}
		if ($_POST['ase'] != '') {
			$reg = ' AND vendedor_cli = "' . $_POST['ase'] . '" ';
		} else {
			$reg = '';
		}
               
                if ($_POST['est'] != '') {
                    $estd = $_POST['est'];
			$est = ' AND estado_cot_s in ('.$estd.') ';
		} else {
			$est = '';
		}
                 if ($_POST['ciu'] != '') {
			$ciu = ' AND ciudad_obra like "%' . $_POST['ciu'] . '%" ';
		} else {
			$ciu = '';
		}
                 if ($_POST['bus_tip'] != '') {
			$tobra = ' AND tip_obra like "%' . $_POST['bus_tip'] . '%" ';
		} else {
			$tobra = '';
		}
  
                
//                if($_POST['dsdd']=='' && $_POST['hstaa']==''){
//                      $fg ='';
//                       }else{
//                      $fg =' and a.fecha_reg_c >= "'.$_POST['est'].'" and a.fecha_reg_c <= "'.$_POST['est'].'" ';
//                       } 
             
	$request = mysqli_query($conexion,"SELECT count(*), sum(vtotal_obra) FROM  seguimientos_cot where borrador='$sin_lista' $tobra $est $cot $valor $nom $obr $reg $ciu $fecha "   );
	if ($request) {
		$req = mysqli_fetch_array($request);
                
		$num_items = $req[0];
	} else {
		$num_items = 0;
	}
	$rows_by_page = $_POST['lista'];
	$last_page = ceil($num_items / $rows_by_page);
	if (isset($_POST['page'])) {
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
	function interval_date2($init, $finish){
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
       ///SELECT max(id_cot), numero_cotizacion,max(version) FROM cotizacion where numero_cotizacion=45490 group by numero_cotizacion order by numero_cotizacion desc
        ?> <br>
<?php
	$limit = 'LIMIT ' . ($page - 1) * $rows_by_page . ',' . $rows_by_page;
        echo '<h3>Cantidad de Registro: '.$num_items. ' | Valor Total en Cotizaciones: $'.  number_format($req[1]);
        $fuente = $_POST['fuente'];
        if($fuente=='1'){
            $class = 'blueTable';
        }elseif($fuente=='2'){
            $class = 'medio';
        }else{
            $class = 'grande';
        }
?>
<br>
<table class="<?php echo $class; ?>">
            <thead>
                
            <tr>
            <?php if($vcot=='false'){ ?><th>COTIZACION</th><?php } ?>
            <th>VALOR</th>
            <th>CLIENTE</th>
            <th>OBRA</th>
            <?php if($vciu=='false'){ ?><th>DEP/CIUDAD</th><?php } ?>
            <?php if($vdir=='false'){ ?><th>DIRECCION</th><?php } ?>
            <?php if($ver_tip=='false'){ ?><th nowrap>TIP OBRA</th><?php } ?>
            <?php if($vest=='false'){ ?><th>ESTADO</th><?php } ?>
            <?php if($vase=='false'){ ?><th NOWRAP>ASESOR / ANALISTA</th><?php } ?>
            <?php if($vfec=='false'){ ?><th>FECHA</th><?php } ?>
            <?php if($vopc=='false'){ ?><th nowrao>OPCIONES</th><?php } ?>
            
            
            </tr>
            </thead>
            <?php
               $footer = '<tfoot><tr><td colspan="11"><div class="links">';
        if ($page > 1) {
            $footer = $footer . '<a href="#" onclick="mostrar(1)">&laquo;</a> <a class="active" href="#" onclick="mostrar('.($page - 1).')">&laquo;&laquo;</a>';
        }else{
           $footer = $footer . ' <a href="#">&laquo;</a> ';   
        }
           $footer = $footer . ' <a href="#">Pagina '.$page.' de '.$last_page.'</a> ';
        if ($page < $last_page) {
            $footer = $footer . '<a href="#" onclick="mostrar('.($page + 1).')">&raquo;&raquo;</a> <a href="#" onclick="mostrar('.($last_page).')">&raquo;</a>';
        }else{
            $footer = $footer . '<a href="#">&raquo;</a>';
        }
        echo $footer = $footer . '</div></tr></tfoot>';
            ?>
            
            <tbody>
<?php

	$request_ac = mysqli_query($conexion,"SELECT * FROM  seguimientos_cot  where borrador='$sin_lista' $tobra $est $cot $nom $valor $obr $reg $ciu $fecha order by $nombre_ord $asc_desc " . $limit);
   
		if ($request_ac) {
                       $table = '';
			$cont = 0;
			while($row = mysqli_fetch_array($request_ac)) {
				$cont = $cont + 1;
				if($row['nombre_cliente']=='CLIENTES VARIOS')
                                    {
                                    $nombre=$row['nom_temp'];    
                                    }else{
                                    $nombre=$row['nombre_cliente'];   
                                    }
                                    if($sin_lista==0){
                                        $ce = 1;
                                    }else{
                                        $ce=0;
                                    }
                                    

                                    $stilo = ' style="background-color:green;color:white" ';
                                    $obra = "'".strtoupper($row["nombre_obra"])."'";
                                
                                           $sg = '<button '.$stilo.' onclick="mostrar_seguimientos('.$row['id_relacion'].','.$obra.');" type="button" title="Seguimiento" data-toggle="modal" data-target="#myModal">S</button>';
                                           $del = '<button onclick="papelera('.$row['id_relacion'].','.$ce.');" type="button" title="Descartar cotizacion"><b>X</b></button>';
                                                 $im = '<button  onclick="cot('.$row['id_relacion'].');" type="button" title="Imprimir Cotizacion">Imp</button>';
                   if($row['tecnica']==''){
                      $tec = '';
                       }else{
                          $tec = '-<font color="purple">'.$row['tecnica'].'</font>';
                              }  
                 if($row['estra_obra']=='0'){
                          $es='N/A';
                       }else{
                          $es=$row['estra_obra'];
                        }
                              
			        $table = $table . '<tr>';
                                if($vcot=='false'){ $table = $table . '<td>' . $row['numero_cotizacion_s'] . '.' . $row["version_s"] .$tec.'<img src="../../images/costo.png" width=35px onclick="m_cost('.$row['id_relacion'].','.$row['vtotal_obra'].')"></td>'; }
                                $table = $table . '<td style="text-align:left;">$' . number_format($row["vtotal_obra"]) . '<font></td>';
				$table = $table . '<td>' . strtoupper($nombre) . '</td>';
				$table = $table . '<td>' . strtoupper($row["nombre_obra"]).'</td>';
                                if($vciu=='false'){ $table = $table . '<td>'. strtoupper($row["ciudad_obra"]) .'</td>'; }
                                if($vdir=='false'){ $table = $table . '<td>' . strtoupper($row["direccion_obra"]).'<br>'.$row["tel_cliente"].' '.$row['tel_obra'].'<font></td>'; }
                                if($ver_tip=='false'){ $table = $table . '<td>'.$row["tip_obra"] .'<br>Estr:&nbsp; &nbsp;'.$es.'</td>'; }
                                if($vest=='false'){ $table = $table . '<td>' . $row["estado_cot_s"] . '</font></td>'; }
                                if($vase=='false'){ $table = $table . '<td style="text-align:center;">' . strtoupper($row["vendedor_cli"]) .'<br>'. strtoupper($row["analista_obra"]) . '<font></td>'; }
                                if($vfec=='false'){ $table = $table . '<td>' . substr($row["fec_sistema"],0,10) . '<font></td>'; }
                                if($vopc=='false'){ $table = $table . '<td nowrap>'.$sg.' '.$im.'&nbsp; &nbsp; '.$del.'</td>'; }
                          
				$table = $table . '</tr>';
			}

		}
                echo $table;
//                $p = array();
//                $p[0] = $table;
//                $p[1] = $footer;
//                echo json_encode($p);
	?>
</tbody>
            
            </table>
