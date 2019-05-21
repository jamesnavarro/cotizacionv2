        $(function() {
            $('#textos').click(function(){
                $("#myModal").modal();
                mostrar_texto();
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
                            $("#add_fila"+id).html("<tr><td>"+per+"</td><td>"+per+"</td><td>"+per+"</td><td>"+per+"</td></tr>");
                        }
                 });
   }
   function editar_general(){
       window.open("../vistas/configuraciones/index.php","Formulario","width=900px, height=600px");
   }
    function editar_moi(id){
        var valor = $("#valor"+id).val();
        var valor2 = $("#valor2"+id).val();
        var valor3 = $("#valor3"+id).val();
        var unidad = $("#unidad"+id).val();
        var unidad2 = $("#unidad2"+id).val();
        var unidad3 = $("#unidad3"+id).val();
        var des = $("#des"+id).val();

        $.ajax({
                        post:'GET',
                        data:'sw=1&id='+id+'&valor='+valor+'&valor2='+valor2+'&valor3='+valor3+'&unidad='+unidad+'&unidad2='+unidad2+'&unidad3='+unidad3+'&des='+des,
                        url:'acciones.php',
                        success:function(d){
                            $("#des"+id).attr("style","background:#E1F5A9;width:100%");
                         
                        }
                 });
    }
   