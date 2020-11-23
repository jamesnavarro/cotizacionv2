<?php
 require '../modelo/conexion.php';
 ini_set("max_execution_time", 900000);                           
    if(isset($_GET['cot'])){
    $sql21 = "SELECT *, (select concat(nombre,' ',apellido) from usuarios where id_user=a.aprobado_por) as nomb,(select sum(cant_restante) from cotizaciones where id_cot=a.id_cot) as cr,(select sum(cantidad_c) from cotizaciones where id_cot=a.id_cot) as cp FROM cotizacion a where a.id_cot=".$_GET['cot'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
             $numero_cotizacion= $fila21["numero_cotizacion"];
            $id= $fila21["id_cot"];
            $obra= $fila21["obra"];
            $ubicacion= $fila21["ubicacion"];   $pago= $fila21["pago"];
            $linea= $fila21["linea"];
            $orden_p= $fila21["orden"]; $version= $fila21["version"];
            $estado= $fila21["estado"];
            $id_cliente= $fila21["id_tercero"];
            $asesor= $fila21["registrado"];
            $responsable= $fila21["responsable"];
             $tel_responsable= $fila21["tel_responsable"];
              $ciudad= $fila21["municipio"].' - '.$fila21["ciudad"];
              $mu= $fila21["municipio"];
              $ci= $fila21["ciudad"];$grabado= $fila21["grabado"];
              $costo_total= $fila21["costo_total"];
              $costo_instalacion= $fila21["costo_instalacion"];
              $validez= $fila21["validez"]; 
              $sel_iva= $fila21["sel_iva"];
              $tec= $fila21["tecnica"]; 
              $cod_temp=$fila21["cod_temp"];
              $nom_temp=$fila21["nom_temp"];
	      $express = $fila21["express"];
              $lugar = $fila21["lugar"];
              $fecha_express = $fila21["fecha_de_entrega"];
              $descuento= $fila21["descuento"];$nota= $fila21["nota"];
              $fecha= $fila21["fecha_reg_c"];$tipo= $fila21["tipo"];$pre= $fila21["presupuesto"];
      $aprobado_por= $fila21["nomb"];$registro= $fila21["fecha_guardado"];
      $ciudadx= $fila21["ciudad"];
    
    $con= "SELECT * FROM `cont_terceros` where id_ter=".$id_cliente."";
    $res=  mysqli_query($conexion,$con);
    while($f=  mysqli_fetch_array($res)){
   
    $doc=$f['cod_ter'];
    $direccion=$f['dir_ter'];
    $telefono_cli=$f['telfijo_ter'];
    $contacto=$f['nom_ter'];
    $tel_cont=$f['telmovil_ter'];
    $email=$f['correo_ter'];
    $propietario =$f['cont_ter'];
    $pvi=$f['pvi'];
    $ciuda=$f['ciudad_ter'];$municipi=$f['municipio_ter'];$vendedor=$f['vendedor'];
    $pal=$f['pal'];
    $pac=$f['pac'];
    }

        
 }


 if(isset($_GET['ped'])){
 
            
            $sql = "SELECT * FROM cotizacion where id_cot=".$_GET['cot']."";
            $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql));
            $estado= $fila2["estado"];
            $orden= $fila2["orden"];
            $ubicacion= $fila2["ubicacion"];
            $obra= $fila2["obra"];
            $id_cliente= $fila2["id_cliente"];
            $asesor= $fila2["registrado"];
            $responsable= $fila2["responsable"];
            $tel_obra= $fila2["tel_responsable"];
            $ciudad_obra= $fila2["municipio"].' - '.$fila2["ciudad"];
             $fecha= $fila2["fecha_reg_c"];$tipo= $fila21["tipo"];$pre= $fila21["presupuesto"];
             $pago= $fila2["pago"];
            $aprobado_por= $fila2["aprobado_por"];$registro= $fila2["fecha_guardado"];
            if($estado!="Aprobado"){
                include '../modelo/conexion.php';
                $sql210 = "SELECT max(orden) FROM cotizacion";
                $fila210 =mysqli_fetch_array(mysqli_query($conexion,$sql210));
                $op= $fila210["max(orden)"] + 1;
                $sql8 = "UPDATE `cotizacion` SET `estado` = 'Aprobado', orden=".$op.", `aprobado_por` = '".$_SESSION['id_user']."' WHERE `id_cot` = ".$_GET['cot']."";
                mysqli_query($conexion,$sql8);
                
                $f1 = date("Y-m-d");
                $fi = date("Y-m-d");
                $ff = date("Y-m-d");
                
                
//                $sqlo = "INSERT INTO `orden_produccion`(`tipo_cli`, `sede_op`,`proyecto`, `numero`, `fecha_registro`, `fecha_i`, `fecha_f`, `id_cliente`, `estado_o`)";
//                $sqlo.= "VALUES ('".$tipo."', 'Vidrio','".$obra."', '".$op."', '".$f1."', '".$fi."', '".$ff."', '".$id_cliente."', 'En proceso')";
//                mysqli_query($conexion,$sqlo);
                
            }
        
            
            $sqlx = "SELECT * FROM cotizacion  where id_cot=".$_GET['cot'];
            $filax =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $orden_px= $filax["orden"];
            
             $sql21 = "SELECT max(num_pedido) FROM cotizaciones where id_cot=".$_GET['cot'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $p= $fila21["max(num_pedido)"] + 1;
 
 $sql = "UPDATE `cotizaciones` SET `estado_c` = 'Pedido', num_pedido=".$p.", orden=".$orden_px." WHERE `id_cot` = ".$_GET['cot']."";
 mysqli_query($conexion,$sql);
 mysqli_query($conexion,"UPDATE `seguimientos_cot` SET `estado_cot_s` = 'Adjudicado' WHERE `id_relacion` ='".$_GET['cot']."' ");
  

echo '<script lanquage="javascript">alert("Se ha generado el pedido");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; 

}

    $sqlxi = "SELECT * FROM ivas";
            $fi =mysqli_fetch_array(mysqli_query($conexion,$sqlxi));
            $iva= $fi["iva"];
 ?>
