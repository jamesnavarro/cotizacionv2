<script>
    function eliminar_prod(idcotizacion,cotizacion,cliente){
        var eliminar = confirm('Desea Eliminar Items?');
        if(eliminar){
            $.ajax({    
                type: 'GET',
                data: 'idcotizacion='+idcotizacion+'&cotizacion='+cotizacion+'&cliente='+cliente,
                url: '../modelo/eliminar_items.php',
                success: function(){
                     location.reload();
                }
               
            });
            
//            location.href=('../vistas/?id=new_fac&cot='+cotizacion+'&cli='+cliente);
        }else{
            return false;
        }
    }
    function pasar(cli,op,id_cot){
    	alert(cli + ' - ' + op + ' - ' + id_cot);
    	//window.opener.lista(cli,op,id_cot);
    }
    function lista(cli,op,id_cot){
    	$.ajax({
    		type: 'GET',
    		data: 'cli='+cli+'&op='+op+'&id_cot='+id_cot,
    		url: '../planeacion/vistas/form/listaproductosplaneacion.php',
    		success: function(data){
    			$("#ver").html(data);
    		}
    	});
    }
            function copiar(id_item,id_cot, cli){
                
            var con = confirm("Desea copiar este items?");
            if(con){
                var can = prompt("Cantidad a copiar");
                if(can===''){
                    alert("Debes digitar la cantidad a copiar");
                    return false;
                }
                $("#"+id_item+"").attr("disabled", true);
                
                $.ajax({
                        type: 'GET',
                        data: 'cli='+cli+'&copy='+id_item+'&cot='+id_cot+'&can='+can,
                        url: '../vistas/form/copiar_items.php',
                        success: function(data){
    			alert(data);
                        window.location.href='../vistas/?id=new_fac&cot='+id_cot+'&cli='+cli;
    		        }
                });
                  
            }
    }
    function quitar_items(){
        var cotizacion = $("#cotizacionx").val();
        var con = confirm("Desea eliminar los items seleccionados? " + cotizacion);
        if(con){
               $("input[name=item]:checked").each(function(){
		var id = $(this).attr("id");
             $.ajax({    
                type: 'GET',
                data: 'idcotizacion='+id+'&cotizacion='+cotizacion,
                url: '../modelo/eliminar_items.php',
                success: function(){
                     //alert(id);
                }
               
            });
           });
           alert("se elimino con exito los items seleccionados");
           location.reload();
        }
    }
    $(document).ready(function(){
    	$("#actualizar_list_prod").click(function(){
    		var cuerpo = $("#cuerpo").val();
    		var ladomm = $("#ladomm").val();
    		var boq = $("#BOQUETE").val();
    		var per = $("#PERFORACION").val();
    		var id_cot = $("#id_cot").val();
    		var op = $("#op").val();
    		var cli = $("#cli").val();
    		var id_cotizacion = $("#id_cotizacion").val();
    		if (boq == undefined) {
    			boq = 0;
    		}
    		if (per == undefined) {
    			per = 0;
    		}
    		//alert(id_cot + ' - ' + op + ' - ' + cli + ' - ' + id_cotizacion);
    		$.ajax({
    			type: 'POST',
                data: 'cuerpo='+cuerpo+'&ladomm='+ladomm+'&boq='+boq+'&per='+per+'&id_cot='+id_cot+'&op='+op+'&cli='+cli+'&id_cotizacion='+id_cotizacion,
                url: '../modelo/act_cot_sinvalores.php',
                success: function(data){
                	pasar(cli,op,id_cot);
                }
    		});
    	});
    	$("#cant_servicio").change(function() {
    		var cantidad = $(this).val();
    		var valor_servicio_hidden = $("#valor_servicio_hidden").val();
    		var valor_venta_servicio_hidden = $("#valor_venta_servicio_hidden").val();
    		$("#valor_servicio").val(cantidad * valor_servicio_hidden);
    		$("#valor_venta_servicio").val(cantidad * valor_venta_servicio_hidden);
    	});
    	$("#add_vidrio").click(function() {
    		var id_cot = $("#id_cot_servicios").val();
    		var id_cli = $("#id_cli_servicios").val();
    		var servicio_hidden = $("#servicio_hidden").val();
    		var valor_servicio = $("#valor_servicio").val();
    		var id_vidrio_servicio = $("#vidrio_servicio_hidden").val();
    		var porcentaje_servicio_vidrio = $("#porcentaje_servicio_vidrio").val();
    		var ancho_vidrio_servicio = $("#ancho_vidrio_servicio").val();
    		var alto_vidrio_servicio = $("#alto_vidrio_servicio").val();
    		var id_espesor_servicio = $("#espesor_servicio_hidden").val();
    		var perforacion_vidrio_servicio = $("#perforacion").val();
    		var boquete_vidrio_servicio = $("#boquete").val();
    		var trae_vidrio = $("#trae_vidrio").val();
    		var cant_vidrio = $("#cant_vidrio").val();
    		//alert(id_cot + " - " + id_cli + " - " + servicio_hidden + " - " + id_vidrio_servicio + " - " + porcentaje_servicio_vidrio + " - " + ancho_vidrio_servicio + " - " + alto_vidrio_servicio + " - " + id_espesor_servicio + " - " + perforacion_vidrio_servicio + " - " + boquete_vidrio_servicio + " - " + cant_vidrio);
    		if (servicio_hidden.length == 0) {
    			$("#servicio_hidden").focus();
    			return false;
    		}
    		if (id_vidrio_servicio.length == 0) {
    			$("#vidrio_servicio").focus();
    			return false;
    		}
    		if (porcentaje_servicio_vidrio.length == 0) {
    			$("#porcentaje_servicio_vidrio").focus();
    			return false;
    		}
    		if (ancho_vidrio_servicio.length == 0) {
    			$("#ancho_vidrio_servicio").focus();
    			return false;
    		}
    		if (alto_vidrio_servicio.length == 0) {
    			$("#alto_vidrio_servicio").focus();
    			return false;
    		}
    		if (id_espesor_servicio.length == 0) {
    			$("#espesor_servicio").focus();
    			return false;
    		}
    		if (perforacion_vidrio_servicio.length == 0) {
    			$("#perforacion").focus();
    			return false;
    		}
    		if (boquete_vidrio_servicio.length == 0) {
    			$("#boquete").focus();
    			return false;
    		}
    		if (cant_vidrio.length == 0) {
    			$("#cant_vidrio").focus();
    			return false;
    		}
    		$.ajax({
    			type: "POST",
    			//url: "../modelo/cotizacion_1_servicios.php?tipo=vidrio&porcentaje_servicio_vidrio="+porcentaje_servicio_vidrio,
    			url: "../modelo/cotizacion_1_servicios.php",
    			data: "linea=Vidrio&cot="+id_cot+"&cli="+id_cli+"&servicio_hidden="+servicio_hidden+"&valor_servicio="+valor_servicio+"&ref="+id_vidrio_servicio+"&valor_vidrio_hidden="+valor_vidrio_hidden+"&ancho="+ancho_vidrio_servicio+"&trae_vidrio="+trae_vidrio+
    				  "&alto="+alto_vidrio_servicio+"&precio="+porcentaje_servicio_vidrio+"&cuerpo=0&hoja=1&pelicula=No Aplica&install=Si&vid="+id_espesor_servicio+"&per="+perforacion_vidrio_servicio+"&boq="+boquete_vidrio_servicio+"&cant="+cant_vidrio,
    			success: function(data) {
    				//alert(data);
    				$("#info_vidrios").html(data);
    				$("#vidrio_servicio_hidden").val("");
    				$("#referencia_vidrio_servicio_hidden").val("");
    				$("#valor_vidrio_hidden").val("");
    				$("#vidrio_servicio").val("");
    				$("#porcentaje_servicio_vidrio").val($("#porcentaje_servicio_vidrio option:first").val());
    				$("#ancho_vidrio_servicio").val("");
    				$("#alto_vidrio_servicio").val("");
    				$("#espesor_servicio_hidden").val("");
    				$("#espesor_servicio").val("");
    				$("#perforacion").val("");
    				$("#boquete").val("");
    				$("#trae_vidrio").val($("#trae_vidrio option:first").val());
    				$("#cant_vidrio").val("");
    			}
    		});
    	});
    	$("#add_accesorio").click(function() {
    		var id_cot = $("#id_cot_servicios").val();
    		var id_cli = $("#id_cli_servicios").val();
    		var servicio_hidden = $("#servicio_hidden").val();
    		var id_accesorio_servicio = $("#accesorio_servicio_hidden").val();
    		var valor_accesorio_hidden = $("#valor_accesorio_hidden").val();
    		var porcentaje_servicio_accesorio = $("#porcentaje_servicio_accesorio").val();
    		var ancho_accesorio_servicio = $("#ancho_accesorio_servicio").val();
    		var alto_accesorio_servicio = $("#alto_accesorio_servicio").val();
    		var color_aluminio = $("#color_aluminio").val();
    		var cant_accesorio = $("#cant_accesorio").val();
    		//alert(id_cot + " - " + id_accesorio_servicio);
    		if (servicio_hidden.length == 0) {
    			$("#servicio_hidden").focus();
    			return false;
    		}
    		if (id_accesorio_servicio.length == 0) {
    			$("#accesorio_servicio").focus();
    			return false;
    		}
    		if (porcentaje_servicio_accesorio.length == 0) {
    			$("#porcentaje_servicio_accesorio").focus();
    			return false;
    		}
    		if (ancho_accesorio_servicio.length == 0) {
    			$("#ancho_accesorio_servicio").focus();
    			return false;
    		}
    		if (alto_accesorio_servicio.length == 0) {
    			$("#alto_accesorio_servicio").focus();
    			return false;
    		}
    		if (color_aluminio.length == 0) {
    			$("#color_aluminio").focus();
    			return false;
    		}
    		if (cant_accesorio.length == 0) {
    			$("#cant_accesorio").focus();
    			return false;
    		}
    		$.ajax({
    			type: "POST",
    			url: "../modelo/agregar_servicios.php?tipo=accesorio",
    			data: "id_cot="+id_cot+"&id_cli="+id_cli+"&servicio_hidden="+servicio_hidden+"&id_accesorio_servicio="+id_accesorio_servicio+"&valor_accesorio_hidden="+valor_accesorio_hidden+"&porcentaje_servicio_accesorio="+porcentaje_servicio_accesorio+"&ancho_accesorio_servicio="+ancho_accesorio_servicio+
    				  "&alto_accesorio_servicio="+alto_accesorio_servicio+"&color_aluminio="+color_aluminio+"&cant_accesorio="+cant_accesorio,
    			success: function(data) {
    				$("#info_accesorios").html(data);
    				$("#accesorio_servicio_hidden").val("");
    				$("#valor_accesorio_hidden").val("");
    				$("#accesorio_servicio").val("");
    				$("#porcentaje_servicio_accesorio").val($("#porcentaje_servicio_accesorio option:first").val());
    				$("#ancho_accesorio_servicio").val("");
    				$("#alto_accesorio_servicio").val("");
    				$("#color_aluminio").val($("#color_aluminio option:first").val());
    				$("#cant_accesorio").val("");
    			}
    		});
    	});
    });
</script>
<script>
	function resetFields() {
    	$("#vidrio_servicio_hidden").val("");
    	$("#espesor_servicio_hidden").val("");
    	$("#accesorio_servicio_hidden").val("");
    }
	function infoTipoServicio(id_tipo_servicio, tipo_servicio, valor_tipo_servicio) {
		$("#cant_servicio").val("");
		$("#servicio_hidden").val(id_tipo_servicio);
		$("#servicio").val(tipo_servicio);
		$("#valor_servicio").val(valor_tipo_servicio);
		$("#valor_servicio_hidden").val(valor_tipo_servicio);
		$("#cant_servicio").focus();
	}
	function tipoServicio() {
		window.open('../combos/tipo_servicio.php', 'Servicios', 'width=800, height=800');
	}
	function infoTipoVidrio(referencia_vidrio, id_tipo_vidrio, tipo_vidrio) {
		//alert(referencia_vidrio + " - " + id_tipo_vidrio + " - " + tipo_vidrio);
		$("#vidrio_servicio_hidden").val(id_tipo_vidrio);
		$("#referencia_vidrio_servicio_hidden").val(referencia_vidrio);
		$("#vidrio_servicio").val(tipo_vidrio);
	}
	function tipoVidrio() {
		window.open('../vistas/lista_productos_servicios.php?linea=Vidrio', 'Vidrios', 'width=800, height=800');
	}
	function infoTipoEspesor(tipo_espesor, id_tipo_espesor) {
		//alert(tipo_espesor + " - " + id_tipo_espesor);
		$("#espesor_servicio_hidden").val(id_tipo_espesor);
		$("#espesor_servicio").val(tipo_espesor);
	}
	function tipoEspesor() {
		window.open('../combos/span_vidrio1_servicios.php', 'Espesores', 'width=800, height=800');
	}
	function infoTipoAccesorio(tipo_accesorio, id_tipo_accesorio, referencia_accesorio, medida_accesorio, valor_accesorio) {
		//alert(tipo_accesorio + " - " + id_tipo_accesorio + " - " + referencia_accesorio + " - " + medida_accesorio);
		$("#accesorio_servicio_hidden").val(id_tipo_accesorio);
		$("#accesorio_servicio").val(tipo_accesorio);
		$("#valor_accesorio_hidden").val(valor_accesorio);
	}
	function tipoAccesorio() {
		window.open('../vistas/materiales_servicios.php', 'Materiales', 'width=800, height=800');
	}
