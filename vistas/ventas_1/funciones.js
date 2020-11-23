$(function() {
    //1. buscar datos de cliente
    //esta es una prueba de gibhub
      $("#doc").keyup(function () {
            buscar_ced();			
            });
      $("#proa").change(function () {
            mostrar_ajustes(1);           
            });
      $("#espa").change(function () {
            mostrar_ajustes(1);           
            });
        $("#v_color").change(function () {
            var m = $("#v_med").val();
                if(m==='1'){
                    $("#v_med_real").val(1);
                     $("#v_can").focus();
                }else{
                     $("#v_med_real").focus();
                }
            });
        $("#v_med_real").change(function () {
                $("#v_can").focus();    
            }); 
            $("#v_can").change(function () {
                $("#v_por").attr("disabled", false); 
                $("#v_por").focus();
                calcular_perfil();
            });
            $("#v_por").change(function () {
                $("#btn_ven").attr("disabled", false).focus();
                var max = $("#v_max").val();
                var por = $("#v_por").val();
                if(parseInt(por) < parseInt(max)){
                    alert("El descuento permitido para este articulo es de "+max+" % ");
                     $("#v_por").val('').focus();
                    return false;
                   
                }
                calcular_perfil();
            });
      //2. buscar codigo del producto
        $("#cod").keyup(function () {
            var cod = $("#cod").val();
            $.ajax({
            post:'GET',
            data:'cod='+cod+'&sw=2',
            url:'../vistas/ventas_1/acciones.php',
            success:function(d){
                var p = eval(d);
                $("#idp").val(p[0]);
                $("#des").val(p[1]);
                $("#per").val(p[4]);
                $("#boq").val(p[5]);
               
                if(p[4]===1){
                    $("#per").attr("disabled", false);
                }else{
                     $("#per").attr("disabled", true);
                }
                if(p[5]===1){
                    $("#boq").attr("disabled", false);
                }else{
                     $("#boq").attr("disabled", true);
                }
                if(p[6]>1){
                    var ca = prompt("Digite la contidad de laminas");
                    if(ca){
                        can = parseInt(ca);
                        $("#hoja").val(can);
                        if(can===2 || can===3 || can===4 || can===5){
                    if(can===2){
                         $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();"  placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();"> <input type="hidden" id="idvh3"><input type="hidden" id="vidh3" style="width: 20px" onclick="vidrioss3();"> <input type="hidden" id="idvh4"><input type="hidden" id="vidh4" style="width: 20px" onclick="vidrioss4();">');
                    }else if(can===3){
                          $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();"  placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();"  placeholder="2"> <input type="hidden" id="idvh3"><input type="text" id="vidh3" style="width: 20px" onclick="vidrioss3();" placeholder="3"> <input type="hidden" id="idvh4"><input type="hidden" id="vidh4" style="width: 20px" onclick="vidrioss4();">');
                    }else if(can===4){
                            $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();" placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();" placeholder="2"> <input type="hidden" id="idvh3"><input type="text" id="vidh3" style="width: 20px" onclick="vidrioss3();"  placeholder="3"> <input type="hidden" id="idvh4"><input type="text" id="vidh4" style="width: 20px" onclick="vidrioss4();" placeholder="4">');
                    }else if(can===5){
                            $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();" placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();" placeholder="2"> <input type="hidden" id="idvh3"><input type="text" id="vidh3" style="width: 20px" onclick="vidrioss3();"  placeholder="3"> <input type="hidden" id="idvh4"><input type="text" id="vidh4" style="width: 20px" onclick="vidrioss4();" placeholder="4">  <input type="hidden" id="idvh4"><input type="text" id="vidh5" style="width: 20px" onclick="vidrioss5();" placeholder="5">');
                    }
                      }else{
                         alert("debes de digitar un valor valido entre 2 y 4");
                         return false;
                       }
                   
                   }else{
                       return false;
                   }
                }else{
                    $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 80px" onclick="vidrios();"> <input type="hidden" id="idvh2"><input type="hidden" id="vidh2" style="width: 20px" onclick="vidrioss2();"> <input type="hidden" id="idvh3"><input type="hidden" id="vidh3" style="width: 20px" onclick="vidrioss3();"> <input type="hidden" id="idvh4"><input type="hidden" id="vidh4" style="width: 20px" onclick="vidrioss4();">');
                    $("#hoja").val('1');
                }
            } 
        });			
            });
            //ventana emergente de ciudades x municipio
            $("#ciu").click(function () {
                var ciu = $("#ciu").val();
                var dep = $("#dep").val();
                if(dep===''){
                    alert("Debe escojer el departamento");
                    $("#dep").focus();
                    return false;
                }
                 window.open("../vistas/municipio.php?muni="+dep,"terceros","width=500,height=400");
            });
            // si le dan clic en la caja de texto abren la ventana emergente de la lista de vidrios
             $("#vid").click(function () {
                vidrios();
            });
            //ventanas emergente de vidrios si digitan el codiggo
              $("#vid").keyup(function () {
                var cod = $("#idp").val();
                if(cod===''){
                    alert("Debe escojer el vidrio primero");
                    $("#cod").focus();
                    return false;
                }
                 window.open("../combos/span_vidrio1.php","terceros","width=500,height=400");
            });
            //saltos de casilla de texto
            $("#ancho").change(function () {
                $("#alto").focus();
                var cant = $("#cant").val();
                if(cant!==''){
                   cot();
                }
            });
            $("#ser").change(function () {
                $("#alto").focus();
                var ser = $("#ser").val();
                 var cot = $("#idcot").val();
                 var max = $("#max").val();
                if(ser==='0'){
                     var t = max * (-1);
                       if(t > 40){
                           $("#desc").val(max);
                       }else{
                           $("#desc").val('');
                       }
                    $("#desc").attr("disabled", false);
                }else{
                     $("#desc").val('0');
                     $("#desc").attr("disabled", true);
                }
                if(cot!==''){
                    mostrar_items(cot);
                }
               
            });
            $("#doc").change(function () {
                var idc = $("#idc").val();
                if(idc!==''){
                    $("#continuar").attr("disabled", false);
                }else{
                     $("#continuar").attr("disabled", true);
                }
                
            });
            $("#alto").change(function () {
                $("#cant").focus();
                var cant = $("#cant").val();
                if(cant!==''){
                   cot();
                }
            });
            $("#per").change(function () {
                $("#cant").focus();
                var cant = $("#cant").val();
                if(cant!==''){
                   cot();
                }
            });
            $("#cant").change(function () {
                cot();
                $("#desc").focus();
                 $("#bot").attr("disabled", false);
            });
            
            $("#cod").change(function () {
                var idp = $("#idp").val();
                if(idp!==''){
                   $("#vid").focus();
                }
            });
            $("#desc").change(function () {
                var desc = $("#desc").val();
                var piva = $("#pivaOut").val();
                var max = $("#max").val();
                var ser = $("#ser").val();
                if(ser==='0'){
                    if( parseInt(desc) < parseInt(max) ){
                        alert("Supera el descuento maximo autorizado para el cliente. ");
                        $("#desc").val('0');
                        return false;
                    }
                }
                cot();
//                $.ajax({
//                    type:'GET',
//                    data:'desc='+desc+'&piva='+piva+'&sw=4',
//                    url:'../vistas/ventas_1/acciones.php',
//                    success : function(t){
//                        $("#piva").val(t);
//                         $("#bot").focus();
//                         
//                    }
//                });
            });
            $("#espesor").change(function () {
                ajuste_referencias();
            });
            $("#ajuste").change(function () {
                var a = $("#precio").val();
                var b = $("#ajuste").val();
                var c = parseInt(a) + parseInt(b);
                $("#unidad").val(c);
            });
            $("#unidad").change(function () {
                var a = $("#precio").val();
                var b = $("#unidad").val();
                var c = parseInt(b) - parseInt(a);
                $("#ajuste").val(c);
            });

});
function agregar_ven(){
    var cot = $("#idcot").val();
    var cod = $("#v_cod").val();
    var id = $("#v_id").val();
    var descri = $("#v_des").val();
    var col = $("#v_color").val();
    var med = $("#v_med_real").val();
    var can = $("#v_can").val();
    var pre = $("#v_vund").val();
    var pre_r = $("#v_vund_real").val();
    var neto = $("#v_vtot").val();
    var tota = $("#v_pagar").val();
    var des = $("#v_por").val();
    var m = $("#v_med").val();
    
    if(cot===''){
        alert("Debes llenar los datos para generar la cotizacion.");
        return false;
    }
    if(cod===''){
        alert("Debes de escoger un producto.");
        return false;
    }
    if(col===''){
        alert("Debes de escoger un color.");
        return false;
    }
    if(can===''){
        alert("Debes de digitar la cantidad.");
        return false;
    }
    if(des===''){
        alert("Debes de digitar el porcentaje");
        return false;
    }
    $("#btn_ven").attr("disabled", true).html("<img src='../imagenes/load.gif'> Cargando..");
    $.ajax({
                    type:'GET',
                    data:'cot='+cot+'&cod='+cod+'&id='+id+'&descri='+descri+'&col='+col+'&med='+med+'&pre='+pre+'&can='+can+'&pre_r='+pre_r+'&neto='+neto+'&tota='+tota+'&des='+des+'&m='+m+'&sw=20',
                    url:'../vistas/ventas_1/acciones.php',
                    success : function(t){
                          alert("Se ha guardado con exito .."+t);
                          mostrar_ventas_1();
                          limpiar_vnt();
                          $("#btn_ven").attr("disabled", false).html("Agregar");
                    }
                });
}
function mostrar_ventas_1(){
    var cot = $("#idcot").val();
        $.ajax({
                    type:'GET',
                    data:'cot='+cot+'&sw=21',
                    url:'../vistas/ventas_1/acciones.php',
                    success : function(t){
                          $("#mostrar_ventas_1").html(t);
                    }
                });
}
function limpiar_vnt(){
 
    var cod = $("#v_cod").val('');
    var id = $("#v_id").val('');
    var descri = $("#v_des").val('');
    var col = $("#v_color").val('');
    var med = $("#v_med_real").val('');
    var can = $("#v_can").val('');
    var pre = $("#v_vund").val('');
    var pre_r = $("#v_vund_real").val('');
    var neto = $("#v_vtot").val('');
    var tota = $("#v_pagar").val('');
    var des = $("#v_por").val('');
    var m = $("#v_med").val('');
    $("#btn_buscar_vnt").focus();
}
function del_ventas_1(id){
    var c = confirm("Esta seguro de eliminar este registro ? ");
    if(c){
        $("#btn_del_ven").attr("disabled", true).html("<img src='../imagenes/load.gif' style='width:20px'> Eliminando..");
            $.ajax({
                    type:'GET',
                    data:'id='+id+'&sw=22',
                    url:'../vistas/ventas_1/acciones.php',
                    success : function(t){
                        if(t==='1'){
                            alert("se ha eliminado con exito ");
                        }else{
                            alert("Ocurrio un error, intentelo de nuevo ");
                        }
                          mostrar_ventas_1();
                    }
                });
            }
}
function calcular_perfil(){
    var can = $("#v_can").val();
    var pre = $("#v_vund").val();
    var med = $("#v_med_real").val();
    var des = $("#v_por").val();
    var m = $("#v_med").val();
    if(m==='1'){
        var medr = 1;
    }else{
       var medr = med / 1000;
    }
    var n = medr * parseInt(pre);
    $("#v_vund_real").val(n);
    
    t = n * can;
    d = t * (des / 100);
    tot = parseInt(t) + parseInt(d);
    iva = tot * 0.19;
    total = parseInt(tot) + parseInt(iva);
    $("#v_vtot").val(tot);
    $("#v_pagar").val(total);
}
//function calcular_perfil_item(id){
//    var can = $("#v_can"+id).val();
//    var pre = $("#v_und"+id).val();
//    var med = $("#v_med"+id).val();
//    var des = $("#v_por"+id).val();
//    var m = $("#v_med"+id).val();
//    if(m==='1'){
//        var medr = 1;
//    }else{
//       var medr = med / 1000;
//    }
//    var n = medr * parseInt(pre);
//    $("#v_und"+id).val(n);
//    
//    t = n * can;
//    d = t * (des / 100);
//    tot = parseInt(t) + parseInt(d);
//    iva = tot * 0.19;
//    total = parseInt(tot) + parseInt(iva);
//    $("#v_net"+id).val(tot);
//    $("#v_tot"+id).val(total);
//}
function ajustar(){
                var pre = $("#precio").val();
                var aju = $("#ajuste").val();
                var und = $("#unidad").val();
                var ref = $("#ref").val();
                var esp = $("#espesor").val();
                if(ref==''){
                    alert("Seleccione alguna referencia");
                    $("#ref").focus();
                    return false;
                }
                if(esp==''){
                    alert("Seleccione algun espesor");
                    $("#espesor").focus();
                    return false;
                }
                if(pre==''){
                    alert("Digite el precio");
                    $("#precio").focus();
                    return false;
                }
                $.ajax({
                    type:'GET',
                    data:'pre='+pre+'&aju='+aju+'&und='+und+'&ref='+ref+'&esp='+esp+'&sw=12',
                    url:'acciones.php',
                    success : function(t){
                        if(t==1){
                            alert("Se ha agregado exitosamente ");
                        }else{
                            alert("Se ha actualizado exitosamente ");
                        }
                        var pre = $("#precio").val('');
                        var aju = $("#ajuste").val('');
                        var und = $("#unidad").val('');
                        mostrar_ajustes(1); 
                        
                        
                    }
                });
}