<script src="../vistas/cotizacion/funciones.js?<?php echo rand(1,100) ?>" type="text/javascript"></script>
<script language='javascript'>
function cliente()
{
catPaises = window.open('../vistas/form_cliente.php', 'contacto', 'width=500,height=600');
}
function registros()
{
catPaises = window.open('../vistas/registros.php?cot=<?php echo $_GET['cot'];  ?> ', 'contacto', 'width=500,height=600');
}
function cotizador(cot)
{
    window.open('../vistas/cotizacion/index.php?cot='+cot, 'Form', 'width=1200,height=800');
}
function materia_prima(){
    var total = $("#to").val();
    window.open('../vistas/form/reporte_costos.php?cot=<?php echo $_GET['cot'];  ?>&gt='+total, 'contacto', 'width=1100,height=600');
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

function vendedor(val7){
    document.getElementById('vendedo').value = val7;
}
function munici()
{
    var munic = $('#ciudad2').val();
    if(munic.length >0){
        window.open('../vistas/municipio.php?muni='+munic, 'contacto', 'width=500,height=600');
    }else{
        alert('Escoga El Departamento');
    }
}
function municipio(muni){
    document.getElementById('municipio2').value = muni;
}

$(document).ready(function(){
   $("#myModal").modal('show');
   $("#myModal").modal('hide');
   $("#ModalPol").modal('show');
   $("#ModalPol").modal('hide');
   $("#ModalCom").modal('show');
   $("#ModalCom").modal('hide');
   
    $('#detallecot').click(function(){
        $("#detallecoti").css('display', 'block');
        $("#detallecot").css('display', 'none');
        $("#detallecot2").css('display', 'block');
    });
    $('#detallecot2').click(function(){
        $("#detallecoti").css('display', 'none');
        $("#detallecot").css('display', 'block');
        $("#detallecot2").css('display', 'none');
    });
    $("#serv_express").change(function() {
    	serv_express = $("#serv_express").val();
    	if (serv_express == 1) {
    		$("#datepicker1").attr('readonly', false);
    		$("#datepicker1").attr('required', true);
    		$("#datepicker1").focus();
    		$("#datepicker1").val("");
    	} else {
    		$("#datepicker1").attr('readonly', true);
    		$("#datepicker1").attr('required', false);
    		$("#datepicker1").val("");
    	}
    });
})
</script>
<?php if(isset($_GET['update'])){ ?>
<style>
    #detallecoti{
        display: block
    }
    #detallecot,#detallecot2{
        display: none
    }
</style>
<?php }else if(isset($_GET['cot'])){ ?>
<style>
    #detallecoti{
        display: none
    }
    #detallecot,#detallecot2{
        display: block
    }
</style>
<?php }else{ ?>
<style>
    #detallecot,#detallecot2{
        display: none
    }
