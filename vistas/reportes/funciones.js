$(function(){
      mostrar(1);
      $('#cot').change(function(){
         mostrar(1);
       }); 
        $('#cli').change(function(){
         mostrar(1);
       }); 
        $('#est').change(function(){
         mostrar(1);
       }); 
        $('#ciu').change(function(){
         mostrar(1);
       }); 
        $('#pre').change(function(){
         mostrar(1);
       }); 
        $('#pref').change(function(){
         mostrar(1);
       }); 
        $('#ase').change(function(){
         mostrar(1);
       }); 
        $('#obr').change(function(){
         mostrar(1);
       }); 
       $('#ord').change(function(){
         mostrar(1);
       }); 
       $('#orden').change(function(){
         mostrar(1);
       }); 
       $('#f2').change(function(){
         mostrar(1);
       }); 
       $('#lista').change(function(){
         mostrar(1);
       }); 
       $('#f1').change(function(){
         mostrar(1);
       }); 
       $('#seg').change(function(){
         mostrar(1);
       });
       $('#fuente').change(function(){
         mostrar(1);
       })
       $('#ver_ciu').click(function(){
         mostrar(1);
       }); 
       $('#ver_est').click(function(){
         mostrar(1);
       }); 
       $('#ver_ase').click(function(){
         mostrar(1);
       }); 
       $('#ver_dir').click(function(){
         mostrar(1);
       }); 
       $('#ver_opc').click(function(){
         mostrar(1);
       }); 
       $('#ver_fec').click(function(){
         mostrar(1);
       }); 
        $('#ver_cot').click(function(){
         mostrar(1);
       });
       $('#ver_tip').click(function(){
         mostrar(1);
       });
        $('#bus_tip').click(function(){
         mostrar(1);
       });
        $('#sin_lista').click(function(){
         mostrar(1);
       });
});

