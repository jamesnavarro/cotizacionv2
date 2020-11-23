 $(function(){
     mostrar_vid(1);
     
    $('#cod').change(function(){
        mostrar_vid(1);
     });
     $('#des').change(function(){
        mostrar_vid(1);
     }); 
        
     $('#cod_vid').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#cod_vid").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/vidrio/acciones.php',
         success: function(t) {
      var p = eval(t);
     $("#cod_vid").val(cod);
    $("#id_vid").val(p[0]);
     $("#color_vid").val(p[2]);
     $("#ref_vid").val(p[3]);
     $("#esp_vid").val(p[4]);
     $("#cos_vid").val(p[5]);
     $("#mon_vid").val(p[6]);
     $("#cos_usd").val(p[7]);
         }
});
 }
    function mostrar_vid(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
       
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&page='+page,
                url: '../vistas/vidrio/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_vid(){
        var id = $("#id_vid").val();
        var codvid = $("#cod_vid").val();
        var colorvid = $("#color_vid").val();
        var refvid = $("#ref_vid").val();
        var espvid = $("#esp_vid").val();
        var cosvid = $("#cos_vid").val();
        var monvid = $("#mon_vid").val();
        var cosusd = $("#cos_usd").val();
       
        if(codvid===''){
        alert("Ingrese el codigo");
        $("#cod_vid").focus();
        return false;
        }
    
           $.ajax({
            type: 'GET',
            data: 'id='+id+'&codvid='+codvid+'&colorvid='+colorvid+'&refvid='+refvid+'&espvid='+espvid+
                  '&cosvid='+cosvid+'&monvid='+monvid+'&cosusd='+cosusd+'&sw=1',
            url: '../vistas/vidrio/acciones.php', 
            success: function(resultado){
                console.log(resultado);
                $("#id_vid").val(resultado); 
               alert("Se guardo el vidrio con exito");
               //updatedollar();
                mostrar_vid(1);
            }
           });
}

function limpiar_vid(){
     $("#id_vid").val('');
     $("#cod_vid").val('');
     $("#color_vid").val('');
     $("#ref_vid").val('');
     $("#esp_vid").val('');
     $("#cos_vid").val('');
     $("#mon_vid").val('');
     $("#cos_usd").val('');
    
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_vid();
}

function editar_vid(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
         $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/vidrio/acciones.php', //
        success: function(resultado){
       var p = eval(resultado);
     $("#id_vid").val(p[0]);
     $("#cod_vid").val(p[1]);
     $("#color_vid").val(p[2]);
     $("#ref_vid").val(p[3]);
     $("#esp_vid").val(p[4]);
     $("#cos_vid").val(p[5]);
     $("#mon_vid").val(p[6]);
     $("#cos_usd").val(p[7]);
 }
 });
}
function borrar(id){
     var c = confirm("Esta seguro de eliminar este vidrio");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/vidrio/acciones.php', 
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_vid(1);
            }
           });
       }
}


function calculardolar(){
   var costo = $("#cos_vid").val();
   var precio_dolar = $("#precio_dolar").val();
   var moneda = $("#mon_vid").val();
   if(moneda=='USD'){
      var t = costo / precio_dolar;
      $("#cos_usd").val(t.toFixed(2));
   }
   
   ;
    
}
function verhist(id){
    window.open('../vistas/vidrio/historial.php?id='+id,'Historia','width=600 , height=800 ');
}
function calusd(){
    var costo = $("#cos_usd").val();
   var precio_dolar = $("#precio_dolar").val();
   var t = costo * precio_dolar;
      $("#cos_vid").val(t.toFixed(2));
}
   
