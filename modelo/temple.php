<?phpsession_start();require("conexion.php");$status = "";              $p1= $_POST["p1"];            $p2= $_POST["p2"];                                          if(isset($_GET['editar'])){                $sql = "UPDATE `servicio_temple` SET `espesor`='".$p1."',`costo`='".$p2."' WHERE `id_temple` = ".$_GET["editar"].";";                 mysqli_query($conexion,$sql);             echo '<script lanquage="javascript">alert("Se ha Editado el servicio");location.href="../vistas/?id=temple"</script>';         }else{            $sql = "INSERT INTO `servicio_temple` (`espesor`, `costo`)";            $sql.= "VALUES ('".$p1."','".$p2."')";            mysqli_query($conexion,$sql);            $status = "ok";            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el servicio");location.href="../vistas/?id=temple"</script>';         }             ?>	                   