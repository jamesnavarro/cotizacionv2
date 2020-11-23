<?php
session_start();
require("conexion.php");

$status = "";

            $ref= $_POST["ref"];
            $descripcion= $_POST["desc"];
            $codigo= $_POST["codigo"];
            $valor= $_POST["valor"];
            $medida= $_POST["medida"];
           
        if(isset($_GET['up'])){

                $sql = "UPDATE `referencia_alum` SET `referencia`='".$ref."',`descripcion`='".$descripcion."',`codigo_alum`='".$codigo."',`costo_mt`='".$valor."',`medida`='".$medida."' WHERE `id_ref_alum` = ".$_GET["up"].";";
                 mysqli_query($conexion,$sql);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del pefil");location.href="../vistas/?id=add_per"</script>'; 

        }else{


            $sql = "INSERT INTO `referencia_alum` (`referencia`, `descripcion`, `codigo_alum`, `medida`, `costo_mt`)";
            $sql.= "VALUES ('".$ref."', '".$descripcion."', '".$codigo."',  '".$medida."',  '".$valor."')";
            mysqli_query($conexion,$sql);

            $status = "ok";

   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el perfil");location.href="../vistas/?id=add_per"</script>'; 

        }

                   