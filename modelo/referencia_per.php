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
                 mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del pefil");location.href="../vistas/?id=add_per"</script>'; 

        }else{


            $sql = "INSERT INTO `referencia_alum` (`referencia`, `descripcion`, `codigo_alum`, `medida`, `costo_mt`)";
            $sql.= "VALUES ('".$ref."', '".$descripcion."', '".$codigo."',  '".$medida."',  '".$valor."')";
            mysql_query($sql, $conexion);

            $status = "ok";

   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el perfil");location.href="../vistas/?id=add_per"</script>'; 

        }

                   