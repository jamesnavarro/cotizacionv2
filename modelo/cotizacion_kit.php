<?phpsession_start();require("conexion.php");$status = "";            $servicio= $_POST["ref"];            $cant= $_POST["cant"];            $desc= $_POST["desc"];$color= $_POST["color"];           $mp= $_POST["mp"];        if(isset($_GET['editar'])){                $sql = "UPDATE `cotizaciones_kit` SET `color_k`='".$color."', `por_k`='".$mp."', `id_producto`='".$servicio."',`cantidad_k`='".$cant."',`desc_k`='".$desc."' WHERE `id_ck` = ".$_GET["editar"].";";                 mysql_query($sql, $conexion);             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente el kit");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>';         }else{            $sql = "INSERT INTO `cotizaciones_kit` (`color_k`, `por_k`, `id_cot`, `id_producto`, `cantidad_k`, `desc_k`)";            $sql.= "VALUES ('".$color."', '".$mp."','".$_GET['cot']."', '".$servicio."', '".$cant."', '".$desc."')";            mysql_query($sql, $conexion);            $status = "ok";               echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el kit");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>';         }             ?>	                   