</script>
<?php
	$query_select_cot = mysql_query("SELECT * FROM cotizacion WHERE id_cot = '" . $_GET['cot'] . "'");
	$row_cot = mysql_fetch_array($query_select_cot);
	$express = $row_cot['express'];
	if (isset($_GET['up_1'])) {
		$sql21 = "SELECT * FROM referencia_acce WHERE id_ref_acce = " . $_GET['up_1'];
		$fila21 = mysql_fetch_array(mysql_query($sql21));
		$ref = $fila21["num_ref"];
		$des = $fila21["descripcion_a"];
		$cod = $fila21["codigo"];
		$cos = $fila21["costo_a"];
	}
?>  
 <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
                                <h4 class="title">Productos aprobados</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
 
                                <ul class="nav nav-tabs">
                                      <li class="active"><a href="#tab5" data-toggle="tab"><span class="icon icone-eye-open"></span> Lista</a></li>
                                 
 <?php    if($estado=='En proceso'){
     
     ?>  
                                  
<?php  if($crear_conf=='Habilitado'){echo '<li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar Producto</a></li>'
    . '<li class=""><a href="#tab7" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar servicios</a></li>'
        . '<li class=""><a href="#tab8" data-toggle="tab"><span class="icon icone-eye-open"></span> Venta Directa</a></li>'
        . '<li class=""><a href="#tab9" data-toggle="tab"><span class="icon icone-eye-open"></span> Venta De Kit de Accesorios</a></li>'
        . '';
              }  ?>
<?php   }else{
             
            
}
echo ' <li class=""><a href="#tab10" data-toggle="tab"><span class="icon icone-eye-open"></span> Reportes</a></li>';
//include '../vistas/imprimir_reportes.php';
	//Codigo Agregado (Jaime)
	$query_total_item = mysql_query("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]."  order by c.fila asc");
	$row_total_item = mysql_num_rows($query_total_item);
 ?> 
          <form name="buscarA" action="../vistas/print.php" method="get"  target="_blank"  enctype="multipart/form-data">
                <div align="right">
                    <input style="width:30px;" type="hidden" name="cot" id="cotizacionx" value="<?php echo $_GET['cot']; ?>">
                    <input style="width:30px;" type="hidden" name="c" value="<?php echo $con; ?>">
                    <input style="width:30px;" type="hidden" name="total_item" value="<?php echo $row_total_item; ?>" /><!--Codigo Agregado (Jaime)-->
                    <input style="width:30px;" type="number" name="col" value="<?php if(isset($_POST['col'])){echo $_POST['col'];}else{echo '7';} ?>">
                    <select name="ciudad"><?php if(isset($_POST['ciudad'])){echo '<option value="'.$_POST['ciudad'].'">'.$_POST['ciudad'].'</option>';} ?><option value="Barranquilla">Barranquilla</option><option value="Bogota">Bogota</option></select>
                    <button type="submit"><img src="../imagenes/print.png"> Imprimir PDF</button>   
                </div>
          </form>
			<?php
				if ($express == 1) { ?>
					<center><h3><font color="red">COTIZACIÓN EXPRESS!!</font></h3></center>
				<?php
				}
			?>
                                    <div align="right">
                                       <a href="<?php echo '../vistas/reportes_orden_cot_2.php?cot='.$_GET['cot'].''; ?>">
                                           <button ><img src="../imagenes/file_excel.png" width="15px">Exportar</button>
                                       </a>
                                    
                                            <?php  

                                            
	if ($fila21["cr"] != 0) {
		if ($estado == 'Aprobado') {
			echo '<button><img src="../images/ok.png"> Aprobado</button>';
	?>
	<?php
    	}
	} else {
		if ($fila21["cp"] == 0) {
			echo '<b style="color:red">Cotizacion sin Registros.</b>';
		} else {
			echo '<b style="color:red">Este pedido se encuentra en produccion.</b>';
		}
	}
	?>

                                       <?php
                                       if($estado=='Pedido por aprobar'){
                                                   if($_SESSION["area"]=='Planeacion' && $_GET['cli']!='658' || $_SESSION["admin"]=='Si' && $_GET['cli']!='658'){
//                                echo '<a href="../vistas/?id=new_fac&ped=ok&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'" title="cotizacion Revisada"><button type="button"> <img WIDTH=18 HEIGHT=18 src="../imagenes/images.jpg"> Generar Pedido</button></a>';
                                }
                                       }
                                       if($estado=='En proceso'){
                                    
                                           ?>  <a title="Editor de porcentajes por item y general" href="../vistas/porcentajes.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1200,height=700'); return false;"><button type="button"><img src="../imagenes/edit_precio.png"> Editar Porcentajes</button></a> <?php  }  ?> 
                                    
                               <?php  if($estado=='En proceso'){  ?>  <?php echo '<a href="../vistas/?id=new_fac&congelar='.$row["id_cotizacion"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'" title="Congelar Cotizacion"><button type="button"><img src="../imagenes/guardar.jpg"> Congelar Cotizacion</button></a>';  ?>
                              <?php } ?>
                                   
                                </ul>
   
                                <div class="tab-content">
                                    <div class="tab-pane <?php if(!isset($_GET['up_serv']) && !isset($_GET['up_mat']) && !isset($_GET['up_k'])){echo 'active';}  ?>" id="tab5">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                   <div class="row-fluid">
                        <!-- START Form Wizard -->
                    
                            <section class="body">
                                 <?php  if($estado!='Aprobado'){  ?>  
                                <header style="background: yellow;"><center><h4 class="title">Productos cotizados (<?php echo 'Cotizacion No.'.$numero_cotizacion; ?>) <?php echo '    (<font color="red">V.'.$numero_cotizacion.'.'.$version.'</font>)'  ?></h4></center></header>
                                 <?php  }else{  ?>  
                                 <header style="background: yellow;"><center><h4 class="title">Lista de Pedidos Aprobados <?php  echo '(Pedido No.'. $orden_p.')'  ?></h4></center></header>
                                 <?php  }  ?>  
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                           <?php
                                           if(isset($_GET['up'])){
            $sql21 = ("SELECT * FROM producto a, cotizaciones c where   c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." and c.id_cotizacion=".$_GET['up']."");
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $linea_cot= $fila21["linea_cot"];
            $id_referencia= $fila21["id_p"];
            $producto= $fila21["producto"];
            $id_vidrio= $fila21["id_vidrio"];
            $id_vidrio2= $fila21["id_vidrio2"];
            $id_vidrio3= $fila21["id_vidrio3"];
            $id_vidrio4= $fila21["id_vidrio4"];
            $id_vidrio5= $fila21["id_vidrio5"];
            $id_vidrio6= $fila21["id_vidrio6"];
            $pelicula= $fila21["pelicula"];
            $id2_vidrio= $fila21["id2_vidrio"];
            $id2_vidrio2= $fila21["id2_vidrio2"];
            $id2_vidrio3= $fila21["id2_vidrio3"];
            $id2_vidrio4= $fila21["id2_vidrio4"];
            $id2_vidrio5= $fila21["id2_vidrio5"];
            
            $id3_vidrio= $fila21["id3_vidrio"];
            $id3_vidrio2= $fila21["id3_vidrio2"];
            $id3_vidrio3= $fila21["id3_vidrio3"];
            $id3_vidrio4= $fila21["id3_vidrio4"];
            $id3_vidrio5= $fila21["id3_vidrio5"];
            
            $id4_vidrio= $fila21["id4_vidrio"];
            $id4_vidrio2= $fila21["id4_vidrio2"];
            $id4_vidrio3= $fila21["id4_vidrio3"];
            $id4_vidrio4= $fila21["id4_vidrio4"];
            $id4_vidrio5= $fila21["id4_vidrio5"];
            $lado= $fila21["imagen"];$ladomm= $fila21["lado"];
            $laminas= $fila21["laminas"];
            $laminas2= $fila21["laminas2"];
            $laminas3= $fila21["laminas3"];
            $laminas4= $fila21["laminas4"];
            $traz_vid= $fila21["traz_vid"];
            $traz_vid2= $fila21["traz_vid2"];
            $traz_vid3= $fila21["traz_vid3"];
            $traz_vid4= $fila21["traz_vid4"];
            $cierre_cot = $fila21["cierre"];
            $ancho_cot= $fila21["ancho_c"];
            $aa= $fila21["ancho_abajo"];
            $alto_cot= $fila21["alto_c"];
             $ancho_temp= $fila21["ancho_temp"];
             $alto_temp= $fila21["alto_temp"];
            $cantidad_cot= $fila21["cantidad_c"];
            $por= $fila21["porcentaje"];
            $por_mp= $fila21["porcentaje_mp"];
            $ruta= $fila21["ruta"];
            $ruta2= $fila21["ruta2"];
            $color_ta= $fila21["color_ta"];
            $cuerpo= $fila21["cuerpo"];$tip= $fila21["tip"];
            $hoja= $fila21["hojas"];
            $desc= $fila21["desc"];
             $per= $fila21["per"];
              $boq= $fila21["boq"];
            $install= $fila21["install"];
            $obs= $fila21["observaciones"];$obs2= $fila21["observaciones2"];$modulo= $fila21["modulo"];
                     $vert= $fila21["verticales"];
                        $ubica= $fila21["ubicacion_c"];
                        $adicional= $fila21["imagen_mas"];
              $hori= $fila21["horizontales"]; $d1= $fila21["d1"];$duracion= $fila21["duracion"];
              if($pvi==0 && $pal==0 && $pac==0){
              	if ($express == 1) {
              		$ppp = '<select name="desc" readonly  style="width: 60px;" id="descuento">
                                                      <option value="'.$desc.'">'.$desc.'</option>
                                                       <option value="0">0</option>
                                                   </select>';
              	} else {
              		$ppp =' <select name="desc" readonly  style="width: 60px;" id="descuento">
                                                      <option value="'.$desc.'">'.$desc.'</option>
                                                       <option value="0">0</option>
                                                       <option value="1">1</option>
                                                       <option value="2">2</option>
                                                       <option value="3">3</option>
                                                       <option value="4">4</option>
                                                       <option value="5">5</option>
                                                       <option value="6">6</option>
                                                       <option value="7">7</option>
                                                       <option value="8">8</option>
                                                       <option value="9">9</option>
                                                       <option value="10">10</option>

                                                       
                                                   </select>';
              	}
              }else{
                          if($linea_cot=='Vidrio'){
                              $ppp = '<input type="text" name="desc" value="'.$pvi.'" style="width: 70px;" >';
                          }else{
                              if($linea_cot=='Aluminio'){
                             $ppp = '<input type="text" name="desc" value="'.$pal.'" style="width: 70px;" >';
                              }else{
                             $ppp = '<input type="text" name="desc" value="'.$pac.'" style="width: 70px;" >';
                              }
              }   }                 
                                               ?>
                                             <?php 
                      $cons = mysql_fetch_array(mysql_query("select * from dolares order by id_dolar desc limit 1"));
                      $pd = $cons['precio_dolar'];
                     ?>
                                               <div class="row-fluid">
					<?php
						if (isset($_GET['check'])) { ?>
							<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo "../modelo/act_cot_sinvalores.php?id_cot=".$_GET['cot']."&id_cotizacion=".$_GET['up']."&op=".$_GET['op']."&cli=".$_GET['cli']; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
						<?php
						} else { ?>
							<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/cotizacion_1.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up'].'&tipo_cli='.$tipo.' '; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
						<?php
						}
					?>
                            <section class="body">
                                <div class="body-inner">
                                   <hr>
                                    <button type="submit" ><img src="../imagenes/guardar.jpg">Guardar Cambios</button>
                                     <a href="../vistas/?id=new_fac&cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']  ?>"><button type="button" ><img width="18px" height="18px" src="../imagenes/no.png">Cancelar</button></a>
                                     Dollar :<input type="text" value="<?php echo $pd ?>" name="dolar" id="dolar" style="width:40px;" readonly="false">$
                                     <input type="hidden" value="<?php echo $cons['id_dolar'] ?>" name="id_dolar" style="width:40px;" >
                                     <hr>
                                     <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td>linea de produccion</td>
                                            <td><select name="linea" id="linea">
                                                    <?php if(isset($_GET['up'])){
                                                        echo "<option value='".$linea_cot."'>".$linea_cot."</option>";
                                                    
                                                    }else{
                                                        echo "<option value=''>.:Seleccione la linea:.</option>"; 
                                                        
                                                    } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta2= "SELECT * FROM `lineas`";                     
                                                            $result2=  mysql_query($consulta2);
                                                            while($fila=  mysql_fetch_array($result2)){
                                                            $valor1=$fila['linea'];
                                                           
                                                            $valor3=$fila['linea'];
                                                         
                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Instalacion:</td>
                                            <td> <select name="install"  style="width: 80px;">
                                                        <?php echo '<option value="'.$install.'">'.$install.'</option>';    ?>
                                                            <option value="Si">Si</option>    
                                                        <option value="No">No</option>
                                                         
                                                        </select></td>
                                        
                                                        <td rowspan="7" id="imagen"  style="width:30%"><div align="center"><?php if(isset($_GET['up'])){
                                                if($lado=='Derecho'){
                                                    echo '<img src="../producto/'.$ruta.'" width=120px heigth=120px>';
                                                }else{
                                                    echo '<img src="../producto/'.$ruta2.'" width=120px heigth=120px>';
                                                }
                                                
                                                
                                            } ?></div></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Referencia del producto</td>
                                            <td>
                                            <div id="busqueda"><a href="../vistas/lista_productos.php?linea=<?php echo $linea_cot; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"> <img src="../imagenes/pop.png"> Busqueda Avanzada</a></div>
                                                <input name="a" type="hidden" readonly id="refer"  value="<?php echo $fila21["referencia_p"]; ?>"><input name="b" readonly type="text" id="descr"  value="<?php echo $producto; ?>">
                                                <input type="hidden" readonly name="ref" id="codig" value="<?php echo $id_referencia; ?>">
                                                </td>
                                            <td>Precio de Venta:</td>
                                            <td> <select name="precio"  style="width: 80px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?> >
                                                        <?php echo '<option value="'.$por.'">'.$por.'</option>'; ?>
                                                        <?php
	                                                    	if ($express == 1) { ?>
	                                                    		<option value="p1">p1</option>
	                                                    	<?php
	                                                    	} else { ?>
	                                                    		<option value="p1">p1</option>
	                                                      		<option value="p2">p2</option>
	                                                         	<option value="p3">p3</option>
	                                                    	<?php
	                                                    	}
	                                                    ?>
                                                    </select></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Sentido</td>
                                            <td><select name="lado"  id="select2_1" style="width: 100%;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$lado.'">'.$lado.'</option>';} ?>                                                      
                                                            
                                                       <option value="N/A">N/A</option>
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>
                                                </select></td>
                                            <td>Precio Materia Prima</td>
                                            <td> <?php if($_SESSION['admin']=='Si'){   ?>
                                                <select name="precio_mp"  style="width: 80px;"<?php if ($express == 1){ echo "readonly='readonly'";} ?> >
                                                	<?php echo '<option value="'.$por_mp.'">'.$por_mp.'</option>'; ?>
                                                	<?php
                                                    	if ($express == 1) { ?>
                                                    		<option value="p1">p1</option>
                                                    	<?php
                                                    	} else { ?>
                                                    		<option value="p1">p1</option>
                                                      		<option value="p2">p2</option>
                                                         	<option value="p3">p3</option>
                                                    	<?php
                                                    	}
                                                    ?>
                                                        </select>
                                                <?php }else{  ?>
                                                <input type="text" readonly name="precio_mp" value="<?php echo $por_mp ?>"  style="width: 80px;">
                                                 <?php } ?></td>
                                        </tr>
                                         
                                        <tr>
                                            <td>Trazabilidad del vidrio
                                            
                                            </td>
                                            <td id="vidrios"> 
                                                   <?php if(isset($_GET['up'])){
                                                       if($traz_vid==0){
                                                      
                                                            echo "<input type='hidden'  name='traz_vid' id='valo1' value='".$traz_vid."'  required>"
                                                                    . "<input placeholder='Vidrio #1' autocomplete='off' type='text' name='xxx' id='valo2' value='Ya tiene'>"
                                                                    . "<input type='hidden' name='modulo' value='".$modulo."'  required> ";

                                                       }else{
                                                        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid." ";
                                                        $res=  mysql_query($con);
                                                         while($f=  mysql_fetch_array($res)){
                                                        $idco=$f['id_p'];
                                                        $nombre1=$f['producto'];

                                                        }
                                                        $con2= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid2." ";
                                                        $res2=  mysql_query($con2);
                                                         while($f2=  mysql_fetch_array($res2)){
                                                        $idco2=$f2['id_p'];
                                                        $nombre2=$f2['producto'];

                                                        }
                                                       $con23= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid3." ";
                                                        $res23=  mysql_query($con23);
                                                         while($f2=  mysql_fetch_array($res23)){
                                                        $idco3=$f2['id_p'];
                                                        $nombre3=$f2['producto'];

                                                        }
                                                        $con24= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid4." ";
                                                        $res24=  mysql_query($con24);
                                                         while($f2=  mysql_fetch_array($res24)){
                                                        $idco4=$f2['id_p'];
                                                        $nombre4=$f2['producto'];

                                                        }
                                                if($hoja >=1){
                                                echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required>"
                                                . "<input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'><br> ";

                                                }if($hoja >=2){
                                                echo "<input type='hidden' name='traz_vid2' id='valo3' value='".$idco2."'  required>"
                                                . "<input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4'  required onclick='vidrio2()'><br> ";

                                                }if($hoja >=3){
                                                echo "<input type='hidden' name='traz_vid3' id='valo5' value='".$idco3."'  required>"
                                                . "<input type='text' placeholder='Vidrio #2' value='".$nombre3."' name='xxx' id='valo6'  required onclick='vidrio3()'><br> ";

                                                }if($hoja >=4){
                                                echo "<input type='hidden' name='traz_vid4' id='valo7' value='".$idco4."'  required>"
                                                . "<input type='text' placeholder='Vidrio #2' value='".$nombre4."' name='xxx' id='valo8'  required onclick='vidrio4()'><br> ";

                                                }
                                                       }

                                                      
      
                                                   } ?>
                                                 </td>
                                            <td>Con descuento de:</td>
                                            <td><?php  echo $ppp;  ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td># Laminas</td>
                                            <td> 
                                                <div  id="lam">
                                                    <?php if(isset($_GET['up'])){ 
                                                        if($laminas!=0){  ?>
                                                     <select name="laminas"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas.'">'.$laminas.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php }else{echo '<input type="text" name="laminas" value="0">';}?>
                                                </div>
                                                <div  id="lam2">
                                                    <?php if($laminas2!=0){  ?>
                                                     <select name="laminas2"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas2.'">'.$laminas2.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam3">
                                                    <?php if($laminas3!=0){  ?>
                                                     <select name="laminas3"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas3.'">'.$laminas3.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                     
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam4">
                                                    <?php if($laminas4!=0){  ?>
                                                     <select name="laminas4"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas4.'">'.$laminas4.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        
                                                </select>
                                                    <?php }} ?>
                                                </div>
                                           </td>
                                            <td>Tipo: </td>
                                            <td><input type="text" name="tip" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $tip;} ?>" placeholder="ej: PV-1"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color y Espesor de vidrio</td>
                                            <td>
                                                <div  id="vid">
                                                    <?php
                                                    if($laminas==0) {  
                                                    
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2' value='0' required><input type='text' name='xxx' id='valor1' value='No tiene vidrio'  required>";
                                                        
                                                    }
                                                     }
                                                    if($laminas>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].' - ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2' value='".$id_vidrio."' required><input type='text' name='xxx' id='valor1' value='".$color_v."'  required onclick='atencion()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].' - ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid2' id='valor4' value='".$id_vidrio2."' required><input type='text' name='xxx' id='valor3' value='".$color_v2."'  required onclick='atencion2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].' - ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid3' id='valor6' value='".$id_vidrio3."' required><input type='text' name='xxx' id='valor5' value='".$color_v3."'  required onclick='atencion3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].' - ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid4' id='valor8' value='".$id_vidrio4."' required><input type='text' name='xxx' id='valor7' value='".$color_v4."'  required onclick='atencion4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].' - ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid5' id='valor10' value='".$id_vidrio5."' required><input type='text' name='xxx' id='valor9' value='".$color_v5."'  required onclick='atencion5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].' - ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor12' value='".$id_vidrio6."' required><input type='text' name='xxx' id='valor11' value='".$color_v6."'  required onclick='atencion6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                            <div  id="vid2">
                                                <?php if($laminas2>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd' id='valor22' value='".$id2_vidrio."' required><input type='text' name='xxx' id='valor21' value='".$color_v."'  required onclick='atenciond()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas2>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd2' id='valor24' value='".$id2_vidrio2."' required><input type='text' name='xxx' id='valor23' value='".$color_v2."'  required onclick='atenciond2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd3' id='valor26' value='".$id_vidrio3."' required><input type='text' name='xxx' id='valor25' value='".$color_v3."'  required onclick='atenciond3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd4' id='valor28' value='".$id2_vidrio4."' required><input type='text' name='xxx' id='valor27' value='".$color_v4."'  required onclick='atenciond4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas2>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd5' id='valor210' value='".$id2_vidrio5."' required><input type='text' name='xxx' id='valor29' value='".$color_v5."'  required onclick='atenciond5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas2>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd6' id='valor212' value='".$id2_vidrio6."' required><input type='text' name='xxx' id='valor211' value='".$color_v6."'  required onclick='atenciond6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?></div>
                                                <div  id="vid3">
                                                     <?php if($laminas3>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt' id='valor32' value='".$id3_vidrio."' required><input type='text' name='xxx' id='valor31' value='".$color_v."'  required onclick='atenciont()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas3>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt2' id='valor34' value='".$id3_vidrio2."' required><input type='text' name='xxx' id='valor33' value='".$color_v2."'  required onclick='atenciont2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt3' id='valor36' value='".$id3_vidrio3."' required><input type='text' name='xxx' id='valor35' value='".$color_v3."'  required onclick='atenciont3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt4' id='valor38' value='".$id3_vidrio4."' required><input type='text' name='xxx' id='valor37' value='".$color_v4."'  required onclick='atenciont4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas3>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt5' id='valor310' value='".$id3_vidrio5."' required><input type='text' name='xxx' id='valor39' value='".$color_v5."'  required onclick='atenciont5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas3>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt6' id='valor312' value='".$id3_vidrio6."' required><input type='text' name='xxx' id='valor311' value='".$color_v6."'  required onclick='atenciont6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                <div  id="vid4">
                                                     <?php if($laminas4>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc' id='valor42' value='".$id4_vidrio."' required><input type='text' name='xxx' id='valor41' value='".$color_v."'  required onclick='atencionc()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas4>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc2' id='valor44' value='".$id4_vidrio2."' required><input type='text' name='xxx' id='valor43' value='".$color_v2."'  required onclick='atencionc2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc3' id='valor46' value='".$id4_vidrio3."' required><input type='text' name='xxx' id='valor45' value='".$color_v3."'  required onclick='atencionc3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc4' id='valor48' value='".$id4_vidrio4."' required><input type='text' name='xxx' id='valor47' value='".$color_v4."'  required onclick='atencionc4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas4>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc5' id='valor410' value='".$id4_vidrio5."' required><input type='text' name='xxx' id='valor49' value='".$color_v5."'  required onclick='atencionc5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas4>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor412' value='".$id4_vidrio6."' required><input type='text' name='xxx' id='valor411' value='".$color_v6."'  required onclick='atencion6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                </td>
                                            <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['up'])){echo $ubica;} ?></textarea></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color del Aluminio</td>
                                            <td> <select name="alum"  required>
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$color_ta."'>".$color_ta."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Duracion del proyecto</td>
                                            <td><input  type="number"  name="duracion" style="width: 80px;" value="<?php if(isset($_GET['up'])){echo $duracion;} ?>" placeholder=""> dias</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tiene cierre?</td>
                                            <td><select name="cierre"  required>
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['color_a'];
                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select></td>
                                            <td>Observaciones</td>
                                            <td><textarea name="descripcion" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['up'])){echo $obs;} ?></textarea></td>
                                            <td rowspan="4" id="areas"><?php
?></td>
                                        </tr>
                                       
                                            <div id="hoja"> <input type="hidden" name="hoja" value="<?php  echo $hoja; ?>"></div>
                                            
                                        <tr>
                                            <td>Medidas</td>
                                            <td><input type="text" autocomplete="off" name="ancho" value="<?php if(isset($_GET['up'])){echo $ancho_cot;} ?>" style="width: 70px;" placeholder="Ancho en mm" required <?php if(isset($_GET['check'])){ ?> readonly="readonly" <?php } ?>>
                                            X <input type="text" name="alto" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required<?php if(isset($_GET['check'])){ ?> readonly="readonly" <?php } ?>></td>
                                            <td>Alto Cuerpo Fijo</td>
                                            <td><input type="text" autocomplete="off" name="cuerpo" id="cuerpo" value="<?php if(isset($_GET['up'])){echo $cuerpo;} ?>" style="width: 70px;"  placeholder="Alto en mm" required</td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td><input type="text" name="cant" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" required></td>
                                           <td>Ancho Cuerpo Fijo</td>
                                            <td><input type="text" autocomplete="off" name="ladomm" id="ladomm" value="<?php if(isset($_GET['up'])){echo $ladomm;} ?>" style="width: 70px;"  placeholder="Lado" required></td>
                                           
                                        </tr>
                                         <tr>
                                            <td>Medidas Totales con Compuestos</td>
                                             <td><input type="text" name="ancho_temp" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $ancho_temp;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required>
                                              X <input type="text" name="alto_temp" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $alto_temp;} ?>" style="width: 70px;"  placeholder="Alto en mm" required></td>
                                              
                                             <td>Lleva Pelicula ?</td>
                                            <td>
                                                <select name="pelicula">
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$pelicula."'>".$pelicula."</option>";} ?>
                                                    <option value="No Aplica">No Aplica</option>
                                                    <option value="Una Cara">Una Cara</option>
                                                    <option value="Doble Cara">Doble Cara</option>
                                                </select>
                                            </td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
                                            <td> <input type="text" autocomplete="off" name="ancho_abajo" value="<?php if(isset($_GET['up'])){echo $aa;} ?>"  style="width: 70px;"  placeholder="Alto en mm" required></td>
                                             <td>Observaciones adicionales:</td>
                                            <td><textarea name="obs2" placeholder="Observacion adicional"><?php if(isset($_GET['up'])){echo $obs2;} ?></textarea></td>
                                            <td rowspan="3"><div id="areas_vid">trazabilidad
                                                <?php