</style>
<?php }?>
<div class="row-fluid">
    <br>
    <button type="button" id="detallecot">Ver Encabezado Cotizacion</button>
    <button type="button" id="detallecot2" style="display: none">Ocultar Encabezado Cotizacion</button>
                        <!-- START Form Wizard -->

                        <section class="body" id="detallecoti">
                                
                                
                                <div class="control-group">
                                    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['update'])){echo '../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar';}else{echo '../vistas/?id=new_fac&consultar';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                                        <header><h4 class="title"><?php if(isset($_GET['cot'])){if($orden_p!=0){
                                            echo 'PEDIDO No. '.$orden_p;}else{if(isset($_GET['cot'])){
                                                echo 'Cotizacion No.(<font color="white">V.'.$numero_cotizacion.'.'.$version.'</font>)';}else{
                                                    echo 'Generar Cotizacion de Producto';}
                                                    }}else{echo 'Generar Cotizacion de Producto';}
                                                    if(isset($_GET['cot'])){
                                                        
                                                        if($editar_cot == 'Habilitado'){
                                                            if(!isset($_GET['update'])){
                                                                if($fila21["cr"]!=0 || $fila21["cp"]==0){
                                                            ?></h4> <a href="<?php echo '../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&update ';  ?>"><button type="button"><img title="Editar cliente de la cotizacion" src="../imagenes/modificar.png"> Editar</button></a>
                                                        <?php }}}
                                                        if(isset($_GET['update'])){
                                                            echo '<button type="submit" ><img src="../imagenes/up.png"> Guardar Cambios</button>';
                                                        } 
                                                        
                                                        ?>
                                            
                                                            <a href="javascript:registros()"><button type="button"><img src="../imagenes/registros.png" title="registro de modificaciones"> Reg. de Cambios</button></a>
                                                        <?php  
                                                      }else{  echo '<button type="submit" ><img src="../imagenes/guardar.jpg"> Guardar Datos</button>';} ?>
                                        </header>
                                        
                                         <div class="body-inner">  
           <div class="control-group">
               
  
            <div class="span6 bordered" >
                <header><h4 class="title">Datos del Cliente </h4></header>
                                         
<label></label><div class="controls"> </div>
<label class="control-label">Cedula / Nit.</label>
<div class="controls">
    <input type="text" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> autocomplete="off" name="documento" id="documento"  value="<?php  if(isset($_GET['cot'])){echo $doc;}  ?>"  placeholder="" required>
    <a href="../vistas/terceros.php"  target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;">
        <button type="button"><img src="../imagenes/search.png"></button>
    </a>
</div>

<div id="informacion">
<label></label><div class="controls"> </div>
<label class="control-label">Nombre del Cliente</label>
<div class="controls">
    <input type="text" id="nombre" readonly autocomplete="off" name="codigo" value="<?php  if(isset($_GET['cot'])){echo $contacto;}  ?>"  placeholder="" required>
    <input type="text" readonly style="width: 20px;" id="id_cli" autocomplete="off" name="id_cli" value="<?php  if(isset($_GET['cot'])){echo $id_cliente;}  ?>"  placeholder="Id" required>
</div>

<label></label><div class="controls"> </div>
<label class="control-label">Direccion del cliente:</label>
<div class="controls">
    <input type="text" id="direccion" readonly autocomplete="off" name="codigo"  value="<?php  if(isset($_GET['cot'])){echo $direccion;}  ?>"  placeholder="" >
</div>

<label></label><div class="controls"> </div>
<label class="control-label">Departamento:</label>
<div class="controls">
    <input type="text" id="depar" readonly autocomplete="off" name="depar"  value="<?php if(isset($_GET['cot'])){echo $ciuda;}  ?>"  placeholder="" >
</div>

<label></label><div class="controls"></div>
<label class="control-label">Ciudad / Municipio:</label>
<div class="controls">
    <input type="text" id="munic" readonly autocomplete="off" name="munic"  value="<?php if(isset($_GET['cot'])){echo $municipi;}  ?>"  placeholder="" >
</div>

<label></label><div class="controls"></div>
<label class="control-label">Nombre del Contacto</label>
<div class="controls">
    <input type="text" id="contacto" readonly autocomplete="off" name="codigo"  value="<?php  if(isset($_GET['cot'])){echo $propietario;}  ?>"  placeholder="" >
</div>

<label></label><div class="controls"> </div>
<label class="control-label">Telefonos</label>
<div class="controls">
    <input type="text" id="telefono" readonly autocomplete="off" name="codigo"  value="<?php  if(isset($_GET['cot'])){echo $telefono_cli;}  ?>"  placeholder="" >
</div>

<label></label><div class="controls"> </div>
<label class="control-label">Tel. del Contacto</label>
<div class="controls">
    <input type="text" id="celular" readonly autocomplete="off" name="codigo"  value="<?php if (isset($_GET['cot'])) {echo $tel_cont ;} ?>"  placeholder="" >
</div>

<label></label><div class="controls"> </div>
<label class="control-label">Email</label>
<div class="controls">
    <input type="text" id="email" readonly autocomplete="off" name="codigo"  value="<?php if (isset($_GET['cot'])) {echo $email ;} ?>"  placeholder="" >
</div>

<label></label><div class="controls"> </div>
<label class="control-label">vendedor</label>
<div class="controls">
    <input type="text" id="vendedo" required autocomplete="off" name="asesor"  onClick="window.open('../vistas/asesor.php', 'buscar', 'width=800,height=800'); return false;"  value="<?php if (isset($_GET['cot'])) {echo $asesor ;} ?>"  placeholder="" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?>>
</div>
<label></label><div class="controls"> </div>
<label class="control-label">iva</label>
<div class="controls">
    <input type="text" id="iva" required autocomplete="off" name="iva"  readonly  value="<?php if (isset($_GET['cot'])) {echo $sel_iva ;}else{echo $iva; } ?>"  placeholder="" <?php if(!isset($_GET['update']) && isset($sel_iva)){echo 'readonly';} ?>>
</div>
<label></label><div class="controls"> </div>
<label class="control-label">Visita Tecnica</label>
<div class="controls">
    <select name="tecnica" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'disabled';} ?>>
        <?php
			if (isset($_GET['cot'])) {
				if ($tec == '') { ?>
					<option value="">Sin Visita</option>
					<option value="V.T">Con Visita</option>
				<?php
				} else { ?>
					<option value="V.T">Con Visita</option>
                                        <option value="">Sin Visita</option>
				<?php
				}
			} else { ?>
				<option value="">Sin Visita</option>
			        <option value="V.T">Con Visita</option>
			<?php
			}
		?>
    </select>
