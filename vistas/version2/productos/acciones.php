<?php
 require '../../../modelo/conexion.php';
 session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
             $sql='select * from producto where id_p="'.$_POST['cod'].'"';
             $fil =mysql_fetch_array(mysql_query($sql));
                    $id_p= $fil["id_p"];
                    $producto= $fil["producto"];
                    $tipo= $fil["tipo"];
                    $codigo= $fil["codigo"];
                    $tipo_v= $fil["tipo_vidrio"];
                    $color_a= $fil["color_alu"];
                    $ancho= $fil["ancho"];
                    $alto= $fil["alto"];
                    $linea= $fil["linea"];
                    $altura= $fil["med_adicional"];
                    $altura_v_c= $fil["altura_v_c"];
                    $anchura_v_c= $fil["ancho_v_c"];
                    $anchura= $fil["ancho_adicional"];
                    $ruta= $fil["ruta"];$ruta2= $fil["ruta2"];
                    $per= $fil["perforacion"];
                    $boq= $fil["boquete"];
                    $referencia= $fil["referencia_p"];
                    $aprobado= $fil["aprobado"];
                    $des = $fil["actualizado"];
                    $rev = $fil["revisado"];
                    $laminas= $fil["laminas"];
                    $alto_maximno= $fil["alto_maximo"];
                    $ancho_maximo= $fil["ancho_maximo"];
                     $hoja= $fil["hoja"];
                     $kit= $fil["kit"];
                     $ok= $fil["ok"];
                     $anulado= $fil["estado_producto"];
                     $sistemas= $fil["sistemas"];
                     if($ok==1){
                         $led = '<img src="../imagenes/led.gif">';
                     }else{
                         $led = '<img src="../imagenes/ledrojo.gif">';
                     }
                     if($anulado==0){
                         $btn = '<font color="green">Producto Activo</font>';
                     }else{
                         $btn = '<font color="red">Producto Inactivo</font>';
                     }
                     if($kit==0){
                         $k = 'No';

                     }else{
                         $k= 'Si';

                     }
            
            break;
        case 2:
            $producto= $_POST["producto"];
            $tipo_p = $_POST["tipo_p"];
            $codigo= $_POST["codigo"];
            $tipo_v= $_POST["tipo_v"];
            $per= $_POST["per"];
            $boq= $_POST["boq"];
            $color_a= '';
            $referencia= $_POST["referencia"];
            $ancho= $_POST["ancho"];
            $alto= $_POST["alto"];
            $kit= $_POST["kit"];
            $laminas = $_POST["laminas"];
            $siste = $_POST["sis_cot"];
            if(isset($_POST["altura"])){
                $altura= $_POST["altura"];
            $altura_v_c= $_POST["alto"]-$_POST["altura"];
            $hoja= $_POST["hoja"];
            }else{
                $altura= '';
                $altura_v_c= '';
                $hoja= '';
            }
            $ancho_maximo= $_POST["ancho_maximo"];
            $alto_maximo= $_POST["alto_maximo"];
            $anchura= $_POST["anchura"];
            $anchura_v_c= $_POST["ancho"]-$_POST["anchura"];
            $rutaEnServidor='producto';
            $rutaTemporal=$_FILES["imagen"]["tmp_name"];
             $nombreImagen=$_FILES["imagen"]["name"];
             //imagen 2
             $rutaTemporal2=$_FILES["imagen2"]["tmp_name"];
             $nombreImagen2=$_FILES["imagen2"]["name"];
             
            if($nombreImagen==''){
                $rutaDestino='../../../'.$rutaEnServidor.'/'.$nombreImagen;
                $rutaDestino2=$nombreImagen;
            }else{
                 $rutaDestino='../../../'.$rutaEnServidor.'/'.$nombreImagen;
                 $rutaDestino2=$nombreImagen;
            }
            //image 2
            if($nombreImagen2==''){
                $rutaDestino3='../../../'.$rutaEnServidor.'/'.$nombreImagen2;
                $rutaDestino33=$nombreImagen2;
            }else{
                 $rutaDestino3='../../../'.$rutaEnServidor.'/'.$codigo.''.$nombreImagen2;
                 $rutaDestino33=$codigo.''.$nombreImagen2;
            }
            
            $rieles = $_POST["rieles"];
            $alfajias = $_POST["alfajias"];
            $cierres = $_POST["cierres"];
            $rodajas = $_POST["rodajas"];
            $brazos = $_POST["brazos"];
            $bisagras = $_POST["bisagras"];
            
            move_uploaded_file($rutaTemporal,$rutaDestino);
            //imagen 2
            move_uploaded_file($rutaTemporal2,$rutaDestino3);
            
        if(isset($_GET['editar'])){
                if($tipo_p=='Vidrio'){
                    $at = $_POST["alto"];
                    $ac = $_POST["ancho"];
                }else{
                    $at = $_POST["alto"]-$_POST["altura"];
                    $ac = $_POST["ancho"]-$_POST["anchura"];
                }
                //modificaciones
                $query = mysql_query("select * from producto where id_p='".$_GET['editar']."'");
                $q = mysql_fetch_row($query);
                $des = '';
                if($q[1]!=$producto){
                    $des = $des."Se actualizo la descripcion del producto ".$q[1].' ';
                }
                if($q[3]!=$codigo){
                    $des = $des." - Se actualizo el codigo del producto ".$q[3].' ';
                }
                if($q[4]!=$referencia){
                    $des = $des.'- Se actualizo la referencia del producto '.$q[4].' ';
                }
                 $que = mysql_query("INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`) VALUES (NULL, '$des','".$_SESSION['k_username']."','Productos','".$_GET["editar"]."') ");

                //fin de modificaciones
                
                if($rutaDestino2!=''){$ruta = "`ruta`='".$rutaDestino2."',";}else{$ruta="";}
                if($rutaDestino33!=''){$ruta2 = "`ruta2`='".$rutaDestino33."',";}else{$ruta2="";}
                $sql = "UPDATE `producto` SET `rieles`='".$rieles."',"
                        . "`alfajia`='".$alfajias."',"
                        . "`cierres`='".$cierres."',"
                        . "`rodajas`='".$rodajas."',`ancho_maximo`='".$ancho_maximo."',`alto_maximo`='".$alto_maximo."',`modificado`='".$_SESSION['k_username']."',`perforacion`='".$per."', `boquete`='".$boq."', `kit`='".$kit."', `hoja`='".$hoja."', `referencia_p`='".$referencia."', $ruta2 $ruta `ancho_v_c`='".$ac."',`altura_v_c`='".$at."', `med_adicional`='".$altura."', `ancho_adicional`='".$anchura."', `producto`='".$producto."',`linea`='".$tipo_p."',`codigo`='".$codigo."',`tipo_vidrio`='".$tipo_v."',`color_alu`='".$color_a."',`ancho`='".$ancho."',`alto`='".$alto."',`laminas`='".$laminas."',`sistemas`='".$siste."' WHERE `id_p` = ".$_GET["editar"].";";
                $error = mysql_query($sql, $conexion) or die(mysql_error());
                 
                 
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del producto '.$_POST["producto"].''.$ruta.'");location.href="../../../vistas/?id=nuevo_producto&cod='.$_GET['editar'].'"</script>'; 

        }else{


            $sql = "INSERT INTO `producto` (`ancho_maximo`,`alto_maximo`,`modificado`,`registrado_por`,`registro`, `ruta2`, `perforacion`, `boquete`, `kit`, `hoja`, `referencia_p`, `ruta`, `ancho_v_c`, `altura_v_c`,`ancho_adicional`, `med_adicional`, `producto`, `linea`, `codigo`, `tipo_vidrio`, `color_alu`, `ancho`, `alto`, `laminas`, `sistemas`)";
            $sql.= "VALUES ('".$ancho_maximo."','".$alto_maximo."','".$_SESSION['k_username']."','".$_SESSION['k_username']."','".date('Y-m-d')."','".$rutaDestino33."', '".$per."', '".$boq."', '".$kit."', '".$hoja."', '".$referencia."', '".$rutaDestino2."', '".$anchura_v_c."', '".$altura_v_c."','".$anchura."','".$altura."', '".$producto."', '".$tipo_p."', '".$codigo."',  '".$tipo_v."', '".$color_a."', '".$ancho."', '".$alto."', '".$laminas."', '".$siste."')";
            mysql_query($sql, $conexion);

            $status = "ok";
            
            $sql21 = "SELECT max(id_p) FROM producto";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $max= $fila21["max(id_p)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el producto ");location.href="../vistas/?id=nuevo_producto&cod='.$max.'"</script>'; 

        }
            break;
        case 3:
                    $altura_v_c = $_GET['altura_v_c']; // altura ventana corrediza
                    $altura = $_GET['altura'];// altura cuerpo fijo
                    $anchura = $_GET['anchura']; //ancho cuerpo fijo
                    $anchura_v_c = $_GET['anchura_v_c']; // ancho ventana corrediza;
                    $ancho = $_GET['ancho'];
                    $alto = $_GET['alto'];
            if($_GET['ref']>90001){
                if($_GET['ref']=='999994'){
                    $med_perfil = $ancho;
                }else if($_GET['ref']=='999995'){
                     $med_perfil = $anchura;
                }else if($_GET['ref']=='999996'){
                     $med_perfil = $anchura_v_c;
                }else if($_GET['ref']=='999997'){
                     $med_perfil = $altura_v_c;
                }else if($_GET['ref']=='999998'){
                     $med_perfil = $altura;
                }else if($_GET['ref']=='999999'){
                     $med_perfil = $alto;
                }
                echo $med_perfil;
            }else{
                  $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where c.grupo='Perfileria' and b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and b.id_r_a='".$_GET['ref']."' ");                     
                    $result=  mysql_query($consulta);
                    $ta = 0;
                    $row=  mysql_fetch_array($result);
                    $valor1_an = $row['id_r_a'];
                    $valor2=$row['descripcion'];
                    $valor3=$row['lado'];
                    $descuento=$row['descuento'];
                    $medida_1=$row['medida_r_a'];
                    $nw_medida = $row['medida_r_a'];
                    $nw_lado = $row['lado'];
                    $nw_var1 = $row['descuento'];
                    $nw_ope = $row['signo'];
                    $nw_var2 = $row['variable'];
                    $nw_cant = $row['cantidad'];
                    $nw_div = $row['division'];
                    
                    $altura_v_c = $_GET['altura_v_c']; // altura ventana corrediza
                    $altura = $_GET['altura'];// altura cuerpo fijo
                    $anchura = $_GET['anchura']; //ancho cuerpo fijo
                    $anchura_v_c = $_GET['anchura_v_c']; // ancho ventana corrediza;
                    $ancho = $_GET['ancho'];
                    $alto = $_GET['alto'];

                    include 'formula_perfil.php';
                    echo $med_perfil;
                    
            }
                    

            break;
        case 4:
            
            
            break;
        case 5:
            
            
            break;        
        
}

