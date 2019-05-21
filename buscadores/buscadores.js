$(function () {
	
//             $("#buscador").click(function () {
//                  cot=$("#cot").val();  
//                  nom=$("#nom").val(); 
//                  nomtemp=$("#nomtemp").val();
//                  obr=$("#obr").val(); 
//                  reg=$("#reg").val(); 
//                  ase=$("#ase").val();  
//                  
//                $.post("../buscadores/buscar.php", { cot: cot, nom:nom,nomtemp:nomtemp,obr:obr,reg:reg,ase:ase }, function(data){
//                $("#cotizacione").html(data);
//
//                });			
//       
//               });	
             $("#buscadorc").click(function () {
                  cot=$("#cot").val();  nom=$("#nom").val();
                $.post("../buscadores/buscarc.php", { cot: cot, nom:nom}, function(data){
                $("#clientes").html(data);

                });			
       
               });
              $("#xbuscador").click(function () {
                  cot=$("#xcot").val();  nom=$("#xnom").val();
                  obr=$("#xobr").val(); reg=$("#reg").val(); 
                  ase=$("#ase").val();  
                $.post("../buscadores/buscar_pedido.php", { cot: cot, nom:nom,obr:obr,reg:reg,ase:ase }, function(data){
                $("#xcotizacione").html(data);	

                });			
       
               });	  

     $("#linea").change(function () {
   		$("#linea option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar.php", { elegido2: elegido2 }, function(data){
				$("#busqueda").html(data);	
			});			
        });
   })
       $("#lineax").change(function () {
   		$("#lineax option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar_pedido.php", { elegido2: elegido2 }, function(data){
				$("#busqueda").html(data);	
			});			
        });
   })
     
  

     $("#xlinea").change(function () {
   		$("#xlinea option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar_pedido.php", { elegido2: elegido2 }, function(data){
				$("#xbusqueda").html(data);	
			});			
        });
   })
       $("#xlineax").change(function () {
   		$("#xlineax option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar_pedido.php", { elegido2: elegido2 }, function(data){
				$("#xbusqueda").html(data);	
			});			
        });
   })
   
   
});


