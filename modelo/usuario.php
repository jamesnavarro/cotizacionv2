<?php

session_start();
require("conexion.php");
$status = "";

            $u_user= $_POST["user"];
            $u_clave= md5($_POST["clave"]);
            $u_nombre= $_POST["nombre"];
            $u_apellido= $_POST["apellido"];
            $u_cedula= $_POST["cedula"];
            $u_email= $_POST["email"];
            $u_admin= $_POST["admin"];
            $u_cargo= $_POST["cargo"];
            $u_area= $_POST["area"];
            $u_telefono= $_POST["telefono"];
            $u_celular= $_POST["celular"];
            $u_direccion= $_POST["direccion"];
            $u_ciudad= $_POST["ciudad"];
            $u_municipio= $_POST["municipio"];
            $u_sede= $_POST["sede"];
            $empresa= $_POST["empresa"];
            $u_estado= $_POST["estado"];
            $rol= $_POST["rol"];
            
            

        if(isset($_GET['editar'])){
            
            if($_POST["clave"]==''){
                $sql = "UPDATE `usuarios` SET `id_roles` = '".$rol."',`usuario` = '".$u_user."', `cedula` = '".$u_cedula."', `email` = '".$u_email."', `administrador` = '".$u_admin."', `nombre` = '".$u_nombre."', `apellido` = '".$u_apellido."', `estado` = '".$u_estado."', `cargo` = '".$u_cargo."', `area` = '".$u_area."', `telefono` = '".$u_telefono."', `celular` = '".$u_cedula."', `direccion` = '".$u_direccion."', `ciudad` = '".$u_ciudad."', `municipio` = '".$u_municipio."', `sede` = '".$u_sede."',`id_empresa` = '".$empresa."' WHERE `id_user` =  ".$_GET["editar"].";";
             
            }else{
                $sql = "UPDATE `usuarios` SET `id_roles` = '".$rol."',`usuario` = '".$u_user."', `password` = '".$u_clave."', `cedula` = '".$u_cedula."', `email` = '".$u_email."', `administrador` = '".$u_admin."', `nombre` = '".$u_nombre."', `apellido` = '".$u_apellido."', `estado` = '".$u_estado."', `cargo` = '".$u_cargo."', `area` = '".$u_area."', `telefono` = '".$u_telefono."', `celular` = '".$u_cedula."', `direccion` = '".$u_direccion."', `ciudad` = '".$u_ciudad."', `municipio` = '".$u_municipio."', `sede` = '".$u_sede."',`id_empresa` = '".$empresa."' WHERE `id_user` =  ".$_GET["editar"].";";
             
            }
             mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente el usuario");location.href="../vistas/?id=user&cod='.$_GET['editar'].'"</script>'; 
        }else{
$sql21 = "SELECT count(id_user), id_user FROM usuarios where usuario='".$_POST['user']."'";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $existe= $fila21["count(id_user)"];
            $id= $fila21["id_user"];
            if($existe==0){

            $reg = date('Y-m-d').' '.$hora;
            $sql = "INSERT INTO `usuarios` (`id_roles`, `usuario`, `password`, `cedula`, `email`, `administrador`, `nombre`, `apellido`, `estado`, `cargo`, `area`, `telefono`, `celular`, `direccion`, `ciudad`, `municipio`, `sede`, `ingreso`,`id_empresa`)";
            $sql.= "VALUES ('".$rol."', '".$u_user."', '".$u_clave."', '".$u_cedula."', '".$u_email."', '".$u_admin."', '".$u_nombre."', '".$u_apellido."', '".$u_estado."', '".$u_cargo."', '".$u_area."', '".$u_telefono."', '".$u_cedula."', '".$u_direccion."', '".$u_ciudad."', '".$u_municipio."', '".$u_sede."', '".$reg."', '".$empresa."');";
            mysql_query($sql, $conexion);

            $status = "ok";
            $sql21 = "SELECT max(id_user) FROM usuarios";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $max= $fila21["max(id_user)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la Pagina");location.href="../vistas/?id=user&cod='.$max.'"</script>'; 
            }else{
                echo '<script lanquage="javascript">alert("El usuario ya existe en la base de datos");location.href="../vistas/?id=user&cod='.$id.'"</script>'; 
                
            }
            }

        
     


?>



	
      
       
    
  
