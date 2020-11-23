<?php 
session_start();
require("../modelo/conexion.php");

    function form_mail($sPara, $sAsunto, $sTexto, $sDe) 
    { 
     
        $bHayFicheros = 0; 
        $sCabeceraTexto = ""; 
        $sAdjuntos = ""; 
        $sCuerpo = $sTexto; 
        $sSeparador = uniqid("_Separador-de-datos_"); 
         
        $sCabeceras = "MIME-version: 1.0\n"; 
         
        // Recogemos los campos del formulario 
        foreach ($_POST as $sNombre => $sValor) 
            $sCuerpo = $sCuerpo."\n".$sNombre." = ".$sValor; 
             
        // Recorremos los Ficheros 
        foreach ($_FILES as $vAdjunto) 
        { 
             
            if ($bHayFicheros == 0) 
            { 
                 
                // Hay ficheros 
                 
                $bHayFicheros = 1; 
                 
                // Cabeceras generales del mail 
                $sCabeceras .= "Content-type: multipart/mixed;"; 
                $sCabeceras .= "boundary=\"".$sSeparador."\"\n"; 
                 
                // Cabeceras del texto 
                $sCabeceraTexto = "--".$sSeparador."\n"; 
                $sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n"; 
                $sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n\n"; 
                 
                $sCuerpo = $sCabeceraTexto.$sCuerpo; 
                 
            } 
             
            // Se añade el fichero 
            if ($vAdjunto["size"] > 0) 
            { 
                $sAdjuntos .= "\n\n--".$sSeparador."\n"; 
                $sAdjuntos .= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n"; 
                $sAdjuntos .= "Content-Transfer-Encoding: BASE64\n"; 
                $sAdjuntos .= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";                  
                 
                $oFichero = @fopen($vAdjunto["tmp_name"], 'rb'); 
                $sContenido = @fread($oFichero, filesize($vAdjunto["tmp_name"])); 
                $sAdjuntos .= chunk_split(base64_encode($sContenido)); 
                @fclose($oFichero); 
            } 
             
        } 
         
        // Si hay ficheros se añaden al cuerpo 
        if ($bHayFicheros) 
            $sCuerpo .= $sAdjuntos."\n\n--".$sSeparador."--\n"; 
         
        // Se añade la cabecera de destinatario 
        if ($sDe)$sCabeceras .= "From:".$sDe."\n"; 
         
        // Por último se envia el mail 
        return(mail($sPara, $sAsunto, $sCuerpo, $sCabeceras)); 
    } 
     
    
    
    
        //Ejemplo de como usar: 
        if (form_mail($_POST['E-mail'], 
                                    "Cotizacion de producto (TEMPLADO S.A) No.".$_POST['Cotizacion'], 
                                    "Detalles de la cotizacion:\n", 
                                    "cotizacion@templadosa.com")) 
                
                    $rutaEnServidor='cotizaciones';
            $rutaTemporal=$_FILES["archivo1"]["tmp_name"];
             $nombreImagen=$_FILES["archivo1"]["name"];
             //imagen 2
             
            if($nombreImagen==''){
                $rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
                $rutaDestino2=$nombreImagen;
            }else{
                 $rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
                 $rutaDestino2=$nombreImagen;
            }
             move_uploaded_file($rutaTemporal,$rutaDestino);
     $sql = "INSERT INTO `correos` (`cotizacion`, `de`, `para`, `archivo`, `comentarios`)";
            $sql.= "VALUES ('".$_POST['Cotizacion']."', '".$_POST['De']."', '".$_POST['E-mail']."', '".$rutaDestino2."', '".$_POST['Observaciones']."')";
            mysqli_query($conexion,$sql);
         
              echo '<script lanquage="javascript">alert("Se ha enviado la cotizacion al cliente exitosamente");location.href="../vistas/?id=send&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&tipo='.$_GET['tipo'].' "</script>'; 
       
        // Ejemplo de como usar, poniendo como remitente el campo pasado de E-mail 
        /* 
        if (form_mail("usuario_destino@dominio.com", 
                                    "Activación de formulario", 
                                    "Los datos introducidos en el formulario son:\n", 
                                    $_POST["E-mail"])) 
        echo "Su formulario ha sido enviado con exito"; 
        */ 
         

?>
