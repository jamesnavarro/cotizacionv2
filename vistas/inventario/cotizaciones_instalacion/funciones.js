$(function() {
mostrarCot(1);
    $("#cot").change(function(){
        mostrarCot(1);
    });
    $("#nom").change(function(){
        mostrarCot(1);
    });
    $("#obr").change(function(){
        mostrarCot(1);
    });
    $("#reg").change(function(){
        mostrarCot(1);
    });
     $("#se").change(function(){
        mostrarCot(1);
    });
    $("#estado").change(function(){
        mostrarCot(1);
    }); 
    $("#freg").change(function(){
        mostrarCot(1);
    });
    $("#precio").change(function(){
        mostrarCot(1);
    });
});
function mostrarCot(page) {
		cot = $("#cot").val();
		nom = $("#nom").val();
		obr = $("#obr").val();
		reg = $("#reg").val();
                ana = $("#se").val();
                est = $("#estado").val();
                freg = $("#freg").val();
                pre = $("#precio").val();
                $("#load").html('<img src="../images/load.gif"> Cargando...');
		$.post("inventario/cotizaciones_instalacion/mostrar_cotizaciones.php", {
                    cot:cot, nom:nom, obr:obr, reg:reg, page:page,ana:ana,est:est,freg:freg,pre:pre
                },
                function(data) {
			$("#cotizacione").html(data);
                        $("#load").html('');
		});
}
function abrir_cotizacion(id){
    var c = confirm("Esta seguro de abrir la cotizacion");
    if(c){
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=1',
        url:'inventario/cotizaciones/acciones.php',
        success : function(){
            alert("Se ha abierto la cotizacion con exito");
            mostrarCot(1);
        }
    });
    }
}
function version_cotizacion(id){
    var c = confirm("Esta seguro de sacar una version de esta cotizacion?");
    if(c){
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=2',
        url:'inventario/cotizaciones_instalacion/acciones.php',
        success : function(v){
            alert("Se ha generado una version nueva No."+v);
            mostrarCot(1);
        }
    });
    }
}
function copiar_cotizacion(id){
    var c = confirm("Esta seguro de copiar esta cotizacion?");
    if(c){
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=3',
        url:'inventario/cotizaciones/acciones.php',
        success : function(v){
            alert("Se ha generado una copia nueva No."+v);
            mostrarCot(1);
        }
    });
    }
}
function ver_desglose1(cot){
             window.open('../vistas/inventario/desgloses/presolicitud.php?cot='+cot,'seg1','width=1200,height=900');  
        }
function ver_desglose2(cot){
             window.open('../vistas/inventario/desgloses/presolicitud_acc.php?cot='+cot,'seg1','width=1200,height=900');  
        }
function ver_desglose3(cot){
     window.open('../vistas/inventario/desgloses/presolicitud_vid.php?cot='+cot,'seg1','width=1200,height=900');  
}





