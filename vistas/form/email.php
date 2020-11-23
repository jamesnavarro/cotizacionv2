<?php
 require '../modelo/conexion.php';

  if(isset($_GET['cot'])){
 $sql21 = "SELECT * FROM cotizacion  where id_cot=".$_GET['cot'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            
            $obra= $fila21["obra"];
            $ubicacion= $fila21["ubicacion"];
            $linea= $fila21["linea"];
            $orden_p= $fila21["orden"];
            $estado= $fila21["estado"];
            $asesor= $fila21["registrado"];
            $responsable= $fila21["responsable"];
            $tel_responsable= $fila21["tel_responsable"];
            $ciudad= $fila21["ciudad"];
            $costo_total= $fila21["costo_total"];
            $costo_instalacion= $fila21["costo_instalacion"];
            $nc= $fila21["numero_cotizacion"].'.'.$fila21["version"];
            if($fila21['tipo']=='Empresarial'){
            $sql='select * from sis_empresa where id_empresa="'.$fila21['id_cliente'].'"';
            $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
            $email= $fil["email1_emp"];
            $nombre= $fil["nombre_emp"];
            }else{
              $sql='select * from sis_contacto where id_contacto="'.$fila21['id_cliente'].'"';
              $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
              $nombre= $fil["nombre_cont"].' '. $fil["apellido_cont"];
              $email= $fil["email1"];
          }
        
 }

 ?>
<script language='javascript'>
function cliente()
{
catPaises = window.open('../vistas/form_cliente.php', 'contacto', 'width=500,height=600');
}
function enfermedad()
{
catPaises = window.open('../vistas/agregar_enfermedad.php', 'contacto', 'width=500,height=600');
}

</script>
<script language="javascript" type="text/javascript">
function dato(val7, val8, val5, val6, val9, val10, val11, val12){
    document.getElementById('valor7').value = val7;
    document.getElementById('valor8').value = val8;
    document.getElementById('valor5').value = val5;
    document.getElementById('valor6').value = val6;
    document.getElementById('valor9').value = val9;
    document.getElementById('valor10').value = val10;
    document.getElementById('valor11').value = val11;
    document.getElementById('valor12').value = val12;
}
</script>
<div class="row-fluid">
                        <!-- START Form Wizard -->
                            <section class="body">
                                <div class="control-group">
                 <form name='formulario' id='formulario' method='post' action='../vistas/message.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli'].'&tipo='.$_GET['tipo'] ?>' enctype="multipart/form-data"> 
          <header><h4 class="title"><?php if(isset($_GET['cot'])){if($orden_p!=0){echo 'PEDIDO No. '.$orden_p;}else{if(isset($_GET['cot'])){echo 'Cotizacion No.'. $nc;}else{echo 'Generar Cotizacion de Producto';} }}else{echo 'Generar Cotizacion de Producto';} ?></h4></header>
                                         
                                         <div class="body-inner">
                                                                                      
                                    <fieldset style="width:90%; float:center; margin: 2% 2% 2% 2%;">
                                   
        <table width="500px">
         <tr>
            <td>Comprador <td><input type='text' name='Comprador'  value="<?php  if(isset($_GET['cot'])){echo $_SESSION["nombre"];}  ?>" id='Comprador'></td> 
            <tr>
            <td>Para : <td><input type='text' name='E-mail' value="<?php  if(isset($_GET['cot'])){echo $email;}  ?>" id='Para'></td>
            <tr> 
            <td>De: <td><input type='text' name='De'  value="<?php  if(isset($_GET['cot'])){echo $_SESSION["email"];}  ?>" id='E-mail'></td> 
            <tr>
            <td>Cotizacion No.<td><input type='text'  name='Cotizacion' id='Cotizacion' value="<?php  echo $nc;  ?>"></td> 
           <tr>
            <td>Adjuntar archivo1: <td><input type='file' name='archivo1' id='archivo1' required></td> 
            <tr>
            <p align='center'> 
                <input type='submit' value='Enviar formulario'> 
                <input type='reset' value='resetear formulario'> 
            </p> 
            <tr>
<td>
<label for="comments">Observaciones: *</label>
</td>
<td>
    <textarea name="Observaciones" id="Observaciones" maxlength="500" cols="100" rows="5"></textarea>
</td>
</tr></table> 
       
</fieldset>
   </div>                                  
      <!-- Form Action -->
</form>
    <br>
  </section>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$request=mysqli_query($conexion,"SELECT * FROM correos where cotizacion='".$nc."' order by id_correo desc ");

     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
             $table = $table.'<tr bgcolor="#D1EEF0">';
             $table = $table.'<th width="5%">'.'Item'.'</th>';
             $table = $table.'<th width="10%">'.'Cotizacion'.'</th>';             
             $table = $table.'<th width="20%">'.'Enviado a'.'</th>';
             $table = $table.'<th  width="20%">'.'Enviado por'.'</th>';
             $table = $table.'<th   width="10%">'.'Fecha de registro'.'</th>';
             $table = $table.'<th   width="30%">'.'Comentarios'.'</th>';
             $table = $table.'<th  class="hidden-phone">'.'Archivo'.'</th>';
             $table = $table.'</tr>';
             $table = $table.'</thead>';
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
 
          $table = $table.'<tr><td  width="5%">'.$row['id_correo'].'</td>'
          . '<td width="10%">'.$row['cotizacion'].'</td>'
          . '<td width="20%">'.$row['para'].'</td>'
          . '<td  width="20%">'.$row["de"].'</td>'
          . '<td  width="10%">'.$row["fecha_envio"].'<font></a></td>
          <td width="30%">'.$row["comentarios"].'</td><td class="hidden-phone"><a href="../vistas/?id=send&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&tipo='.$_GET['tipo'].'&descargar='.$row["archivo"].' "><img src="../imagenes/pdf.png"></a></td>'
          . '</tr>';   
	}
           $table = $table.'</table>';
	   echo $table;  
}
 ?>
   <!--/ END Form Wizard -->
 </div>

    
 <div class="control-group">
<?php
if(isset($_POST['para'])) {

// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
$email_to = $_POST['para'];
$email_subject = "Cotizacion de Producto (TEMPLADO S.A)";

// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['cliente']) ||
!isset($_POST['de']) ||
!isset($_POST['para']) ||
!isset($_POST['link']) ||
!isset($_POST['detalle'])) {

echo "<b>Ocurrio un error al enviar el formulario debe intentar nuevamente. </b><br />";
echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
die();
}

$email_message = "Cotizacion #:\n\n";
$email_message .= "Nombre del Asesor: " . $_POST['cliente'] . "\n";
$email_message .= "De: " . $_POST['de'] . "\n";
$email_message .= "Para: " . $_POST['para'] . "\n";
$email_message .= "Cotizacion: " . $_POST['link'] . "\n";
$email_message .= "Comentarios: " . $_POST['detalle'] . "\n\n";


// Ahora se envía el e-mail usando la función mail() de PHP
$headers = 'From: '.$_POST['de']."\r\n".
'Reply-To: '.$_POST['de']."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

echo "¡El fomulario fue enviado con exito!";
}



?>
 </div>
 </div>
  <br>    
  <br>   
  <br>       
