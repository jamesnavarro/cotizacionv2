<?phpsession_start();require("conexion.php");$status = "";            $grupo= $_POST["grupo"];            $producto= $_POST["producto"];                              if(isset($_GET['editar'])){                $sql = "UPDATE `item_fachada` SET `grupo`='".$grupo."',`id_ref`='".$producto."' WHERE `id_f` = ".$_GET["editar"].";";                 mysql_query($sql, $conexion);             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=add_fac&cod='.$_GET['cod'].'"</script>';         }else{            $sql = "INSERT INTO `item_fachada` (`grupo`, `id_ref`, `id_producto`)";            $sql.= "VALUES ('".$grupo."', '".$producto."', '".$_GET['id_p']."')";            mysql_query($sql, $conexion);            $status = "ok";               echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=add_fac&cod='.$_GET['id_p'].'"</script>';         }             ?>	                   