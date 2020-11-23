$(function(){
        $('#cant_servicio').change(function(){
            calculo();
        });
        $('#valor_servicio').change(function(){
            calculo();
        });
         $("#ancho_max").change(function(){
            var an = $("#an_max").val();
            var ancho = $("#ancho_max").val();
            if(parseInt(ancho)>parseInt(an)){
                $("#msg").val("El ancho es mayor al standar "+an);
                $("#ancho_max").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg").val('');
                 $("#ancho_max").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#alto_max").change(function(){
            var an = $("#al_max").val();
            var ancho = $("#alto_max").val();
            if(parseInt(ancho)>parseInt(an)){
                 $("#msg2").val("El alto es mayor al standar "+an);
                 $("#alto_max").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg2").val('');
                 $("#alto_max").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#ancho2").change(function(){
            var an = $("#an_max2").val();
            var ancho = $("#ancho2").val();
            if(parseInt(ancho)>parseInt(an)){
                $("#msg3").val("El ancho es mayor al standar "+an);
                $("#ancho2").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg3").val('');
                 $("#ancho2").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#alto2").change(function(){
            var an = $("#al_max2").val();
            var ancho = $("#alto2").val();
            if(parseInt(ancho)>parseInt(an)){
                 $("#msg4").val("El alto es mayor al standar "+an);
                 $("#alto2").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg4").val('');
                  $("#alto2").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#color_alum").change(function(){
            var col = $("#color_alum").val();
            var cot = $("#cotizacionx").val();
            var con = confirm("Esta seguro de cambiar el color de aluminio para esta cotizacion");
            if(con){
            $.ajax({
    		type: 'POST',
                data: 'col='+col+'&cot='+cot+'&cli=0',
                url: '../modelo/act_cot_color.php',
                success: function(data){
                    alert("Se han actualizado los colores para esta cotizacion. "+data);
                	window.location.href='../vistas/?id=new_fac&cot='+cot+'&cli=0';
                }
    		});
            }else{
                $("#color_alum").val('').focus();
                return false;
            }
        });
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
function compuestos(cot,cli,item,por,tipo){
    window.open("../vistas/?id=add_acc&cot="+cot+"&cli="+cli+"&mas="+item+"&por="+por+"&pagina=new_fac&tipo_cli="+tipo,"Compuestos","width=900 , height=700");
}
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
    var xye = 0;
    var tt = 0;
    function activar_boton(ct){
         var can = $("#cantidad_total").val();
          var ciu = $("#ciu").val();
           var cot = $("#cotizacionx").val();
           var gt = $("#gt").val();
        
        $("#rep").html("Generando "+ct+" de "+can);

        //if(parseInt(can)===parseInt(ct)){
                       $("#btn_report").attr("disabled", false);
                       $("#btn_report").html('Generar Reporte');
                       xye = 0;
                       $("#rep").html("Ok");
                       window.open('../vistas/form/reporte_costos.php?cot='+cot+'&ciudad='+ciu+'&gt='+gt, 'Reporte_Total', 'width=1100, height=600');
                   //}   
    }
        function reporte_itemsxd(id){
        var con = confirm("Desea Generar el reporte de costos? ");
        if(con){
              var can = $("#cantidad_total").val();
              $("#btn_report").attr("disabled", true);
              $("#btn_report").html('<img src="../imagenes/load.gif"> Generando..');
              
                var url = '../modelo/reporte_de_plantilla.php?cot='+id+'&reporte';
                console.log('cotizacion: '+id);
             $.ajax({    
                 type:'GET',
                 url: url,
                success: function(d){
                    console.log('Resultado de costo: '+d);
                   //window.open(url, 'Reporte'+id, 'width=100, height=100');
//                   if(parseInt(can)==parseInt(d)){
//                       $("#btn_report").html('Generar Reporte de Costo Materia Prima');
//                       $("#btn_report").attr("disabled", false);
//                       
                  
                  activar_boton(d);  
                }

            });
        }
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
        function calcu(id){
            $.ajax({
    		type: 'GET',
                data: 'item='+id,
                url: '../modelo/calcular_cotizacion_items.php',
                success: function(da){
                	alert(da);
                }
    		});
        }
        function resetFields() {
    	$("#vidrio_servicio_hidden").val("");
    	$("#espesor_servicio_hidden").val("");
    	$("#accesorio_servicio_hidden").val("");
    }
	function infoTipoServicio(id_tipo_servicio, tipo_servicio, valor_tipo_servicio) {
		$("#cant_servicio").val("").focus();
		$("#servicio_hidden").val(id_tipo_servicio);
		$("#servicio").val(tipo_servicio).attr("readonly", true);;
		$("#valor_servicio").val(valor_tipo_servicio);
		$("#valor_servicio_hidden").val(valor_tipo_servicio);
		$("#cant_servicio").focus();
	}
            function nuevo_servicio(){
               $("#servicio_hidden").val('');
               $("#servicio").attr("readonly", false).val('').focus(); 
            }
            function calculo(){
               var und = $("#valor_servicio").val();
               var can = $("#cant_servicio").val();
               var ser = $("#servicio_hidden").val();
                if(ser===''){
                    $("#msgs").html(' x 40% de utilidad');
                     var tot = (und / 0.6) * can;
                }else{
                     var tot = parseInt(und) * parseInt(can);
                     $("#msgs").html('');
                }
            
           
            $("#total").val(tot);
    }