function mostrar(page){
    var cot = $("#cot").val();
    var cli = $("#cli").val();
    var est = $("#est").val();
    var ciu = $("#ciu").val();
    var pre = $("#pre").val();
    var pref = $("#pref").val();
    var ase = $("#ase").val();
    var obr = $("#obr").val();
    var ord = $("#ord").val();
    var orden = $("#orden").val();
    var ano = $("#f1").val();
    var mes = $("#f2").val();
    var lista = $("#lista").val();
    var vciu = $("#ver_ciu").is(":checked");
    var vdir = $("#ver_dir").is(":checked");
    var vest = $("#ver_est").is(":checked");
    var vase = $("#ver_ase").is(":checked");
    var vfec = $("#ver_fec").is(":checked");
    var vopc = $("#ver_opc").is(":checked");
    var vcot = $("#ver_cot").is(":checked");
    var bus_tip = $("#bus_tip").val();
    var ver_tip = $("#ver_tip").is(":checked");
    var fuente = $("#fuente").val();
     var sin_lista = $("#sin_lista").val();
    var seg = $("#seg").val();
    if(seg=='1'){
        url = 'tabla_seg.php';
    }else{
        url = 'tabla.php';
    }


    $.ajax({
            type: 'POST',
            data: 'cot='+cot+'&fuente='+fuente+'&pref='+pref+'&bus_tip='+bus_tip+'&sin_lista='+sin_lista+'&vcot='+vcot+'&seg='+seg+'&lista='+lista+'&vciu='+vciu+'&vdir='+vdir+'&vest='+vest+'&vase='+vase+'&vfec='+vfec+'&vopc='+vopc+'&ano='+ano+'&mes='+mes+'&cli='+cli+'&obr='+obr+'&est='+est+'&pre='+pre+'&ase='+ase+'&ciu='+ciu+'&ord='+ord+'&orden='+orden+'&ver_tip='+ver_tip+'&page='+page,
            url: url, 
            success: function(resultado){
                //var p = eval(resultado);
                $("#mostrar_tabla").html(resultado);  
//                $("#mostrar_foot").html(p[1]); 
            }
           });
}
function mostrar_seguimientos(ra,obra){
        $("#rel").val(ra);
        var des = $("#des_seg").val();
        $("#se").html('<button type="button" class="btn btn-success" onclick="seguir('+ra+')">Seg. Principal</button>');
     $("#titulo_obra").html(obra);
        $.ajax({
            type: 'GET',
            data: 'rad='+ra,
            url: 'seguimientos.php',
            success: function(resultado){
                 $("#mostrar_detalles").html(resultado);
            }
  }); 
} 
function verseg(ra,est,obra){
    $("#rel").val(ra);
    $("#des_seg").val('');
    $("#id_seguimiento").val(ra);
    $("#est_seg").val(est);
    $("#obra_seg").val(obra);
}
function actualizar(cot){
    var est = $("#verseg"+cot).is(":checked");
    $.ajax({
            type: 'GET',
            data: 'cot='+cot+'&est='+est+'&sw=3',
            url: 'acciones.php',
            success: function(){
                 //$("#mostrar_detalles").html(resultado);
            }
  }); 
}
function cambiar_estado(){
    var id = $("#id_seguimiento").val();
    var est = $("#est_seg").val();
    var obra = $("#obra_seg").val();
    var c = confirm("Esta seguro de cambiar el estado del seguimiento?");
    if(c)
    $.ajax({
            type: 'GET',
            data: 'cot='+id+'&est='+est+'&sw=4',
            url: 'acciones.php',
            success: function(d){
                 alert("Se ha cambiado el estado con exito" +d);
                 mostrar_seguimientos(id,obra);
            }
  }); 
}
function add_seg(){
     var rel = $("#rel").val();
     var des = $("#des_seg").val();
     var id= $("#id_sg").val();
     if(des===''){
         alert("No hay nada escrito");
        $("#des_seg").focus();
        return false;
    }
     
     $.ajax({
            type: 'GET',
            data: 'rel='+rel+'&des='+des+'&id_sg='+id+'&sw=2',
            url: 'acciones.php',
            success: function(resultado){
                 alert(resultado);
                 mostrar_seguimientos(rel);
                 $("#des_seg").val('');
            }
  }); 
}
function segui_nuevo(rad){
       window.open("../reportes/edit_seg.php?rad="+rad+"","seg1",'width=500,height=500');  
}
function editar_s(rad,id,obsr){
       window.open("../reportes/edit_seg.php?rad="+rad+"&id="+id+"&obsr="+obsr+"","seg1",'width=500,height=500');  
}
function nuev_seg(){
     var rel = $("#rel").val();
     var des = $("#des_seg").val();
     var id= $("#id_sg").val();
     if(des===''){
         alert("No hay nada escrito");
        $("#des_seg").focus();
        return false;
    }
     
     $.ajax({
            type: 'GET',
            data: 'rel='+rel+'&des='+des+'&id_sg='+id+'&sw=2',
            url: 'acciones.php',
            success: function(resultado){
                 alert(resultado);
                 window.opener.mostrar_seguimientos(rel);
                 $("#des_seg").val('');
                 window.close();
            }
  }); 
}

function cot(cot){
    //http://172.16.0.40/laboratorio/cotizacion/vistas/imp_cotizacion.php?cot=49915&c=&total_item=100&col=7&ciudad=Barranquilla
     window.open("../../vistas/imp_cotizacion.php?cot="+cot+"&c=0&total_item=100&col=7&ciudad=Barranquilla","muestrados","width=1200, height=600");
}

function papelera(id,c){
      var v = confirm("Esta seguro de quitar de la lista?");
     if(v){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&c='+c+'&sw=1',  //
            url: 'acciones.php', //
            success: function(resultado){
                alert("Se quito de la lista");
                mostrar(1);
            }
           });
       }
    
}

function m_cost(cot,vt){
     window.open("../../vistas/form/reporte_costos.php?gt="+vt+"&cot="+cot,"muestrare","width=900, height=600")
}

 function seguir(cot){
             window.open('../seguimientos/index.php?cotis='+cot,'seg1','width=1000,height=600');  
 }