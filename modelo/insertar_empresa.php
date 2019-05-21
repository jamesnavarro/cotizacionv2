<?php 

session_start();

require("conexion.php");

$status = "";

        $cod = $_POST["cod"];

        $nombre = $_POST["empresa"];

	$nit = $_POST["nit"];

	$resolucion = $_POST["resolucion"];

        $fechaRes=$_POST["fechaRes"];

        $direccion = $_POST["direccion"];

        $telefono_emp = $_POST["telefono1"];

        $fax_emp = $_POST["telefono2"];

        $celular_emp = $_POST["telefono3"];

        $email_emp1 = $_POST["email"];

        $fact1 = $_POST["fi"];

        $fact2 = $_POST["ff"];

        $departamento_emp = $_POST["departamento_emp"];

        $municipio_emp = $_POST["municipio_emp"];

        $regimen = $_POST["regimen"];

        $gerente = $_POST["gerente"];

        $inf_emp = $_POST["info"];    

        $rutaEnServidor='logo';

            $rutaTemporal=$_FILES["imagen"]["tmp_name"];

             $nombreImagen=$_FILES["imagen"]["name"];

            if($nombreImagen==''){

                $rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;

                $rutaDestino2=$nombreImagen;

            }else{

                 $rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;

                 $rutaDestino2=$nombreImagen;

            }



            move_uploaded_file($rutaTemporal,$rutaDestino);

        if($cod!=''){

            if($rutaDestino2!=''){$ruta = "`logo`='".$rutaDestino2."',";}else{$ruta="";}

                        $sql = "UPDATE `inf_empresa` SET $ruta `nombre`='".$nombre."',`resolucion`='".$resolucion."',`fechaRes`='".$fechaRes."',`regimen`='".$regimen."',`gerente`='".$gerente."',`nit_emp`='".$nit."',`telefono_1`='".$telefono_emp."',`telefono_2`='".$fax_emp."',`telefono_3`='".$celular_emp."',`dapartamento`='".$departamento_emp."',`municipio`='".$municipio_emp."',`direccion`='".$direccion."',`email`='".$email_emp1."',`factura_inicial`='".$fact1."',`factura_final`='".$fact2."',`inf`='".$inf_emp."' WHERE `id_emp` = '".$cod."';";

                         mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=lista_empresa"</script>'; 

        }else{

            	$sql = "INSERT INTO `inf_empresa`(`logo`, `nombre`, `resolucion`, `fechaRes`,`regimen`, `gerente`, `nit_emp`, `telefono_1`, `telefono_2`, `telefono_3`, `factura_inicial`, `factura_final`, `dapartamento`, `municipio`, `direccion`, `email`, `inf`)";

                 $sql.= "VALUES ('".$rutaDestino2."', '".$nombre."', '".$resolucion."','".$fechaRes."', '".$regimen."', '".$gerente."', '".$nit."', '".$telefono_emp."', '".$fax_emp."', '".$celular_emp."','".$fact1."','".$fact2."', '".$departamento_emp."', '".$municipio_emp."', '".$direccion."', '".$email_emp1."', '".$inf_emp."')";

	          mysql_query($sql) or die(mysql_error());

   



            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=lista_empresa "</script>'; 



        }

                    
