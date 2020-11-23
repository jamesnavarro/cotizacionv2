$(function(){
     $("#mostrar_tabla").html(mostrar_alu(1));
     
    $('#cod').change(function(){
        mostrar_alu(1);
      });
     $('#des').change(function(){
        mostrar_alu(1);
      }); 
        $('#est').change(function(){
        mostrar_alu(1);
      }); 
     $('#res').change(function(){
         mostrar_alu(1);
     });
    
 });  
    function mostrar_alu(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&page='+page,
                url: '../vistas/aluminio/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_alu(){
        var idalu = $("#id_alu").val();
        var col_alu = $("#col_alu").val();
        var tip_alum = $("#tip_alum").val();
         var var_alu = $("#var_alu").val();
        var codigo_alu = $("#codigo_alu").val();
        var ren_alu = $("#ren_alu").val();
         var med_alu = $("#med_alu").val();
        
        if (col_alu===''){
            alert('debe ingresar el color') 
            $("#col_alu").focus();
            return false;
        }
      
    $.ajax({
            type: 'GET',
            data: 'idalu='+idalu+'&col_alu='+col_alu+'&tip_alum='+tip_alum+'&var_alu='+var_alu+'&codigo_alu='+codigo_alu+'&ren_alu='+ren_alu+'&med_alu='+med_alu+'&sw=1',
              url: '../vistas/aluminio/acciones.php',
            success: function(resultado){
            
               alert("Se guardo con exito");
                mostrar_alu(1);
            }
           });
}

function limpiar_alu(){
 $("#id_alu").val('');
 $("#col_alu").val('');
 $("#tip_alum").val('');
 $("#var_alu").val('');
 $("#codigo_alu").val('');
 $("#ren_alu").val('');
 $("#med_alu").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_alu();
}

function editar_alu(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/aluminio/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#id_alu").val(t[0]);
     $("#col_alu").val(t[1]);
     $("#tip_alum").val(t[2]);
     $("#var_alu").val(t[3]);
     $("#codigo_alu").val(t[4]);
     $("#ren_alu").val(t[5]);
     $("#med_alu").val(t[6]);
 }
});
}
