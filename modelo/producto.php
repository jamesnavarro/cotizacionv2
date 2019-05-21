<?php
session_start();
require("conexion.php");
$status = "";

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
                $rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
                $rutaDestino2=$nombreImagen;
            }else{
                 $rutaDestino='../'.$rutaEnServidor.'/'.$codigo.''.$nombreImagen;
                 $rutaDestino2=$codigo.''.$nombreImagen;
            }
            //image 2
            if($nombreImagen2==''){
                $rutaDestino3='../'.$rutaEnServidor.'/'.$nombreImagen2;
                $rutaDestino33=$nombreImagen2;
            }else{
                 $rutaDestino3='../'.$rutaEnServidor.'/'.$codigo.''.$nombreImagen2;
                 $rutaDestino33=$codigo.''.$nombreImagen2;
            }
            
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
                $sql = "UPDATE `producto` SET `ancho_maximo`='".$ancho_maximo."',`alto_maximo`='".$alto_maximo."',`modificado`='".$_SESSION['k_username']."',`perforacion`='".$per."', `boquete`='".$boq."', `kit`='".$kit."', `hoja`='".$hoja."', `referencia_p`='".$referencia."', $ruta2 $ruta `ancho_v_c`='".$ac."',`altura_v_c`='".$at."', `med_adicional`='".$altura."', `ancho_adicional`='".$anchura."', `producto`='".$producto."',`linea`='".$tipo_p."',`codigo`='".$codigo."',`tipo_vidrio`='".$tipo_v."',`color_alu`='".$color_a."',`ancho`='".$ancho."',`alto`='".$alto."',`laminas`='".$laminas."',`sistemas`='".$siste."' WHERE `id_p` = ".$_GET["editar"].";";
                mysql_query($sql, $conexion);
                 
                 
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del producto '.$_POST["producto"].'");location.href="../vistas/?id=add_cot&cod='.$_GET['editar'].'"</script>'; 

        }else{


            $sql = "INSERT INTO `producto` (`ancho_maximo`,`alto_maximo`,`modificado`,`registrado_por`,`registro`, `ruta2`, `perforacion`, `boquete`, `kit`, `hoja`, `referencia_p`, `ruta`, `ancho_v_c`, `altura_v_c`,`ancho_adicional`, `med_adicional`, `producto`, `linea`, `codigo`, `tipo_vidrio`, `color_alu`, `ancho`, `alto`, `laminas`, `sistemas`)";
            $sql.= "VALUES ('".$ancho_maximo."','".$alto_maximo."','".$_SESSION['k_username']."','".$_SESSION['k_username']."','".date('Y-m-d')."','".$rutaDestino33."', '".$per."', '".$boq."', '".$kit."', '".$hoja."', '".$referencia."', '".$rutaDestino2."', '".$anchura_v_c."', '".$altura_v_c."','".$anchura."','".$altura."', '".$producto."', '".$tipo_p."', '".$codigo."',  '".$tipo_v."', '".$color_a."', '".$ancho."', '".$alto."', '".$laminas."', '".$siste."')";
            mysql_query($sql, $conexion);

            $status = "ok";
            
            $sql21 = "SELECT max(id_p) FROM producto";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $max= $fila21["max(id_p)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el producto ");location.href="../vistas/?id=add_cot&cod='.$max.'"</script>'; 

        }
                   