</div>
<label></label><div class="controls"> </div>
<!-- <label class="control-label">Ubicacion Instalacion</label>-->
<!--<div class="controls">
    <select name="lugar" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'disabled';} ?>>
        <?php
			if (isset($_GET['cot'])) {
				if ($lugar == 'Costa') { ?>
					<option value="Costa">Costa</option>
					<option value="Antioquia">Antioquia</option>
                                        <option value="Otros">Otros</option>
				<?php } else if ($lugar == 'Antioquia'){ ?>
                                        <option value="Antioquia">Antioquia</option>
					<option value="Costa">Costa</option>
                                        <option value="Otros">Otros</option>
				<?php }else{ ?>
                                        <option value="Otros">Otros</option>   
                                     <option value="Antioquia">Antioquia</option>
					<option value="Costa">Costa</option>
                                               
                        <?php  }}else{ ?>
				<option value="Costa">Costa</option>
                                <option value="Antioquia">Antioquia</option>
                                <option value="Otros">Otros</option>
			<?php } ?>
    </select>
</div>-->
</div>


</div>
            
            <div class="span6">
                <header><h4 class="title">Datos de la Obra</h4></header>
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre de la obra</label>
                                            <div class="controls"><input type="text" name="obra" autocomplete="off" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?>   value="<?php  if(isset($_GET['cot'])){echo $obra;}  ?>" required></div>
                 <label></label><div class="controls"> </div>
                                            <label class="control-label">Direccion de la obra</label>
                                            <div class="controls"><input type="text" id="ubicacion" name="ubicacion" autocomplete="off" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?>  value="<?php  if(isset($_GET['cot'])){echo $ubicacion;}  ?>" ></div>
           <label></label><div class="controls"> </div>
                                            <label class="control-label">Telefono</label>
                                            <div class="controls"><input type="text" name="tel_o" autocomplete="off" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> value="<?php  if(isset($_GET['cot'])){echo $tel_responsable;}  ?>"></div>
           <label></label><div class="controls"> </div>
                <label class="control-label">Departamentos</label>
                <div class="controls"><select name="departamento" id="ciudad2" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'disabled';} ?> class="span4" required>    
                    <?php if(isset($_GET['cot'])){echo "<option value='".$ci."'>".$ci."</option>";}else{
                        echo "<option value=''>..Seleccione </option>"; } ?>    
                                                                                                                            
      <?php
      $consulta= "SELECT * FROM `departamentos` group by nombre_dep";   
      $result=  mysqli_query($conexion,$consulta); 
      while($fila=  mysqli_fetch_array($result)){       
          $valor1=$fila['cod_dep'];  
          $valor2=$fila['nombre_dep'];   
          echo"<option value='".$valor2."'>".$valor2."</option>";   
          }                                                       
          ?>       
    </select>&nbsp;Ciudad:
    <input class="span4" type="text" name="municipio" id="municipio2" value="<?php if(isset($_GET['cot'])){echo $mu; } ?>" onclick="munici()">

                </div>
           <label></label><div class="controls"> </div>
                                            <label class="control-label">Encargado de la obra</label>
                                            <div class="controls"><input type="text" name="encargado" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> autocomplete="off" value="<?php  if(isset($_GET['cot'])){echo $responsable;}  ?>"></div>
           <label></label><div class="controls"> </div>
        <label class="control-label">Analista</label>
        <div class="controls"><select name="presupuesto" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'disabled';} ?>  class="span4" required>    
            <?php 
     if(isset($_GET['cot'])){echo "<option value='".$pre."'>".$pre."</option>";}else{ echo "<option value='".$_SESSION['k_username']."'>".$_SESSION['k_username']." </option>";  }
      $consulta= "SELECT * FROM `usuarios` where area='Presupuesto' order by nombre";   
      $result=  mysqli_query($conexion,$consulta);
           echo "<option value='".$_SESSION['k_username']."'>".$_SESSION['k_username']." </option>";
      while($fila=  mysqli_fetch_array($result)){       
          $valor1=$fila['usuario'];  
          $valor2=$fila['nombre'].' '.$fila['apellido'];   
          echo"<option value='".$valor1."'>".strtoupper($valor2)."</option>";   
          } 
     
          ?>       
                            </select></div>
           <label></label><div class="controls"> </div>
                                            <label class="control-label">Validez de Oferta</label>
                                            <div class="controls"><input type="text" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> autocomplete="off" name="validez" value="<?php if(isset($_GET['cot'])){echo $validez;}  ?>"></div>
                                         
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Forma de Pago</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="pago" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?>  value="<?php if (isset($_GET['cot'])) {echo $pago ;} ?>"  placeholder="" ></div><br>
                                            --------------------------------------------------- &nbsp; <b>(TEMPORAL)</b> &nbsp; ----------------------------------
