<?phpsession_start();require("conexion.php");$status = "";            $ref= $_POST["ref_ac"];            $color_acc= $_POST["color_acc"];            $cant= $_POST["cant_acc"];            $para= $_POST["para"];             $cal= $_POST["cal"];             $metros= $_POST["metros"];             $yes= $_POST["yes"];             $lado= $_POST["lado"];             $cr = $_POST["can_rej"];             $valor = $_POST["valor"];             $med= $_POST["med"];             $mul= $_POST["mul"];             $obs= $_POST["obs_n"];             $ambos= $_POST["ambos"];                   if(isset($_GET['editar'])){            //modificaciones                $query = mysql_query("select * from producto_rep_acc where `id_r_ac` = ".$_GET["editar"]." ");                $q = mysql_fetch_row($query);                $des = '';                if($q[1]!=$ref){                    $des = $des." Se actualizo el accesorio  id:".$q[1].' por id: '.$ref;                }                if($q[6]!=$para){                    $des = $des." - Se cambio el tipo de accesorio de ".$q[6].' a  '.$para;                }                if($q[3]!=$cant){                    $des = $des.'- Se actualizo la cantidad del accesorio de  '.$q[3].' a  '.$cant .' und';                }                if($q[10]!=$lado){                    $des = $des.'- Se actualizo el lado de  '.$q[10].' a  '.$lado .' ';                }                               $que = mysql_query("INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`) VALUES (NULL, '$des','".$_SESSION['k_username']."','Productos','".$_GET["cod"]."') ");                //fin de modificaciones                                 $sql = "UPDATE `producto_rep_acc` SET `ambos`='".$ambos."',`multiplica`='".$mul."',`valor_f`='".$valor."',`can_rej`='".$cr."', `med`='".$med."', `lado`='".$lado."',`metro`='".$metros."', `yes`='".$yes."',`calcular`='".$cal."', `para`='".$para."', `id_ref_acc`='".$ref."',`color_acc`='".$color_acc."',`cantidad_acc`='".$cant."',`observacion_acc`='".$obs."' WHERE `id_r_ac` = ".$_GET["editar"].";";                 mysql_query($sql, $conexion);             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del accesorio");location.href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'"</script>';         }else{            $sql = "INSERT INTO `producto_rep_acc` (`ambos`,`multiplica`,`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `observacion_acc`, `id_p`)";            $sql.= "VALUES ('".$ambos."','".$mul."','".$valor."','".$cr."', '".$med."', '".$lado."', '".$metros."', '".$yes."', '".$cal."', '".$para."', '".$ref."', '".$color_acc."', '".$cant."', '".$obs."', '".$_GET['id_p']."')";            mysql_query($sql, $conexion);            $status = "ok";               echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el perfil");location.href="../vistas/?id=nuevo_producto&cod='.$_GET['id_p'].'"</script>';         }             ?>	                   