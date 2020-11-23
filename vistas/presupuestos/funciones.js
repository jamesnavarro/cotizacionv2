$(function() {



        });

function mostrar_tabla_items(cot,cli,page){
    var pag = $("#paginas").val();
    var est = $("#estcot").val();
    var buscar = $("#buscar").val();
       $("#mostrar_listado").html('<img src="../images/loading.gif">');
       $.ajax({
                post:'GET',
                data:'cot='+cot+'&cli='+cli+'&page='+page+'&est='+est+'&pag='+pag+'&buscar='+buscar,
                url:'../vistas/presupuestos/lista_items.php',
                success:function(d){
                    $("#mostrar_listado").html(d);
                }
         });
}
   