<label></label><div class="controls"> </div>
<label class="control-label">Cedula / Nit.</label>   
<div class="controls">
    <input type="text" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> autocomplete="off" id="cod_temp" name="cod_temp"  value="<?php  if(isset($_GET['cot'])){echo $cod_temp;}  ?>"  placeholder="" >
</div>

<label></label><div class="controls"> </div>
<label class="control-label">Nombre del Cliente</label>
<div class="controls">
    <input type="text" autocomplete="off" id="nombre_temp" name="nombre_temp" value="<?php  if(isset($_GET['cot'])){echo $nom_temp;}  ?>"  <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> placeholder="" required>
</div>

<label></label><div class="controls"> </div>
<label class="control-label">Servicio Express</label>
<div class="controls">
	<select name="serv_express" id="serv_express" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'disabled';} ?> required>
		 
		<?php
			if (isset($_GET['cot'])) {
				if ($express == 1) { ?>
            <option value="0">No</option>
					<option value="1" selected="selected">Si</option>
					
				<?php
				} else { ?>
                                        <option value="0" selected="selected">No</option>
					<option value="1">Si</option>
					
				<?php
				}
			} else { ?>
                                        <option value="0">No</option>
				<option value="1">Si</option>
				
			<?php
			}
		?>
	</select>
</div>
<label></label><div class="controls"> </div>
<label class="control-label">Fecha Servicio Express</label>
<div class="controls">
	<input name="fecha_serv_express" class="span5" type="text" id="datepicker1" placeholder="<?php echo date("Y-m-d"); ?>" value="<?php  if(isset($_GET['cot'])){echo $fecha_express;}  ?>" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> />
</div>
            </div>
                  
           </div>
 <div class="control-group">
      <label></label><div class="controls"> </div>
