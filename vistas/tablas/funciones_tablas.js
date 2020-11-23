
$(function(){
     mostrar_master(1); 
   
     
});
 
function mostrar_master(page){
      var item = $("#item").val(); 
      var cod = $("#cod").val();
      var ref = $("#ref").val();
      var des = $("#des").val();
      var lin = $("#lin").val();
      var sis = '';
      var per = '';
        $.ajax({
            type: 'GET',
            data: 'item='+item+'&cod='+cod+'&ref='+ref+'&des='+des+'&lin='+lin+'&sis='+sis+'&per='+per+'&page='+page,
            url: '../vistas/tablas/lista_monty2.php',
            success: function(resultado){
                 $("#mostrarproductos").html(resultado);
            }
  }); 
}
function mostrar_master1(page){
      var item = $("#item1").val(); 
      var cod = $("#cod1").val();
      var ref = $("#ref1").val();
      var des = $("#des1").val();
      var lin = $("#lin1").val();
      var sis = '';
      var per = '';
        $.ajax({
            type: 'GET',
            data: 'item='+item+'&cod='+cod+'&ref='+ref+'&des='+des+'&lin='+lin+'&sis='+sis+'&per='+per+'&page='+page,
            url: '../vistas/tablas/lista_monty1.php',
            success: function(resultado){
                 $("#mostrarproductos1").html(resultado);
            }
  }); 
}
function mostrar_master3(page){
      var item = $("#item3").val(); 
      var cod = $("#cod3").val();
      var ref = $("#ref3").val();
      var des = $("#des3").val();
      var lin = $("#lin3").val();
      var sis = '';
      var per = '';
        $.ajax({
            type: 'GET',
            data: 'item='+item+'&cod='+cod+'&ref='+ref+'&des='+des+'&lin='+lin+'&sis='+sis+'&per='+per+'&page='+page,
            url: '../vistas/tablas/lista_monty3.php',
            success: function(resultado){
                 $("#mostrarproductos3").html(resultado);
            }
  }); 
}
function pasare(ref,id,pro,an,al,rie,alf,cie,rod){
          window.opener.buscare(ref,id,pro,an,al,rie,alf,cie,rod);
          window.close();
        }