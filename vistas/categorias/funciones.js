 
$(function(){
     $("#mostrar_tabla").html(mostrar_catcos(1)); 
   
     $('#nombre_c').change(function(){
             mostrar_catcos(1);
     });   
});
 
function mostrar_catcos(page){
      var nomb = $("#nombre_c").val(); 
        $.ajax({
            type: 'GET',
            data: '&nombb='+nomb+'&page='+page,
            url: '../vistas/categorias/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_catcos(){ 
     var idcatcos = $("#id_catcos").val(); 
     var nomcate = $("#nom_cate").val();
    if(nomcate===''){
         alert("Nombre de la categoria?");
        $("#nom_cate").focus();
        return false;
    }
    
   $("#btn_guardar").attr("disabled",true);
        $.ajax({
            type: 'GET',
            data: 'idcatcosc='+idcatcos+'&nomcatec='+nomcate+'&sw=1',
            url: '../vistas/categorias/acciones.php', 
            success: function(resultado){
                $("#id_catcos").val(resultado); 
                alert("Se guardo con exito");
                $("#btn_guardar").attr("disabled",false);
                mostrar_catcos(1);
            }
           });
}

function limpiar_catcos(){
$("#id_catcos").val(''); 
$("#nom_cate").val('');

}

function nuevo(){
    limpiar_catcos();
}

function editar(id){
     $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/categorias/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
 $("#id_catcos").val(p[0]); 
 $("#nom_cate").val(p[1]);

 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/categorias/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_catcos(1);
            }
           });
       }
}
 