<label class="control-label">Observaciones</label>
<div class="controls">
    <textarea name="nota" id="nota" style="width: 89%; background-color: #D6EAF8;" <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'readonly';} ?> class="span12"><?php if(isset($_GET['cot'])){echo $nota;}  ?></textarea></div>
    <button id="textos" onclick="textos();" type="button"> <b>?</b> </button> <button id="pol" onclick="politicas(1);" type="button"> <b>Politicas</b> </button>
 </div>
     <?php
     if(isset($_GET['cot'])){
         echo '<div style="float:left; background-color: #DFDFDF">';
         echo 'Este Cliente tiene Descuento en Vidrio del: <font color="red">'.$pvi.'%</font> , en Aluminio el: <font color="red">'.$pal.'%</font>, y en Acero el: <font color="red">'.$pac.'%</font><br>'
                 . 'Registrado Por:<font color="blue">'.$grabado.'</font><br>Estado: <font color="blue">'.$estado.'</font><br>'
                 . 'Fecha de Registro:<font color="blue">'.$registro.'</font><br>'
                 . 'Aprobado por<font color="blue">'.$aprobado_por.'</font><br>'; }
      
 ?> 
       </div>                                   
                                    <!-- Form Action -->
         <div style="float:right; background-color: #DFDFDF">
             <center>
                 <table>
                     <tr>
                         <th>Item</th>
                         <th>Descripcion</th>
                         <th>Valor</th>
                         <th>Opciones</th>
                     
                         <tr>
                         <th> - </th>
                         <th><input type="text" id="mas_des" ></th>
                         <th><input type="text" id="mas_val" style="width:90px"></th>
                         <th><button type="button" onclick="cobro(<?php echo $_GET['cot']; ?>)" id="btn_mas"> + </button></th>
                       <tbody id="mas_cobros">
                             
                       <tbody>
                 </table>
             </center>
         </div>
                                    
    </form>
       <br>
          <?php
            if(isset($_GET['consultar'])){
            $sx = "SELECT max(numero_cotizacion) FROM cotizacion";
            $filax =mysqli_fetch_array(mysqli_query($conexion,$sx));
            $max_nc= $filax["max(numero_cotizacion)"]+1;
            if ($_POST['fecha_serv_express'] != "") {
                $fecha_serv_express = $_POST['fecha_serv_express'];
                } else {
                $fecha_serv_express = '0000-00-00';
                }									//echo "<script>alert('" . $_POST['serv_express'] . " - " . $fecha_serv_express . "');</script>";
                $sql = "INSERT INTO `cotizacion` (`lugar`,`tecnica`,`sel_iva`,`express`, `fecha_de_entrega`, `nota`, `fecha_modificacion`, `fecha_reg_c`, `pago`, `registrado`, `version`, `numero_cotizacion`,`presupuesto`,`tipo`, `instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`municipio`,`id_tercero`, `grabado`, `estado`, `obra`, `ubicacion`, `linea`,`validez`,`cod_temp`,`nom_temp`)";
                $sql.= "VALUES ('" . $_POST['lugar'] . "','" . $_POST['tecnica'] . "','" . $_POST['iva'] . "','" . $_POST['serv_express'] . "', '" . $fecha_serv_express . "', '" . $_POST['nota']."','".$fecha_hoy."', '".$fecha_hoy."', '".$_POST['pago']."', '".$_POST['asesor']."', '1', '".$max_nc."', '".$_POST['presupuesto']."','".$_POST['tipo']."','Si','p1','No','".$_POST['encargado']."','".$_POST['tel_o']."','".$_POST['departamento']."','".$_POST['municipio']."','".$_POST['id_cli']."', '".$_SESSION['k_username']."', 'En proceso', '".$_POST['obra']."', '".$_POST['ubicacion']."', 'Aluminio','".$_POST['validez']."','".$_POST['cod_temp']."','".$_POST['nombre_temp']."')";
                mysqli_query($conexion,$sql);
                $status = "ok";
                $sql21 = "SELECT max(id_cot) FROM cotizacion";
                $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
                $max= $fila21["max(id_cot)"];
                       echo "<script language='javascript' type='text/javascript'>";
                       echo "location.href='../vistas/?id=new_fac&cot=".$max."&cli=".$_POST['id_cli']."'";
                       echo "</script>";
                                    }
                                     if(isset($_GET['editar'])){
                                     if ($_POST['fecha_serv_express'] != "") {
                                                    $fecha_serv_express = $_POST['fecha_serv_express'];
                                            } else {
                                                    $fecha_serv_express = '0000-00-00';
                                            }
                                         $sql = "UPDATE  `cotizacion` SET `lugar` = '" . $_POST['lugar'] . "',`tecnica` = '" . $_POST['tecnica'] . "', `express` = '" . $_POST['serv_express'] . "', `fecha_de_entrega` = '" . $fecha_serv_express . "', `nota` = '".$_POST['nota']."', `registrado` = '".$_POST['asesor']."', `pago` = '".$_POST['pago']."', `presupuesto` = '".$_POST['presupuesto']."', `responsable` = '".$_POST['encargado']."', `tel_responsable` = '".$_POST['tel_o']."', `ciudad` = '".$_POST['departamento']."', `municipio` = '".$_POST['municipio']."', `id_tercero` = '".$_POST['id_cli']."', `obra` = '".$_POST['obra']."', `ubicacion` = '".$_POST['ubicacion']."', `validez` = '".$_POST['validez']."',`cod_temp` ='".$_POST['cod_temp']."',`nom_temp`='".$_POST['nombre_temp']."' WHERE `id_cot` = '".$_GET['cot']."'";
                                         mysqli_query($conexion,$sql);
                            
                                        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                                        $sqlr.= "VALUES ('Se modifico la informacion del cliente', '".$_GET['cot']."', '".$_SESSION['k_username']."', 'Cotizacion')";
                                        mysqli_query($conexion,$sqlr);
                                                echo '<script lanquage="javascript">alert("Se ha editado exitosamente");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_POST['id_cli'].' "</script>'; 
                                     }
                           if(isset($_GET['cot'])){         ?>
                           <?php } ?> 
                            </section>
                        <!--/ END Form Wizard -->

                    </div>
                      <?php if(isset($_GET['consultar'])){ ?>          
                              <?php

 require '../modelo/conexion.php';

 if(isset($_GET['consultar']) || isset($_GET['cod'])){

 $sql='select * from producto where id_p="'.$_POST["ref"].'"';

 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));

        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["tipo"];
        $codigo= $fil["codigo"];
        $variable= $fil["tipo_vidrio"];
        $color_v= $fil["color_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $fil["ancho"];
        $alto= $fil["alto"];
 }
 ?>