?></div>
                                                <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <label class="control-label">Imagen Opcional</label>
                                               
                                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                                    <img src="<?php if(isset($_GET['up'])){if($adicional !=''){echo '../adicionales/'.$adicional;}else{echo '../imagenes/nofoto.png';}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Seleccione La Imagen</span>
                                                <span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['up'])){echo '<input name="imagen" type="file" value="'.$adicional.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                               <a title="Eliminar imagen" href="../vistas/<?php echo '?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&up='.$_GET['up'].'&quitar'; ?>"><img src="../imagenes/cancelar.png"> </a>
                                               <i>Nota: Antes de hacer cualquier modificacion primero quite la imagen, si la quiere quitar.</i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Digite la cantidad de verticales y horizontales</td>
                                            <td>Verticales<input type="text" name="vert" value="<?php echo $vert; ?>"  style="width: 70px;">
                                                
                                            </td>
                                            <td>Horizontales</td>
                                            <td><input type="text" name="hori" value="<?php echo $hori; ?>"  style="width: 70px;"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td> <input type="checkbox" name="d1"  <?php if($d1!='0'){echo 'checked';}  ?> value="1">Automatico</td>
                                            <td></td><td></td>
                                        </tr>
                                    </table>
                                     
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div> 
                                        <?php       
                                           }else{
                                               ?>
                                
                                <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                <input type="text" name="buscar" class="span8" placeholder="Digite el tipo, referencia ó descripcion del producto"><button type="submit"><img src="../imagenes/buscar.png" height="40px"> Buscar</button>
                                </form>
        <form name="buscarA" action="../vistas/?id=new_fac&cot=<?php echo $_GET['cot'] ?>&cli=<?php echo $_GET['cli'] ?>&por" method="post" enctype="multipart/form-data">
                                <?php
    
if(isset($_GET['cot'])){ 
  if(isset($_POST['buscar'])){   
      $request=mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " AND CONCAT(producto, referencia_p,tip) LIKE '%" . $_POST['buscar'] . "%' ORDER BY c.fila ASC ");
  }else{
      $request=mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " ORDER BY c.fila ASC ");
  }
  $table = "";
