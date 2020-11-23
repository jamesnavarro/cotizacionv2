 
$(function(){
     $("#mostrar_tabla").html(mostrar_sistemas(1)); 
   
     $('#nombre_s').change(function(){
             mostrar_sistemas(1);
     });   
});
 
function mostrar_sistemas(page){
      var nomb = $("#nombre_s").val(); 
        $.ajax({
            type: 'GET',
            data: '&nombb='+nomb+'&page='+page,
            url: '../vistas/sistemas/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_sistemas(){ 
     var idsist = $("#id_sist").val(); 
     var nomsis = $("#nom_sist").val();
    if(nomsis===''){
         alert("Nombrea?");
        $("#nom_sist").focus();
        return false;
    }
    
   $("#btn_guardar").attr("disabled",true);
        $.ajax({
            type: 'GET',
            data: 'idsists='+idsist+'&nomsiss='+nomsis+'&sw=1',
            url: '../vistas/sistemas/acciones.php', 
            success: function(resultado){
                $("#id_sist").val(resultado); 
                alert("Se guardo con exito");
                $("#btn_guardar").attr("disabled",false);
                mostrar_sistemas(1);
            }
           });
}

function limpiar_sist(){
$("#id_sist").val(''); 
$("#nom_sist").val('');

}

function nuevo(){
    limpiar_sist();
}

function editar(id){
     $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/sistemas/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
 $("#id_sist").val(p[0]); 
 $("#nom_sist").val(p[1]);

 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/sistemas/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_sistemas(1);
            }
           });
       }
}
 