<?php } ?>      

 <div class="control-group">
<!--                                        <div class="alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                       
<?php
if(isset($_GET['consultar'])){
$total = $ta + $tv + $tac;
echo "El valor total de los insumos son: $".number_format($total);

} 
?> 
      </div>-->
                                    </div>
     <?php if(isset($_GET['cot'])){ 
          include '../vistas/form/generar_orden_cot_2.php'; 
}

if(isset($orden_p)>0){ ?>
    <div class="row-fluid">
        <!-- START Form Wizard -->
        <!-- START Widget Collapse -->
            <section class="body">      
                        <div class="span12 widget dark stacked">
                        <header>
                         <h4 class="title">Ordenes de Produccion</h4>
                        </header>                                    
                                        <?php
$request_ac=mysqli_query($conexion,'select * from orden_produccion where ref='.$_GET['cot'].' order by id_orden desc ');

if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
       $table = $table.'<thead >';
       $table = $table.'<tr bgcolor="#D1EEF0">';
       $table = $table.'<th width="5%">'.'# O.P'.'</th>';
       $table = $table.'<th width="5%">'.'Pedido'.'</th>';
       $table = $table.'<th width="20%">'.'Cliente'.'</th>';
       $table = $table.'<th width="20%">'.'Nombre de la Obra'.'</th>';
       $table = $table.'<th width="8%">'.'Fecha Inicial'.'</th>';
       $table = $table.'<th width="8%">'.'Fecha Final'.'</th>';
       $table = $table.'<th width="10%">'.'Fecha/Hora entregado'.'</th>';
       $table = $table.'<th width="8%">'.'Estado'.'</th>';
       $table = $table.'<th width="8%">'.'Detalle'.'</th>';
       $table = $table.'</tr>';
       $table = $table.'</thead>';
	//Por cada resultado pintamos una linea
        $cont=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
            $cont= $cont + 1;
            $sql='select * from cont_terceros where id_ter="'.$row['id_cliente'].'"';
            $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
            $nombre= $fil["nom_ter"];    
if($ver_op=='Habilitado'){$ver='<img src="../imagenes/ojo.png">';}else{$ver='';}
            $table = $table.'<tr><td width="5%">'.$row["numero"].'</a></td><td width="5%">'.$row["referencia"].'</td> 
                <td width="20%">'.$nombre.'</td><td width="20%">'.$row['proyecto'].'</td><td width="8%">'.$row['fecha_i'].'</td></td>
               <td width="10%">'.$row['fecha_f'].'</td><td width="8%">'.$row['entregado'].' '.$row['hora'].'</td><td width="8%">'.$row['estado_o'].'</td>
                        <td  width="8%"><a href="../../planeacion/vistas/?id=detalle_op&cot='.$row["ref"].'&cli='.$row["id_cliente"].'&op='.$row["numero"].'" title="Ver detalle de la orden de produccion">'.$ver.'</a></td>
                         </tr>';         
	} 
	$table = $table.'</table>';
	echo $table;
}

