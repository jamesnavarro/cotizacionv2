<?php
include "../modelo/conexion.php";
$rpta2="";

      $request2=mysqli_query($conexion,'select * from cont_terceros WHERE cod_ter="'.$_POST["documento_ter"].'"');
     $row2=mysqli_fetch_array($request2);
              $id = $row2["id_ter"];
              $doc = $row2["cod_ter"];
              $dir = $row2["dir_ter"];
              $tel = $row2["telfijo_ter"];
              $cel = $row2["telmovil_ter"];
              $correo = $row2["correo_ter"];
              $contacto = $row2["cont_ter"];
              $nombre = $row2["nom_ter"];
              $ciudad = $row2["ciudad_ter"];
              $municipio = $row2["municipio_ter"];
              $vendedor = $row2["vendedor"];
        
?>
<label class="control-label">Nombre del Cliente</label>
<div class="controls"><input type="text" id="nombre" readonly autocomplete="off" name="codigo" value="<?php  echo $nombre;  ?>"  placeholder="" required><input type="text" readonly style="width: 20px;" id="id_cli" autocomplete="off" name="id_cli" value="<?php  echo $id; ?>"  placeholder="Id" required></div>
<label></label><div class="controls"> </div>
<label class="control-label">Direccion del cliente:</label>
<div class="controls"><input type="text" id="direccion" readonly autocomplete="off" name="codigo"  value="<?php echo $dir;  ?>"  placeholder="" ></div>
<label></label><div class="controls"> </div>
<label class="control-label">Departamento:</label>
<div class="controls"><input type="text" id="depar" readonly autocomplete="off" name="depar"  value="<?php echo $ciudad;  ?>"  placeholder="" ></div>
<label></label><div class="controls"></div>
<label class="control-label">Ciudad / Municipio:</label>
<div class="controls"><input type="text" id="munic" readonly autocomplete="off" name="munic"  value="<?php echo $municipio;  ?>"  placeholder="" ></div>
<label></label><div class="controls"> </div>
<label class="control-label">Nombre del Contacto</label>
<div class="controls"><input type="text" id="contacto" readonly autocomplete="off" name="codigo"  value="<?php echo $contacto; ?>"  placeholder="" ></div>
<label></label><div class="controls"> </div>
<label class="control-label">Telefonos</label>
<div class="controls"><input type="text" id="telefono" readonly autocomplete="off" name="codigo"  value="<?php  echo $tel;  ?>"  placeholder="" ></div>
<label></label><div class="controls"> </div>
<label class="control-label">Tel. del Contacto</label>
<div class="controls"><input type="text" id="celular" readonly autocomplete="off" name="codigo"  value="<?php echo $cel ; ?>"  placeholder="" ></div>
<label></label><div class="controls"> </div>
<label class="control-label">Email</label>
<div class="controls"><input type="text" id="email" readonly autocomplete="off" name="codigo"  value="<?php echo $correo ; ?>"  placeholder="" ></div>
<label class="control-label">Vendedor</label>
<div class="controls"><input type="text" id="vendedo" readonly autocomplete="off" name="vendedor"  value="<?php echo $vendedor ; ?>"  placeholder="" >
<a href="../vistas/asesor.php"  target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;">
        <button type="button"><img src="../imagenes/search.png"></button>
    </a></div>

