<?php
session_start();
require("conexion.php");
$status = "";

            $nombre= $_POST["nombre"];
            $documento = $_POST["documento"];
            $tipo= $_POST["tipo"];
            $direccion= $_POST["direccion"];
            $departamento= $_POST["departamento"];
            $municipio= $_POST["municipio"];
            $telefono= $_POST["telefono"];
            $mail= $_POST["mail"];
            $contacto= $_POST["contacto"];
            $contacto_tel= $_POST["tel_contacto"];
            
            $sql21 = "SELECT count(id_cli), id_cli FROM clientes where cedu_nit=".$_POST['documento'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $existe= $fila21["count(id_cli)"];
            $id= $fila21["id_cli"];
            if($existe==0){
           
        if(isset($_GET['editar'])){

                $sql = "UPDATE `clientes` SET `contacto`='".$contacto."',`tel_contacto`='".$contacto_tel."',`direccion_cli`='".$direccion."', `nombre_cli`='".$nombre."',`cedu_nit`='".$documento."',`tipo_cli`='".$tipo."',`Departamento`='".$departamento."', `Municipio`='".$municipio."',`telefono_cli`='".$telefono."',`email`='".$mail."' WHERE `id_cli` = ".$_GET["editar"].";";
                 mysqli_query($conexion,$sql);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del cliente");location.href="../vistas/?id=new_cli&cod='.$_GET['editar'].'"</script>'; 

        }else{


            $sql = "INSERT INTO `clientes`(`contacto`, `tel_contacto`, `nombre_cli`, `cedu_nit`, `tipo_cli`, `direccion_cli`, `Departamento`, `Municipio`, `telefono_cli`, `email`, `registrado_por`)";
            $sql.= "VALUES ('".$contacto."', '".$contacto_tel."','".$nombre."', '".$documento."', '".$tipo."',  '".$direccion."', '".$departamento."', '".$municipio."', '".$telefono."', '".$mail."', '".$_SESSION['k_username']."')";
            mysqli_query($conexion,$sql);

            $status = "ok";

            $sql21 = "SELECT max(id_cli) FROM clientes";
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $max= $fila21["max(id_cli)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el cliente");location.href="../vistas/?id=new_cli&cod='.$max.'"</script>'; 

            }}else{
                echo '<script lanquage="javascript">alert("El cliente ya existe en la base de datos");location.href="../vistas/?id=new_cli&cod='.$id.'"</script>'; 
                
            }


	                   