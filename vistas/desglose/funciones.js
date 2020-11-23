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
            data:'cot='+cot+'&sw=1',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
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
    function reiniciar(){
        var cot = $("#cot").val();
        var c = confirm("Esta seguro de reestablecer el desglose?");
        if(c){
        $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=10',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
                mostrar(cot);
            } 
        });
    }
    }
    
    function mostrar_desglose(){
       var cot = $("#cot").val();
        $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=3',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
                $("#mostrar_desglose").html(d);
            } 
        });
    }
     function desglose_final(){
       var cot = $("#cot").val();
        $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=3.1',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
                $("#mostrar_final").html(d);
            } 
        }); 
    }
    function upobs(ref,med,cot,c){
        var obs = $("#obs"+c).val();
        $.ajax({
            post:'GET',
            data:'cot='+cot+'&ref='+ref+'&med='+med+'&obs='+obs+'&sw=22',
            url:'desglose/acciones.php',
            success:function(d){
                alert(d);
                //$("#mostrar_final").html(d);
            } 
        }); 
    }
        function procesar(){
            var cot = $("#cot").val();
            var c = confirm("Esta seguro de procesar esta solicitud");
            if(c){
               $("input[name=item]:checked").each(function(){
                        var id = $(this).attr("id");
                        var item = $("#item"+id).val();
                        var cod = $("#cod"+id).val();
                        var ref = $("#ref"+id).val();
                        var col = $("#col"+id).val();
                        var med = $("#med"+id).val();
                        var und = $("#und"+id).val();
                        var can = $("#can"+id).val();
                        var per = $("#per"+id).val();
                        var tipo = $("#tipo"+id).val();
                        var sis = $("#sis"+id).val();
                        console.log(id);
                        $.ajax({
                            post:'GET',
                            data:'id='+id+'&cod='+cod+'&item='+item+'&ref='+ref+'&sis='+sis+'&col='+col+'&med='+med+'&und='+und+'&can='+can+'&per='+per+'&cot='+cot+'&tipo='+tipo+'&sw=2',
                            url:'../vistas/desglose/acciones.php',
                            success:function(d){
                               $("#msg"+id).html(d);
                            } 
                        });
                }); 
            }
        }
        
        function veri(refe){
            $("input[name=item]:checked").each(function(){
                var id = $(this).attr("id");
                var ref = $("#ref"+id).val();
            });
            
        }
        function vermodal(){
            var ids = '';
            $("input[name=item]:checked").each(function(){
                var id = $(this).attr("id");
                var ref = $("#ref"+id).val();
                ids = ids+id+',';
            });
            ids = ids+'0';
            calcular_desglose(ids);
        }
        function calcular_desglose(ids){
        $.ajax({
            post:'GET',
            data:'ids='+ids+'&sw=4',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
                $("#contenido").html(d);
            } 
        });
    }
    function multiplicar(){
        var a = $("#MT").val();
        var b = $("#vr").val();
        var t = (a*b)+100;
        $("#pt").val(t);
    }
    
    function updateperfil(){
         var ref = $("#ref").val();
         var perfil = $("#pt").val();
         var cot = $("#cot").val();
         var id = $("#idxx").val();
          $.ajax({
            post:'GET',
            data:'ref='+ref+'&cot='+cot+'&perfil='+perfil+'&id='+id+'&sw=5',
            url:'desglose/acciones.php',
            success:function(d){
                alert(d);
                mostrar_desglose();
            } 
        });
    }
    
    function pasar(id,item){
        $("#sist"+id).val(item);
        updatesistema(id);
    }
    function cambiarsistema(id){
        var ref = $("#refe"+id).val();
        var sis = $("#sist"+id).val();
        var cot = $("#cot").val();
        window.open("../popup/sistemas.php?id="+id,"acc","width=600px , height=600px");
        
    }
    function updatesistema(id){
        var ref = $("#refe"+id).val();
        var sis = $("#sist"+id).val();
        var cot = $("#cot").val();
            $.ajax({
                post:'GET',
                data:'ref='+ref+'&cot='+cot+'&sis='+sis+'&id='+id+'&sw=6',
                url:'desglose/acciones.php',
                success:function(d){
                    alert(d);
                    mostrar_desglose();
                } 
            });
    }
    function cambiarperfil(id){
         var ref = $("#refe"+id).val();
         var perfil = $("#perf"+id).val();
         var med = $("#medi"+id).val();
         var cot = $("#cot").val();
         var c = confirm("Esta seguro  de cambiar el perfil");
         if(c){
            $.ajax({
            post:'GET',
            data:'ref='+ref+'&id='+id+'&perfil='+perfil+'&med='+med+'&cot='+cot+'&sw=5',
            url:'desglose/acciones.php',
            success:function(d){
            alert(d);
            mostrar_desglose();
              } 
            });
         }
    }
