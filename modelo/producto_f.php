<?php
session_start();
require("conexion.php");
$status = "";

            $producto= $_POST["producto"];
            $tipo_p = $_POST["tipo_p"];
            $codigo= $_POST["codigo"];
            $tipo_v= $_POST["tipo_v"];
            
            $color_a= '';
            $referencia= $_POST["referencia"];
            $ancho= $_POST["ancho"];
            $alto= $_POST["alto"];
            if(isset($_POST["altura"])){
                $altura= $_POST["altura"];
            $altura_v_c= $_POST["alto"]-$_POST["altura"];
            $hoja= $_POST["hoja"];
            }else{
                $altura= '';
                $altura_v_c= '';
                $hoja= '';
            }
            
            $rutaEnServidor='producto';
            $rutaTemporal=$_FILES["imagen"]["tmp_name"];
             $nombreImagen=$_FILES["imagen"]["name"];
            if($nombreImagen==''){
                $rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
                $rutaDestino2=$nombreImagen;
            }else{
                 $rutaDestino='../'.$rutaEnServidor.'/'.$codigo.''.$nombreImagen;
                 $rutaDestino2=$codigo.''.$nombreImagen;
            }
            move_uploaded_file($rutaTemporal,$rutaDestino);
            
        if(isset($_GET['editar'])){
                if($tipo_p=='Vidrio'){
                    $at = $_POST["alto"];
                }else{
                    $at = $_POST["alto"]-$_POST["altura"];
                }
                
                
                if($rutaDestino2!=''){$ruta = "`ruta`='".$rutaDestino2."',";}else{$ruta="";}
                $sql = "UPDATE `producto` SET `hoja`='".$hoja."', `referencia_p`='".$referencia."', $ruta `altura_v_c`='".$at."', `med_adicional`='".$altura."', `producto`='".$producto."',`linea`='".$tipo_p."',`codigo`='".$codigo."',`tipo_vidrio`='".$tipo_v."',`color_alu`='".$color_a."',`ancho`='".$ancho."',`alto`='".$alto."' WHERE `id_p` = ".$_GET["editar"].";";
                 mysqli_query($conexion,$sql);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del producto '.$_POST["producto"].'");location.href="../vistas/?id=add_fac&cod='.$_GET['editar'].'"</script>'; 

        }else{


            $sql = "INSERT INTO `producto` (`especial`, `hoja`, `referencia_p`, `ruta`, `altura_v_c`, `med_adicional`, `producto`, `linea`, `codigo`, `tipo_vidrio`, `color_alu`, `ancho`, `alto`)";
            $sql.= "VALUES ('1', '".$hoja."', '".$referencia."', '".$rutaDestino2."', '".$altura_v_c."', '".$altura."', '".$producto."', '".$tipo_p."', '".$codigo."',  '".$tipo_v."', '".$color_a."', '".$ancho."', '".$alto."')";
            mysqli_query($conexion,$sql);

            $status = "ok";

            $sql21 = "SELECT max(id_p) FROM producto";
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $max= $fila21["max(id_p)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente ");location.href="../vistas/?id=add_fac&cod='.$max.'"</script>'; 

        }
                   