if($request){

       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="2%">'.'Tipo'.'</th>'; 
              $table = $table.'<th width="2%">'.'#'.'</th>'; 
              $table = $table.'<th width="7%">'.'Ref'.'</th>'; 
              $table = $table.'<th width="60%">'.'Producto'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Ancho <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. <br>Total.'.'</th>';
         
              $table = $table.'<th class="hidden-phone">'.'PV'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'PM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'%.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Mas'.'</th>';
              $table = $table.'<th style="text-align:center">Aprobaciones</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;
	while($row=mysql_fetch_array($request))
	{    
                $cons_vi = "SELECT color_v, espesor_v FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vir = "SELECT color_v, espesor_v FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vir));
                $cons_vir2 = "SELECT color_v , espesor_v FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
                $fv3 =mysql_fetch_array(mysql_query($cons_vir2));
                $cons_vir3 = "SELECT color_v, espesor_v FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
                $fv4 =mysql_fetch_array(mysql_query($cons_vir3));
                $cons_vi2 = "SELECT color_v, espesor_v FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv21 =mysql_fetch_array(mysql_query($cons_vi2));
                $cons_vi3 = "SELECT color_v, espesor_v FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio2']." ";
                $fv22 =mysql_fetch_array(mysql_query($cons_vi3));
                $cons_vi4 = "SELECT color_v, espesor_v FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv23 =mysql_fetch_array(mysql_query($cons_vi4));
                $cons_vi4 = "SELECT color_v, espesor_v FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv24 =mysql_fetch_array(mysql_query($cons_vi4));
                
				if ($row["linea_cot"] == 'Aluminio') {
					$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Aluminio'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$mult = $fi3["p"] / 100;
				} else {
					if ($row["linea_cot"] == 'Vidrio') {
						$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Vidrio'";
						$fi3 = mysql_fetch_array(mysql_query($s3));
						$mult = $fi3["p"] / 100;
					} else {
						if ($row["linea_cot"] == 'Fachada') {
							$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Fachada'";
							$fi3 = mysql_fetch_array(mysql_query($s3));
							$mult = $fi3["p"] / 100;
						} else {
							if ($row["linea_cot"] == 'Divisiones') {
								$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Divisiones'";
								$fi3 = mysql_fetch_array(mysql_query($s3));
								$mult = $fi3["p"] / 100;
							} else {
								if ($row["linea_cot"] == 'Barandas en Vidrios') {
									$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Barandas en Vidrios'";
									$fi3 = mysql_fetch_array(mysql_query($s3));
									$mult = $fi3["p"] / 100;
								} else{
									if ($row["linea_cot"] == 'Vidrios Decoracion Jamar') {
										$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Vidrios Decoracion Jamar'";
										$fi3 = mysql_fetch_array(mysql_query($s3));
										$mult = $fi3["p"] / 100;
									} else {
										if ($row["linea_cot"] == 'Puertas Batiente en Vidrio') {
											$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Puertas Batiente en Vidrio'";
											$fi3 = mysql_fetch_array(mysql_query($s3));
											$mult = $fi3["p"] / 100;
										} else {
											$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Acero'";
											$fi3 = mysql_fetch_array(mysql_query($s3));
											$mult = $fi3["p"] / 100;
										}
									}
								}
							}
						}
					}
				}
            $comp=mysql_query("SELECT count(*) FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm1 = mysql_fetch_array($comp);
            $d = $cm1['count(*)'];
            
            $ac =mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysql_fetch_array($ac);
            $mt = $cm['count(*)'];
            
              $ak =mysql_query("SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$row["id_cotizacion"]." and b.comp='1'  ");
            $ck = mysql_fetch_array($ak);
            $mtk = $ck['count(*)'];
            
            $as =mysql_query("SELECT count(*) FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=".$row["id_cotizacion"]." ");
            $cs = mysql_fetch_array($as);
            $mts = $cs['count(*)'];
            $compu =mysql_query("SELECT * FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysql_fetch_array($compu)){
        
                 $sx = "SELECT (".$fila["porcentaje_sub"].") as p FROM porcentajes where area_por='".$fila["linea_cot_sub"]."'";
                $fix =mysql_fetch_array(mysql_query($sx));
                $multx= $fix["p"]/100;
                
          $costo_sp += $fila['valor_sp'];
          $costo_fom_sp += $fila['valor_fom_sp'];
          $costo_mp += $fila['valor_c_sub']/$multx;
          $costo_fom_mp += $fila['valor_fom_sub'];
          
    }
           $t = $d + $mt + $mtk + $mts;

            $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           $a = (((($row["valor_c"]))) / $mult) + $pad  + $tk;


            
//            echo ($tk ) .'<br>';
            if($row["linea_cot"]=='Vidrio' || $row["linea_cot"]=='VIDRIO'){$d1 = 'Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            $cont = $cont + 1;
          
                                if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            // modificar de este lado
                                
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
            $tacot = $tacot + $ptt;
            if($row["especial"]==1){
                if($ver_pro=='Habilitado'){
                $ver = '<a href="../vistas/?id=ver_fac&ref='.$row["id_referencia"].'&cot='.$row["id_cotizacion"].'&cli='.$_GET["cli"].'&ped='.$_GET["cot"].'">';
                }
                else{$ver =''; }
                }else{
                    if($ver_pro=='Habilitado'){
                $ver = '<a target="_blank" href="../vistas/?id=ver_pro&l='.$row["imagen"].''
                        . '&mod='.$row["modulo"].'&per='.$row["per"].'&boq='.$row["boq"].'&ref='.$row["id_referencia"].''
                        . '&cot='.$_GET["cot"].'&idcot='.$row["id_cotizacion"].'&tv='.$row["traz_vid"].'&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].''
                        . '&aa='.$row["ancho_abajo"].'&ancho='.$row["ancho_c"].'&alto='.$row["alto_c"].''
                        . '&cant='.$row["cantidad_c"].'&vidrio='.$fv1["color_v"].'('.$fv1["espesor_v"].'mm)'
                        . '&id_v='.$row["id_vidrio"].'&id_v2='.$row["id_vidrio2"].'&id_v3='.$row["id_vidrio3"].'&id_v4='.$row["id_vidrio4"].'&id_v5='.$row["id_vidrio5"].'&id_v6='.$row["id_vidrio6"].''
                        . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].''
                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].''
                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].''
                        . '&cuerpo='.$row["cuerpo"].'&hojas='.$row["hojas"].'&ins='.$row["install"].''
                        . '&por='.$row["porcentaje_mp"].'&v='.$row["verticales"].'&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'&lado='.$row["lado"].'">';
                    
              
                    }
                    else{$ver =''; }
                    }
                     if($row["estado_item"]==''){ 
                         $chk ='';
                         $est_itm = '<span id="ver'.$row["id_cotizacion"].'"></span>';
                    }else{
                         if($row["estado_item"]=='Anulado'){ 
                            $chk ='';
                            $est_itm = '<span id="ver'.$row["id_cotizacion"].'"><font color="red">Anulado por: '.$row["aprobado_por_user"].'<br>Modificado: '.$row["fecha_aprobada"].'</font></span>';
                        }else{
                            $chk ='checked';
                            $est_itm = '<span id="ver'.$row["id_cotizacion"].'"><font color="green">Aprobado por: '.$row["aprobado_por_user"].'<br>Modificado: '.$row["fecha_aprobada"].'</font></span>';
                       }
                    }
                    $img_delx ='<input type="checkbox" '.$chk.' name="item" id="'.$row["id_cotizacion"].'"  onClick="if (this.checked) aprobar_item(1,'.$row["id_cotizacion"].'); else aprobar_item(0,'.$row["id_cotizacion"].');">';
         if($crear_ped=='Habilitado'){$add = '';}else{$add = '';}
     $con2= "SELECT id_p, producto FROM `producto` where id_p=".$row['traz_vid']." ";
$res2=  mysql_query($con2);
$f8=  mysql_fetch_array($res2);
$idco=$f8['id_p'];
$nombr=$f8['producto'];

