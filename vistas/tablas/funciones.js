
$(function(){
     mostrar_master(1); 
   
     
});
 
function mostrar_master(page){
      var item = $("#item").val(); 
      var cod = $("#cod").val();
      var ref = $("#ref").val();
      var des = $("#des").val();
      var lin = $("#lin").val();
      var sis = $("#sis").val();
      var per = $("#per").val();
      var est = $("#es").val();
        $.ajax({
            type: 'GET',
            data: 'item='+item+'&cod='+cod+'&ref='+ref+'&des='+des+'&est='+est+'&lin='+lin+'&sis='+sis+'&per='+per+'&page='+page,
            url: '../vistas/tablas/lista_3.php',
            success: function(resultado){
                 $("#mostrarproductos").html(resultado);
            }
  }); 
}
function uppertenece(id){ 
     var a = $("#ma"+id).is(":checked"); 
     var b = $("#mb"+id).is(":checked");
     var c;
     if(a==true){
         c=1;
         alert(c);
     }else{
         c=2;
         alert(c);
     }
     
     
        $.ajax({
            type: 'GET',
            data: 'id='+id+'&c='+c+'&sw=1',
            url: '../vistas/tablas/acciones.php', 
            success: function(resultado){
                alert("Se guardo con exito"+resultado);
            }
           });
}
function buscarsis(id){

        window.open("../popup/sistemas.php?id="+id+"&conf","acc","width=600px , height=600px");
        
    }
  function buscarref(id){

        window.open("../popup/referencias_2.php?id="+id+"&conf","acc","width=600px , height=600px");
        
    }
    function buscarref2(id){

        window.open("../popup/referencias_3.php?id="+id+"&conf","acc","width=600px , height=600px");
        
    }
function cargarref(idp){
 $.ajax({
        type: 'GET',
        data: 'id='+idp+'&sw=3',  //
        url: '../vistas/tablas/acciones.php', //
        success: function(resultado){
             $("#mostrarperfileria").html(resultado);
        }
 });

}
function cargaracc(idp){
 $.ajax({
        type: 'GET',
        data: 'id='+idp+'&sw=4',  //
        url: '../vistas/tablas/acciones.php', //
        success: function(resultado){
             $("#mostraraccesorios").html(resultado);
        }
 });

}
function pasarid(id,d,est){
    $("#idp").val(id);
    
    $("#titulo").html(d);
    if(est==0){
        $("#estp").html('Producto Activo');
         $("#botest").attr('class','btn btn-success');
         $("#estadop").val('1');
    }else{
        $("#estp").html('Producto No Activo');
        $("#botest").attr('class','btn btn-danger');
        $("#estadop").val('0');
    }
    cargarref(id);
    cargaracc(id);
}

function pasar_sistema(id,sis){
      $("#sis"+id).val(sis); 
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sis='+sis+'&sw=2',  //
        url: '../vistas/tablas/acciones.php', //
        success: function(resultado){
             alert("Se guardo con exito"+resultado);
        }
 });
}

function pasar_referencias2(id,item){
     var idp = $("#idp").val();
     var c = confirm("Esta seguro de cambiar esta referencia?" +id+ " - "+item);
     if(c){
        
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&item='+item+'&sw=5',  //
            url: '../vistas/tablas/acciones.php', //
            success: function(resultado){
                alert("Se ha cambiado con exito"+resultado);
                cargarref(idp);
            }
           });
       }
}
function upest(){
     var idp = $("#idp").val();
     var est = $("#estadop").val();
     var c = confirm("Esta seguro de cambiar estado del producto? ");
     if(c){
        
         $.ajax({
            type: 'GET',
            data: 'id='+idp+'&est='+est+'&sw=9',  //
            url: '../vistas/tablas/acciones.php', //
            success: function(resultado){
                alert(resultado);
                mostrar_master(1); 
            }
           });
       }
}
function pasar_referencias3(id,item){
     var idp = $("#idp").val();
     var c = confirm("Esta seguro de cambiar esta referencia?" +id+ " - "+item);
     if(c){
        
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&item='+item+'&sw=7',  //
            url: '../vistas/tablas/acciones.php', //
            success: function(resultado){
                alert("Se ha cambiado con exito"+resultado);
                cargaracc(idp);
            }
           });
       }
}
 function updatereferencia(item){
     var idp = $("#idp").val();
     var c = confirm("Esta seguro de cambiar esta referencia?");
     if(c){
        var lad = $("#uplad"+item).val();
        var can = $("#upcan"+item).val();
         $.ajax({
            type: 'GET',
            data: 'can='+can+'&item='+item+'&lad='+lad+'&sw=6',  //
            url: '../vistas/tablas/acciones.php', //
            success: function(resultado){
                alert("Se ha cambiado con exito"+resultado);
                cargarref(idp);
            }
           });
       }
}
 function updatereferencia2(item){
     var idp = $("#idp").val();
     var c = confirm("Esta seguro de cambiar esta referencia?");
     if(c){
        var lad = $("#uplada"+item).val();
        var can = $("#upcana"+item).val();
         $.ajax({
            type: 'GET',
            data: 'can='+can+'&item='+item+'&lad='+lad+'&sw=8',  //
            url: '../vistas/tablas/acciones.php', //
            success: function(resultado){
                alert("Se ha cambiado con exito"+resultado);
                cargaracc(idp);
            }
           });
       }
}