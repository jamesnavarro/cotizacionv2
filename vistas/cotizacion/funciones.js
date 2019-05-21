        $(function() {

            $('#textos').click(function(){
                $("#myModal").modal();
                mostrar_texto();
            });
            $('#pol').click(function(){
                $("#ModalPol").modal();
                mostrar_politicas();
            });

        });
   function editar_perfil(id,cot){
       var per = $("#med"+id).val();
       var persta = $("#medsta"+id).val();
       var ref = $("#ref"+id).val();
       //alert('ref='+ref+' mesta='+persta+' per='+per+' cot='+cot);
       $.ajax({
                        post:'GET',
                        data:'sw=14&per='+per+'&ref='+ref+'&persta='+persta+'&cot='+cot+'&id='+id,
                        url:'../vistas/solicitudes/acciones.php',
                        success:function(d){
                            alert("Se agrupo con exito");
                            mostrar(cot);
                            //$("#med"+id).focus();
                        }
                 });
   }
    function salvar(){
       var tex = $("#text_1").val();
       if(tex==''){
           alert("llene este campo");
           $("#text_1").focus();
           return false;
       }
       $.ajax({
                        post:'GET',
                        data:'sw=1&tex='+tex,
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){
                            alert("Se agrego con exito" + d);
                            mostrar_texto();
                            $("#text_1").val('');
                        }
                 });
    }
        function salvar_pol(id){
       var tex = $("#politica").val();
       if(tex==''){
           alert("llene este campo");
           $("#politica").focus();
           return false;
       }
       $.ajax({
                        type:'POST',
                        data:'sw=6&tex='+encodeURIComponent(tex),
                        dataType: 'json',
                        url:'../vistas/cotizacion/politicas.php',
                        success:function(){
                            alert("Se Modifico con exito");
                        }
                 });
    }
            function salvar_com(){
       var tex = $("#com").val();
       var id = $("#idcoti").val();
       if(tex==''){
           alert("llene este campo");
           $("#com").focus();
           return false;
       }
       $.ajax({
                        type:'GET',
                        data:'sw=7&tex='+encodeURIComponent(tex)+'&id='+id,
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){
                            alert("Se Agrego con exito" + d);
                            $("#com").val('');
                            com(id);
                        }
                 });
    }
    function mostrar_texto(){
               $.ajax({
                        post:'GET',
                        data:'sw=2',
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){
                            $("#ver_texto").html(d);
                        }
                 });
    }
        function mostrar_politicas(){
               $.ajax({
                        post:'GET',
                        data:'sw=5',
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){
                            $("#politica").val(d);
                        }
                 });
    }
    function com(id){
        $("#ModalCom").modal();
        $("#idcoti").val(id);
        var it = $("#it"+id).val();
        $("#it").val(it);
               $.ajax({
                        post:'GET',
                        data:'sw=6&id='+id,
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){
                            $("#ver_com").html(d);
                        }
                 });
    }
    function salvar_up(id){
        var tex = $("#text_1"+id).val();
        $("#nota").val(tex);
    }
    function cambiar_texto(id){
         var tex = $("#text_1"+id).val();
               $.ajax({
                        post:'GET',
                        data:'sw=3&id='+id+'&tex='+tex,
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){

                        }
                 });
    }
        function borrar_texto(id){
            var co = confirm("Esta seguro de eliminar este items?");
            if(co){
               $.ajax({
                        post:'GET',
                        data:'sw=4&id='+id,
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){
                            alert("Se elimino con exito");
                            mostrar_texto();
                        }
                 });
             }
    }
        function borrar_com(id,idc){
            var co = confirm("Esta seguro de eliminar este items?");
            if(co){
               $.ajax({
                        post:'GET',
                        data:'sw=8&id='+id,
                        url:'../vistas/cotizacion/acciones.php',
                        success:function(d){
                            alert("Se elimino con exito");
                            com(idc);
                        }
                 });
             }
    }
    
    function rielesform(nom){
    var codigo = $("#refer").val();
    $("#titu").html(nom);
    $("#modalselection").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=9',
            url:'../vistas/cotizacion/acciones.php',
            success:function(a){
               //alert(a);
               $("#mostrar_select").html(a);     
            } 
        });
}
function alfajiasform(nom){
    var codigo = $("#refer").val();
    $("#titu").html(nom);
    $("#modalselection").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=10',
            url:'../vistas/cotizacion/acciones.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function rejillasform(nom){
    var codigo = $("#refer").val();
    $("#titu").html(nom);
    $("#modalselection").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=11',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function cierresform(nom){

    var codigo = $("#refer").val();
    $("#titu").html(nom);
    $("#modalselection").modal('show');

    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=11',
            url:'../vistas/cotizacion/acciones.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
    
}
function rodajasform(nom){
    var codigo = $("#refer").val();
    $("#titu").html(nom);
    $("#modalselection").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=12',
            url:'../vistas/cotizacion/acciones.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function brazosform(nom){
    var codigo = $("#refer").val();
    $("#titu").html(nom);
    $("#modalselection").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=14',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function bisagrasform(nom){
    var codigo = $("#refer").val();
    $("#titu").html(nom);
    $("#modalselection").modal('show');
    $.ajax({
            post:'GET',
            data:'codigo='+codigo+'&sw=15',
            url:'acciones_alu.php',
            success:function(a){
               $("#mostrar_select").html(a);     
            } 
        });
}
function seleccionar_riel(id,nom){
    $("#rieles").val(id);
    $("#desriel").val(nom);
    $("#modalselection").modal('hide');
}
function seleccionar_alfa(id,nom){
    $("#alfajias").val(id);
    $("#desalfa").val(nom);
    $("#modalselection").modal('hide');
}
function seleccionar_cierre(id,nom){
    $("#cierres").val(id);
    $("#descier").val(nom);
    $("#cancier").focus();
    $("#modalselection").modal('hide');
}
function seleccionar_roda(id,nom){
    $("#rodajas").val(id);
    $("#desroda").val(nom);
    $("#canroda").focus();
    $("#modalselection").modal('hide');
}
