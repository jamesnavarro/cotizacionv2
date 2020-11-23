$(function(){
     $("#mostrar_tabla").html(mostrar_porc(1));
     
    $('#cod').change(function(){
        mostrar_porc(1);
      });
     $('#des').change(function(){
        mostrar_porc(1);
      }); 
  
    
 });  
    function mostrar_porc(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&page='+page,
                url: '../vistas/porcentaje/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_porc(){
        var id_porc = $("#id_porc").val();
        var lin_porc = $("#lin_porc").val();
        var uno_porc = $("#uno_porc").val();
        var dos_porc = $("#dos_porc").val();
         var tres_porc = $("#tres_porc").val();
        var grup_por = $("#grup_por").val();
        var div_porc = $("#div_porc").val();
        
        if (lin_porc===''){
            alert('Escoje la linea') 
            $("#lin_porc").focus();
            return false;
        }
      
    $.ajax({
            type: 'GET',
            data: 'idporc='+id_porc+'&linporc='+lin_porc+'&unoporc='+uno_porc+'&dosporc='+dos_porc+'&tresporc='+tres_porc+'&gruppor='+grup_por+'&divporc='+div_porc+'&sw=1',
              url: '../vistas/porcentaje/acciones.php',
            success: function(resultado){
               alert("Se guardo con exito");
                mostrar_porc(1);
            }
           });
}


function limpiar_porc(){
        $("#id_porc").val();
        $("#lin_porc").val('');
        $("#uno_porc").val('');
        $("#dos_porc").val('');
        $("#tres_porc").val('');
        $("#grup_por").val('');
        $("#div_porc").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_porc();
}

function editar_gas(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/porcentaje/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
   $("#id_gas").val(t[0]);
        $("#id_porc").val(t[0]);
        $("#lin_porc").val(t[1]);
        $("#uno_porc").val(t[2]);
        $("#dos_porc").val(t[3]);
        $("#tres_porc").val(t[4]);
        $("#grup_por").val(t[5]);
        $("#div_porc").val(t[6]);
 }
});
}
