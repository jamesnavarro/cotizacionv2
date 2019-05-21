<?php
$bd_host = "localhost"; 
$bd_usuario = "samplevi_templa"; 
$bd_password = "20031123003"; 
$bd_base = "samplevi_templados"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
$idemp=$_POST['idemp'];

$sql=mysql_query("SELECT * FROM referencias WHERE id_referencia=$idemp",$con);

$row = mysql_fetch_array($sql);

//valores de las consultas
$nom=$row['descripcion'];
$suel=$row['costo_mt'];

//muestra los datos consultados en los campos del formulario
?>
<form name="frmempleado" action="" onsubmit="enviarDatosEmpleado(); return false">
	<input name="idempleado" type="hidden" value="<?php echo $idemp; ?>" />
    <!-- Input Append -->
                                    <div class="control-group">
                                        <label class="control-label">Descripcion </label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input name="nombres"  readonly type="text" value="<?php echo $nom; ?>" />
                                                
                                            </div>
                                        </div>
                                    </div><!--/ Input Append -->
  <!-- Input Append -->
                                    <div class="control-group">
                                        <label class="control-label">Precio</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input type="text" name="sueldo" class="span8" value="<?php echo $suel; ?>">
                                                <span class="add-on">.00</span>
                                            </div>
                                        </div>
                                    </div><!--/ Input Append -->
  <p>
    <input type="submit" name="Submit" value="Actualizar" />
  </p>
</form>