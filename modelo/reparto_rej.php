<?phpsession_start();require("conexion.php");switch ($_POST['sw']){       case 1:            $ref= $_POST["ref"];            $ancho_v= $_POST["perfil_med"];            $dv= $_POST["med_rej"];            $var= $_POST["var3"];            $varr= $_POST["varr"];            $en= $_POST["en"];             $por= $_POST["multiplo"];             $id= $_POST["id"];             $id_p= $_POST["cod"];                   if($id!==''){                $sql = "UPDATE `producto_rep_rej` SET `multiplo`='".$por."', `en`='".$en."',`id_referencia`='".$ref."',`id_referencia_med`='".$ancho_v."',`medida_rej`='".$dv."', `var3`='".$var."', `varr`='".$varr."' WHERE `id_r_rej` = ".$id.";";                 mysql_query($sql, $conexion);                 $p = array();                 $p[0] = $id;                 $p[1] = 'Se ha Editado Satisfactoriamente la informacion del pefil';                 echo json_encode($p);        }else{            $sql = "INSERT INTO `producto_rep_rej` (`multiplo`, `en`, `id_referencia`, `id_referencia_med`, `var3`, `varr`,`medida_rej`,`id_p`)";            $sql.= "VALUES ('".$por."', '".$en."', '".$ref."', '".$ancho_v."', '".$var."', '".$varr."', '".$dv."', '".$id_p."')";            mysql_query($sql, $conexion);            $id = mysql_insert_id();            $p = array();            $p[0] = $id;            $p[1] = 'Se ha Guardado Satisfactoriamente el perfil';            echo json_encode($p);        }        break;    case 2:        $id= $_POST["id"];            $sql=mysql_query('select * from producto_rep_rej a, referencias b where a.id_referencia=b.id_referencia and a.id_r_rej='.$id.' ') or die(mysql_error());            $fil =mysql_fetch_array($sql);            $p = array();            $p[0]= $fil["id_r_rej"];            $p[1]= $fil["id_referencia"];            $p[2]= $fil["descripcion"];            $p[3]= $fil["referencia"];            $p[4]= $fil["codigo"];            $p[5]= $fil["id_referencia_med"];            $p[6]= $fil["medida_rej"];            $p[7]= $fil["var3"];            $p[8]= $fil["varr"];            $p[9]= $fil["en"];            $p[10]=$fil["multiplo"];            echo json_encode($p);                break;       case 3:                                 break;        }?>	                   