function mostrar_ajustes(page){
           var a = $("#proa").val();
      var b = $("#espa").val();
     $.ajax({
                    type:'GET',
                    data:'pro='+a+'&esp='+b+'&sw=13',
                    url:'acciones.php',
                    success : function(t){
                         $("#mostrar_tabla").html(t);
                        
                    }
                });
}
  function eliminar(id){
        var con = confirm("Esta seguro de eliminar este item?");
        if(con){
            $.ajax({
                type:'GET',
                data:'id='+id+'&sw=16',
                url:'acciones.php',
                success : function(){
                    alert("Se elimino correctamente.");
                    mostrar_ajustes(1);
                }
            });
        }
    }
function vidrios(){
    var cod = $("#idp").val();
               
                if(cod===''){
                    alert("Debe escojer el vidrio primero");
                    $("#cod").focus();
                    return false;
                }
                 window.open("../combos/span_vidrio1.php","terceros","width=500,height=400");
}
function vidrioss2(){
    var cod = $("#idp").val();
               
                if(cod===''){
                    alert("Debe escojer el vidrio primero");
                    $("#cod").focus();
                    return false;
                }
                 window.open("../combos/span_vidrio2.php","terceros","width=500,height=400");
}
function listado(){
    var cod = $("#idp").val();
                 window.open("../vistas/ventas_1/listado.php","ajustes","width=1000,height=600");
}
function perfiles(){
         window.open("../vistas/materiales_ventas_1.php","ajustes","width=1000,height=600");
}
function kits(){
         window.open("../vistas/kit_ventas_1.php","ajustes","width=1000,height=600");
}
function datos_ventas_1(des,id,ref,med,pre,max){
    $("#v_cod").val(ref);
    $("#v_des").val(des);
    $("#v_id").val(id);
    $("#v_vund").val(pre);
    $("#v_med").val(med);
    $("#v_max").val(max);
    $("#v_color").focus();
    $("#v_can").attr("disabled", false);
}
function vidrioss3(){
    var cod = $("#idp").val();
               
                if(cod===''){
                    alert("Debe escojer el vidrio primero");
                    $("#cod").focus();
                    return false;
                }
                 window.open("../combos/span_vidrio3.php","terceros","width=500,height=400");
}
function vidrioss4(){
    var cod = $("#idp").val();
               
                if(cod===''){
                    alert("Debe escojer el vidrio primero");
                    $("#cod").focus();
                    return false;
                }
                 window.open("../combos/span_vidrio4.php","terceros","width=500,height=400");
}
function vidrioss5(){
    var cod = $("#idp").val();
               
                if(cod===''){
                    alert("Debe escojer el vidrio primero");
                    $("#cod").focus();
                    return false;
                }
                 window.open("../combos/span_vidrio5.php","terceros","width=500,height=400");
}
//http://172.16.0.40/master/vistas/imprimir_carnet.php?cot=137
function agregar_item(){
         var idp = $("#idp").val();
         var idc = $("#idc").val();
         var cot = $("#idcot").val();
        var idv = $("#idv").val();
        var idv2 = $("#idvh2").val();
        var idv3 = $("#idvh3").val();
        var idv4 = $("#idvh4").val();
        var idv5 = $("#idvh5").val();
        var ancho = $("#ancho").val();
        var alto = $("#alto").val();
        var cant = $("#cant").val();
        var per = $("#per").val();
        var boq = $("#boq").val();
        var desc = $("#desc").val();
        var rep = $("#rep").val();
        var pel = $("#pel").val();
        var ins = $("#ins").val();
        var p4 = $("#p4").val();
        var p5 = $("#p5").val();
        var p6 = $("#p6").val();
        var p7 = $("#p7").val();
        var ubc = $("#ubc").val();
        var obse = $("#obse").val();
        var ajuste = $("#ajuste").val();
        var adi = $("#adi_per_boq").val();
        if(cot===''){
            alert("debes llenar los datos del cliente para poder agregar los items");
            $("#doc").val();
            return false;
        }
        if(ancho===''){
             alert("Digite el ancho del vidrio");
             $("#ancho").focus();
             return false;
         }
         if(alto===''){
             alert("Digite el alto del vidrio");
             $("#alto").focus();
             return false;
         }
         if(cant===''){
             alert("Digite la cantidad de vidrios");
             $("#cant").focus();
             return false;
         }
         if(per===''){
             alert("Digite las cantidades de Perforaciones");
             $("#per").focus();
             return false;
         }
         if(boq===''){
             alert("Digite las cantidades de Boquete");
             $("#boq").focus();
             return false;
         }
         if(desc===''){
             alert("Digite el descuento para el cliente, si no lo tiene solicitelo al jefe de ventas_1.");
             $("#desc").focus();
             return false;
         }
        var precio = $("#pretotal").val();
                var ct = $("#ct").val();
        //alert(precio);
        $("#boton").html(" <img src='../images/load.gif'>Agregando.. ");
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&ct='+ct+'&ajuste='+ajuste+'&adi='+adi+'&ubc='+ubc+'&obse='+obse+'&pelicula='+pel+'&install='+ins+'&precio='+precio+'&desc='+desc+'&cot='+cot+'&idc='+idc+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&vid='+idv+'&vid2='+idv2+'&vid3='+idv3+'&vid4='+idv4+'&vid5='+idv5+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=5',
            url:'../vistas/ventas_1/acciones.php',
            success:function(a){
               //alert(a);
               //alert(p[4]+' - '+p[5]+' - '+p[6]+' - '+p[7]);
               
               clear_items();
               mostrar_items(cot);
            } 
        });
}
function pre(){
    var cot = $("#idcot").val();
    mostrar_items(cot);
}
function buscar_ced(){
    var doc = $("#doc").val();
            $.ajax({
            post:'GET',
            data:'doc='+doc+'&sw=1',
            url:'../vistas/ventas_1/acciones.php',
            success:function(d){
                var p = eval(d);
                $("#idc").val(p[0]);
                $("#cli").val(p[7]);
                $("#dir").val(p[2]);
                $("#tel").val(p[3]);
                $("#dep").val(p[8]);
                $("#ciu").val(p[9]);
                $("#max").val(p[11]);
                $("#desmax").html(p[11]);
                var t = p[11] * (-1);
                if(t > 40){
                    $("#desc").val(p[11]);
                }else{
                    $("#desc").val(0);
                }
                
                if(p[11]!=='0'){
                    $("#desc").attr("disabled", false);
                }else{
                    $("#desc").attr("disabled", true);
                }
                if(p[0]==null){
                    $("#idc").focus();
                }else{
                    $("#ser").focus();
                }
            } 
        });
}
function cot(){
        var idp = $("#idp").val();
        var idv = $("#idv").val();
        var idvh2 = $("#idvh2").val();
        var idvh3 = $("#idvh3").val();
        var idvh4 = $("#idvh4").val();
        var idvh5 = $("#idvh5").val();
        var ancho = $("#ancho").val();
        var alto = $("#alto").val();
        var cant = $("#cant").val();
        var per = $("#per").val();
        var boq = $("#boq").val();
        var desc = $("#desc").val();
        var des = $("#des").val();
        var rep = $("#rep").val();
        var pel = $("#pel").val();
        var ins = $("#ins").val();
        var desc = $("#desc").val();
        var hoja = $("#hoja").val();
        var ajuste = $("#ajuste").val();
        //alert(hoja);
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&pelicula='+pel+'&install='+ins+'&hoja='+hoja+'&des='+des+'&desc='+desc+'&vid='+idv+'&vid2='+idvh2+'&vid3='+idvh3+'&vid4='+idvh4+'&vid5='+idvh5+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=3',
            url:'../vistas/ventas_1/acciones.php',
            success:function(d){
                //alert(d);
               var p = eval(d);
               
               $("#pretotal").val(p[0]);
               $("#preund").val(p[2]);
               $("#piva").val(p[3]);
               $("#pivaOut").val(p[3]);
               //parametros para ingresar a la base de datos
               $("#p4").val(p[4]);
               $("#p5").val(p[5]);
               $("#p6").val(p[6]);
               $("#p7").val(p[7]);
                $("#ajuste").val(p[10]);
                
               $("#preund_desc").val(p[11]);
               $("#pretotal_desc").val(p[12]);
               $("#adi_per_boq").val(p[13]);
               //$("#msj").html(p[13]); // este alert sirve para visualizar las variables 
               sumaritem();
               //alert(p[10]);
            } 
        });
}
function ajuste_referencias(){
        var idp = $("#ref").val();
        var idv = $("#espesor").val();
        var idvh2 = 0;
        var idvh3 = 0;
        var idvh4 = 0;
        var ancho = 1000;
        var alto = 1000;
        var cant = 1;
        var per = 0;
        var boq = 0;
        var desc = 0;
        var rep = 1;
        var pel = 'No Aplica';
        var ins = 'No';
        var desc = 0;
        var hoja = 1;
        
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&pelicula='+pel+'&install='+ins+'&hoja='+hoja+'&des='+desc+'&vid='+idv+'&vid2='+idvh2+'&vid3='+idvh3+'&vid4='+idvh4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=18',
            url:'../ventas_1/acciones.php',
            success:function(d){
                //alert(d);
               var p = eval(d);
               $("#precio").val(p[2]);
               verificar(idp,idv);
            } 
        });
}
function recalcular(ref,vid,id){
        var idp = ref;
        var idv = vid;
        var idvh2 = 0;
        var idvh3 = 0;
        var idvh4 = 0;
        var ancho = 1000;
        var alto = 1000;
        var cant = 1;
        var per = 0;
        var boq = 0;
        var desc = 0;
        var rep = 1;
        var pel = 'No Aplica';
        var ins = 'No';
        var desc = 0;
        var hoja = 1;
        
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&pelicula='+pel+'&install='+ins+'&hoja='+hoja+'&des='+desc+'&vid='+idv+'&vid2='+idvh2+'&vid3='+idvh3+'&vid4='+idvh4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=18',
            url:'../ventas_1/acciones.php',
            success:function(d){
                //alert(d);
               var p = eval(d);
               var a = $("#a"+id).val(p[2]);
               var c = $("#c"+id).val();
               var b = parseInt(c) - parseInt(p[2]);
               $("#b"+id).val(b);
               actualizar_precio(id,p[2],c,b);
            } 
        });
}
function ajuste_manual(id){
  
    var a = $("#a"+id).val();
    var c = $("#c"+id).val();
    var b = parseInt(c) - parseInt(a);
     $("#b"+id).val(b);
     actualizar_precio(id,a,c,b);
//    success: function(){
//        b = parseInt(c) - parseInt(a);
//        $("#b"+id).val(b);
//    }
}
function actualizar_precio(id,cos,pre,aju){
    $.ajax({
            post:'GET',
            data:'id='+id+'&cos='+cos+'&pre='+pre+'&aju='+aju+'&sw=19',
            url:'../ventas_1/acciones.php',
            success:function(dd){
               $("#por"+id).html(dd);
                $("#ok"+id).html('<img src="../../images/ok.png">');
            } 
        });
}
function verificar(pro, vid){
  
            $.ajax({
            post:'GET',
            data:'ref='+pro+'&vid='+vid+'&sw=17',
            url:'../ventas_1/acciones.php',
            success:function(d){
  
                if(d>0){
                     alert("Este producto con el espesor ya existe");
                     $("#des_ref").val('');
                     $("#espesor").val('');
                     $("#precio").val('');
                     return false;
                }
        
            } 
        });
}
function actualizaritems(item){
        var idp = $("#idp"+item).val();
        var idv = $("#idv"+item).val();
        var idv2 = $("#idva"+item).val();
        var idv3 = $("#idvb"+item).val();
        var idv4 = $("#idvc"+item).val();
        var ancho = $("#ancho"+item).val();
        var alto = $("#alto"+item).val();
        var cant = $("#cant"+item).val();
        var ajuste = $("#ajuste"+item).val();
        var per = $("#per"+item).val();
        var boq = $("#boq"+item).val();
        var desc = $("#desc"+item).val();
        var des = $("#des"+item).val();
        var rep = $("#rep"+item).val();
        var adi = $("#adi_per_boq"+item).val();
        var pel = $("#pel").val();
        var ins = $("#ins").val();
        var cot = $("#idcot").val();
         var max = $("#max").val();
                var ser = $("#ser").val();
                if(ser==='0'){
                    if( parseInt(desc) < parseInt(max) ){
                        alert("No puedes dar max descuento, el descuento maximo para este cliente es de: "+max+' %');
                        $("#desc"+item).val('0');
                        return false;
                    }
                }
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&pelicula='+pel+'&install='+ins+'&adi='+adi+'&desc='+desc+'&des='+des+'&vid='+idv+'&vid2='+idv2+'&vid3='+idv3+'&vid4='+idv4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=3',
            url:'../vistas/ventas_1/acciones.php',
            success:function(d){
                //alert(d);
                console.log(d);
               var p = eval(d);
               $("#pretotal"+item).val(p[0]);
               $("#preund"+item).val(p[2]);
               $("#piva"+item).val(p[3]);
               $("#pivaOut"+item).val(p[8]);
               $("#p4"+item).val(p[4]);
               $("#p5"+item).val(p[5]);
               $("#p6"+item).val(p[6]);
               $("#p7"+item).val(p[7]);
               $("#ajuste"+item).val(p[10]);
               $("#pud"+item).val(p[11]);
               $("#ptd"+item).val(p[12]);
               $("#adi_per_boq"+item).val(p[13]);
               
               //saveitem(item);382a779137fcf7fc271e97a008770dfa
               sumaritem();
               //$("#msj").html(p[0]); bcbcbaef21e9c0efe0b6607dda62e66d
            } 
        });
}
function validarinput(input,item){
    var i;
    if(item=='0'){
        i = '';
    }else{
        i = item;
    }
    var inp = $("#"+input+i).val();
    if(inp=='0'){
        alert("Debes de digitar la cantidad de "+input);
        return false;
    }
    var c = confirm("Esta seguro de ingresar esta cantidad ="+inp);
    if(c){
        return true;
    }else{
        $("#"+input+i).val('');
        return false;
    }
}
function terceros(){
    
    window.open("../vistas/terceros.php","terceros","width=800,height=600");
}
function update_ced(){
     var idc = $("#idc").val();
    window.open("../vistas/ventas_1/index.php?id="+idc,"terceros","width=300,height=300");
}
function cliente_info(id,nom,dir,con,tel,cel,ema,doc,dep,mun,ven,ubi,ciud,muni,pvi){
    $("#cli").val(nom);
    $("#doc").val(doc);
    $("#dir").val(dir);
    $("#tel").val(tel);
    $("#dep").val(dep);
    $("#ciu").val(mun);
    $("#dir").val(ubi);
    $("#dir").val(ubi);
     $("#max").val(pvi);
     $("#desmax").html(pvi);
    var idc = $("#idc").val(id);
    if(id!==''){
        $("#continuar").attr("disabled", false);
    }else{
         $("#continuar").attr("disabled", true);
    }
}
function valdes(){
    var max = $("#max").val();
    var desc = $("#desc").val();
    console.log('max'+max+' d:'+desc)
    if( parseInt(desc) < parseInt(max) ){
        alert("El descuento permitido es de "+max);
        $("#desc").val('');
        $("#desc").focus();
        return false;
    }
}
function municipio(ciu){
    $("#ciu").val(ciu);
}
function referencias(){
    window.open("../vistas/lista_vidrios.php?linea=Vidrio","terceros","width=800,height=600");
}
function buscare(cod,id,des,per,boq,lam){
    $("#cod").val(cod);
    $("#idp").val(id);
    $("#des").val(des);
    
    if(per==='1'){
        $("#per").attr("disabled", false);
        $("#per").val('');
    }else{
        $("#per").attr("disabled", true);
        $("#per").val(per);
    }
    if(boq==='1'){
        $("#boq").attr("disabled", false);
         $("#boq").val('');
    }else{
        $("#boq").attr("disabled", true);
        $("#boq").val(boq);
    }
    console.log("laminas: "+lam);
     if(parseInt(lam) > 1 ){
         window.open("../vistas/cantidad.php","x","width=400 , height=200 ");
                  
                
                }else{
                    $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 80px" onclick="vidrios();"> <input type="hidden" id="idvh2"><input type="hidden" id="vidh2" style="width: 20px" onclick="vidrioss2();"> <input type="hidden" id="idvh3"><input type="hidden" id="vidh3" style="width: 20px" onclick="vidrioss3();"> <input type="hidden" id="idvh4"><input type="hidden" id="vidh4" style="width: 20px" onclick="vidrioss4();">');
                    $("#hoja").val('1');
                }
}
function PasarCantidad(ca){
    var can = parseInt(ca);
                        $("#hoja").val(can);
                        if(can===2 || can===3 || can===4 || can===5){
                    if(can===2){
                         $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();"  placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();"> <input type="hidden" id="idvh3"><input type="hidden" id="vidh3" style="width: 20px" onclick="vidrioss3();"> <input type="hidden" id="idvh4"><input type="hidden" id="vidh4" style="width: 20px" onclick="vidrioss4();"> <input type="hidden" id="idvh5"><input type="hidden" id="vidh5" style="width: 20px" onclick="vidrioss5();" placeholder="5">');
                    }else if(can===3){
                          $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();"  placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();"  placeholder="2"> <input type="hidden" id="idvh3"><input type="text" id="vidh3" style="width: 20px" onclick="vidrioss3();" placeholder="3"> <input type="hidden" id="idvh4"><input type="hidden" id="vidh4" style="width: 20px" onclick="vidrioss4();">  <input type="hidden" id="idvh5"><input type="hidden" id="vidh5" style="width: 20px" onclick="vidrioss5();" placeholder="5">');
                    }else if(can===4){
                            $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();" placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();" placeholder="2"> <input type="hidden" id="idvh3"><input type="text" id="vidh3" style="width: 20px" onclick="vidrioss3();"  placeholder="3"> <input type="hidden" id="idvh4"><input type="text" id="vidh4" style="width: 20px" onclick="vidrioss4();" placeholder="4"> <input type="hidden" id="idvh5"><input type="hidden" id="vidh5" style="width: 20px" onclick="vidrioss5();" placeholder="5">');
                    }else if(can===5){
                            $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 20px" onclick="vidrios();" placeholder="1"> <input type="hidden" id="idvh2"><input type="text" id="vidh2" style="width: 20px" onclick="vidrioss2();" placeholder="2"> <input type="hidden" id="idvh3"><input type="text" id="vidh3" style="width: 20px" onclick="vidrioss3();"  placeholder="3"> <input type="hidden" id="idvh4"><input type="text" id="vidh4" style="width: 20px" onclick="vidrioss4();" placeholder="4"> <input type="hidden" id="idvh5"><input type="text" id="vidh5" style="width: 20px" onclick="vidrioss5();" placeholder="5">');
                    }
                      }else{
                         alert("debes de digitar un valor valido entre 2 y 4");
                         window.open("../vistas/cantidad.php","x","width=400 , height=200 ");
                         return false;
                         
                       }
}
function vidrios1(des,id){
     $("#idv").val(id);
    $("#vid").val(des);
    $("#ancho").focus();
}
function vidrios2(des,id){
     $("#idvh2").val(id);
    $("#vidh2").val(des);

}
function vidrios3(des,id){
     $("#idvh3").val(id);
    $("#vidh3").val(des);

}
function vidrios4(des,id){
     $("#idvh4").val(id);
    $("#vidh4").val(des);

}
function vidrios5(des,id){
     $("#idvh5").val(id);
    $("#vidh5").val(des);

}
function obtenervidrios(des,id,item){
     $("#idv"+item).val(id);
    $("#vid"+item).val(des);
    $("#ancho"+item).focus();
    actualizaritems(item);
    console.log($("#idv"+item));
    console.log($("#vid"+item));
}
function obtenervidrios2(des,id,item){
     $("#idva"+item).val(id);
    $("#vida"+item).val(des);
    actualizaritems(item);
}
function obtenervidrios3(des,id,item){
     $("#idvb"+item).val(id);
    $("#vidb"+item).val(des);
    actualizaritems(item);
}
function obtenervidrios4(des,id,item){
     $("#idvc"+item).val(id);
    $("#vidc"+item).val(des);
    actualizaritems(item);
}
function clear_items(){
     $("#cod").val('').focus();
    $("#idp").val('');
    $("#des").val('');
    $("#per").val('');
    $("#boq").val('');
     $("#idv").val('');
    $("#vid").val('');
    $("#idvh2").val('');
    $("#vidh2").val('');
    $("#idvh3").val('');
    $("#vidh3").val('');
    $("#idvh4").val('');
    $("#vidh4").val('');
    $("#hoja").val('');
    $("#ancho").val('');
    $("#alto").val('');
    $("#cant").val('');
    $("#preund").val('');
    $("#pretotal").val('');
    $("#piva").val('');
    $("#pivaOut").val('');
    $("#p4").val('');
    $("#p5").val('');
    $("#p6").val('');
    $("#p7").val('');
    $("#ajuste").val('');
    $("#rep").val('1');
    $("#per").val('');
    $("#boq").val('');
    $("#ubc").val('');
    $("#obse").val('');
    
}
function generar(){
            var idc = $("#idc").val();
            var cot = $("#idcot").val();
            var doc = $("#doc").val();
            var dep = $("#dep").val();
            var ciu = $("#ciu").val();
            var ase = $("#ase").val();
            var ana = $("#ana").val();
            var dir = $("#dir").val();
            var ent = $("#ent").val();
            var obra = $("#obra").val();
            var obs = $("#obs").val();
            var exp = $("#ser").val();
            var pag = $("#pag").val();
            var tel = $("#tel").val();
          if(idc===''){
              alert("Debes escojer el cliente");
              $("#doc").focus();
              return false;
          }
          if(exp===''){
              alert("Debes seleccionar el tipo de servicio");
              $("#ser").focus();
              return false;
          }
         $("#continuar").attr("disabled",true);
         $("#doc").attr("disabled",true);
         if(cot!==''){
             var save = confirm("Esta seguro de congelar esta cotizacion. \n Antes de congelar la cotizacion verifique que la informacion este bien.");
             if(!save){
                 return false;
             }
         }
      $.ajax({
            post:'GET',
            data:'idc='+idc+'&dep='+dep+'&ciu='+ciu+'&ana='+ana+'&ase='+ase+'&tel='+tel+'&dir='+dir+'&cot='+cot+'&ent='+ent+'&obra='+obra+'&obs='+obs+'&exp='+exp+'&pag='+pag+'&sw=6',
            url:'../vistas/ventas_1/acciones.php',
            success:function(a){
              
              if(exp==1){
                $("#porcentaje").attr("disabled",true);
              }
              $("#sear").attr("disabled",true);
              $("#ser").attr("disabled",true);
               var p = eval(a);
                
            if(p[3]==='En proceso'){
               $("#idcot").val(p[0]);
               $("#cot").val(p[1]);
               $("#ver").val(p[2]);
               $("#est").val(p[3]);
               $("#guardar").attr("disabled", false);
               $("#doc").attr("disabled",true);
               $("#sear").attr("disabled",true);
               $("#msg").html('<img src="../imagenes/ledrojo.gif"><font color="red"> Sin Congelar</font>');
           }else{
               $("#est").val(p[3]);
                $("#guardar").attr("disabled",true);
                $("#doc").attr("disabled",true);
                $("#sear").attr("disabled",true);
                $("#ser").attr("disabled",true);
                $("#acte").attr("disabled",true);
                $("#formulario").html("");
                $("#msg").html('<img src="../imagenes/ok.png"><font color="green"> Congelado</font>');
                mostrar_items(cot);
           }
            } 
        });
}
function mostrar_items(cot){
    var  ser = $("#ser").val();
      $.ajax({
            post:'GET',
            data:'cot='+cot+'&ser='+ser+'&sw=7',
            url:'../vistas/ventas_1/acciones.php',
            success:function(a){
                $("#boton").html('<button onclick="agregar_item();" id="bot" disabled>Agregar</button>');
               $("#mostrar_lineas").html(a);
              
            } 
        });
}
function del_item(item, id){
    var cot = $("#idcot").val();
     con = confirm("Esta seguro de quitar este items?");
     if(con){
         $("#boton"+item).html(" <img src='../images/load.gif'>Quitando.. ");
      $.ajax({
            post:'GET',
            data:'id='+id+'&sw=8',
            url:'../vistas/ventas_1/acciones.php',
            success:function(a){
               mostrar_items(cot);
              
            } 
        });
    }else{
        return false;
    }
}
function rep_item(item, id){
    var cot = $("#idcot").val();
    var rep = $("#rep"+item).val();
     var ct = $("#ct").val();
     con = confirm("Esta seguro de repetir este items?");
     if(con){
         $("#boton"+item).html(" <img src='../images/load.gif'>Duplicando.. ");
      $.ajax({
            post:'GET',
            data:'id='+id+'&ct='+ct+'&rep='+rep+'&sw=9',
            url:'../vistas/ventas_1/acciones.php',
            success:function(a){
               mostrar_items(cot);
              
            } 
        });
    }else{
        return false;
    }
}
function lista_vidrios(item){
     window.open("../combos/lista_vidrios.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios2(item){
     window.open("../combos/lista_vidrios_1.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios3(item){
     window.open("../combos/lista_vidrios_2.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios4(item){
     window.open("../combos/lista_vidrios_3.php?item="+item,"terceros","width=500,height=400");
}

function sumaritem(){
    var ct = $("#ct").val();
    gt = 0;ctt = 0;
    for(i=1;i<=ct;i++){
        var piva = $("#piva"+i).val();
        var cant = $("#cant"+i).val();
        gt = parseInt(gt) + parseInt(piva);
        ctt = parseInt(ctt) + parseInt(cant);
    }
    $("#grantotal").val(gt);
    $("#cantotal").val(ctt);
    
}
function saveitem(){
    var ct = $("#ct").val();
    var cot = $("#idcot").val();
 for(i=1;i<=ct;i++){
         var idp = $("#idp"+i).val();
         var idc = $("#idc"+i).val();
        var idv = $("#idv"+i).val();
        var idv2 = $("#idva"+i).val();
        var idv3 = $("#idvb"+i).val();
        var idv4 = $("#idvc"+i).val();
        var ancho = $("#ancho"+i).val();
        var alto = $("#alto"+i).val();
        var cant = $("#cant"+i).val();
        var per = $("#per"+i).val();
        var boq = $("#boq"+i).val();
        var desc = $("#desc"+i).val();
        var rep = $("#rep"+i).val();
        var pel = $("#pel").val();
        var ins = $("#ins").val();
        var p4 = $("#p4"+i).val();
        var p5 = $("#p5"+i).val();
        var p6 = $("#p6"+i).val();
        var p7 = $("#p7"+i).val();
        var ajuste = $("#ajuste"+i).val();
        var fila = $("#tipo"+i).val();
        var ubc = $("#ubc"+i).val();
        var obse = $("#obse"+i).val();
         var id_cot = $("#id_cotizacion"+i).val();
        var precio = $("#pretotal"+i).val();
        var adi = $("#adi_per_boq"+i).val();
        //alert("pas0 1 "+precio);
        $("#acte").html(" <img src='../images/load.gif'> Editando.. ");
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&id_cot='+id_cot+'&ajuste='+ajuste+'&adi='+adi+'&ubc='+ubc+'&obse='+obse+'&fila='+fila+'&pelicula='+pel+'&install='+ins+'&precio='+precio+'&desc='+desc+'&cot='+cot+'&idc='+idc+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&vid='+idv+'&vid2='+idv2+'&vid3='+idv3+'&vid4='+idv4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=10',
            url:'../vistas/ventas_1/acciones.php',
            success:function(a){
               $("#acte").html('<img src="../imagenes/cambiar.png" width="15px"> Guardar Cambios de Items');
               mostrar_items(cot);
               $("#msj").html(a);
            } 
        });
 
    }     
}
function cargar_cotizacion(cot){
                $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=11',
            url:'../vistas/ventas_1/acciones.php',
            success:function(d){
                var p = eval(d);
                $("#mostrar_lineas").html("<tr><td colspan='14'><center> <img src='../images/load.gif'>Cargando Tabla.. </center></td></tr>");
                $("#idc").val(p[0]);
                $("#cli").val(p[7]);
                $("#dir").val(p[2]);
                $("#tel").val(p[3]);
                $("#dep").val(p[8]);
                $("#ciu").val(p[9]);
                $("#max").val(p[11]);
                $("#desmax").html(p[11]);
                $("#desc").val('0');
                 $("#doc").val(p[1]);
                 
                  $("#cot").val(p[21]);
                   $("#ver").val(p[22]);
                    $("#ser").val(p[24]);
                     $("#pag").val(p[23]);
                      $("#reg").val(p[14]);
                       $("#ent").val(p[25]);
                       $("#obs").val(p[26]);
                       $("#obra").val(p[13]);
                       $("#est").val(p[16]);
                       $("#idcot").val(cot);
                       $("#ana").val(p[27]);
                      $("#ase").val(p[28]);
                if(p[16]!=='En proceso'){
                    $("#guardar").attr("disabled", true);
                    $("#sear").attr("disabled", true);
                    $("#doc").attr("disabled", true);
                    $("#formulario").html("");
                    $("#msg").html('<img src="../imagenes/ok.png"><font color="green"> Congelado</font>');
                }else{
                    $("#guardar").attr("disabled", false); 
                    $("#sear").attr("disabled", true);
                    $("#doc").attr("disabled", true);
                    $("#msg").html('<img src="../imagenes/ledrojo.gif"><font color="red"> Sin Congelar</font>');
                }
                if(p[24]!=='0'){
                    $("#desc").attr("disabled", false);
                    $("#desc").val('0');
                    $("#ser").attr("disabled", false);
                }else{
                    $("#desc").attr("disabled", false);
                    $("#ser").attr("disabled", false);
                    var t = p[11] * (-1);
                    if(t > 40){
                        var de = p[11];
                    }else{
                        de = 0;
                    }
                    $("#desc").val(de);
                }
                if(p[0]==null){
                    $("#idc").focus();
                }else{
                    $("#ser").focus();
                }
                mostrar_items(cot);
                mostrar_ventas_1();
            } 
        });
}
function imprimir(){ 
      var cot = $("#idcot").val();
      var ct = $("#ct").val();
      var col = $("#columnas").val();
     if(cot!==''){
    window.open("../vistas/imprimir_vidrios.php?cot="+cot+"&total_item="+ct+"&col="+col+"&ciudad=Barranquilla","Imprimir","width=1200,height=800");
     }
}
//function guardar_cot(){
//     var cot = $("#idcot").val();
//             $.ajax({
//            post:'GET',
//            data:'ref='+idp+'&id_cot='+id_cot+'&fila='+fila+'&pelicula='+pel+'&install='+ins+'&precio='+precio+'&desc='+desc+'&cot='+cot+'&idc='+idc+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&vid='+idv+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=10',
//            url:'../vistas/ventas_1/acciones.php',
//            success:function(a){
//               //alert(a);
//      
//            } 
//        });
//}
function nuevo(){
    window.location.href='../vistas/sala_ventas_1.php';
}
function porcentajes(){
      var cot = $("#idcot").val();
      var cli = $("#idc").val();
     window.open("../vistas/porcentajes.php?cot="+cot+"&cli="+cli+"","Porcentajes","width=1200,height=800");
    
}
function porcentajes_ventas_1(){
      var cot = $("#idcot").val();
      var cli = $("#idc").val();
      var max = $("#max").val();
     window.open("../vistas/porcentajes_1.php?cot="+cot+"&cli="+cli+"&max="+max,"Porcentajes","width=1200,height=800");
    
}
function vendedor(usu){
    $("#ase").val(usu);
}