if($row['traz_vid2']==0){
    $nombr2='';
}else{
$con22= "SELECT id_p, producto FROM `producto` where id_p=".$row['traz_vid2']." ";
$res22=  mysql_query($con22);
$f8r=  mysql_fetch_array($res22);
$idco2=$f8r['id_p'];
$nombr2=$f8r['producto'];
}
if($row['traz_vid3']==0){
    $nombr3='';
}else{
$con23= "SELECT id_p, producto FROM `producto` where id_p=".$row['traz_vid3']." ";
$res23=  mysql_query($con23);
$f83=  mysql_fetch_array($res23);
$idco3=$f83['id_p'];
$nombr3=$f83['producto'];
}
if($row['traz_vid4']==0){
    $nombr3='';
}else{
$con24= "SELECT id_p, producto FROM `producto` where id_p=".$row['traz_vid4']." ";
$res24=  mysql_query($con24);
$f84=  mysql_fetch_array($res24);
$idco4=$f84['id_p'];
$nombr4=$f84['producto'];
}
$v1 = $fv1['color_v'];
if($fv2['color_v']==''){$v2 = '';}else{$v2 = '+'.$fv2['color_v'];}
if($fv3['color_v']==''){$v3 = '';}else{$v3 = '+'.$fv3['color_v'];}
if($fv4['color_v']==''){$v4 = '';}else{$v4 = '+'.$fv4['color_v'];}
$v21 = $fv21['color_v'];
if($fv22['color_v']==''){$v22 = '';}else{$v22 = '+'.$fv22['color_v'];}
if($fv23['color_v']==''){$v23 = '';}else{$v23 = '+'.$fv23['color_v'];}
if($fv24['color_v']==''){$v24 = '';}else{$v24 = '+'.$fv24['color_v'];}
             $tip =$row['tip']; $tip2 =$row['fila'];
            if($row['id_vidrio']!=0 && $row['id_vidrio2']!=0){
                $vi = $v1.$v2.$v3.$v4.' - '.$nombr;
            }else{
                if($fv1['espesor_v']!='' && $row['producto']!=$nombr){
                 $vi = $fv1['color_v'].' '.$nombr;
                }else{
                 $vi = $fv1['color_v'];
                }
            }
            if($row['id2_vidrio']!=0 && $row['id2_vidrio2']!=0){
                $vi2 = $v21.$v22.$v23.$v24.' - '.$nombr2;
            }else{
                
                 $vi2 = $fv21['color_v'].' - '.$nombr2;
            }
               $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99 ";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
      if($row['pelicula']=='No Aplica'){
                $peli = '';
            }else{
                if($row['pelicula']=='Una Cara'){
                     
                    $peli = ', + '.$fila21['descripcion_mo'];
            }else{
                  
               $peli = ', + '.$fila21['descripcion_mo'].' ambos lados';
            }
            }
            $iva3 = $ptt * 0.16;
            $tota = $ptt + $iva3;
             $pdlr = "select * from dolares where id_dolar=".$row['id_dolar']."  ";
                $fia =mysql_fetch_array(mysql_query($pdlr));
                $precio_actual= $fia["precio_dolar"];
                
                if($row["valor_temp"]==0){
                    $w = '';
                }else{
                     $w = '<img src="../imagenes/warning.png" title="Advertencia tiene Precios ingresado manualmente">';
                }
                
                if($estado=='Aprobado'){$pen = '<td class="hidden-phone"><div align="center"><font color="red">'.$row["cant_restante"].'</font></td>';}else{$pen = '';}
            //consulta de compuestos  a005c9f95212f79b7e20753ceeecd8f1     61843d7a6710ba2f2dd19abb2cb04e90
                $com=mysql_query("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
                $compuesto ='<ul>';
                $up = '';
                while($cpt = mysql_fetch_array($com)){
                    if($cpt['actualizado']==0){
                        $up = $up.'<a href="../vistas/?id=add_cot&cod='.$cpt['id_p'].'" target="_blank"><font color="red">'.$cpt['codigo'].'</font></a><br> ';
                    }else{
                        $up = $up.'<font color="green">'.$cpt['codigo'].'</font> <br> ';
                    }
                    $compuesto = $compuesto.'<li>'.$cpt['producto'].'</li>';
                }
                if($row['actualizado']==0){
                        $upp = '<a href="../vistas/?id=add_cot&cod='.$row['id_p'].'" target="_blank"> <font color="red">'.$row['codigo'].'</font></a> ';
                    }else{
                        $upp = '<font color="green">'.$row['codigo'].'</font> ';
                    }
                
                // fin de consulta de compuesto
                $table = $table.'<tr>'
. '<td width="2%">'.$tip.'</td><td width="2%">'.$tip2.'</td>
<td width="7%">'.$upp.'<br>'.$up.'</td>
<td width="60%">'.$ver.''.$row['producto'].' '.$peli.', '.$row['observaciones'].', '
. ''.$m.','.$d1.', Cierre: '.$row["cierre"].', Inst: '.$row["install"].', Lam: '.$row["laminas"].''
. '<br>Se Cotizó con el Dollar a: $ '.$precio_actual.'<br><font color="red">'.$vi.'<br>'.$vi2.'</font>'.$est_itm.''
                        . '</a><br>Precio Total: $'.number_format($tota).'<br>'.$compuesto.'</td>                     
<td class="hidden-phone"><div align="center">'.$row["ancho_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["alto_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["cantidad_c"].'</div></td>

<td class="hidden-phone">'.$row["porcentaje"].'</font></td>
    <td class="hidden-phone">'.$row["porcentaje_mp"].'</font></td>
<td class="hidden-phone">'.number_format($row["desc"],2,',','').'</a></td>'
. '<td><a title="Aqui puede adicionar alguna estructura o un material" href="../vistas/?id=add_acc&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'&mas='.$row["id_cotizacion"].'&por='.$row["porcentaje_mp"].'&pagina='.$_GET['id'].'&tipo_cli='.$tipo.'""><button type="button"><img src="../imagenes/puzzle_3.png">(<font color="red">'.$t.'</font>)</button></a></td>
<td style="text-align:center"> '.$img_delx.'</td></tr>';   



                
	} 
	$table = $table.'</table>';
       }
	echo $table.'<br><hr>';
        
        ///  --------------------------------------------servicios-----------------------------------------

        echo '<hr>';
        if($cont!=0){
     echo '<div align="right"><FONT color="red"><h5>TOTAL COT.: $'.number_format($tacot).'</h5></FONT></div>';} 
     
     
} 
    ?>
            <a title="Imprimir Servicios, Kits, Materiales" href="../vistas/service.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><button type="button"><img src="../imagenes/print.png"> Imprimir Servicios</button></a>
            
            <?php } 
                                           
$request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and id_cot_mas=0 ");
    
