$(function(){
     $("#mostrar_tabla").html(mostrar_man(1));
     
    $('#cod').change(function(){
        mostrar_man(1);
      });
     $('#des').change(function(){
        mostrar_man(1);
      }); 
       
     $('#res').change(function(){
         mostrar_man(1);
     });
     
          $('#inst_b').change(function(){
         mostrar_man(1);
     });
    
 });  
    function mostrar_man(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var inst = $("#inst_b").val();
         
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&inst='+inst+'&page='+page,
                url: '../vistas/mano_obra/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_man(){
        var id_mano = $("#id_mano").val();
        var refmano = $("#ref_mano").val();
        var desmano = $("#des_mano").val();
        var instmano = $("#inst_mano").val();
        var cobramano = $("#cobra_mano").val();
        var costomano = $("#costo_mano").val();
        var utimano = $("#uti_mano").val();
        var parafmano = $("#paraf_mano").val();
        
        if (refmano===''){
            alert('') 
            $("#ref_mano").focus();
            return false;
        }
      
    $.ajax({
            type: 'GET',
            data: 'idmano='+id_mano+'&ref_mano='+refmano+'&desmano='+desmano+'&instmano='+instmano+'&cobramano='+cobramano+'&costomano='+costomano+'&utimano='+utimano+'&parafmano='+parafmano+'&sw=1',
              url: '../vistas/mano_obra/acciones.php',
            success: function(resultado){
            
               alert("Se guardo con exito");
                mostrar_man(1);
            }
           });
}

function limpiar_man(){
 $("#id_mano").val('');
 $("#ref_mano").val('');
 $("#des_mano").val('');
 $("#inst_mano").val('');
 $("#cobra_mano").val('');
 $("#costo_mano").val('');
 $("#uti_mano").val('');
 $("#paraf_mano").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_man();
}

function editar_man(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/mano_obra/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#id_mano").val(t[0]);
     $("#ref_mano").val(t[1]);
     $("#des_mano").val(t[2]);
     $("#inst_mano").val(t[3]);
     $("#cobra_mano").val(t[4]);
     $("#costo_mano").val(t[5]);
     $("#uti_mano").val(t[6]);
     $("#paraf_mano").val(t[7]);
 }
});
}
