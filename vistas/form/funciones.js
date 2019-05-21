 
$(function(){
     $("#mostrar_tabla").html(mostrar_costo(1)); 
     $('#buscar_cat').change(function(){
             mostrar_costo(1);
     }); 
     $('#nombre').change(function(){
             mostrar_costo(1);
     });   
});
 
function mostrar_costo(page){
     var busc = $("#buscar_cat").val(); 
      var nomb = $("#nombre").val(); 
        $.ajax({
            type: 'GET',
            data: 'buscc='+busc+'&nombb='+nomb+'&page='+page,
            url: '../vistas/costos/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_costos(){ 
     var idcos = $("#id_costo").val(); 
     var desccos = $("#descripcos").val();
     var porccos = $("#porcencos").val();
     var operun = $("#operuno").val();
     var varun = $("#variuno").val();
     var opdos = $("#opedos").val();
     var vardos = $("#varidos").val();
     var totalsum = $("#suma_tot").val();
     var costvari = $("#variablescost").val();
     var catego = $("#catego_cost").val();
     var costosuma = $("#suma_costotal").val();
     var editar = $("#edit_valor").val();
     
    if(desccos===''){
         alert("descripciono");
        $("#descripcos").focus();
        return false;
    }
     if(porccos===''){
        alert("porcentaje");
        $("#porccos").focus();
        return false;
    }
         if(costosuma===''){
        alert("costo total suma?");
        $("#suma_costotal").focus();
        return false;
    }
        if(editar===''){
        alert("edita valor absoluto?");
        $("#edit_valor").focus();
        return false;
    }
  
       
      $("#btn_guardar").attr("disabled",true);
    
    
        $.ajax({
            type: 'GET',
            data: 'idcotn='+idcos+'&desccosc='+desccos+'&porccosc='+porccos+'&operunc='+operun+'&varunc='+varun+'&opdosc='+opdos+'&vardosc='+vardos+'&totalsumc='+totalsum+'&costvaric='+costvari+'&categoc='+catego+'&costosumac='+costosuma+'&editarv='+editar+'&sw=1',
            url: '../vistas/costos/acciones.php', 
            success: function(resultado){
                $("#id_costo").val(resultado); 
                alert("Se guardo con exito");
                 $("#btn_guardar").attr("disabled",false);
                mostrar_costo(1);
            }
           });
}

function limpiar_costo(){
$("#id_costo").val(''); 
$("#catego_cost").val('');
$("#descripcos").val('');
$("#porcencos").val('');
$("#operuno").val('');
$("#variuno").val('');
$("#opedos").val('');
$("#varidos").val('');
$("#suma_tot").val('');
$("#variablescost").val('');
$("#suma_costotal").val('');
}

function nuevo(){
    limpiar_costo();
}

function editar(id){
     $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/costos/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
 $("#id_costo").val(p[0]); 
 $("#catego_cost").val(p[1]);
 $("#descripcos").val(p[2]);
 $("#porcencos").val(p[3]);
 $("#operuno").val(p[4]);
 $("#variuno").val(p[5]);
 $("#opedos").val(p[6]);
 $("#varidos").val(p[7]);
 $("#suma_tot").val(p[8]);
 $("#variablescost").val(p[9]);
  $("#suma_costotal").val(p[10]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/costos/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_costo(1);
            }
           });
       }
}
function ver_planilla(id){
    window.open("../vistas/costos/planilla_costo.php?archivo="+id,"visualiza","width=550px,height=600px");  
}
function andamio(){
     var anda = $("#mp_andamio").val();
     $("#mp_andamio2").val(anda);
     calcular();
}
function recalcular(id){
     var valor = $("#operacionuno"+id).val();

     $("#operaciondos"+id).val(valor);
     var precio = $("#precio_base_1").val();
     var precio2 = $("#precio_base_2").val();
     var total = ((valor) / precio) * 100;
     $("#porcen"+id).val(total);
     
     calcular();
}
function calcular(){
    
            var total = $("#total_costo_1").val();    
            var alu = $("#mp_aluminio").val();
            var p_alu = $("#por_alum").val();
            
            var porcentaje_transporte = $("#porcentaje_transporte").val();
            
            var a1 = parseInt((alu / ((100-parseInt(p_alu))/100))-parseInt(alu));
            $("#desp_alum").val(a1.toFixed(2));
            $("#desp_alum2").val(a1.toFixed(2));

            var vid = $("#mp_vidrio").val();
            var p_vid = $("#por_vid").val();
            var a2 = parseInt((vid / ((100-parseFloat(p_vid))/100))-parseFloat(vid));
            $("#desp_vidrio").val(a2.toFixed(2));
            $("#desp_vidrio2").val(a2.toFixed(2));

            var acc = $("#mp_accesorios").val();
            var adi = $("#mp_adicionales").val();

            var fab = $("#mp_fabricacion").val();
            var ins = $("#mp_instalacion").val();
            
            var poli = $("#mp_polimask").val();
            var anda = $("#mp_andamio").val();
  

            var kit = $("#mp_kit").val();
            var t_acc = parseFloat(acc) + parseFloat(adi) + parseFloat(kit);
            var p_acc = $("#por_acc").val();
            var a3 = Math.round((t_acc / ((100-parseFloat(p_acc))/100))-parseFloat(t_acc));
            $("#desp_accesorios").val(a3.toFixed(2));
            $("#desp_accesorios2").val(a3.toFixed(2));

            var total_costo = parseFloat(a1) + parseFloat(a2) + parseFloat(a3) + parseFloat(alu) + parseFloat(vid) + parseFloat(t_acc) + parseFloat(fab) + parseInt(ins) + parseInt(poli) + parseInt(anda);
            $("#total_costo_1").val(total_costo.toFixed(2));
            $("#total_costo_2").val(total_costo.toFixed(2));

            var total_costo_fijos_1 = $("#total_costo_fijos_1").val();
            var precio_base = total_costo / ((100 - total_costo_fijos_1)/100 );
            //$precio_base = $costo_totales / ((100-$suma_por) / 100);
            
            var ganancia_2 = $("#ganancia_2").val();

            var precio_base_2 = precio_base * (ganancia_2 / 100);
            precio_base_2 = precio_base_2 + precio_base;
            
            $("#precio_base_1").val(precio_base.toFixed(2));
            $("#precio_base_2").val(precio_base_2.toFixed(2));
            
            
            
            
            var total_utilidad = 0;
            var total_p_comision = 0;
            var suma_comision = 0;
            var suma_costo = 0;
            var total_transporte = 0;
    $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var por = $("#porcen"+id).val();
                                var util = $("#suma_utilidad"+id).val();
                                var transporte = $("#suma_transporte"+id).val();
                                if(transporte==='Si'){
                                    total_transporte +=(por/100);
                                }
                                var p_comision = $("#p_comision"+id).val();
                                if(p_comision==='Si'){
                                     total_p_comision += ((por/100));
                                     suma_comision += parseFloat(por);
                                }
                                var por_to = $("#por_total"+id).val();
                                
                                
//                              $("#sub_total2"+(parseInt(id) + 1)).val(tp);
//                              $("#sub_total3"+(parseInt(id) + 1)).val(tp);
                                var base = $("#base"+id).val();
                              //console.log('base'+base);
                                
                                var t = (precio_base * por)/100;
                                
                                if(parseInt(base)===2){
                                    var t_base = ((precio_base_2 * por)/100) - t ;
                                    
                                }else{
                                    var t_base = 0;
                                }
                                suma_costo += t_base;
                                
                                if(util=='Si'){
                                    total_utilidad += parseFloat(t) + parseFloat(t_base);
                                    
                                }
                                
                                
                                $("#operacionuno"+id).val(t.toFixed(2));
                                $("#operaciondos"+id).val(t.toFixed(2));
                                
                                if(por_to!=='undefined'){
                                    
                                      var tp = (precio_base * por_to)/100;
                                      var tp2 = ((precio_base * por_to)/100);
                                      
                                      $("#sub_total2"+id).val(tp.toFixed(2));
                                      $("#sub_total3"+id).val(tp2.toFixed(2));
                                  
                                }
                                
			});
            var pvbi_1 = (precio_base * (total_transporte)) + parseFloat(precio_base);
            var pvbi_2 = (precio_base * (total_transporte)) + parseFloat(precio_base_2) ;
            console.log((porcentaje_transporte/100));
            
            
            
            $("#precio_venta_base_1").val(pvbi_1.toFixed(2));
            $("#precio_venta_base_2").val(pvbi_2.toFixed(2));
                        
                           var utilidad_neta = parseFloat(precio_base_2) - parseFloat(total_costo) - parseFloat(total_utilidad + parseFloat(suma_costo));
               console.log(parseFloat(precio_base_2) +'-'+ parseFloat(total_costo)+ '-'+ parseFloat(total_utilidad +'+'+ parseFloat(suma_costo)));
                          $("#utilidad_1").val(utilidad_neta.toFixed(2));
                          $("#utilidad_2").val(utilidad_neta.toFixed(2));
                        
                          var ganancia_1 = $("#ganancia_1").val();
                          var precio_base_1 = $("#precio_base_1").val();
                          
                          
                          var gan_1 = precio_base_1 * (ganancia_1 /100);
                          $("#ganancia_esperada_1").val(gan_1.toFixed(2));
                         
                          var ganancia_2 = $("#ganancia_2").val();
                          var precio_venta_base_2 = $("#precio_venta_base_2").val();
                          var gan_2 = precio_venta_base_2 * (ganancia_2 /100);
                          
                          $("#Ganancia_real").val(utilidad_neta.toFixed(2));
                          var porcentaje_ganancia = (utilidad_neta / precio_base_2)*100;
                          $("#por_ganancia_real").val(porcentaje_ganancia.toFixed(2));


                          

                         
                          

                          var com = precio_base_2 * total_p_comision;
                          $("#comision").val(com.toFixed(2));
                          $("#tabla_comision").val(suma_comision);
                     $.ajax({
                            type:'GET',
                            data:'por='+suma_comision+'&sw=4',
                            url:'acciones.php',
                            success : function(incremento){
                               
                               var t_ganancia = (precio_venta_base_2 * (incremento/100)) + parseFloat(gan_2);
                               
                               var ajuste_precio = t_ganancia - utilidad_neta;
                              $("#ajuste").val(ajuste_precio.toFixed(2));
                               var por_ajuste =  (ajuste_precio / precio_base_2) * 100;
                              $("#por_ajuste").val(por_ajuste.toFixed(2));
                          
                               $("#ganancia_esperada_2").val(t_ganancia.toFixed(2));
                               var precio_venta_total = parseFloat(precio_venta_base_2) + parseFloat(com) + parseFloat(ajuste_precio);
                                console.log((precio_venta_base_2)+' +' + (com)+' +' + (ajuste_precio));
                                $("#precio_venta").val(precio_venta_total.toFixed(2));
                                 $("#venta").val(number_format(precio_venta_total));
                                 var precio = $("#presupuestox").val();
                                 var dif = precio_venta_total - precio;
                                 console.log(dif);
                                 $("#diferencia").val(number_format(dif));
                                 var pt = ((precio_venta_total / precio) - 1) * 100;
                                 $("#por_dif").val(pt.toFixed(2));
                                 $("#presupuesto").val(number_format(precio));
                                 
                            }
                      });
                          
                           
                           
                                                     
}



function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}