if($request2){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="">';
             $table2 = $table2.'<thead >';
              $table2 = $table2.'<tr bgcolor="#D1EEF0">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>';
              $table2 = $table2.'<th width="40%">'.'Servicio'.'</th>';
			  $table2 = $table2.'<th width="40%">'.'Descripción del Servicio'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Pago Ins'.'</th>';
             
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Total Pago Servicio'.'</th>';
			  $table2 = $table2.'<th width="10%">'.'Total Pago Accesorios'.'</th>';
           
              $table2 = $table2.'<th width="10%">'.'Costo Total'.'</th>';
              $table2 = $table2.'<th width="10%">Editar</th>';
              $table2 = $table2.'<th width="10%">Eliminar</th>';
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2s=0;
        $to_serv =0;
	while($row2=mysql_fetch_array($request2))
	{    
            
                  $request_ac1=mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
               $tota=0;
	while($row1=mysql_fetch_array($request_ac1))
	{       
               $por = 100;
            $tota = $tota + ($row2["valor_mo"]*$row1["porcentaje_ad"]/$por);  
            
	} 
        $pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["valor_mo"] + $tota) / $pr;
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            
             $to_serv = $to_serv + $dd + $row2["precio_accesorios"];
              if($estado=='En proceso'){ 
if($editar_cot=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';}
 if($eliminar_cot=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}
 }else{
                 $ver='';$del='';
             }
            $table2 = $table2.'<tr><td width="5%">'.$total2s.'</a></td><td width="5%">'.$row2['id_ref_mo'].'</font></td>'
                    . '<td width="40%"><a href="../vistas/?id=ver_gastos&cod='.$row2['id_ref_mo'].' ">'.$row2['descripcion_mo'].'</font></td>'
                    . '<td width="40%">' . $row2["observaciones"] . '</td>'
                    . '<td width="10%">'.$row2["referencia"].'</a></td>
               <td width="10%">$'.number_format($fr).'</td>'
                    . '<td width="10%">'.$row2["descuento_serv"].'%</td>'
                    . '<td width="10%">'.$row2["cantidad_serv"].'</td><td width="10%">'.number_format($dd).'</td><td width="10%">' . number_format($row2["precio_accesorios"]) . '</td>'
                         . '<td width="10%">'.number_format(($dd + $row2["precio_accesorios"])).'</td>'
                    . '<td width="10%"><a href="../vistas/?id=new_fac&up_serv='.$row2["id_cot_serv"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$ver.'</a> </td>
                        <td width="10%"> <a href="../vistas/?id=new_fac&del_serv='.$row2["id_cot_serv"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$del.'</a></td></tr>';   
           
		
               
	} 
	$table2 = $table2.'</table>';
        
	echo $table2.'<br><hr>';
         echo '<div align="right"><FONT color="red"><h5>TOTAL SERVICIOS.: $'.number_format($to_serv).'</h5></FONT></div>';
      
  
} 
$request3=mysql_query("SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=".$_GET['cot']." ");
    
if($request3){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="">';
             $table2 = $table2.'<thead >';
              $table2 = $table2.'<tr bgcolor="#D1EEF0">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="40%">'.'Descripcion de los materiales'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Medida (Ancho)'.'</th>';
			  $table2 = $table2.'<th width="10%">'.'Medida (Alto)'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Costo'.'</th>';   
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Valor Und'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Valor Total'.'</th>'; 
              $table2 = $table2.'<th width="10%">Editar</th>';
              $table2 = $table2.'<th width="10%">Eliminar</th>';
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_mat =0;
      
	while($row21=mysql_fetch_array($request3))
	{       
             $acc_por = "SELECT (".$row21['pe'].") as p FROM porcentajes where area_por='MP' and grupo='".$row21["grupo"]."'";
             $fipa =mysql_fetch_array(mysql_query($acc_por));
             $porcacc= $fipa["p"]/100; 
             
             $acc_porv = "SELECT (".$row21['pe'].") as p FROM porcentajes where area_por='Aluminio' and division='Venta'";
             $fipav =mysql_fetch_array(mysql_query($acc_porv));
             $porcven= $fipav["p"]/100; 
             
             
             $total2= $total2 +  1;
             if($row21['med']==1){
                 $mt = 1;
             }else{
      
                 $mt = ($row21['med']/1000);
             }
            $au = (100 - $row21['aumento']) / 100;
            $prt3 = $row21["costo_mt"] / $au;
             $desm = ($row21['descuento_mat']/100) * ($prt3*$mt);
             $ddm = (((($prt3*$mt) + $desm) * $row21["cantidad_mat"]) / $porcacc)/$porcven;
             $to_mat = $to_mat + $ddm;
             if($estado=='En proceso'){ 
if($editar_cot=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';}
 if($eliminar_cot=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}
 }else{
                 $ver='';$del='';
             }
             if($row21['color_ma']==''){
                 $cm = '';
             }else{
                  $cm = 'Color: '.$row21['color_ma'];
             }
            $table2 = $table2.'<tr><td width="5%">'.$porcven.' - '.$row21['pe'].'</a></td>'
                    . '<td width="5%">'.$row21['codigo'].'</font></td>'
                    . '<td width="40%">'.$row21['descripcion'].' '.$cm.'</font></td>'
                    . '<td width="10%">'.$row21["referencia"].'<font></a></td>'
                    . '<td width="10%">'.$row21["med"].'</td>
                    	<td width="10%">' . $row21["med2"] . '</td>
               <td width="10%">$'.number_format(($prt3*$mt)/ $porcacc).'</td>'
                    . '<td width="10%">'.$row21["descuento_mat"].'%</td>'
                    . '<td width="10%">'.$row21["cantidad_mat"].'</td>'
                    . '<td width="10%">'.number_format($ddm/$row21["cantidad_mat"]).'</td>'
                    . '<td width="10%">'.number_format($ddm).'</td>'
                    . '<td width="10%"><a href="../vistas/?id=new_fac&up_mat='.$row21["id_cot_mat"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$ver.'</a> </td>
                        <td width="10%"> <a href="../vistas/?id=new_fac&del_mat='.$row21["id_cot_mat"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$del.'</a></td></tr>';   
           
		
               
	} 
	$table2 = $table2.'</table>';
        
	echo $table2;
         echo '<div align="right"><FONT color="red"><h5>TOTAL MATERIALES.: $'.number_format($to_mat).'</h5></FONT></div>';

} 

$request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']."  and b.comp='0'");
    
if($request4){
//    echo'<hr>';
       $table4 = '<table class="table table-bordered table-striped table-hover" id="">';
             $table4 = $table4.'<thead >';
              $table4 = $table4.'<tr bgcolor="#D1EEF0">';
              $table4 = $table4.'<th width="5%">'.'Items'.'</th>';    
              $table4 = $table4.'<th width="5%">'.'Codigo'.'</th>'; 
              $table4 = $table4.'<th width="40%">'.'Descripcion del kit'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Referencia'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Medida'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Costo'.'</th>';   
              $table4 = $table4.'<th width="10%">'.'Descuento'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Costo Total'.'</th>'; 
              $table4 = $table4.'<th width="10%">Editar</th>';
              $table4 = $table4.'<th width="10%">Eliminar</th>';
              $table4 = $table4.'</tr>';
              $table4 = $table4.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t2e=0;
        $to_k =0;
     
                
                
	while($row21k=mysql_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
             $t2e= $t2e + 1;
                include '../modelo/suma_kit.php';
            
             $desm = ($row21k['desc_k']/100) * ($totk);
             $ddm = ((($totk) + $desm)) / $porcacc;
             $to_k = $to_k + $ddm;
             if($estado=='En proceso'){ 
if($editar_cot=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';}
 if($eliminar_cot=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}
             }else{
                 $ver='';$del='';
             }
              if($row21k['color_k']==''){
                 $ck = '';
             }else{
                  $ck = 'Color: '.$row21k['color_k'];
             }
            $table4 = $table4.'<tr><td width="5%">'.$t2e.'</a></td><td width="5%">'.$row21k['codigo'].'</font></td><td width="40%">'.$row21k['producto'].' '.$ck.'</font></td><td width="10%">'.$row21k["referencia_p"].'<font></a></td><td width="10%">N/A</td>
               <td width="10%">$'.number_format(($totk)/ $porcacc).'</td><td width="10%">'.$row21k["desc_k"].'%</td><td width="10%">'.$row21k["cantidad_k"].'</td><td width="10%">'.number_format($ddm).'</td>'
                    . '<td width="10%"><a href="../vistas/?id=new_fac&up_k='.$row21k["id_ck"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$ver.'</a> </td>
                        <td width="10%"> <a href="../vistas/?id=new_fac&del_k='.$row21k["id_ck"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$del.'</a></td></tr>';   
           
		
               
	} 
	$table4 = $table4.'</table>';
        
	echo $table4;
         echo '<div align="right"><FONT color="red"><h5>TOTAL KIT.: $'.number_format($to_k).'</h5></FONT></div>';
         //echo '<div align="right"><FONT color="red"><h4>GRAN TOTAL.: $'.number_format($to_serv+$tacot+$to_mat+$to_k).'</h4></FONT></div>';
  
} 
        
            if($estado!='Aprobado'){                             
 ?>
        <table>
                <tr>
                    <td><label><i>Total de Cotizaciones: </i></label> <input type="hidden" name="cant" readonly  style="width:20px;height:20px;"  value="<?php echo $cont; ?>"></td>
                </tr>
                
            </table>  
            <?php } ?>
            </form>                                   
                                             
                                </div>
                            </section>
        
                       
                      <!-- START Widget Collapse -->
                           </div>
                                
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                       

                       
                      <!-- START Widget Collapse -->
                           </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                     <?php 
                      $cons = mysql_fetch_array(mysql_query("select * from dolares order by id_dolar desc limit 1"));
                      $pd = $cons['precio_dolar'];
                     ?>
        
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <div class="row-fluid">
                                       <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/cotizacion_1.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&tipo_cli='.$tipo.''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                           
                            <section class="body">
                                <div class="body-inner">
                                    <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                     Dollar :<input type="text" value="<?php echo $pd ?>" name="dolar" style="width:40px;" readonly="false">$
                                     <input type="hidden" value="<?php echo $cons['id_dolar'] ?>" name="id_dolar" style="width:40px;">
                                     <hr>
                                     <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td style="width:30%" >linea de produccion</td>
                                            <td><select name="linea" id="linea">
                                                    <?php if(isset($_GET['up'])){
                                                        echo "<option value='".$linea_cot."'>".$linea_cot."</option>";
                                                    
                                                    }else{
                                                        echo "<option value=''>.:Seleccione la linea:.</option>"; 
                                                        
                                                    } ?>             
                                                        <?php
                                                            require '../modelo/conexion.php';
                                                            $consulta= "SELECT * FROM `lineas`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['linea'];                                                          
                                                            $valor3=$fila['linea'];                                                        
                                                            echo"<option value='".$valor1."'>".$valor3."</option>"; 
                                                            }
                                                            ?>
                                                             </select>
                                            <input type="hidden" name="pvi" value="<?php echo $pvi; ?>" id="pvi">
                                               <input type="hidden" name="pal" value="<?php echo $pal; ?>" id="pal">
                                               <input type="hidden" name="pac" value="<?php echo $pac; ?>" id="pac"></td>
                                            <td style="width:30%">Instalacion:</td>
                                            <td> <select name="install"  style="width: 80px;">
                                                        
                                                            <option value="Si">Si</option>    
                                                        <option value="No">No</option>
                                                         
                                                        </select></td>
                                        
                                            <td rowspan="7" id="imagen"  style="width:40%">Imagen del producto</td>
                                        </tr>
                                        <tr>
                                            <td>Referencia del producto</td>
                                            <td><div id="busqueda"></div>
                                                <input name="a" type="hidden" readonly id="refer">
                                                <input name="b" readonly type="text" id="descr">
                                                <input type="hidden" readonly name="ref" id="codig">
                                               
                                            </td>
                                            <td>Precio de Venta:</td>
                                            <td> <select name="precio"  style="width: 80px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?> >
                                                    <?php
                                                    	if ($express == 1) { ?>
                                                    		<option value="p1">p1</option>
                                                    	<?php
                                                    	} else { ?>
                                                    		<option value="p1">p1</option>
                                                      		<option value="p2">p2</option>
                                                         	<option value="p3">p3</option>
                                                    	<?php
                                                    	}
                                                    ?>
                                                    </select></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Sentido</td>
                                            <td><select name="lado" id="select2_1"  style="width: 100%" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$lado.'">'.$lado.'</option>';} ?>                                                      
                                                            
                                                        <option value="">Seleccione</option> 
                                                        <option value="N/A">N/A</option>
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>
                                                        
                                                </select></td>
                                            <td>Precio de la materia prima:</td>
                                            <td>  <?php if($_SESSION['admin']=='Si'){   ?>
                                                <select name="precio_mp"  style="width: 80px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?> >
                                                	<?php
                                                    	if ($express == 1) { ?>
                                                    		<option value="p1">p1</option>
                                                    	<?php
                                                    	} else { ?>
                                                    		<option value="p1">p1</option>
                                                      		<option value="p2">p2</option>
                                                         	<option value="p3">p3</option>
                                                    	<?php
                                                    	}
                                                    ?>
                                                        </select>
                                                <?php }else{  ?>
                                                <input type="text" readonly name="precio_mp" value="p1"  style="width: 80px;">
                                                 <?php } ?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td>Trazabilidad del vidrio</td>
                                            <td id="vidrios"></td>
                                            <td>Con descuento de:</td>
                                            <td id="descuento">  
                                                <input type="text" name="desc" value="0"  style="width: 60px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?>>%</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Laminas del Vidrio</td>
                                            <td>
                                            <div  id="lam"></div>
                                            <div  id="lam2"></div>
                                            <div  id="lam3"></div>
                                            <div  id="lam4"></div>
                                            </td>
                                            <td>Tipo:</td>
                                            <td><input type="text" name="tip" value="<?php if(isset($_GET['up'])){echo $tip;} ?>" placeholder="ej: PV-1"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color y Espesor del Vidrio</td>
                                            <td>
                                            <div  id="vid"></div>
                                            <div  id="vid2"></div>
                                            <div  id="vid3"></div>
                                            <div  id="vid4"></div>
                                            </td>
                                             <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['up'])){echo $ubica;} ?></textarea></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color del Aluminio</td>
                                            <td  id="alum"> <select name="alum"  required>
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$color_ta."'>".$color_ta."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Duracion del proyecto</td>
                                            <td><input  type="number"  name="duracion" style="width: 80px;" value="<?php if(isset($_GET['up'])){echo $duracion;} ?>" placeholder=""> dias</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tiene cierre?</td>
                                            <td id="cierre"><select name="cierre"  required >
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['color_a'];
                                                           
                                                        
                                                         
                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select></td>
                                            <td>Observaciones</td>
                                            <td><textarea name="descripcion" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['up'])){echo $obs;} ?></textarea></td>
                                            <td rowspan="3" id="areas">trazabilidad</td>
                                        </tr>
                                      
                                            <div id="hoja"> <input type="hidden" name="hoja" value=""></div>
                               
                                        <tr>
                                            <td>Medidas</td>
                                            <td><input type="text" name="ancho" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $ancho_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required> X 
                                            <input type="text" name="alto" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Alto en mm" required></td>
                                            <td>Medida Alto Cuerpo Fijo</td>
                                            <td><input type="text" name="cuerpo"  value="0"></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td><input type="text" name="cant" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" required></td>
                                             <td>Medida Ancho Cuerpo Fijo</td>
                                            <td><input type="text" name="ladomm"  value="0"></td>
                                           
                                           
                                        </tr>
       
                                         <tr>
                                            <td>Medidas Totales con Compuestos</td>
                                             <td><input type="text" autocomplete="off" name="ancho_temp" value="<?php if(isset($_GET['up'])){echo $ancho_temp;} ?>" style="width: 70px;"  placeholder="Ancho en mm" >
                                              X <input type="text" autocomplete="off" name="alto_temp" value="<?php if(isset($_GET['up'])){echo $alto_temp;} ?>" style="width: 70px;"  placeholder="Alto en mm" ></td>
                                             <td>Lleva Pelicula ?</td>
                                            <td>
                                                <select name="pelicula">
                                                    <option value="No Aplica">No Aplica</option>
                                                    <option value="Una Cara">Una Cara</option>
                                                    <option value="Doble Cara">Doble Cara</option>
                                                </select>
                                            </td>
                                             
                                        </tr>
                                        <tr>
                                            <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
                                            <td><input type="text" name="ancho_abajo" value="0"></td>
                                            <td>Observaciones adicionales:</td>
                                            <td><textarea name="obs2" placeholder="Observacion adicional"><?php if(isset($_GET['up'])){echo $obs2;} ?></textarea></td>
                                            <td rowspan="2"><div id="areas_vid">trazabilidad</div>
                                          <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <label class="control-label">Imagen Opcional</label>
                                               
                                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                                    <img src="<?php if(isset($_GET['up'])){if($adicional !=''){echo '../adicionales/'.$adicional;}else{echo '../imagenes/nofoto.png';}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Seleccione La Imagen</span>
                                                <span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['up'])){echo '<input name="imagen" type="file" value="'.$adicional.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                                 
                                            </div></td>
                                        </tr>
                                        <tr>
                                            <td>Digite la cantidad de verticales y horizontales</td>
                                            <td><input type="text" name="vert" value="" PLACEHOLDER="Verticales" style="width: 70px;">
                                                X <input type="text" name="hori" value="" placeholder="Horizontales"  style="width: 70px;">
                                            </td>
                                            <td><input type="checkbox" name="d1"   value="1">Automatico</td>
                                            <td>
                                            </td>
                                            
                                        </tr>
                                        
                                    </table>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
      
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
<div class="tab-pane <?php if(isset($_GET['up_serv'])){echo 'active';}  ?>" id="tab7">
	<div class="row-fluid">
		<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_serv'])){echo '../modelo/cotizacion_servicios.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up_serv'].' ';}else{echo '../modelo/cotizacion_servicios.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&tipo_cli='.$tipo.'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
			<section class="body">
				<div class="body-inner">                    
					<?php
						if (isset($_GET['up_serv'])) {
							$sql21 = "SELECT *
										FROM referencia_mo a, cotizaciones_servicios b
									   WHERE a.id_ref_mo = b.id_servicio
										 AND b.id_cot_serv = " . $_GET['up_serv'];
							$fila21 = mysql_fetch_array(mysql_query($sql21));
							$idcotsv = $fila21["id_cot_serv"];
							$id_sv = $fila21["id_ref_mo"];
							$cant_sv = $fila21["cantidad_serv"];
							$des_sv = $fila21["descripcion_mo"];
							$valor_sv = $fila21["valor_mo"];
							$valor_sv_total = $fila21["precio_servicio"];
							$observaciones_sv = $fila21["observaciones"];
							$ca = $fila21["cantidad_serv"];
							$dd = $fila21["descuento_serv"];
							$idfrm = $fila21["id_ref_mo"];
							$request_ac1 = mysql_query("SELECT *
														  FROM gastos_serv a, referencia_admin c
														 WHERE a.id_administrativo = c.id_ref_ad
														   AND a.id_ref = " . $fila21["id_ref_mo"]);
							$tota = 0;
							while ($row1 = mysql_fetch_array($request_ac1)) {
								$por = 100;
								$tota = $tota + ($fila21["valor_mo"] * $row1["porcentaje_ad"] / $por);
							}
							$pr = (100 - $fila21["utilidad"]) / 100;
							$fr = ($fila21["valor_mo"] + $tota) / $pr;
							$des = ($dd / 100) * $fr;
							$vv = ($fr + $des) * $fila21["cantidad_serv"];
						}
						if (isset($_GET['up_mat'])) {
							$sql21 = "SELECT *
										FROM referencias a, cotizaciones_materiales b
									   WHERE a.id_referencia = b.id_material
									     AND b.id_cot_mat = " . $_GET['up_mat'];
							$fila21 = mysql_fetch_array(mysql_query($sql21));
							$idmt = $fila21["id_referencia"];
							$ref = $fila21["referencia"];
							$des_mt = $fila21["descripcion"];
							$color_ma = $fila21["color_ma"];
							$camt = $fila21["cantidad_mat"];
							$ddmt = $fila21["descuento_mat"];
							$por_mp = $fila21["pe"];
							$observaciones_mat = $fila21["observaciones"];
							$med = $fila21["med"];
							$med2 = $fila21["med2"];
						}
						if (isset($_GET['up_k'])) {
							$sql21 = "SELECT *
										FROM producto a, cotizaciones_kit b
									   WHERE a.id_p = b.id_producto
									     AND b.id_ck = " . $_GET['up_k'];
							$fila21 = mysql_fetch_array(mysql_query($sql21));
							$idmt = $fila21["id_p"];
							$ref = $fila21["referencia_p"];
							$des_mt = $fila21["producto"];
							$color_k = $fila21["color_k"];
							$camt = $fila21["cantidad_k"];
							$ddmt = $fila21["desc_k"];
							$por_mp= $fila21["por_k"];
						}
					?>
					<div class="row-fluid">
						<br>
						<table class="table table-bordered table-striped table-hover">
							<tr>
								<th style="width: 15%">Seleccionar Servicios</th>
								<input type="hidden" name="id_cot_servicios" id="id_cot_servicios" value="<?php echo $_GET['cot']; ?>" />
								<input type="hidden" name="id_cli_servicios" id="id_cli_servicios" value="<?php echo $_GET['cli']; ?>" />
								<td width="40%">
									<input type='hidden' value='<?php if (isset($_GET['up_serv'])) { echo $id_sv; } ?>' name='servicio_hidden' id='servicio_hidden' />
									<input class="span12" style="background-color: white; cursor: pointer;" type='text' name='servicio' id='servicio' readonly="readonly" required="required" value='<?php if (isset($_GET['up_serv'])) { echo $des_sv; } ?>' onclick='tipoServicio()' />
								</td>
								<th style="width: 6%">Cantidad</th>
								<td width="10%">
									<input class="span8" type="number" name="cant_servicio" id="cant_servicio" value="<?php if (isset($_GET['up_serv'])) { echo $cant_sv; } ?>" min="1" required="required" />
								</td>
								<th style="width: 6%">Valor Costo $</th>
								<td width="10%">
									<input class="span8" style="background-color: white;" type="text" name="valor_servicio" id="valor_servicio" value="<?php if (isset($_GET['up_serv'])) { echo $valor_sv_total; } ?>" readonly="readonly" required="required" />
									<input type="hidden" name="valor_servicio_hidden" id="valor_servicio_hidden" value="<?php if (isset($_GET['up_serv'])) { echo $valor_sv; } ?>" />
								</td>
								<th style="width: 6%">Valor Venta $</th>
								<td width="10%">
									<input class="span8" style="background-color: white;" type="text" name="valor_venta_servicio" id="valor_venta_servicio" value="<?php if (isset($_GET['up_serv'])) { echo $vv; } ?>" readonly="readonly" required="required" />
									<input type="hidden" name="valor_venta_servicio_hidden" id="valor_venta_servicio_hidden" value="<?php if (isset($_GET['up_serv'])) { echo ($vv / $cant_sv); } ?>" />
								</td>
							</tr>
							<tr>
								<th>Descripción</th>
								<td>
									<textarea style="resize: none;" name="descripcion_servicio" id="descripcion_servicio" rows="3" class="span12" required><?php if (isset($_GET['up_serv'])) { echo $observaciones_sv; } ?></textarea>
								</td>
								<!--<td>
									<input type="text" name="cant" value=" <?php if(isset($_GET['up_serv'])){ echo $ca; } ?>">
								</td>-->
							</tr>
							<tr>
								<th>Porcentaje</th>
								<td>
									<input type="number" name="porcentaje_servicio" id="porcentaje_servicio" value="<?php if (isset($_GET['up_serv'])) { echo $dd; } ?>" step="any" required="required" />
								</td>
							</tr>
							<tr>
								<th>Vidrio</th>
								<td colspan="7">
									<input type='hidden' value='' name='vidrio_servicio_hidden' id='vidrio_servicio_hidden' />
									<input type='hidden' value='' name='referencia_vidrio_servicio_hidden' id='referencia_vidrio_servicio_hidden' />
									<input type="hidden" value="" name="valor_vidrio_hidden" id="valor_vidrio_hidden" />
									<input class="span2" style="background-color: white; cursor: pointer;" type="text" name="vidrio_servicio" id="vidrio_servicio" value="" placeholder="Tipo Vidrio" readonly="readonly" onclick="tipoVidrio()" />
									<b>%</b>
									<select class="span1" name="porcentaje_servicio_vidrio" id="porcentaje_servicio_vidrio">
										<option value="p1">p1</option>
										<option value="p2">p2</option>
										<option value="p3">p3</option>
									</select>
									<input class="span1" type="number" name="ancho_vidrio_servicio" id="ancho_vidrio_servicio" min="1" placeholder="Ancho en mm" />
									<b>X</b>
									<input class="span1" type="number" name="alto_vidrio_servicio" id="alto_vidrio_servicio" min="1" placeholder="Alto en mm" />
									<b>X</b>
									<input type='hidden' value='' name='espesor_servicio_hidden' id='espesor_servicio_hidden' />
									<input style="background-color: white; cursor: pointer;" class="span2" type="text" name="espesor_servicio" id="espesor_servicio" value="" placeholder="Color y Espesor" readonly="readonly" onclick="tipoEspesor()" />
									<input class="span1" type="number" name="perforacion" id="perforacion" min="0" placeholder="Perf." />
									<input class="span1" type="number" name="boquete" id="boquete" min="0" placeholder="Boq." />
									<b>Cant</b>
									<input class="span1" type="number" name="cant_vidrio" id="cant_vidrio" min="1" />
									<b>Trae Vidrio</b>
									<select class="span1" name="trae_vidrio" id="trae_vidrio">
										<option value="1">Si</option>
										<option value="0">No</option>
									</select>
									<button type="button" class="btn btn-primary" name="add_vidrio" id="add_vidrio">+</button>
								</td>
							</tr>
							<tr>
								<th>Accesorio</th>
								<td colspan="7">
									<input type='hidden' value='' name='accesorio_servicio_hidden' id='accesorio_servicio_hidden' />
									<input type="hidden" value="" name="valor_accesorio_hidden" id="valor_accesorio_hidden" />
									<input class="span2" style="background-color: white; cursor: pointer;" type="text" name="accesorio_servicio" id="accesorio_servicio" value="" placeholder="Tipo Accesorio" readonly="readonly" onclick="tipoAccesorio()" />
									<b>%</b>
									<select class="span1" name="porcentaje_servicio_accesorio" id="porcentaje_servicio_accesorio">
										<option value="p1">p1</option>
										<option value="p2">p2</option>
										<option value="p3">p3</option>
									</select>
									<input class="span1" type="number" name="ancho_accesorio_servicio" id="ancho_accesorio_servicio" min="1" placeholder="Ancho en mm" />
									<b>X</b>
									<input class="span1" type="number" name="alto_accesorio_servicio" id="alto_accesorio_servicio" min="1" placeholder="Alto en mm" />
									<b>X</b>
									<select class="span2" name="color_aluminio" id="color_aluminio">
										<option value="">Seleccione el Color</option>
										<?php
											$query_select_color_aluminio = mysql_query("SELECT * FROM tipo_aluminio");
											while ($row_color_aluminio = mysql_fetch_assoc($query_select_color_aluminio)) {
												echo "<option value='" . $row_color_aluminio['id_ta'] . "'>" . $row_color_aluminio['color_a'] . "</option>";
											}
										?>
									</select>
									<b>Cant</b>
									<input class="span1" type="number" name="cant_accesorio" id="cant_accesorio" min="1" />
									<button type="button" class="btn btn-primary" name="add_accesorio" id="add_accesorio">+</button>
								</td>
							</tr>
						</table>
						<hr />
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr bgcolor="#D1EEF0">
									<th>Vidrio</th>
									<th>Ancho</th>
									<th>Alto</th>
									<th>Color y Espesor</th>
									<th>Cantidad</th>
									<th>Valor Unitario</th>
									<!--<th>Editar</th>-->
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody id="info_vidrios">
								<?php
									if (isset($_GET['up_serv'])) {
										$precio_total_vidrio = 0;
										$query_select_info_vidrios = mysql_query("SELECT *
																					FROM info_servicios infoser, cotizaciones cot
																				   WHERE infoser.id_cotizacion = cot.id_cotizacion
																				     AND infoser.id_cot = " . $_GET['cot'] . "
																				     AND infoser.linea = 'Vidrio'
																				     AND infoser.id_servicio = " . $_GET['up_serv']);
										while ($row_info_vidrios = mysql_fetch_assoc($query_select_info_vidrios)) {
											$cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio = " . $row_info_vidrios['id_vidrio'] . " ";
											$fv1 = mysql_fetch_array(mysql_query($cons_vi));
											$url_producto = '<a href="../vistas/?id=ver_pro&l=' . $row_info_vidrios["imagen"] . ''
															. '&mod=' . $row_info_vidrios["modulo"] . '&per=' . $row_info_vidrios["per"] . '&boq=' . $row_info_vidrios["boq"]
															. '&ref=' . $row_info_vidrios["id_referencia"] . ''
															. '&cot=' . $id_cot . '&idcot=' . $row_info_vidrios["id_cotizacion"] . '&tv=' . $row_info_vidrios["traz_vid"]
															. '&tv2=' . $row_info_vidrios["traz_vid2"] . '&tv3=' . $row_info_vidrios["traz_vid3"] . '&tv4=' . $row_info_vidrios["traz_vid4"] . ''
															. '&aa=' . $row_info_vidrios["ancho_abajo"] . '&ancho=' . $row_info_vidrios["ancho_c"] . '&alto=' . $row_info_vidrios["alto_c"] . ''
															. '&cant=' . $row_info_vidrios["cantidad_c"] . '&vidrio=' . $fv1["color_v"] . '(' . $fv1["espesor_v"] . 'mm)'
															. '&id_v=' . $row_info_vidrios["id_vidrio"] . '&id_v2=' . $row_info_vidrios["id_vidrio2"] . '&id_v3=' . $row_info_vidrios["id_vidrio3"]
															. '&id_v4=' . $row_info_vidrios["id_vidrio4"] . '&id_v5=' . $row_info_vidrios["id_vidrio5"] . '&id_v6=' . $row_info_vidrios["id_vidrio6"] . ''
															. '&id2_v=' . $row_info_vidrios["id2_vidrio"] . '&id2_v2=' . $row_info_vidrios["id2_vidrio2"] . '&id2_v3=' . $row_info_vidrios["id2_vidrio3"]
															. '&id2_v4=' . $row_info_vidrios["id2_vidrio4"] . '&id2_v5=' . $row_info_vidrios["id2_vidrio5"] . ''
															. '&id3_v=' . $row_info_vidrios["id3_vidrio"] . '&id3_v2=' . $row_info_vidrios["id3_vidrio2"] . '&id3_v3=' . $row_info_vidrios["id3_vidrio3"]
															. '&id3_v4=' . $row_info_vidrios["id3_vidrio4"] . '&id3_v5=' . $row_info_vidrios["id3_vidrio5"] . ''
															. '&id4_v=' . $row_info_vidrios["id4_vidrio"] . '&id4_v2=' . $row_info_vidrios["id4_vidrio2"] . '&id4_v3=' . $row_info_vidrios["id4_vidrio3"]
															. '&id4_v4=' . $row_info_vidrios["id4_vidrio4"] . '&id4_v5=' . $row_info_vidrios["id4_vidrio5"] . ''
															. '&cuerpo=' . $row_info_vidrios["cuerpo"] . '&hojas=' . $row_info_vidrios["hojas"] . '&ins=' . $row_info_vidrios["install"] . ''
															. '&por=' . $row_info_vidrios["porcentaje_mp"] . '&v=' . $row_info_vidrios["verticales"] . '&h=' . $row_info_vidrios["horizontales"]
															. '&d1=' . $row_info_vidrios["d1"] . '&dias=' . $row_info_vidrios["duracion"] . '&lado=' . $row_info_vidrios["lado"] . '">';
											$query_select_tipo_vidrio = mysql_query("SELECT * FROM producto WHERE id_p = " . $row_info_vidrios['id_prod']);
											$row_tipo_vidrio = mysql_fetch_array($query_select_tipo_vidrio);
											echo "<tr>";
											echo "<td>" . $url_producto . "" . $row_tipo_vidrio['producto'] . "</a></td>";
											echo "<td>" . $row_info_vidrios['medida1'] . "</td>";
											echo "<td>" . $row_info_vidrios['medida2'] . "</td>";
											echo "<td>" . $row_info_vidrios['color_prod'] . "</td>";
											echo "<td>" . $row_info_vidrios['cantidad_prod'] . "</td>";
											echo "<td>" . number_format($row_info_vidrios['precio_unitario']) . "</td>";
											//echo "<td><a href='../vistas/?id=new_fac&up_vid=" . $row_info_vidrios['id_info_servicio'] . "&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . "'>" . $ver . "</a></td>";
											echo "<td><a href='../vistas/?id=new_fac&del_vid=" . $row_info_vidrios['id_info_servicio'] . "&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . "'>" . $del . "</a></td>";
											echo "</tr>";
											$precio_total_vidrio = $precio_total_vidrio + $row_info_vidrios["precio_unitario"];
										}
									}
								?>
							</tbody>
						</table>
						<?php
							echo '<div align="right"><h5>TOTAL VIDRIOS: $' . number_format($precio_total_vidrio) . '</h5></div>';
						?>
						<hr />
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr bgcolor="#D1EEF0">
									<th>Accesorio</th>
									<th>Ancho</th>
									<th>Alto</th>
									<th>Color</th>
									<th>Cantidad</th>
									<th>Valor Unitario</th>
									<!--<th>Editar</th>-->
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody id="info_accesorios">
								<?php
									if (isset($_GET['up_serv'])) {
										$precio_total_accesorio = 0;
										$query_select_info_accesorios = mysql_query("SELECT * FROM info_servicios WHERE id_cot = " . $_GET['cot'] . " AND linea = 'Accesorio' AND id_servicio = " . $_GET['up_serv']);
										while ($row_info_accesorios = mysql_fetch_assoc($query_select_info_accesorios)) {
											echo "<tr>";
											$query_select_accesorio = mysql_query("SELECT * FROM referencias WHERE id_referencia = " . $row_info_accesorios['id_prod']);
											$row_accesorio = mysql_fetch_array($query_select_accesorio);
											echo "<td>" . $row_accesorio['descripcion'] . "</td>";
											echo "<td>" . $row_info_accesorios['medida1'] . "</td>";
											echo "<td>" . $row_info_accesorios['medida2'] . "</td>";
											echo "<td>" . $row_info_accesorios['color_prod'] . "</td>";
											echo "<td>" . $row_info_accesorios['cantidad_prod'] . "</td>";
											echo "<td>" . number_format($row_info_accesorios['precio_unitario']) . "</td>";
											//echo "<td><a href='../vistas/?id=new_fac&up_acce=" . $row_info_accesorios['id_info_servicio'] . "&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . "'>" . $ver . "</a></td>";
											echo "<td><a href='../vistas/?id=new_fac&del_acce=" . $row_info_accesorios['id_info_servicio'] . "&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . "'>" . $del . "</a></td>";
											echo "</tr>";
											$precio_total_accesorio = $precio_total_accesorio + $row_info_accesorios["precio_unitario"];
										}
									}
								?>
							</tbody>
						</table>
						<?php
							echo '<div align="right"><h5>TOTAL ACCESORIOS: $' . number_format($precio_total_accesorio) . '</h5></div>';
						?>
						<hr />
						<button type="submit" ><img src="../imagenes/guardar.jpg"> Agregar</button>
						<button type="reset" onclick="resetFields()" ><img width="18px" height="18px" src="../imagenes/clear.png"> Limpiar</button>
						<a href="../vistas/?id=new_fac&cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']  ?>"><button type="button"><img width="18px" height="18px" src="../imagenes/no.png"> Cancelar</button></a>
						<hr>
					</div>
				<div class="control-group"></div>
			</section>
		</form>
		<!--/ END Form Wizard -->
	</div>
</div>
                                               <div class="tab-pane <?php if(isset($_GET['up_mat'])){echo 'active';}  ?>" id="tab8">
                                        <div class="row-fluid">
                                       <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(!isset($_GET['up_mat'])){echo '../modelo/cotizacion_materiales.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'';}else{echo '../modelo/cotizacion_materiales.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up_mat'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                    
                             
                                        <div class="row-fluid">
                                            <br>
                                            <table  class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    <th style="width:10%">Seleccionar Material</th>
                                                    <td><input type="text" name="refe" id="valor1"  value="<?php if(isset($_GET['up_mat'])){ echo $des_mt; } ?>" placeholder="Descripcion del material">
                                                   <input type="hidden" name="ref" id="valor2"  value="<?php if(isset($_GET['up_mat'])){ echo $idmt; } ?>"><a href="../vistas/materiales.php?cot=<?php echo $_GET['cot']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/check.png"></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Referencia</th>
                                                    <td><input type="text" name="refer" id="valor3"  value="<?php if(isset($_GET['up_mat'])){ echo $ref; } ?>" placeholder="Referencia"></td>
                                                </tr>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['up_mat'])){ echo $camt; } ?>"></td>
                                                </tr>
                                                 <tr>
                                            <th>Color del Material</th>
                                            <td  id="alum"> <select name="color"  required>
                                                    <?php if(isset($_GET['up_mat'])){echo "<option value='".$color_ma."'>".$color_ma."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                         
                                        </tr>
                                                <tr>
                                                    <th>Medida (Ancho)</th>
                                                    <td><input type="text" id="valor4" name="medida" value="<?php if(isset($_GET['up_mat'])){ echo $med; }else{echo '1';} ?>">Nota: Si es un perfil, digite la medida (Ancho).</td>
                                                </tr>
                                                 <tr>
                                                    <th>Medida (Alto)</th>
                                                    <td><input type="text" id="valor5" name="medida2" value="<?php if(isset($_GET['up_mat'])){ echo $med2; }else{echo '1';} ?>">Nota: Si es un perfil, digite la medida (Alto).</td>
                                                </tr>
                                                <tr>
                                                    <th>Descuento (%)</th>
                                                    <td>
                                                        <input type="text" name="desc" value="<?php if(isset($_GET['up_mat'])){ echo $ddmt; } ?>">
                                                        </td>
                                                </tr>
                                                <tr>
                                                	<th>Observaciones</th>
                                                	<td>
                                                		<textarea style="resize: none;" name="descripcion_materiales" id="descripcion_materiales" rows="3" class="span12"><?php if (isset($_GET['up_mat'])) { echo $observaciones_mat; } ?></textarea>
                                                	</td>
                                                </tr>
                                                <tr>
                                                    <th>Porcentaje Materia Prima %</th>
                                                    <td><select name="mp"  style="width: 80px;">
                                                       <?php if(isset($_GET['up_mat'])){echo "<option value='".$por_mp."'>".$por_mp."</option>";} ?>
                                                            <option value="p1">p1</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p3">p3</option>
                                                        </select></td>
                                                </tr>
                                            </table>
                                            <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                     <hr>
                                      
                                     </div> 

                                    
                                    
                                    
                                    
                                    
                                        
                                    <div class="control-group"></div>
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                     <div class="tab-pane <?php if(isset($_GET['up_k'])){echo 'active';}  ?>" id="tab9">
                                        <div class="row-fluid">
                                       <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(!isset($_GET['up_k'])){echo '../modelo/cotizacion_kit.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'';}else{echo '../modelo/cotizacion_kit.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up_k'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                      
                            <section class="body">
                                <div class="body-inner">
                                        <div class="row-fluid">
                                            <br>
                                            <table class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    <th style="width:10%">Seleccionar Kit</th>
                                                    <td><input type="text" name="refe" id="valor555"  value="<?php if(isset($_GET['up_k'])){ echo $des_mt; } ?>" placeholder="Descripcion del material">
                                                   <input type="hidden" name="ref" id="valor655"  value="<?php if(isset($_GET['up_k'])){ echo $idmt; } ?>"><a href="../vistas/kit.php?cot=<?php echo $_GET['cot']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/check.png"></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Referencia</th>
                                                    <td><input type="text" name="refer" id="valor755"  value="<?php if(isset($_GET['up_k'])){ echo $ref; } ?>" placeholder="Referencia"></td>
                                                </tr>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['up_k'])){ echo $camt; } ?>"></td>
                                                </tr>
                                                <tr>
                                            <th>Color del Kit</th>
                                            <td  id="alum"> <select name="color"  required>
                                                    <?php if(isset($_GET['up_k'])){echo "<option value='".$color_k."'>".$color_k."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                         
                                        </tr>
                                                <tr>
                                                    <th>Descuento (%)</th>
                                                    <td>
                                                        <input type="text" name="desc" value="<?php if(isset($_GET['up_k'])){ echo $ddmt; } ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Porcentaje Materia Prima %</th>
                                                    <td><select name="mp"  style="width: 80px;">
                                                       <?php if(isset($_GET['up_k'])){echo "<option value='".$por_mp."'>".$por_mp."</option>";} ?>
                                                            <option value="p1">p1</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p3">p3</option>
                                                        </select></td>
                                                </tr>
                                            </table>
                                          <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                     <hr>
                                     </div>   
                                    <div class="control-group"></div>
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                            <div class="tab-pane" id="tab10">
                                        <div class="row-fluid">
                                   
                            <section class="body">
                                <div class="body-inner">
<!--                               //codigo aqui-->
                          <a title="Hoja de Costo Temporal" href="../vistas/hoja_presupuesto.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><img src="../imagenes/hoja.png"> Hoja de Costo Sistema Vs Costos Reales</a>
<?php if(isset($_POST['col'])){
    $filas = $_POST['col'];
}else{
    $filas = 6;
}  ?>
                                        <br><a title="Ver todas las dt en general" href="../vistas/hoja_presupuesto_1.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><img src="../imagenes/print.png"> Imprimir todas las dt</a> 
                                       <br><a title="Ver todas las dt en general" href="../vistas/hoja_materiales.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><img src="../imagenes/print.png"> Desgloses detallado</a> 
                                       <br><a title="Ver todas las dt en general" href="../vistas/hoja_materiales_1.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><img src="../imagenes/print.png"> Desgloses Resumindo</a> 
                                        <br><a title="Reporte de utilidad" href="../vistas/costos.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/bars.png"> UTILIDAD DE TEMPLADO CON COSTO LISTA</a>
                                        <br><a title="Reporte de utilidad" href="../vistas/costosfom.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/bars.png"> UTILIDAD DE TEMPLADO CON COSTO CONTABLE COTIZADOS</a>
                                         <br><a title="Reporte de utilidad" href="../vistas/costos_actuales.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/bars.png"> UTILIDAD DE TEMPLADO CON COSTO CONTABLE ACTUALES</a>
                                         <br><a title="Reporte de utilidad" href="../vistas/costos_1.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/barsf.png"> UTILIDAD DE BOGOTA CON COSTO CONTABLE PARA BOGOTA</a>
                                         <br><a title="Reporte de utilidad" href="../vistas/costosfom_1.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/barsf.png"> UTILIDAD TEMPLADO VS COSTO CONTABLE PARA BOGOTA</a> <a title="Reporte de utilidad" href="../vistas/costosfom_1_excel.php?cot=<?php echo $_GET['cot'].'&col='.$filas.'&excel'; ?>"><img src="../imagenes/file_excel.png"></a>
                           <form name="buscarA" action="" method="post" enctype="multipart/form-data">
              <div align="right">
                  <button type="submit"> Ordenar filas de :</button> <input style="width:30px;" type="number" name="col" value="<?php if(isset($_POST['col'])){echo $_POST['col'];}else{echo '7';} ?>">
                   </div>  
          </form>
                            </section>
                 
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>