?> 
</div>
</section>
</div>
<!-- Remisiones-->
<div class="row-fluid">
	<!-- START Form Wizard -->
	<!-- START Widget Collapse -->
	<section class="body">
		<div class="body-inner">
			<div class="span12 widget dark stacked">
				<header>
					<h4 class="title">Remisiones</h4>
				</header>
				<section id="collapse1" class="body collapse in">
					<div class="body-inner">               
						<!-- Normal Tabs -->    
						<div class="tabbable" style="margin-bottom: 25px;">    
							<div class="tab-content">
								<div class="tab-pane active" id="tab3">
									<!-- START Row -->
									<div class="row-fluid">
										<!-- START Datatable 2 -->
										<div class="span12 widget lime">
											<section class="body">
												<div class="body-inner no-padding">
													<?php
														$request = mysqli_query($conexion,"SELECT * FROM facturas WHERE numero_pedido = '$orden_p' ORDER BY id_factura desc");     
														if ($request) {
															//echo'<hr>';
															$table = '<table class="table table-bordered table-striped table-hover" id="">';
															$table = $table . '<thead>';
															$table = $table . '<tr bgcolor="#D1EEF0">';
															$table = $table . '<th width="3%">' . 'Remision #' . '</th>';
															$table = $table . '<th width="3%">' . 'Ped.' . '</th>';
															$table = $table . '<th width="25%">' . 'Nombre del Cliente' . '</th>';
															$table = $table . '<th width="7%">' . 'Tipo de Cliente' . '</th>';
															$table = $table . '<th width="4%">' . 'Pendiente' . '</th>';
															$table = $table . '<th width="4%">' . 'Vendedor' . '</th>';
															$table = $table . '<th width="10%">' . 'Remisionado por' . '</th>';
															$table = $table . '<th width="10%">' . 'Fecha de registro' . '</th>';
															$table = $table . '<th width="4%">' . 'Ver.' . '</th>';
															$table = $table . '<th width="4%">' . 'Imprimir' . '</th>';
															$table = $table . '</tr>';
															$table = $table . '</thead>';
															//Por cada resultado pintamos una linea
															$total2 = 0;
															$ta2 = 0;
															$cont = 0;
															while ($row = mysqli_fetch_array($request)) {
																$sql = 'SELECT * FROM cont_terceros WHERE id_ter = "' . $row['id_cliente'] . '"';
																$fil = mysqli_fetch_array(mysqli_query($conexion,$sql));
																$vercl = '<a href="../vistas/?id=ver_empresa&cod=' . $row['id_cliente'] . '">';
																$nombre = $fil["nom_ter"];
																if ($ver_rem == 'Habilitado') {
																	$ver = '<img src="../imagenes/ojo.png">';
																} else {
																	$ver = '';
																}
																if ($ver_ped == 'Habilitado') {
																	$verp = '<a href="../vistas/?id=new_fac&cot=' . $row["cotizacion"] . '&cli=' . $row["id_cliente"] . '">';
																} else {
																	$verp = '';
																}
																$table = $table . '<tr><td width="3%">' . $row["numero_factura"] . '</a></td>
																						<td width="3%">' . $verp . '' . $row["numero_pedido"] . '</a></td>
																						<td width="25%">' . $vercl . '' . $nombre . '</a></td>
																						<td width="7%">' . $row['tipo_cliente'] . '</a></td>
																						<td width="4%">' . $row["pago_pendiente"] . '</td>
																						<td width="4%">' . $row['asesor'] . '</td>
																						<td width="10%">' . $row['registrado_por'] . '</td>
																						<td width="10%">' . $row['fecha_registro'] . '</td>'
																					 . '<td width="4%"><a href="../vistas/?id=remision&rem=' . $row["id_factura"] . '&ped=' . $row["numero_pedido"] . '&cot=' . $row["cotizacion"] . '">' . $ver . '</a></td>
																						<td width="4%"><a href="../vistas/remision.php?rem=' . $row["id_factura"] . '&ped=' . $row["numero_pedido"] . '&cot=' . $row["cotizacion"] . '"><img src="../imagenes/imp.png" width=20 heigth=20></a></td>
																					</tr>';
															}
															$table = $table . '</table>';
															echo $table;
														}
													?>
												</div>
											</section>
										</div>
										<!--/ END Datatable 2 -->
									</div>
									<!--/ END Row -->
								</div>
							</div>
						</div>
						<!--/ Normal Tabs -->
					</div>
				</section>
			</div>
		</div>
	</section>
</div>
<?php
	}
?>
<br />
<br />
<br />
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Texto para las observaciones</h4>
      </div>
      <div class="modal-body">
        <table  width="100%">
            <tr>
                <td style="width:300px"><textarea id="text_1"  rows=5></textarea></td>
                <td><button type="button" class="btn btn-info btn-lg" onclick="salvar();">Agregar</button></td>
            </tr>
            <tbody id="ver_texto">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="ModalPol" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Politicas de Presupuesto</h4>
      </div>
      <div class="modal-body">
        <table  width="100%">
            <tr>
                <td style="width:100%"><textarea id="politica" style="width:100%"  rows=5></textarea></td>
               <tr> <td><button type="button" class="btn btn-info btn-lg" onclick="salvar_pol(1);">Modificar</button></td>
            </tr>
            
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="ModalCom" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Comentarios del Items <input type="text" id="it" disabled> <input type="hidden" id="idcoti"></h4>
      </div>
      <div class="modal-body">
        <table  width="100%">
            <tr>
                <td style="width:100%"><textarea id="com" style="width:100%"  rows=5></textarea></td>
            </tr>
            <tr> 
                 <td><button type="button" class="btn btn-info btn-lg" onclick="salvar_com(1);">Agregar</button></td>
            </tr>
             <tbody id="ver_com">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <div id="modalselection" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Seleccione el items <span id="titu"></span></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="mostrar_select">
          <p>Cargando datos...</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>