function vidrios(){
       var cot = $("#cot").val();
       $("#btn_vidrio").html('<img src="../images/load.gif"> Cargando Datos...');
        $.ajax({
        post:'GET',
        data:'cot='+cot+'&sw=1',
        url:'desglose/vidrios.php',
        success:function(d){
       //alert(d);
       $("#mostrar_vidrios").html(d);
       $("#btn_vidrio").html('Actualizar Modulo vidrio');
       } 
        });
    }
    
     function procesarvid(){
        var cot = $("#cot").val();
        var c = confirm("Esta seguro de procesar esta solicitud");
            if(c){
               $("input[name=item2]:checked").each(function(){
                        var id = $(this).attr("id");
                        var item = $("#item"+id).val();
                        var idv = $("#idvidrio"+id).val();
                        var col = $("#color"+id).val();
                        var esp = $("#espesor"+id).val();
                        var pes = $("#peso"+id).val();
                        var area = $("#area"+id).val();
                        console.log(id);
                        $.ajax({
                            post:'GET',
                            data:'id='+id+'&idv='+idv+'&item='+item+'&esp='+esp+'&pes='+pes+'&col='+col+'&area='+area+'&cot='+cot+'&sw=2.1',
                            url:'../vistas/desglose/acciones.php',
                            success:function(d){
                               $("#msg2"+id).html(d);
                            } 
                        });

                });
                
            }
    }
        function resetvid(){
        var cot = $("#cot").val();
        var c = confirm("Esta seguro de resetear los vidrios?");
            if(c){
                        $.ajax({
                            post:'GET',
                            data:'cot='+cot+'&sw=21',
                            url:'../vistas/desglose/acciones.php',
                            success:function(d){
                                alert(d);
                              mostrar_desglose_vidrio();
                            } 
                        });    
            }
    }
    function mostrar_desglose_vidrio(){
         var cot = $("#cot").val();
         //alert(cot);
         $.ajax({
         post:'GET', 
         data:'cot='+cot+'&sw=7',
         url:'../vistas/desglose/acciones.php',
         success:function(d){
         $("#mostrar_desglose_vidrios").html(d);
                            } 
         });  
    }
    function accesorios(){
        var cot = $("#cot").val();
        $("#mostrar_accesorios").html("Cargando Datos.. <img src='../images/load.gif'> ");
         $.ajax({
             post:'GET',
             data:'cot='+cot+'',
             url:'../vistas/desglose/accesorios.php',
             success:function(d){
                               $("#mostrar_accesorios").html(d);

                            } 
                        });
    }
    function procesar_accesorios(){
         var cot = $("#cot").val();
        var c = confirm("Esta seguro de procesar esta solicitud!");
            if(c){
               $("input[name=item3]:checked").each(function(){
                        var id = $(this).attr("id");
                        var item = $("#itema"+id).val();
                        var cod = $("#coda"+id).val();
                        var ref = $("#refa"+id).val();
                        var col = $("#coloa"+id).val();
                        var med = $("#meda"+id).val();
                        var und = $("#unda"+id).val();
                        var can = $("#cana"+id).val();
                        var per = '';
                        var tipo = $("#tipoa"+id).val();
                        var sis = '';
                        console.log(id);
                        $.ajax({
                            post:'GET',
                            data:'id='+id+'&cod='+cod+'&item='+item+'&ref='+ref+'&sis='+sis+'&col='+col+'&med='+med+'&und='+und+'&can='+can+'&per='+per+'&cot='+cot+'&tipo='+tipo+'&sw=8',
                            url:'../vistas/desglose/acciones.php',
                            success:function(d){
                               $("#msgx"+id).html(d);
                            } 
                        });
                }); 
            }
    }
    function mostrar_desglose_acc(){
       var cot = $("#cot").val();
        $.ajax({
            post:'GET',
            data:'cot='+cot+'&sw=9',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
                $("#mostrar_accesorios_resumen").html(d);
            } 
        });
    }
    function mandar(c){
        var cot = $("#cot").val();
        window.open("desglose/EnviarSolicitud.php?id="+cot,"acc","width=600px , height=400px");
    }
    function buscarema(){
                    var usuario = $("#usuario").val();
                    if(usuario!==''){
                     $.ajax({
                            post:'GET',
                            data:'usuario='+usuario+'&sw=11',
                            url:'desglose/acciones.php',
                            success:function(d){
                               $("#email").val(d);
                            } 
                        });
                    }else{
                        $("#email").val('');
                    }
                }
        function enviarnot(){
            var cot = $("#cot").val();
            var de = $("#de").val();
            var email = $("#email").val();
            var msg = $("#message").val();
            $.ajax({
                   post:'GET',
                            data:'cot='+cot+'&sw=12',
                            url:'desglose/acciones.php',
                            success:function(d){
                               enviar_email(cot,de,email,msg);
                               alert(d);

                            } 
                        });

        }
 function enviar_email(cot,de,para,notas){
          window.open("http://aluvmix.softmediko.com/notificar.php?cot="+cot+"&de="+de+"&para="+para+"&notas="+notas,"form","width=100px, height=100px");
 }
 function verperfiles(ref,med){
     var cot = $("#cot").val();
            $.ajax({
                            post:'GET',
                            data:'cot='+cot+'&ref='+ref+'&med='+med+'&sw=13',
                            url:'desglose/acciones.php',
                            success:function(d){
                                $("#mostrar_editar").html(d);
                            } 
                        });
     
 }
 
 function CambiarPerfil(id){
          window.open("../popup/referencias_1.php?id="+id,"form","width=900px, height=500px");
 }
 function UpPerfil(id){
     var c = confirm("esta seguro de editar este perfil?");
     if(c){
     var cot = $("#cot").val();
     var cod = $("#xcod"+id).val();
     var ref = $("#xref"+id).val();
     var can = $("#xcan"+id).val();
     $.ajax({
                post:'GET',
                data:'id='+id+'&cot='+cot+'&ref='+ref+'&cod='+cod+'&can='+can+'&sw=14',
                url:'desglose/acciones.php',
                success:function(d){
                   alert(d);
                   desglose_final();
                } 
            });
        }
     
 }
  function mostrarconf(){
       var cod = $("#bcod").val();
       var cot = $("#cot").val();
       var ref = $("#bref").val();
       var per = $("#bper").val();
       var tip = $("#btip").val();
       
        $.ajax({
            post:'GET',
            data:'cod='+cod+'&cot='+cot+'&ref='+ref+'&per='+per+'&tip='+tip+'&sw=15',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
                $("#mostrar_configuracion").html(d); 
            } 
        });
    
    }
    function updateref(id){
       var cod = $("#upcod"+id).val();
       var ref = $("#upref"+id).val();
       var med = $("#upmed"+id).val();
       var can = $("#upcan"+id).val();
       var per = $("#upper"+id).val();
       var cpe = $("#upcpe"+id).val();
       var tip = $("#uptip"+id).val();
       
        $.ajax({
            post:'GET',
            data:'id='+id+'&cod='+cod+'&ref='+ref+'&med='+med+'&can='+can+'&per='+per+'&cpe='+cpe+'&tip='+tip+'&sw=16',
            url:'desglose/acciones.php',
            success:function(d){
               alert(d);
               mostrarconf();
            } 
        });
    
    }
    function delper(id){
     var c = confirm("esta seguro de eliminar este items?");
     if(c){

     $.ajax({
                post:'GET',
                data:'id='+id+'&sw=17',
                url:'desglose/acciones.php',
                success:function(d){
                   alert(d);
                   mostrarconf();
                } 
            });
        }
     
 }
 function copyper(id){
     var c = confirm("Esta seguro de copiar este items?");
     if(c){

     $.ajax({
                post:'GET',
                data:'id='+id+'&sw=18',
                url:'desglose/acciones.php',
                success:function(d){
                   alert(d);
                   mostrarconf();
                } 
            });
        }
     
 }
 //probar 18068
 function buscarvid(c){
     var id = $("#idvidrio"+c).val();
        $.ajax({
            post:'GET',
            data:'id='+id+'&sw=20',
            url:'desglose/acciones.php',
            success:function(d){
                //alert(d);
                var p = eval(d);
                $("#color"+c).val(p[0]);
                $("#espesor"+c).val(p[1]);
            } 
        });
    }
    
    function updatetipovid(c,it){
        var id = $("#idvidrio"+c).val();
        var ti = $("#it"+c).val();
        
         //alert(it+' c: '+c);
        $.ajax({
            post:'GET',
            data:'idvidrio='+id+'&tipo='+ti+'&item='+it+'&sw=23',
            url:'desglose/acciones.php',
            success:function(d){
                alert(d);
               
            } 
        });
    }