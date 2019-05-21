$(function(){
    $('#cod').change(function(){
        mostrar_bod(1);
      });

 });  
 function inv_buscar_codigo(){
     var cod = $("#bod_cod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/bodegas/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#bod_cod").val(cod);
              $("#bod_nomb").val(t[1]);
              $("#bod_resum").val(t[2]);
              $("#bod_cuenta").val(t[3]);
              $("#ctaapi_bod").val(t[4]);
              $("#estado_bod").val(t[5]);
              $("#ciudad_bod").val(t[6]);
              $("#codica_bod").val(t[7]);
              $("#costos_bod").val(t[8]);
              $("#codnit_bod").val(t[9]);
              $("#sed_bod").val(t[10]);
         }
     
});
 }
 function add_perfil(){
    $.ajax({
                type: 'GET',
                url: '../vistas/version2/productos/modalperfil.php',
         success: function(t) {
              $("#modalper").html(t);
              $("#Formularioaluminio").modal('show');
              
         }
     
});
}
function modalrejillas(){
     $("#ModalRejillas").modal('show');
//     var ancho = $("#ancho").val();
//     var alto = $("#alto").val();
//     var altura = $("#altura").val();
//     var altura_v_c = $("#altura_v_c").val();
//     var anchura = $("#anchura").val();
//     var anchura_v_c = $("#anchura_v_c").val();
//     var cod = $("#cod").val();
//     $.ajax({
//                type: 'GET',
//                data:'ancho='+ancho+'&cod='+cod+'&alto='+alto+'&altura='+altura+'&altura_v_c='+altura_v_c+'&anchura='+anchura+'&anchura_v_c='+anchura_v_c+'',
//                url: '../vistas/version2/productos/modalrejillas.php',
//                success: function(t) {
//                     $("#modalform").html(t);
//                     $("#ModalRejillas").modal('show');
//
//                }
//     
//     });
}
     
     function calcularperfil(){
         var ancho = $("#ancho").val();
         var alto = $("#alto").val();
         var altura = $("#altura").val();
         var altura_v_c = $("#altura_v_c").val();
         var anchura = $("#anchura").val();
         var anchura_v_c = $("#anchura_v_c").val();
         
         var lado = $("#lado").val();
         
         var per1 = $("#fom_per1").val();
         var per = $("#lado_r").val();
         var var1 = $("#fom_var1").val();
         var ope = $("#fom_ope").val();
         var var2 = $("#fom_var2").val();
         var medida;
         var total;
         if(per1=='0'){
             
             if(lado=='Vertical'){
                medida = alto;
             }else{
                medida = ancho;
             }
         }else{
             if(per1=='1'){
                  medida = altura_v_c;
             }else if(per1=='2'){
                  medida = altura;
             }else if(per1=='3'){
                  medida = anchura;
             }else if(per1=='4'){
                  medida = anchura_v_c;
             }else if(per1=='976'){
                  medida = ancho;
             }else{
                  medida = ancho;
             }
         }
        
         if(ope=='+'){
             total = parseInt(medida) + parseInt(var1) + parseInt(var2);
         }else if(ope=='-'){
              total = parseInt(medida) + parseInt(var1) - parseInt(var2);
         }else if(ope=='*'){
              total = parseInt(medida) + parseInt(var1) * var2;
         }else{
              total = (parseInt(medida) + parseInt(var1)) / var2;
         }
         
         $("#resu").val(total);
     }
     function cal_can_rej(){
          var ancho = $("#ancho").val();
         var alto = $("#alto").val();
         var altura = $("#altura").val();
         var altura_v_c = $("#altura_v_c").val();
         var anchura = $("#anchura").val();
         var anchura_v_c = $("#anchura_v_c").val();
         var medp = $("#medp").val();
         
         var per1 = $("#perfil_med").val();
         var var3 = $("#var3").val();
         var mul = $("#multiplo").val();
         var medida;
         var tot;
         
             if(per1=='90001'){
                  medida = altura_v_c;
             }else if(per1=='90002'){
                  medida = altura;
             }else if(per1=='90003'){
                  medida = anchura;
             }else if(per1=='90004'){
                  medida = anchura_v_c;
             }else{
                 
                  medida = medp;
             }
            tot = (parseInt(medida) / parseInt(var3)) * parseInt(mul);
         
         $("#res_can_rej").val(tot);
         
         
     }
     function sacar_medida_perfil(){
         var ancho = $("#ancho").val();
         var alto = $("#alto").val();
         var altura = $("#altura").val();
         var altura_v_c = $("#altura_v_c").val();
         var anchura = $("#anchura").val();
         var anchura_v_c = $("#anchura_v_c").val();
         
         var ref = $("#perfil_med").val();
         
         $.ajax({
                 type: 'GET',
                 data:'ancho='+ancho+'&ref='+ref+'&alto='+alto+'&altura='+altura+'&altura_v_c='+altura_v_c+'&anchura='+anchura+'&anchura_v_c='+anchura_v_c+'&sw=3',
                 url: '../vistas/version2/productos/acciones.php',
                 success: function(t) {
                     
                      $("#medp").val(t);
                 }
     
           });
     }
     function cal_med_rej(){
         var ancho = $("#ancho").val();
         var alto = $("#alto").val();
         var altura = $("#altura").val();
         var altura_v_c = $("#altura_v_c").val();
         var anchura = $("#anchura").val();
         var anchura_v_c = $("#anchura_v_c").val();
         var medp = $("#medm").val();
         
         var per1 = $("#med_rej").val();
         var var3 = $("#varr").val();
         var mul = $("#en").val();
         var medida;
         var tot;
         
             if(per1=='999994'){
                  medida = ancho;
             }else if(per1=='999995'){
                  medida = anchura;
             }else if(per1=='999996'){
                  medida = anchura_v_c;
             }else if(per1=='999997'){
                  medida = altura_v_c;
             }else if(per1=='999998'){
                  medida = altura;
             }else if(per1=='999999'){
                  medida = alto;
             }else{
                  medida = medp;
             }
            tot = (parseInt(medida) + parseInt(var3)) / parseInt(mul);
         
         $("#res_med_rej").val(tot);
         
         
     }
      function sacar_medida_perfil2(){
         var ancho = $("#ancho").val();
         var alto = $("#alto").val();
         var altura = $("#altura").val();
         var altura_v_c = $("#altura_v_c").val();
         var anchura = $("#anchura").val();
         var anchura_v_c = $("#anchura_v_c").val();
         
         var ref = $("#med_rej").val();
         
         $.ajax({
                 type: 'GET',
                 data:'ancho='+ancho+'&ref='+ref+'&alto='+alto+'&altura='+altura+'&altura_v_c='+altura_v_c+'&anchura='+anchura+'&anchura_v_c='+anchura_v_c+'&sw=3',
                 url: '../vistas/version2/productos/acciones.php',
                 success: function(t) {
                     
                      $("#medm").val(t);
                 }
     
           });
     }