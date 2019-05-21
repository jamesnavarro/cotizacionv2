        $(function() {
            $('#cantidad').change(function(){
                agregar();
            });
            $('#codigo').change(function(){
                var cod = $("#codigo").val();
                 $.ajax({
                        post:'GET',
                        data:'sw=4&cod='+cod,
                        url:'../vistas/solicitudes/acciones.php',
                        success:function(d){
                            var p = eval(d);
                            if(p[0]===null){
                                $("#msg").html("<font color='red'><b>Este codigo no existe</b></font>").show(200).delay(1000).hide(200);
                                $("#codigo").focus();
                                return false;
                            }
                            $("#codigo").val(p[3]);
                            $("#descripcion").val(p[1]);
                            $("#ref").val(p[2]);
                            $("#dado").val(p[4]);
                            $("#perfil").val(p[5]);
                            $("#cantidad").focus();
                        }
                 });
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
    function adicionar(item,sw){
        var ref = $("#ref"+item).val();
        var can = $("#can"+item).val();
        var per = $("#per"+item).val();
        var color = $("#color"+item).val();
        var des = $("#des"+item).val();
        var idcot = $("#idcot"+item).val();
        var idpro = $("#idpro"+item).val();
        var sistema = $("#sistema"+item).val();
        var v = $("#v"+item).val();
        var cot = $("#cot").val();
        //alert("per:"+per+" - referencia:"+ref);
         $("#proceso").html("<img src='../imagenes/load.gif'> Procesando...");
        $.ajax({
            post:'GET',
            data:'sw='+sw+'&ref='+ref+'&sistema='+sistema+'&v='+v+'&idcot='+idcot+'&idpro='+idpro+'&can='+can+'&per='+per+'&color='+color+'&cot='+cot+'&des='+des+'&item='+item,
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
                //alert(d);
                if(d==='error'){
                    alert("Este codigo no existe en la base de datos con esta medida");
                    $("#"+item).attr("checked",false);
                    $("#proceso").html("");
                    return false;
                }else{
                    if(d==='update'){
                        $("#msg").html("<font color='blue'><b>Se adiciono mas cantidades de ese codigo </b></font>"+item).show(200).delay(1000).hide(200);
                    }else{
                        if(d==='insert'){
                           $("#msg").html("<font color='green'><b>Se agrego un nuevo codigo</b></font>"+item).show(200).delay(1000).hide(200);
                        }else{
                           $("#msg").html("<font color='red'><b>Se quito con exito</b></font>"+item).show(200).delay(1000).hide(200);
                        }
                    }
                    $("#proceso").html("");
                }
                mostrar(cot);
            } 
        });  
    }
        function adicionarmix(item,sw,opt){
        var ref = $("#ref"+item).val();
        var can = $("#can"+item).val();
        var per = $("#per"+item).val();
        var color = $("#color"+item).val();
        var des = $("#des"+item).val();
        var cot = $("#cot").val();
        $.ajax({
            post:'GET',
            data:'sw='+sw+'&ref='+ref+'&can='+can+'&per='+per+'&color='+color+'&cot='+cot+'&des='+des+'&item='+item,
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
                 var p = eval(d);
                 if(p[0]==='0'){
                     var con = confirm("No hay referencias ingresadas con esta medida, desea agregarla?");
                     if(con){
                         agregarmix(ref,can,per,color,des,cot,11);
                     }else{
                        return false;
                     }
                 }else{
                    if(opt=='1'){
                     var con = confirm("Ya existe la referencia "+p[4]+" con esta medida de "+p[2]+" con una cantidad de "+p[3]+" \n ¿Quieres actualizar este perfil?");
                     

                     }else{
                        var con = confirm("Se quitara el un segmento del perfil "+p[4]+" con esta medida de "+p[2]+" con una cantidad de "+p[3]+" \n ¿Quieres actualizar este perfil?");
                     
                        }
                        if (con) {
                        var pt = parseInt(per) + parseInt(p[2]);
                        if(pt>7100 && opt==1){
                            alert("No puedes agregar este item por que supera el perfil maximo de 7100,\n la suma de los dos son de "+pt);
                            $("#mix"+item).attr("checked", false);
                            return false;
                        }else{
                            if(opt=='1'){
                            var i = prompt("Que cantidad total  quieres ingresar para esta medida de "+pt+" .\n recuerda que hay "+p[3]+" Und ingresadas de "+p[2]);
                            }else{
                                var pt = parseInt(p[2]) - parseInt(per);
                                var i = prompt("Que cantidad total  quieres ingresar para la nueva medida de "+pt+" .\n recuerda que hay "+p[3]+" Und ingresadas de "+p[2]);
                            
                            }

                            if(i==null){
                                alert("debes ingresar alguna medida");
                                $("#mix"+item).attr("checked", false);
                                return false;

                            }else{
                                if(opt=='1'){
                                    
                                    agregarmix(ref,i,pt,color,des,cot,12);
                                    alert("paso en actualizar");
                                }else{
                                    
                                    agregarmix(ref,i,per,color,des,cot,13);
                                    alert("paso a quitar");
                                }
                                
                            }
                            
                        }
                       
                     }else{
                        $("#mix"+item).attr("checked", false);
                     }
                 }
                
                
                mostrar(cot);
            } 
        });  
    }
            function agregarmix(ref,can,per,color,des,cot,sw){
    $("#proceso").html("<img src='../imagenes/load.gif'> Procesando...");
        $.ajax({
            post:'GET',
            data:'sw='+sw+'&ref='+ref+'&can='+can+'&per='+per+'&color='+color+'&cot='+cot+'&des='+des+'&item='+item,
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
                $("#proceso").html("");
            } 
        });  
    }
    function mostrar(cot){
        $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=3',
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
                $("#mostrar_items").html(d);
            } 
        });
    }
    function formulario(cod){
        var cot = $("#cot").val();
        window.open("../vistas/solicitudes/referencias_up.php?cod="+cod+'&cot='+cot,"Buscar","width=300 , height=200");
    }
    function buscar(){
        window.open("../popup/referencias.php","Buscar","width=800 , height=400");
    }
      function pasar_referencias(id,des,ref,cod,dado,med){
        $("#codigo").val(cod);
        $("#descripcion").val(des);
        $("#ref").val(ref);
        $("#dado").val(dado);
        $("#perfil").val(med);
        $("#cantidad").focus();
    }
    function agregar(){
        var ref = $("#ref").val();
        var can = $("#cantidad").val();
        var per = $("#perfil").val();
        var color = $("#col").val();
        var cot = $("#cot").val();
        var cod = $("#codigo").val();
        var des = $("#descripcion").val();
        if(cod===''){
            $("#codigo").focus();
            return false;
        }
        if(can===''){
            $("#cantidad").focus();
            return false;
        }
         $("#proceso").html("<img src='../imagenes/load.gif'> Procesando..." + ref+'-'+can+'-'+per+'-'+color+'-'+cot);
        $.ajax({
            post:'GET',
            data:'sw=1&ref='+ref+'&can='+can+'&per='+per+'&color='+color+'&des='+des+'&cot='+cot,
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
                if(d==='error'){
                    alert("Este codigo no existe en la base de datos con esta medida");
                    $("#"+item).attr("checked",false);
                    $("#proceso").html("");
                    return false;
                }else{
                    
                    $("#proceso").html("");
                }
                mostrar(cot);
                limpiarsc();
            } 
        });
    }
    function limpiarsc(){
         $("#codigo").val('');
        $("#descripcion").val('');
        $("#ref").val('');
        $("#dado").val('');
        $("#perfil").val('');
        $("#cantidad").val('');
        $("#codigo").focus();
    }
    function del(id){
        var cot = $("#cot").val();
        var co = confirm("Desea quitar este items");
        if(co){
             $.ajax({
            post:'GET',
            data:'id='+id+'&sw=6',
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
                mostrar(cot);
            } 
        });
       }
    }
    function savesc(){
        
        var cot = $("#cotizacion").val();
        var idcot = $("#cot").val();
        var fecha = $("#fecha").val();
        var user = $("#user").val();
        var sol = $("#sol").val();
        var obs = $("#obs").val();
        var peso = $("#pesot").val();
        var area = $("#areat").val();
        var item = $("#item").val();
        var co = confirm("Esta seguro de guardar?");
        if(co){
        if(item==='0'){
            alert("Debes ingresar por lo menos 1 perfil");
            return false;
        }
         $.ajax({
            post:'GET',
            data:'idcot='+idcot+'&cot='+cot+'&user='+user+'&sol='+sol+'&obs='+obs+'&peso='+peso+'&area='+area+'&sw=7',
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
                $("#sol").val(d);
                $("#imp").attr("disabled", false);
                
            } 
        });
    }

    }
    function imp(cot){
        var sol = $("#sol").val();
        if(sol===''){
            alert("Debes de generar la solicitud");
        }else{
            window.open("../vistas/solicitudes/imprimir.php?cot="+cot+"&exportar","Form","width=800 , height=500");
        }
    }
        function impd(cot){
        var sol = $("#sol").val();
        if(sol===''){
            alert("Debes de generar la solicitud");
        }else{
            window.open("../vistas/solicitudes/imprimir_1.php?cot="+cot,"Form","width=800 , height=500");
        }
    }
     function pdfx(sol){
            window.open("../../compras/vistas/print_sol_compra.php?sol="+sol,"FormCompra","width=900 , height=800");
      
        }
        function actualizar(id){
            var cod = $("#c"+id).val();
            $.ajax({
            post:'GET',
            data:'id='+id+'&cod='+cod+'&sw=8',
            url:'../vistas/solicitudes/acciones.php',
            success:function(d){
               alert(d);
                
            } 
        });
        }
function selectAll(sw,ch,idcot,c) {
    

	var checkboxes = document.getElementsByName('anular'+idcot);
        var t = c + 1;
        //alert(t);
	for(var i=0; i<checkboxes.length; i++){
                
		console.log(checkboxes[i].id);
		checkboxes[i].checked =ch.checked;
                adicionar(i+t,sw);
                //alert(i+t);
                
                
	}
}