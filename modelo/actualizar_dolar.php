<?php
	session_start();
	include 'conexion.php';
	$precio = $_POST['precio'];
        $dolar = $_POST['dolar'];
        $lma = $_POST['lma'];
        $prima = $_POST['prima'];
	$consultar = mysql_fetch_array(mysql_query("SELECT precio_dolar FROM dolares ORDER BY id_dolar DESC LIMIT 1"));
	$pd = $consultar['precio_dolar'];
	//echo '<script lanquage="javascript">alert("Se Actualizaron precio new:'.$p.', viejo:'.$pd.' Registros ");</script>';
	$sql2 = "INSERT INTO `dolares` (`lma`,`prima`,`precio_actual`,`precio_dolar`, `ingresado_por`, `fecha_reg_dolar`)";
	$sql2.= "VALUES ('" . $lma . "','" . $prima . "','" . $precio . "','" . $dolar . "','" . $_SESSION['k_username'] . "','" . date("Y-m-d") . "')";
	mysql_query($sql2, $conexion) or die(mysql_error());
	$maxi = mysql_fetch_array(mysql_query("select max(id_dolar) from dolares"));
	$max = $maxi['max(id_dolar)'];
	$request = mysql_query("SELECT * FROM referencias a, sublineas b WHERE a.grupo = b.descripcion_sl AND a.act_dolar = '1' and a.grupo in ('Perfileria','Perfileria Acero') ");
	$c = 0;
	while ($row = mysql_fetch_array($request)) {
                $grupo = $row['grupo'];
                
		$c += 1;
                if($grupo=='Perfileria'){
                    $por = $row['peso'];
                    $precio_fom = $_POST['precio'];
                    $precio = $_POST['precio'] * $por;
                }else{
                     $precio_fom = $row['costo_fom'];
                     $precio = $row['costo_fom']/6;// en parte de actualizacion se quito /6
                }
		
                

		$sql3 = "INSERT INTO `dolar_relaciones` (`id_dolar`, `id_referencia`, `precio_actual`, `precio_act_fom`, `cod_ref`)";
		$sql3.= "VALUES ('" . $max . "','" . $row['id_referencia'] . "','" . $precio . "','" . $precio_fom . "','" . $row['codigo']."')";
		mysql_query($sql3, $conexion) or die(mysql_error());
		include 'conexion.php';
		if ($pd != '') {
			$sql4 = "UPDATE `referencias` SET `costo_mt` = '" . $precio . "',`costo_fom` = '" . $precio_fom . "' WHERE `id_referencia` = '" . $row['id_referencia'] . "'";
			mysql_query($sql4, $conexion);
		}
		//$sql4 = "UPDATE  `dolar_relaciones` SET `precio_act_fom` = '".$row['costo_fom']."' WHERE `id_referencia` = '".$row['id_referencia']."'";
		//mysql_query($sql4, $conexion);
	}
	echo '<script lanquage="javascript">alert("Se Actualizaron '.$c.' Registros ");location.href="../vistas/?id=md"</script>';
?>