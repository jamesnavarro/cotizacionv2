<?php
session_start();
require("conexion.php");
$status = "";

            $link= $_POST["link"];
            $desc = $_POST["desc"];
            $solu= $_POST["solu"];
            $estado= $_POST["estado"];
             $user= $_POST["user"];
              $fr= $_POST["fr"];
              $correo= $_POST["correo"];
           
            

            
        if(isset($_GET['editar'])){
                
            $email_to = $correo;
$email_subject = "Solución de Requerimiento";


$email_message = "Reporte  No. " .$_GET['editar']. "\n\n";
$email_message .= "Solucion:".$solu."\n http://sample.virtualdiseno.com/\n";
$email_message .= "Fecha de Modificacion: " .date("Y-m-d"). "\n\n";


$cc = 'ventas@virtualdiseno.com';
$headers = 'From: '.$_SESSION["email"]."\r\n".
'Reply-To: '.$_SESSION["email"]."\r\n" .
'Bcc: '.$cc."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($correo, $email_subject, $email_message, $headers);
$rutaEnServidor='registros';
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
                if($rutaDestino2!=''){$ruta = "`foto`='".$rutaDestino2."',";}else{$ruta="";}
           
                $sql = "UPDATE `requerimientos` SET $ruta `link`='".$link."', `requerimiento`='".$desc."', `solucion`='".$solu."', `estado`='".$estado."' WHERE `id_r` = ".$_GET["editar"].";";
                 mysqli_query($conexion,$sql);
                        
                        


             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del reporte '.$correo.'");location.href="../vistas/?id=soporte"</script>'; 

        }else{
  $sql21 = "SELECT max(id_r) FROM requerimientos";
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $max= $fila21["max(id_r)"]+1;
            
            $email_to = 'jnavarro@virtualdiseno.com';
$email_subject = "Reporte No. ".$max.'';

$email_message = "Requerimiento " .$desc. "\n\n";


$cc = 'ventas@virtualdiseno.com';
$headers = 'From: '.$_SESSION["email"]."\r\n".
'Bcc: '.$cc."\r\n" .
'Reply-To: '.$_SESSION["email"]."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

$rutaEnServidor='registros';
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
            
            $sql = "INSERT INTO `requerimientos` (`correo`, `link`, `requerimiento`, `solucion`, `foto`, `estado`, `fecharegistro`, `usuario`)";
            $sql.= "VALUES ('".$_SESSION["email"]."', '".$link."', '".$desc."', '".$solu."', '".$rutaDestino2."', '".$estado."', '".$fr."', '".$user."')";
            mysqli_query($conexion,$sql);

            $status = "ok";
 $sql212 = "SELECT max(id_r) FROM requerimientos";
            $fila212 =mysqli_fetch_array(mysqli_query($conexion,$sql212));
            $max2= $fila212["max(id_r)"]+1;
          
            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el Reporte, Su numero de reporte es: '.$max2.', Por favor guarde su numero de reporte para reclamos. ");location.href="../vistas/?id=soporte"</script>'; 

        }
                   