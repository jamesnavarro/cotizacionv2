<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Lista_Cotizaciones".date("YmdHis").".xls");
	include "../../modelo/conexion.php";
	include "../../modelo/consultar_permisos.php";
        session_start();
        $nombre_ord = $_GET['ord'];
        $asc_desc = $_GET['orden'];
         $ano = $_GET['ano'];
         $mes = $_GET['mes'];
         $vciu = $_GET['vciu'];
         $vest = $_GET['vest'];
         $vopc = $_GET['vopc'];
         $vdir = $_GET['vdir'];
         $vase = $_GET['vase'];
         $vfec = $_GET['vfec'];
         $seg = $_GET['seg'];
         if($seg==''){
             $qseg = '';
         }else{
             $qseg = ' AND a.seguimiento="'.$seg.'"  ';
         }
         if($ano!='' && $mes!=''){
             $fecha = ' and fecha_reg_c between  "' . $ano . '" and "' . $mes . '" ';
         }else{
             $fecha = '';
         }
          $vcot = '';

		if ($_GET['cot'] != '') {
			$cot = ' AND a.numero_cotizacion in ('. $_GET['cot'] . ') ';
                         $asc = '  a.version ';
		} else {
			$cot = '';
                         $asc = '  a.numero_cotizacion ';
		}
		if ($_GET['cli'] != '') {
			$nom = ' AND CONCAT(b.nom_ter, " ", a.nom_temp) LIKE "%' . $_GET['cli'] . '%" ';
		} else {
			$nom = '';
		}
                if ($_GET['pre'] != '') {
			$valor = ' AND a.costo_total  BETWEEN  "' .$_GET['pre'] .'" and "' .$_GET['pref'] .'" ';
		} else {
			$valor = '';
		}
		if ($_GET['obr'] != '') {
			$obr = ' AND a.obra LIKE "%'.$_GET['obr'].'%" ';
		} else {
			$obr = '';
		}
		if ($_GET['ase'] != '') {
			$reg = ' AND a.registrado = "' . $_GET['ase'] . '" ';
		} else {
			$reg = '';
		}
               
                if ($_GET['est'] != '') {
                    
			$est = ' AND a.estado in (' . $_GET['est'] . ') ';
		} else {
			$est = '';
		}
                 if ($_GET['ciu'] != '') {
			$ciu = ' AND a.municipio like "%' . $_GET['ciu'] . '%" ';
		} else {
			$ciu = '';
		}

        ?> <br>

<br>
<table class="">
            <thead>
                
            <tr>
            <th>COTIZACION</th>
           
            <th>VALOR</th>
             <th>CLIENTE</th>
            <th>OBRA</th>
            <th>DEPARTAMENTO</th>
            <th>MUNICIPIO</th>
            <th>DIRECCION</th>
            <th>TELEFONO</th>
            <th>ESTADO</th>
            <th NOWRAP>ASESOR</th>
            <th NOWRAP>ANALISTA</th>
            <th>FECHA</th>
            <th nowrao>FECHA MODIFICACION</th>
            
            
            </tr>
            </thead>

            
            <tbody>
<?php 
	$request_ac = mysqli_query($conexion,"SELECT max(a.id_cot) as id_cot, max(a.version) as version,id_tercero,nom_temp,cod_temp,a.seguimiento,a.costo_total,a.estado,numero_cotizacion,obra,ciudad, ubicacion,a.registrado,fecha_reg_c,fecha_modificacion,telfijo_ter,tel_responsable,presupuesto,municipio FROM cotizacion a, cont_terceros b WHERE  a.id_cot IN (SELECT max(id_cot) FROM `cotizacion` GROUP by numero_cotizacion) and  a.id_tercero = b.id_ter " . $cot . $nom . $obr . $reg . $est. $valor .$ciu. $fecha.$qseg. " group by numero_cotizacion ORDER BY $nombre_ord $asc_desc  limit 0,5000 "  );
   
		if ($request_ac) {
                       $table = '';
			$cont = 0;
			while($row = mysqli_fetch_array($request_ac)) {
				$cont = $cont + 1;
				$sql = 'SELECT * FROM cont_terceros WHERE id_ter = "' . $row['id_tercero'] . '"';
				$fil = mysqli_fetch_array(mysqli_query($conexion,$sql));
				if ($row["nom_temp"] == '') {
					$nombre = $fil["nom_ter"];
					$documento = $fil["cod_ter"];
				} else {
					$nombre = $row["nom_temp"] ;
					$documento = $row["cod_temp"];
				}

                             
                   
			        $table = $table . '<tr>';
                                $table = $table . '<td>' . $row['numero_cotizacion'] . '.' . $row["version"] .$tec.'</td>'; 
                                $table = $table . '<td style="text-align:left;">$' . number_format($row["costo_total"]) . '<font></td>';
				$table = $table . '<td>' . strtoupper($nombre) . '</td>';
				$table = $table . '<td>' . strtoupper($row["obra"]).'</td>';
                                $table = $table . '<td>'. strtoupper($row["ciudad"]) .'</td>'; 
                                $table = $table . '<td>'. strtoupper($row["municipio"]) . '</td>'; 
                                $table = $table . '<td>' . strtoupper($row["ubicacion"]).'<font></td>'; 
                                $table = $table . '<td>'.$row["tel_responsable"].'<font></td>'; 
                                $table = $table . '<td>' . $row["estado"] . '</font></td>'; 
                                $table = $table . '<td style="text-align:center;">' . strtoupper($row["registrado"]) .'<font></td>'; 
                                $table = $table . '<td style="text-align:center;">'. strtoupper($row["presupuesto"]) . '<font></td>'; 
                                $table = $table . '<td>' . substr($row["fecha_reg_c"],0,10) . '<font></td>'; 
                                $table = $table . '<td nowrap>' . substr($row["fecha_modificacion"],0,10) . '</td>'; 
                          
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
