<?php
 require '../modelo/conexion.php';
 if(isset($_GET['cod'])){
 $sql='select * from producto where id_p="'.$_GET['cod'].'"';
 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["tipo"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $fil["ancho"];
        $alto= $fil["alto"];
        $linea= $fil["linea"];
        $altura= $fil["med_adicional"];
        $altura_v_c= $fil["altura_v_c"];
        $anchura_v_c= $fil["ancho_v_c"];
        $anchura= $fil["ancho_adicional"];
        $ruta= $fil["ruta"];$ruta2= $fil["ruta2"];
        $per= $fil["perforacion"];
        $boq= $fil["boquete"];
        $referencia= $fil["referencia_p"];
        $aprobado= $fil["aprobado"];
        $des = $fil["actualizado"];
        $rev = $fil["revisado"];
        $laminas= $fil["laminas"];
        $alto_maximno= $fil["alto_maximo"];
        $ancho_maximo= $fil["ancho_maximo"];
         $hoja= $fil["hoja"];
         $kit= $fil["kit"];
         $ok= $fil["ok"];
         $anulado= $fil["estado_producto"];
         $sistemas= $fil["sistemas"];
         
         $rieles= $fil["rieles"];
         $alfajia= $fil["alfajia"];
         $cierres= $fil["cierres"];
         $rodajas= $fil["rodajas"];
         $brazos= $fil["brazos"];
         $bisagras= $fil["bisagras"];
         $despcorte = $fil["sumaperfil"];
         if($rieles=='true'){$check_rie = 'checked';}else{$check_rie = '';}
         if($alfajia=='true'){$check_alf = 'checked';}else{$check_alf = '';}
         if($cierres=='true'){$check_cie = 'checked';}else{$check_cie = '';}
         if($rodajas=='true'){$check_rod = 'checked';}else{$check_rod = '';}
         if($brazos=='true'){$check_bra = 'checked';}else{$check_bra = '';}
         if($bisagras=='true'){$check_bis = 'checked';}else{$check_bis = '';}
         
         if($ok==1){
             $led = '<img src="../imagenes/led.gif">';
         }else{
             $led = '<img src="../imagenes/ledrojo.gif">';
         }
         if($anulado==0){
             $btn = '<font color="green">Producto Activo</font>';
         }else{
             $btn = '<font color="red">Producto Inactivo</font>';
         }
         if($kit==0){
             $k = 'No';
             
         }else{
             $k= 'Si';
             
         }
 }
if(isset($_GET['aprobar'])){
    if($_GET['aprobar']==0){
         $sql = "UPDATE `producto` SET `aprobado`='1' WHERE `id_p` = ".$_GET["cod"].";";
         $que = mysqli_query($conexion,"INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`) VALUES (NULL, 'Se aprobo el producto','".$_SESSION['k_username']."','Productos','".$_GET["cod"]."') ");

    }else{
         $sql = "UPDATE `producto` SET `aprobado`='0' WHERE `id_p` = ".$_GET["cod"].";";
         $que = mysqli_query($conexion,"INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`) VALUES (NULL, 'Se Desaprobo el producto','".$_SESSION['k_username']."','Productos','".$_GET["cod"]."') ");
    }
   mysqli_query($conexion,$sql);
     echo '<script lanquage="javascript">alert("Se ha Modificado la DT");location.href="../vistas/?id=nuevo_producto&cod='.$_GET["cod"].'"</script>'; 

}
if(isset($_GET['revisar'])){
    if($_GET['revisar']==0){
         $sql = "UPDATE `producto` SET `revisado`='1' WHERE `id_p` = ".$_GET["cod"].";";
    }else{
         $sql = "UPDATE `producto` SET `revisado`='0' WHERE `id_p` = ".$_GET["cod"].";";
    }
   mysqli_query($conexion,$sql);
     echo '<script lanquage="javascript">alert("Se ha Modificado la DT");location.href="../vistas/?id=nuevo_producto&cod='.$_GET["cod"].'"</script>'; 

}
if(isset($_GET['actu'])){
    if($_GET['actu']==0){
         $sql = "UPDATE `producto` SET `actualizado`='1' WHERE `id_p` = ".$_GET["cod"].";";
    }else{
         $sql = "UPDATE `producto` SET `actualizado`='0' WHERE `id_p` = ".$_GET["cod"].";";
    }
   mysqli_query($conexion,$sql);
     echo '<script lanquage="javascript">alert("Se ha Modificado la DT");location.href="../vistas/?id=nuevo_producto&cod='.$_GET["cod"].'"</script>'; 

}
?>
<script>
function sel(c){
    formu=document.forms['formulario'];
    caracteres=c.length;
    if(caracteres!=0){
    for (x=0;x<formu['ref_mo'].options.length;x++){
    if(formu['ref_mo'].options[x].value.slice(0,caracteres)==c){
    formu['ref_mo'].selectedIndex=x;
    formu['ref_mo'].style.visibility="visible";
    break;
    }else{
    formu['ref_mo'].style.visibility="hidden";
    }
    }
    }else{
    formu['ref_mo'].style.visibility="hidden";

    }
}
$(document).ready(function(){
    var pro = $("#pro_des").val();
   $("#mostrar_desgloses").load(desgloses(pro));
   $("#ModalAccesorios").modal('show');
   $("#ModalAccesorios").modal('hide');
   $("#ref").click(function () {
   	window.open("../popup/cuentas.php","Registro","width=600 , height=600 ");
   });
});
function limpiar(){
    $("#id_ref").val('');
    $("#lado_des").val('');
    $("#can_des").val('');
    $("#ref").val('');
    $("#referencia").val('');
}
function desglose(){
    var pro = $("#pro_des").val();
    var ref = $("#id_ref").val();
    var lado = $("#lado_des").val();
    var can = $("#can_des").val();
    var med = $("#medida_des").val();
    var id = $("#id_des").val();
    if(lado==='Horizontal'){
        if(med==='1' || med==='2' || med==='5'){
            alert("Debes escoger solo los anchos  para este lado.");
            return false;
        }
    }else{
        if(med==='3' || med==='4' || med==='6'){
            alert("Debes escoger solo los altos para este lado.");
            return false;
        }
    }
    if(ref ==='' || can===''){
        alert("Llena todos los campos");
        return false;
    }
    $.ajax({
        type:'GET',
        data:'pro='+pro+'&id='+id+'&ref='+ref+'&lado='+lado+'&can='+can+'&med='+med+'&sw=0',
        url:'../modelo/insertar_desglose.php',
        success : function(d){
            alert("Se agrego con exito");
            limpiar();
            desgloses(pro);
        }
    });
}
function del_desglose(id_des, cod){
    var con = confirm("Estas seguro de eliminar este items?");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id_des+'&cod='+cod+'&sw=1',
        url:'../modelo/insertar_desglose.php',
        success : function(d){
            alert("Se Elimino con exito");
            desgloses(cod);
        }
    });
    }
}
function okr(id,ok){
    var con = confirm("Estas seguro de que revisaste este items?");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=4',
        url:'../modelo/insertar_desglose.php',
        success : function(d){
            alert("Se Reviso con exito");
            $("#btn").html(d);
        }
    });
    }
}
function anular(id,ok){
    var con = confirm("Estas seguro de cambiar el estado este producto?");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=5',
        url:'../modelo/insertar_desglose.php',
        success : function(d){
            alert("Se guardo con exito");
            $("#btn2").html(d);
        }
    });
    }
}
function desgloses(cod){
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var altura = $("#altura").val();
    var altura_v_c = $("#altura_v_c").val();
    var anchura = $("#anchura").val();
    var anchura_v_c = $("#anchura_v_c").val();
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&ancho='+ancho+'&alto='+alto+'&altura='+altura+'&altura_v_c='+altura_v_c+'&anchura='+anchura+'&anchura_v_c='+anchura_v_c+'&sw=2',
        url:'../modelo/insertar_desglose.php',
        success : function(d){
           $("#mostrar_desgloses").html(d);
        }
    });
}
function up_desglose(des, cod){
     $.ajax({
        type:'GET',
        data:'cod='+cod+'&des='+des+'&sw=3',
        url:'../modelo/insertar_desglose.php',
        success : function(d){
           var p = eval(d);
           var ref = $("#id_ref").val(p[1]);
            var ref = $("#ref").val(p[5]);
            var ref = $("#referencia").val(p[6]);
            $("#lado_des").val(p[2]);
            $("#medida_des").val(p[4]);
            $("#can_des").val(p[3]);
            $("#id_des").val(p[0]);
        }
    });
}
function pasar_referencias(id_ref, nombre, referencia){
    var ref = $("#id_ref").val(id_ref);
    var ref = $("#ref").val(nombre);
    var ref = $("#referencia").val(referencia);
    
    $("#refrej").val(id_ref);
    $("#b").val(nombre);
    $("#c").val(referencia);
    
    $("#select2_4").val(id_ref);
    
    
    
}
function historial(id){
    window.open("../vistas/historial.php?cod="+id,"Historial","width= 800px , height=600px");
}
function SaveRejillas(){
        var ref = $("#refrej").val();
        var perfil_med = $("#perfil_med").val();
        var multiplo = $("#multiplo").val();
        var med_rej = $("#med_rej").val();
        var var3 = $("#var3").val();
        var varr = $("#varr").val();
        var en = $("#en").val();
        var id = $("#idrefe").val();
         var cod = $("#cod").val();
        $.ajax({
            type:'POST',
            data:'id='+id+'&cod='+cod+'&ref='+ref+'&perfil_med='+perfil_med+'&multiplo='+multiplo+'&med_rej='+med_rej+'&var3='+var3+'&varr='+varr+'&en='+en+'&sw=1',
            url:'../modelo/reparto_rej.php',
            success : function(d){
                var p = eval(d);
                alert(p[1]);
                $("#idrefe").val(p[0]);
                location.reload();
            }
        });
}
function EditarRejilla(id){
    $.ajax({
            type:'POST',
            data:'id='+id+'&sw=2',
            url:'../modelo/reparto_rej.php',
            success : function(d){
                console.log(d);
                var p = eval(d);
                $("#refrej").val(p[1]);
                $("#b").val(p[2]);
                $("#c").val(p[3]);
                $("#perfil_med").val(p[5]);
                $("#multiplo").val(p[10]);
                $("#med_rej").val(p[6]);
                $("#var3").val(p[7]);
                $("#varr").val(p[8]);
                $("#en").val(p[9]);
                $("#idrefe").val(p[0]);
            }
        });
}

function LimpiarRejilla(){
        $("#refrej").val('');
        $("#perfil_med").val('');
       $("#multiplo").val('');
       $("#med_rej").val('');
       $("#var3").val('');
       $("#varr").val('');
       $("#en").val('');
       $("#idrefe").val('');
       $("#b").val('');
       $("#c").val('');
}
function BuscarReferencia(){
    window.open("../popup/referencias.php","Referencias"," width=1000px , height=600px"); 
}

      function editaracc(id){
          $("#ModalAccesorios").modal('show');
          //$('.nav-tabs a[href="#tab4x"]').tab('show');
    $.ajax({
            type:'GET',
            data:'id='+id+'&sw=4',
            url:'../vistas/version2/productos/acciones.php',
            success : function(d){
                console.log(d);
                var p = eval(d);
                $("#acc_id").val(p[0]);
                $("#select2_4").val(p[1]);
                $("#acc_col").val(p[2]);
                $("#perimetro").val(p[7]);
                $("#acc_can").val(p[3]);
                $("#acc_med").val(p[11]);
                $("#acc_rej").val(p[13]);
                $("#acc_metro").val(p[8]);
                $("#acc_lado").val(p[10]);
                $("#acc_mul").val(p[14]);
                $("#acc_ambos").val(p[16]);
                $("#acc_para").val(p[6]);
                $("#acc_obs").val(p[15]);
                $("#acc_yes").val(p[9]);
                $("#fija").val(p[17]);
            }
        });
}
function calcularacc(){
                var ancho = $("#ancho").val();
                var alto = $("#alto").val();
                var altura = $("#altura").val();
                var anchura = $("#anchura").val();
                var altura_v_c = $("#altura_v_c").val();
                var anchura_v_c = $("#anchura_v_c").val();
                
                var alto = $("#alto").val();
                var calcular = $("#perimetro").val();
                var can = $("#acc_can").val();
                var med = $("#acc_med").val();
                var rej = $("#acc_rej").val();
                var metro = $("#acc_metro").val();
                var lado = $("#acc_lado").val();
                var mul = $("#acc_mul").val();
                var amb = $("#acc_ambos").val();
                var par = $("#acc_para").val();
                var yes = $("#acc_yes").val();
                var fija = $("#fija").val();
                
                
}
function openaccesorios(id){
    $("#ModalAccesorios").modal('show');
}
function BuscarAccesorios(){
    window.open("../popup/referencias.php?tipo=accesorios","Referencias"," width=1000px , height=600px"); 
}
function masacc(id){
    window.open("../vistas/version2/FormAccesorios.php?cod="+id,"Referencias"," width=1000px , height=300px"); 
}
    </script> 
<script src="../vistas/version2/productos/funciones.js?<?php echo rand(1,100) ?>"></script>
<?php 
if(isset($_GET['cod'])){
$atras = $_GET['cod']-1;
$next = $_GET['cod']+1;
echo '<a href="../vistas/?id=nuevo_producto&cod='.$atras.'"><img src="../images/a1.png"></a>';
echo '<i>'.$producto.'</i>';
echo '<a href="../vistas/?id=nuevo_producto&cod='.$next.'"><img src="../images/p11.png"></a>';
}
?>
<div class="row-fluid">

                        <!-- START Form Wizard -->
                        <a href="../../modelo/producto_f.php"></a>
                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../vistas/version2/productos/acciones.php?sw=2&editar='.$_GET['cod'].'';}else{echo '../modelo/producto.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                            <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar Producto';}else{echo 'Crear Producto';} ?>  
                                    <button type="button" onclick="historial(<?php echo $_GET['cod']; ?>)"><img src="../imagenes/registros.png"> Hist. Modificaciones</button>
                                    <span id="btn"><button id="ok" type="button" onclick="okr(<?php echo $_GET['cod'].','.$ok ?>)"> <?php echo $led ?> Ok</button></span>
                                    <span id="btn2"><button id="est" type="button" onclick="anular(<?php echo $_GET['cod'].','.$anulado ?>)"> <?php echo $btn ?></button></span>
                                </h4></header>

                            <section class="body">

                                <div class="body-inner">
                                  
                                        <center>   
<table class="table table-bordered table-striped table-hover">
    <tr>
        <td colspan="2">
            <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                <label class="control-label">Diseño Derecha</label>
                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                    <img src="<?php if(isset($_GET['cod'])){echo '../producto/'.$ruta;} ?>">
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                <span class="btn btn-file">
                    <span class="fileupload-new">Seleccione La Imagen</span>
                    <span class="fileupload-exists">Cambiar</span>
                    <?php if(isset($_GET['cod'])){echo '<input name="imagen" type="file" value="'.$ruta.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?>
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
            </div>
        </td>
        <td colspan="2">
            <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                <label class="control-label">Diseño Izquierdo</label>
                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                    <img src="<?php if(isset($_GET['cod'])){echo '../producto/'.$ruta2;} ?>">
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                <span class="btn btn-file">
                    <span class="fileupload-new">Seleccione La Imagen</span>
                    <span class="fileupload-exists">Cambiar</span>
                    <?php if(isset($_GET['cod'])){echo '<input name="imagen2" type="file" value="'.$ruta2.'" />';}else{echo '<input name="imagen2" type="file" value="" />';} ?>
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
            </div>
        </td>
    </tr>
    <tr>
        <td>Linea</td>
        <td>
            <select name="tipo_p"  required id="linea_p">
                <?php if(isset($_GET['cod'])){echo "<option value='".$linea."'>".$linea."</option>";}else{echo "<option value=''>.:Seleccione la linea:.</option>"; } ?>
                    <?php
                        require '../modelo/conexion.php';
                        $consulta= "SELECT * FROM `lineas`";                     
                        $result=  mysqli_query($conexion,$consulta);
                        while($fila=  mysqli_fetch_array($result)){
                            $valor1=$fila['id_linea'];
                            $valor3=$fila['linea'];
                            echo"<option value='".$valor3."'>".$valor3."</option>";
                        }
                    ?>
            </select>
        </td>
        <td>Estado</td>
        <td>
            <?php 
            if(isset($aprobado)){
            if($_SESSION['k_username']=='admin'){
                
                if($aprobado==0){
                    echo '<button><a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&aprobar='.$aprobado.'"><img src="../imagenes/no.png"> Sin Aprobar</a></button>';
                }else{
                    echo '<button><a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&aprobar='.$aprobado.'"><img src="../imagenes/ok.png"> Aprobado</a></button>';
                }
                if($rev==0){
                    echo ' | <img src="../imagenes/stop.png"> DT SIN ACTUALIZAR ';
                }else{
                    echo ' | <img src="../imagenes/ok.png"> DT ACTUALIZADA ';
                    }
                if($des==0){
                    echo ' | <img src="../imagenes/stop.png"> Sin Material ';
                }else{
                    echo ' | <img src="../imagenes/ok.png"> Con Material ';
                }
            }else{
                
                if($_SESSION['admin']=='Si'){
                    if($aprobado==0){
                    echo '<button><a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&aprobar='.$aprobado.'"><img src="../imagenes/no.png"> Sin Aprobar</a></button>';
                }else{
                    echo '<button><a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&aprobar='.$aprobado.'"><img src="../imagenes/ok.png"> Aprobado</a></button>';
                }
                if($rev==0){
                    echo ' | <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&revisar='.$rev.'"><button type="button"><img src="../imagenes/stop.png"> DT SIN ACTUALIZAR</button></a>';
                }else{
                    echo ' | <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&revisar='.$rev.'"><button type="button"><img src="../imagenes/ok.png"> DT ACTUALIZADA </button></a>';
                }
                if($des==0){
                     echo ' | <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&actu='.$des.'"><button type="button"><img src="../imagenes/stop.png"> Sin Desglose</button></a>';
                }else{
                    echo ' | <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&actu='.$des.'"><button type="button"><img src="../imagenes/ok.png"> Desglose Actualizado </button></a>';
                }
                }ELSE{
                    if($aprobado==0){
                    echo '  | <img src="../imagenes/stop.png"> Sin Aprobar ';
                }else{
                    echo '  | <img src="../imagenes/ok.png"> Aprobado ';
                }
                     if($rev==0){
                    echo ' | <img src="../imagenes/stop.png"> DT SIN ACTUALIZAR ';
                }else{
                    echo ' | <img src="../imagenes/ok.png"> DT ACTUALIZADA ';
                    }
                    if($des==0){
                    echo ' | <img src="../imagenes/stop.png"> Sin Desglose';
                }else{
                    echo ' | <img src="../imagenes/ok.png"> Con Material';
                }
                }
                
            } } ?>
            <input type="hidden" name="tipo_v" value="<?php if(isset($_GET['cod'])){echo $tipo_v;}else{echo '1';} ?>"  class="span10" placeholder="Digite el porcentaje de ganacia" readonly>
        </td>
    </tr>
    <tr>
        <td>Codigo del Producto</td>
        <td>
            <input type="text"  name="codigo" value="<?php if(isset($_GET['cod'])){echo $codigo;} ?>" class="span6" placeholder="Digite el codigo o referencia del producto" required>
        </td>
        <td>Ancho X Alto</td>
        <td>
            <input type="text" name="ancho"  id="ancho"  value="<?php if(isset($_GET['cod'])){echo $ancho;}else{echo "1000";} ?>"  placeholder=" " required class="span6" style="width: 80px"> (mm)
            X <input type="text" name="alto" id="alto" value="<?php if(isset($_GET['cod'])){echo $alto;}else{echo "1000";} ?>"  placeholder=" " required class="span6" style="width: 80px"> (mm)
        </td>
    </tr>
<tr>
    
<td>Nombre del Producto</td>
<td><input type="text"  name="producto" title="<?php if(isset($_GET['cod'])){echo $producto;} ?>" value="<?php if(isset($_GET['cod'])){echo $producto;} ?>"  placeholder=" " required></td>
<td colspan="2">
    Riel <input type="checkbox" name="rieles" <?php if(isset($_GET['cod'])){echo $check_rie;} ?> value="true"> |
    Alfajia <input type="checkbox" name="alfajias" <?php if(isset($_GET['cod'])){echo $check_alf;} ?> value="true"> |
    Cierres <input type="checkbox" name="cierres" <?php if(isset($_GET['cod'])){echo $check_cie;} ?> value="true"> |
    Rodajas <input type="checkbox" name="rodajas" <?php if(isset($_GET['cod'])){echo $check_rod;} ?> value="true"> |
<!--    Manijas <input type="checkbox" name="brazos" <?php if(isset($_GET['cod'])){echo $check_bra;} ?> value="true"> |-->
   <!-- Bisagras <input type="checkbox" name="bisagras" <?php if(isset($_GET['cod'])){echo $check_bis;} ?> value="true"> |-->
</td>

</tr>
<tr>
    <td>Referencia</td>
    <td><input type="text"  name="referencia" value="<?php if(isset($_GET['cod'])){echo $referencia;} ?>"  placeholder="" required></td>
    <td>Es un Kit?</td>
    <td><select name="kit" style="width:60px">
            <?php  if(isset($_GET['cod'])){ echo"<option value='".$kit."'>".$k."</option>";}  ?>
            <option value="0">No</option><option value="1">Si</option>
        </select></td>
</tr>
<tr>
    <td>Perforaciones</td>
    <td><input type="text"  name="per" value="<?php if(isset($_GET['cod'])){echo $per;} ?>"  placeholder=""  class="span4"></td>
    <td>Boquetes</td>
    <td><input type="text"  name="boq" value="<?php if(isset($_GET['cod'])){echo $boq;} ?>"  placeholder=""  class="span4"></td>
</tr>
<tr <?php if(isset($_GET['cod'])){  }else{echo 'id="resultado"';} ?>>

<td>Altura Cuerpo Fijo ó de la Rejilla  (mm)</td>
<td><input type="text" name="altura" id="altura" style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $altura;}else{echo '0';} ?>"  required>  </td>
<td>Altura Ventana Corrediza  (mm)</td>
<td><input type="text" name="altura_v_c" id="altura_v_c"  style="width:20%;" readonly  value="<?php if(isset($_GET['cod'])){echo $altura_v_c;} ?>" > # Modulos: <input type="text" style="width:20%;" name="hoja"  value="<?php if(isset($_GET['cod'])){echo $hoja;} ?>" ></td>

</tr>
<tr>
<td>Ancho C.F </td>
<td><input type="text" name="anchura"  id="anchura"  style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $anchura;}else{echo '0';} ?>"  required></td>
<td>Ancho Ventana Corrediza  (mm)</td>
<td><input type="text" name="anchura_v_c" id="anchura_v_c"  style="width:20%;" readonly  value="<?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?>" ></td>
</tr>
<tr>
    <td>Laminas</td>
    <td>
        <input type="text" name="laminas"  style="width:20%;"  value="<?php if(isset($_GET['cod'])){echo $laminas;} ?>" >
    </td>
    <td>Sistemas</td>
    <td> <select name="sis_cot" class="col-sm-10" required>
            
            <?php if(isset($_GET['cod'])){echo "<option value='".$sistemas."'>".$sistemas."</option>";} ?>
                                          <option value=''>.:Seleccione:.</option>
                                                                 <?php 
                                                                  
                                                                   $resl ="select * from sistemas";
                                                                   $r = mysqli_query($conexion,$resl);
                                                                    while($fila=  mysqli_fetch_array($r)){
                                                                            $valor1=$fila['id_sistema'];
                                                                            $valor3=$fila['nombre_sistema'];
                                                                            echo "<option value='".$valor3."'>".$valor3."</option>";
                                                                            }
                                                                   ?>
                                       </select></td>
<tr>
    <td>Ancho Maximo</td>
    <td> <input type="text" name="ancho_maximo"  style="width:20%;"  value="<?php if(isset($_GET['cod'])){echo $ancho_maximo;} ?>" ></td>
    <td>Alto Maximo</td>
    <td> <input type="text" name="alto_maximo"  style="width:20%;"  value="<?php if(isset($_GET['cod'])){echo $alto_maximno;} ?>" >
        | <b><i>Desperdicio en corte en mm</i></b> <input type="text" name="desp"  style="width:20%;"  value="<?php if(isset($_GET['cod'])){echo $despcorte;} ?>"></td>

</tr>
        </table></center><br><button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>

        <a href="../vistas/?id=nuevo_producto"><button type="button" class="btn">Cancelar</button></a></fieldset>

                                    
                                </div>
                                  
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                      <?php if(isset($_GET['cod'])){
//                          if($linea!='Vidrio'){
                          ?>    
<!--Modulo de Perfiles-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Reparto de Aluminio</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse2" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span>Perfiles</a></li>

<!--                                    <li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Perfil</a></li>
                                     <li class=""><a href="#tab3" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Desglose </a></li>-->
<!--                                     <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Desglose de aluminio</a></li>-->
                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->
                                         
                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

   <button type="button"><a href="#tab2" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Perfil</a></button>   
  

<?php 
if(isset($_GET['up_1'])){
    
    $sql='select * from producto_rep_alu a, referencias b where a.id_ref_alum=b.id_referencia and a.id_r_a="'.$_GET["up_1"].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id_r_a= $fil["id_referencia"];
$codigo_a= $fil["codigo"];
$referencia_a= $fil["referencia"];
$desc= $fil["descripcion"];
$lado= $fil["lado"];
$descuento= $fil["descuento"];
$cantidad= $fil["cantidad"];
$signo= $fil["signo"];
$var= $fil["variable"];
$check= $fil["medida_r_a"];
$check2= $fil["division"];
$obs_a= $fil["observacion_alu"];
if($lado=='Vertical'){
    $m = 'Alto';
}else{
    $m = 'Ancho';
}
    ?>
<!--form for edit-->

              <div class="row-fluid">

<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_1'])){echo '../modelo/reparto_a.php?id_p='.$_GET['cod'].'&editar='.$_GET['up_1'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
 <section class="body">

                              
                                <fieldset style="width:95%; float:center;margin-right: 3%;margin-left: 3%; margin-top: 3%; margin-bottom: 3%;">
                                    
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Codigo del Perfil</td>
                                                    <td><select  name="ref" id="select2_1">
                                                   
                                                                   
                                                                   <?php if(isset($_GET['up_1'])){echo '<option value="'.$id_r_a.'">'.$codigo_a.'</option>';}
                                                                       require '../modelo/conexion.php';
                                                            $consulta= "SELECT * FROM `referencias` where grupo in ('Perfileria','Perfileria Acero')";                    
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valorxx=$fila['id_referencia'];
                                                            $valor1=$fila['codigo'];
                                                            $valor2p=$fila['descripcion'];
                                                           
                                                            $valor3p=$fila['referencia'];

                                                            echo"<option value=".$valorxx.">".$valor1."-".$valor2p."-".$valor3p."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                                    <td><span class="label label-info">Montura adicional (Cuerpo Fijo)</span></td>
                                                    <td> (Medidas del Producto : <?php echo 'Alto :'.$alto. ' Ancho'.$ancho; ?>)</td>
                                                </tr>
                                                <tr>
                                                    <td>Referencia</td>
                                                    <td><select name="descr" id="ref1">
                                                        <?php  echo '<option value="'.$desc.'">'.$desc.'<option>'; ?>
                                                        </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                 <tr>
                                                    <td>Descripcion</td>
                                                    <td><select name="referecia" id="ref2">
                                                        <?php  echo '<option value="'.$referencia_a.'">'.$referencia_a.'<option>'; ?>
                                                        </select></td>
                                                    <td></td>
                                                    <td>Sin divisiones
                                                    	<select name="sin_div" class="span6">
                                                    		<option value="">Seleccione..</option>
                                                    		<?php if ($check2 == '1') { ?>
                                                    			<option value="1" selected>Si</option>
                                                    			<option value="0">No</option>
                                                    		<?php
                                                    		} else { ?>
                                                    			<option value="1">Si</option>
                                                    			<option value="0" selected>No</option>
                                                    		<?php
                                                    		} ?>
                                                    	</select>
                                                    	<!--<input type="checkbox" name="sin_div" <?php if($check2=='1'){echo 'checked';} ?> value="1" />-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Seleccione el lado</td>
                                                    <td><select name="lado" id="lado" class="span6" required> 
                                                 <?php if(isset($_GET['up_1'])){echo '<option value="'.$lado.'">'.$lado.'</option>';}  ?>
                                                <option value="Vertical">Vertical</option> 
                                                <option value="Horizontal">Horizontal</option> 
                                               
                                     
                                                 
                                                  
                                          </select></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['up_1'])){echo $cantidad;} ?>" class="span6" placeholder="Digite la cantidad de perfil" required></td>
                                                    <td align="right"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Formula para el perfil</td>
                                                    <td colspan="2"> 
                                                        <select name="b" id="fom_per1">
                                                            <?php if($check==0){ ?><option value="0">Ninguno</option>  <?php }  ?>  
                                                            <?php if($check==2){ ?><option value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option> <?php }  ?>
                                                            <?php if($check==1){ ?><option value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option><?php }  ?>
                                                            <?php if($check==3){ ?><option value="3"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option><?php }  ?>
                                                            <?php if($check==4){ ?><option value="4"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option><?php }  ?>
                                                            <option value="0">Ninguno</option> 
                                                            <option value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option>
                                                            <option value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option>
                                                             <option value="3"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option>
                                                            <option value="4"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option>
                                                            <?php
                                                                       require '../modelo/conexion.php';
                                                            $request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            if($request_v){

        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
            
            $tv = $al + $row['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            $nw_medida = $fil_al['medida_r_a'];
            $nw_lado = $fil_al['lado'];
            $nw_var1 = $fil_al['descuento'];
            $nw_ope = $fil_al['signo'];
            $nw_var2 = $fil_al['variable'];
            $nw_cant = $fil_al['cantidad'];
            $nw_div = $fil_al['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
            include '../vistas/version2/productos/formula_perfil.php';
            $al2 = $med_perfil;
            
            $tv2 = $al2 + $row['var2'];
            echo"<option value='".$row['id_ref_vid']."'>(".$tv." mm) ".$row['descripcion']."</option>";
		
               
	} 
	
        
	
}
                                                            ?>
                                                        </select>
                                                        |
                                                        <select name="vc" id="lado_r" style="width: 80px;">
                                              <?php if(isset($_GET['up_1'])){echo '<option value="'.$m.'">'.$m.'</option>';}  ?>
                                                        </select>&nbsp;+ 
                                                        
                                                        <input type="number"  style="width: 40px;" name="descuento" id="fom_var1" value="<?php echo $descuento;  ?>"  placeholder="Digite la medidad a restar" required>
                                                        <select name="signo" style="width: 40px;" id="fom_ope">
                                                    <?php if(isset($_GET['up_1'])){echo '<option value="'.$signo.'">'.$signo.'</option>';}  ?>
                                                       <option value="/">/</option>
                                                       <option value="+">+</option>
                                                       <option value="-">-</option>
                                                       <option value="*">*</option>
                                                        </select>&nbsp;<input type="number" id="fom_var2" name="variable" value="<?php echo $var;  ?>" style="width: 40px;"></td>
                                                    
                                                    <td><button type="button" onclick="calcularperfil()">=</button><input type="text" id="resu" value="0" style="width: 40px;"></td>
                                                </tr>
                                            </table>
                                        
                                            
                                                  <label></label><div class="controls"> Digite la formula: por Ej: (Ancho + 7) / 2</div>
                                             
     <tr>
                                                  <th><b>Observaciones</b></th>
                                                  <td><textarea name="obs_a" id="obs_a" style="width:40%"><?php if(isset($_GET['up_1'])){ echo ($obs_a); } ?></textarea></td>
                                                </tr>
                                               <div class="controls">
                                                   </div>
                                               
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <a href="../vistas/?id=nuevo_producto&cod=<?php echo $_GET['cod']; ?>" ><button type="button" class="btn">Cancelar.</button></a>

                                    </div><!--/ Form Action -->

                                </div>
                                </fieldset>
                            </section>
                        
                          

                        </form>

                        <!--/ END Form Wizard -->

                    </div>                        
                                    
   
                                    <?php
}else{
if(isset($_GET['cod'])){
    


$request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." order by b.lado, b.id_r_a");
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
            $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'cant. perfiles'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'cant. und.'.'</th>';
               $table = $table.'<th width="20%">'.'medida.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Precio Total.*'.'</th>';

              $table = $table.'<th>Editar</th>';
              $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;
	while($row=mysqli_fetch_array($request))
	{    
            $nw_medida = $row['medida_r_a'];
            $nw_lado = $row['lado'];
            $nw_var1 = $row['descuento'];
            $nw_ope = $row['signo'];
            $nw_var2 = $row['variable'];
            $nw_cant = $row['cantidad'];
            $nw_div = $row['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
           
            $n=1000;
            $ta = $ta + ($al*$row["costo_mt"]/$n);
            $numero = ($row["cantidad"]*$al)/$row["medida"];  
            if($nw_medida==0){if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}}else{$x=$nw_medida;}
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           if($row["costo_mt"]==0){$st ='style="background:red"';}else{$st = '';}
           $formula = ''.$medida .'+' .$nw_var1.'' .$nw_ope. ''.$nw_var2;
            $table = $table.'<tr><td width="10%" title="'.$formula.'">'.$row['codigo'].'</a></td>'
                    . '<td width="40%" '.$st.'>'.$row['descripcion'].'<br><i>'.$row['observacion_alu'].'</i></td>'
                    . '<td width="10%">'.$row['referencia'].'</font></td>'
                    . '<td width="10%">'.$row['lado'].'</a></td>'
                    . '<td width="10%">'.$row["medida"].' mm<font></a></td>
               <td class="hidden-phone">'.  number_format($numero,1,',','.').'</font></td>'
                    . '<td width="10%">'.$row["cantidad"].'<font></a></td>'
                    . '<td width="20%">'.number_format($med_perfil).' mm.<font></a></td>
                   <td class="hidden-phone">'.$row["cantidad"].'</font></td><td class="hidden-phone" >$'.number_format($al*$row["costo_mt"]/$n).'</font></td>'
                    . '<td><a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&up_1='.$row["id_r_a"].'"><button>Editar</button></a></td>'
                    . '<td><a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_1='.$row["id_r_a"].'&pr='.$row['descripcion'].'"><button>Eliminar</button></a></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
} }}
   
 ?>
                                
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab2">
                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_a.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_a.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                            <section class="body">

                              
                                <fieldset style="width:95%; float:center;margin-right: 3%;margin-left: 3%; margin-top: 3%; margin-bottom: 3%;">
                                    
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Codigo del Perfil</td>
                                                    <td><select  name="ref" id="select2_1">
                                                    <option value=''>Seleccione Perfil...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                            $consulta= "SELECT * FROM `referencias` where grupo in ('Perfileria','Perfileria Acero')";                   
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valorxx=$fila['id_referencia'];
                                                            $valor1=$fila['codigo'];$valor2p=$fila['descripcion'];
                                                     $valor2r=$fila['referencia'];
                                                           
                                                            

                                                            echo"<option value=".$valorxx.">".$valor1." ".$valor2p." (".$valor2r.")</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                                    <td><span class="label label-info">Montura adicional (Cuerpo Fijo)</span></td>
                                                    <td> (Medidas del Producto : <?php echo 'Alto :'.$alto. ' Ancho'.$ancho; ?>)</td>
                                                </tr>
                                                <tr>
                                                    <td>Referencia</td>
                                                    <td><select name="descr" id="ref1">
                                                        
                                                        </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                 <tr>
                                                    <td>Descripcion</td>
                                                    <td><select name="referecia" id="ref2">
                                                        
                                                        </select></td>
                                                    <td></td>
                                                    <td>Sin divisiones
                                                    	<!--<input type="checkbox" name="sin_div" value="1">-->
                                                    	<select name="sin_div" class="span6">
                                                    		<option value="">Seleccione..</option>
                                                    		<option value="1">Si</option>
                                                    		<option value="0">No</option>
                                                    	</select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Seleccione el lado</td>
                                                    <td><select name="lado" id="lado" class="span6" required> 
                                                <option value="">Seleccione.. </option> 
                                                <option value="Vertical">Vertical</option> 
                                                <option value="Horizontal">Horizontal</option> 
                                               
                                     
                                                 
                                                  
                                          </select></td>
                                                    <td align="right"></td>
                                                    <td>
                                                      
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder="Digite la cantidad de perfil" required></td>
                                                    <td align="right"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Formula para el perfil</td>
                                                    <td colspan="2">
                                                          <select name="b" id="fom_per1">
                                                            <option value="0">Ninguno</option> 
                                                            <option value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option>
                                                            <option value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option>
                                                             <option value="3"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option>
                                                            <option value="4"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option>
                                                            <?php
                                                                       require '../modelo/conexion.php';
                                                            $request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            if($request_v){

        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
            
            $tv = $al + $row['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            $nw_medida = $fil_al['medida_r_a'];
            $nw_lado = $fil_al['lado'];
            $nw_var1 = $fil_al['descuento'];
            $nw_ope = $fil_al['signo'];
            $nw_var2 = $fil_al['variable'];
            $nw_cant = $fil_al['cantidad'];
            $nw_div = $fil_al['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al2 = $med_perfil;
            
            $tv2 = $al2 + $row['var2'];
            echo"<option value='".$row['id_ref_vid']."'>(".$tv." mm) ".$row['descripcion']."</option>";
		
               
	} 
	
        
	
}
                                                            ?>
                                                        </select>
                                                        |
                                                        <select name="vc" id="lado_r" style="width: 80px;">
                                              
                                                        </select>&nbsp;+ <input type="number" id="fom_var1"  style="width: 40px;" name="descuento" value="0"  placeholder="Digite la medidad a restar" required>
                                                <select name="signo" style="width: 40px;" id="fom_ope">
                                                       <option value="/">/</option>
                                                       <option value="+">+</option>
                                                       <option value="-">-</option>
                                                       <option value="*">*</option>
                                                </select>&nbsp;<input type="number"  id="fom_var2" name="variable" value="1" style="width: 40px;"></td>
                                                   
                                                    <td><button type="button" onclick="calcularperfil()">=</button><input type="text" id="resu" value="0" style="width: 40px;"></td>
                                                </tr>
                                            </table>
                                        
                                            
                                                  <label></label><div class="controls"> Digite la formula: por Ej: (Ancho + 7) / 2</div>
                                             

                                               <div class="controls">
                                                   </div>
                                               
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <a href="#tab1" data-toggle="tab"><button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->

                                </div>
                                </fieldset>
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>
<div class="tab-pane" id="tab3">
    <div class="row-fluid">
        <fieldset style="width:95%; float:center;margin-right: 3%;margin-left: 3%; margin-top: 3%; margin-bottom: 3%;">
            <legend>Desglose de Aluminio</legend>
            
            <table>
                <tr>
                    <td>Id Producto</td>
                    <td><input type="text" id="id_des" value="" disabled>
                        <input type="text" id="pro_des" value="<?php echo $_GET['cod']; ?>" disabled></td>
                </tr>
                <tr>
                    <td>Referencia</td>
                    <td><input type="hidden" id="id_ref" value=""> <input type="text" id="ref" value="" placeholder="Nombre del perfil"> <input type="text" id="referencia" value="" placeholder="Referencia" ></td></td>
                </tr>
                <tr>
                    <td>Lado</td>
                            <td><select id="lado_des">
                                    <option value="Horizontal">Horizontal</option>
                                    <option value="Vertical">Vertical</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Descuento</td>
                            <td>
                          <select id="medida_des">
                              
                              <option value="5"><?php if(isset($_GET['cod'])){echo $alto;} ?> (Alto General)</option>
                              <option value="6"><?php if(isset($_GET['cod'])){echo $ancho;} ?> (Ancho General)</option>
                              <option value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option>
                              <option value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option>
                              <option value="3"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option>
                              <option value="4"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option>
                       </select></td>
                <tr>
                    <td>Cantidad</td>
                    <td><input type="text" id="can_des" value=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button onclick="desglose();" class="btn btn-primary"> Agregar </button>
                        <button onclick="limpiar();" class="btn btn-danger"> Limpiar </button>
                        <a  href="#tab4"  data-toggle="tab" ><button  class="btn btn-warning"> Cancelar</button></a>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    </div>
<div class="tab-pane" id="tab4">
    <button type="button"><a href="#tab3" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Desglose</a>
    </button>
    <div class="row-fluid" id="mostrar_desgloses">
        <?php

        ?>
    </div>
</div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<!--Fin Modulo de Perfiles--> 

<!--Modulo de Vidrio -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Reparto de vidrios</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse3" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab5" data-toggle="tab"><span class="icon icone-eye-open"></span>Vidrios</a></li>

                                    <li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Vidrio</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab5">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
if(isset($_GET['up_2'])){ 
   
     $sql='select * from producto_rep_vid a, referencias b where a.id_ref_vid=b.id_referencia and a.id_r_v="'.$_GET["up_2"].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id_r_v= $fil["id_referencia"];
$desc_v= $fil["descripcion"];
$ancho_v= $fil["ancho_v"];
$alto_v= $fil["alto_v"];
$ancho_v2= $fil["ancho_v2"];
$alto_v2= $fil["alto_v2"];
$var1= $fil["var1"];
$var2= $fil["var2"];
$divisor= $fil["divisor"];
$divisor_alto= $fil["divisor_alto"];
$seleccionado= $fil["seleccionado"];
$obs_v= $fil["observacion"];
$cantidad_v= $fil["cantidad_v"];
$si= $fil["utilizar"];
$cp= $fil["cp"];
$ddesc= $fil["desc"];
$pertenece= $fil["pertenece"];

            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$ancho_v."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_ancho= $fil_an["id_r_a"];
            $descripcion_ancho= $fil_an["descripcion"];
            
            $sqlxa=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$alto_v."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlxa));
            $id_alto= $fil_al["id_r_a"];
            $descripcion_alto= $fil_al["descripcion"];
            
             $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$ancho_v2."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
            $id_ancho2= $fil_an2["id_r_a"];
            $descripcion_ancho2= $fil_an2["descripcion"];
            
            $sqlxa2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$alto_v2."");
            $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlxa2));
            $id_alto2= $fil_al2["id_r_a"];
            $descripcion_alto2= $fil_al2["descripcion"];
            
?>
      <div class="tab-pane" id="tab6">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_2'])){echo '../modelo/reparto_v.php?id_p='.$_GET['cod'].'&editar='.$_GET['up_2'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <fieldset style="width:95%; float:center; margin: 3% 3% 3% 3%;">
                                    <span class="label label-info">Editar Valores de Medidas del Vidrio</span>
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione referencia</label>
                                            <div class="controls"> 
                                               <select name="ref_v" class="span11" required>
                                                                 <?php
                                                                 
                                                            echo"<option value='".$id_r_v."'>".$desc_v."</option>";
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Vidrios'";                    
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                       
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                         <label></label><div class="controls"> </div>
                                               <label class="control-label">Ancho (mm)</label>

                                            <div class="controls"> <select name="ancho_v" class="span4" required>
                                                                   <?php
                                                                   if($id_ancho==0){
                                                                       echo"<option value='0'>Ancho</option>";
                                                                   }else{
                                                                       echo"<option value='".$id_ancho."'>".$descripcion_ancho."</option>";
                                                                   }
                                                                     
                                                          
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_an = $row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;

                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;
                                                            echo"<option value='".$valor1_an."'>".$valor2." (".$alv.")</option>";
                                                            
                                                            }
                                                             echo"<option value='0'>Ancho</option>";
                                                            ?>
                                                </select>- <select name="ancho_v2" class="span4" required>
                                                                   <?php
                                                                   if($id_ancho2==""){echo"<option value='0'>0</option>";}else{
                                                                       echo"<option value='".$id_ancho2."'>".$descripcion_ancho2."</option>";
                                                                   }
                                                                     
                                                          
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_an = $row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            
                                                             $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;

                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;

                                                            echo"<option value='".$valor1_an."'>".$valor2." (".$alv.")</option>";
                                                            
                                                            }echo"<option value='0'>0</option>";
                                                            ?>
                                                </select> +/- <input type="number" name="dv" value="<?php echo $var1  ?>" style="width: 40px;"> / <input type="number" name="divisor" value="<?php echo $divisor  ?>" style="width: 40px;">
                                            <select name="si" style="width:140px">
                                                     <?php if($si==1){
                                                         echo '<option value="1">Utilizar Ancho</option>'
                                                         . '<option value="0">No Utilizar Ancho</option>';
                                                         
                                                     }else{
                                                echo '<option value="0">No Utilizar Ancho</option><option value="1">Utilizar Ancho</option>';
                                            } ?></select></div>
                                               <label></label><div class="controls"> </div>
                                                     <label></label><div class="controls"> </div>
                                               <label class="control-label">Alto (mm)</label>

                                            <div class="controls"><select name="alto_v" class="span4" required>
                                                                  <?php
                                                                  if($id_alto==0){
                                                                       echo"<option value='0'>Alto</option>";
                                                                   }else{
                                                                       echo"<option value='".$id_alto."'>".$descripcion_alto."</option>";
                                                                   }
                                                                       require '../modelo/conexion.php';
                                                           $consulta2= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result2=  mysqli_query($conexion,$consulta2);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result2)){
                                                            $valor1_al=$row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            
                                                             $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;

                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;

                                                            echo"<option value='".$valor1_al."'>".$valor2." (".$alv.")</option>";
                                                            
                                                            }
                                                            echo"<option value='0'>Alto</option>";
                                                            ?>
                                                </select> - 
                                                <select name="desc" class="span2" required>
                                                    <?php
                                                     if($ddesc==0){echo"<option value='0'>0</option><option value='1'>Alto</option>";}else{
                                                                       echo"<option value='1'>Alto</option><option value='0'>0</option>";
                                                                   }
                                                    ?>
                                                 
                                                </select>
                                                - <select name="alto_v2" class="span2" required>
                                                                  <?php
                                                                  if($id_alto2==""){echo"<option value='0'>0</option>";}else{
                                                                       echo"<option value='".$id_alto2."'>".$descripcion_alto2."</option>";
                                                                   }
                                                                 
                                                          
                                                                       require '../modelo/conexion.php';
                                                           $consulta3= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result3=  mysqli_query($conexion,$consulta3);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result3)){
                                                            $valor1_al=$row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            
                                                            
                                                             $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;

                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;

                                                            echo"<option value='".$valor1_al."'>".$valor2." (".$alv.")</option>";
                                                            
                                                            }
                                                            echo"<option value='0'>0</option>";
                                                            ?>
                                                </select> +/- <input type="number" name="dv2" value="<?php echo $var2  ?>" style="width: 40px;"> /
                                                <input type="number" name="divisor_alto" value="<?php echo $divisor_alto  ?>" style="width: 40px;">
                                                - <select name="acp" style="width:140px">
                                                     <?php if($cp==1){
                                                         echo '<option value="1">+ Alto cf</option><option value="-1">- Alto cf</option>'
                                                         . '<option value="0">No Utilizar Alto cp</option>';
                                                         
                                                     }else{
                                                         if($cp=='-1'){
                                                         echo '<option value="-1">- Alto cf</option><option value="1">+ Alto cf</option>'
                                                         . '<option value="0">No Utilizar Alto cp</option>';
                                                         
                                                               }else{
                                                            echo '<option value="0">No Utilizar Alto cf</option><option value="1">Utilizar Alto cf</option>';
                                                             } 
                                                           
                                                             } 
                                            ?></select>
                                            </div>
                                                                               
                                           

                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Cantidad (Und)</label>

                                            <div class="controls"><input type="text" name="cant_v" value="<?php echo $cantidad_v ?>" class="span6" placeholder="Digite la cantidad de vidrios" required></div>
                                                 
                                        <label></label><div class="controls"> </div>
                                               <label class="control-label">Pertenece al modulo</label>

                                               <div class="controls">
                                                   <select name="pertenece">
                                                       <?php
                                                       echo '<option value="'.$pertenece.'">'.$pertenece.'</option>';
                                                       for($x=1; $x<=$hoja; $x=$x+1){
                                                           echo '<option value="'.$x.'">'.$x.'</option>';
                                                           
                                                       }
                                                       
                                                       ?>
                                                   </select>
                                               </div>
                                               
                                              
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Observaciones</label>

                                            <div class="controls"><input type="text" name="obs_v" value="<?php echo $obs_v ?>" class="span6" placeholder="" required></div>
                                        </div>
                                             
                                           

                           
<!--
                                        <span class="label label-info">Montura adicional del producto</span>-->
                                        <div class="control-group">
                                              
<!--                                             
                                            <h4><label>Si el Producto tiene una montura adicional seleccione algun valor, sino dejelo en 0</label><div class="controls"> </div>
                                            </h4><div class="controls"> 
                                               Altura Cuerpo fijo <?php echo $altura; ?><input type="radio" <?php if($seleccionado==1){echo 'checked';} ?> name="op1" value="1">
                                            </div>  <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                               Altura Ventana Corrediza <?php echo $altura_v_c; ?><input type="radio" <?php if($seleccionado==2){echo 'checked';} ?> name="op1" value="2">
                                            </div> <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                                Ninguno <input type="radio" checked name="op1" <?php if($seleccionado==0){echo 'checked';} ?> value="0">
                                            </div> 
                                         <label></label><div class="controls"> </div>
                                            Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->
                                   

                                </div>
</fieldset>
                               
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>
                                    <?php
}else{
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_v){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
$table = $table.'<th width="10%">'.'Referencia'.'</th>'; 
              $table = $table.'<th class="hidden-phone">'.'Ancho'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cantidad'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Valor'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Modulo'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Notas'.'</th>';
               $table = $table.'<th>Editar</th>';
               $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            
            if($row["ancho_v"]==0){
                 if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $ancho;
                 }
            }else{

            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;   
              
            }

            if($row["alto_v"]==0){
                $al2= $alto;
            }else{
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            $nw_medida = $fil_al['medida_r_a'];
            $nw_lado = $fil_al['lado'];
            $nw_var1 = $fil_al['descuento'];
            $nw_ope = $fil_al['signo'];
            $nw_var2 = $fil_al['variable'];
            $nw_cant = $fil_al['cantidad'];
            $nw_div = $fil_al['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
            include '../vistas/version2/productos/formula_perfil.php';
            $al2 = $med_perfil;
            
            }

            //------------------------------------------------------------------------------------------------------------------------------------ part 2---------------
            if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
  
            $nw_medida = $fil_an2['medida_r_a'];
            $nw_lado = $fil_an2['lado'];
            $nw_var1 = $fil_an2['descuento'];
            $nw_ope = $fil_an2['signo'];
            $nw_var2 = $fil_an2['variable'];
            $nw_cant = $fil_an2['cantidad'];
            $nw_div = $fil_an2['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
            include '../vistas/version2/productos/formula_perfil.php';
            $al22 = $med_perfil;
            }else{
               
                $al22 = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlw2));
            
              $nw_medida = $fil_al2['medida_r_a'];
            $nw_lado = $fil_al2['lado'];
            $nw_var1 = $fil_al2['descuento'];
            $nw_ope = $fil_al2['signo'];
            $nw_var2 = $fil_al2['variable'];
            $nw_cant = $fil_al2['cantidad'];
            $nw_div = $fil_al2['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
            include '../vistas/version2/productos/formula_perfil.php';
            $al2x = $med_perfil;
            }else{
               
                $al2x = 0;
            }
            // descuento o suma del cuerpo fijo
            if($row['cp']=='-1'){
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto'] - $altura; // calcular alto del vidrio
            }elseif($row['cp']=='1'){
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto'] + $altura; // calcular alto del vidrio
            }else{
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto']; // calcular alto del vidrio
            }
             $tv = ($al + $row['var1']) / $row['divisor']; //calcular ancho del vidrio
             
              
             //$al22 no se utiliza casi ----ojo------
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
            }else{
                $n = 0;
                $an2 = $tv; // ancho total del vidrio
            }
             if($row['cp']==1){
                $cf = $altura;
              
            }else{
                if($row['cp']==-1){
                $cf = - $altura;
              
            }else{
                $cf = 0;
              
            }  
            }
            if($row['desc']==0){
                $dess = 0;
              
            }else{
                $dess = $alto;
              
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2  - $dess; // alto de vidrio
            }else{
                $nx = 0;
                $all = $tv2  + $cf - $dess;
            }

            $table = $table.'<tr><td width="9%">'.$row['codigo'].'</a></td>'
                    . '<td width="10%">'.$row['descripcion'].'</font></td>'
                    . '<td width="10%">'.$row['referencia'].'</a></td>
                       <td class="hidden-phone">'.number_format($an2).'</font></td>'
                    . '<td class="hidden-phone">'.$all.'</font></td>'
                    . '<td class="hidden-phone">'.$row["cantidad_v"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["cantidad_v"]*$row["costo_mt"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["pertenece"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["observacion"].'</font></td>'
                    . '<td><a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&up_2='.$row["id_r_v"].'"><button><img src="../imagenes/modificar.png"></button></a></td>'
                    . '<td>  <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_2='.$row["id_r_v"].'&vr='.$row['descripcion'].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
}
}
 ?></div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab6">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_v.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_v.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <fieldset style="width:95%; float:center; margin: 3% 3% 3% 3%;">
                                    <center><span class="label label-info">Medidas del Vidrio</span></center>
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione referencia</label>
                                            <div class="controls"> 
                                               <select name="ref_v" class="span11" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Vidrios'";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                          
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                         <label></label><div class="controls"> </div>
                                               <label class="control-label">Ancho (mm)</label>

                                            <div class="controls"> <select name="ancho_v" class="span4" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <option value="0">Ancho</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_an = $row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                             $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;
                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;
                                                            $n=1000;


                                                            echo"<option value='".$valor1_an."'>(".$alv." mm) ".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> - <select name="ancho_v2" class="span4" required>
                                                                   <option value="0">0</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_an = $row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;
                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;
                                                            echo"<option value='".$valor1_an."'>(".$alv." mm) ".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> +/- <input type="number" name="dv" value="0" style="width: 40px;"> / <input type="number" name="divisor" value="1" style="width: 40px;">
                                            <select name="si" style="width:140px">
                                                     <?php if($si==1){
                                                         echo '<option value="1">Utilizar Ancho</option>'
                                                         . '<option value="0">No Utilizar Ancho</option>';
                                                         
                                                     }else{
                                                echo '<option value="0">No Utilizar Ancho</option><option value="1">Utilizar Ancho</option>';
                                            } ?></select>
                                            </div>
                                               <label></label><div class="controls"> </div>
                                                     <label></label><div class="controls"> </div>
                                               <label class="control-label">Alto (mm)</label>

                                            <div class="controls"><select name="alto_v" class="span4" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <option value="0">Alto</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_al=$row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;
                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;
                                                            echo"<option value='".$valor1_al."'> (".$alv." mm) ".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> -
                                                
                                                <select name="desc" class="span2" required>
                                                    <option value="0">0</option>
                                                    <option value="1">Alto</option>
                                                </select> -
                                                <select name="alto_v2" class="span2" required>
                                                                   <option value="0">0</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_al=$row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            $nw_medida = $row['medida_r_a'];
                                                            $nw_lado = $row['lado'];
                                                            $nw_var1 = $row['descuento'];
                                                            $nw_ope = $row['signo'];
                                                            $nw_var2 = $row['variable'];
                                                            $nw_cant = $row['cantidad'];
                                                            $nw_div = $row['division'];
                                                            $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                            $altura = $altura;// altura cuerpo fijo
                                                            $anchura = $anchura; //ancho cuerpo fijo
                                                            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                            $ancho = $ancho;
                                                            $alto = $alto;
                                                            include '../vistas/version2/productos/formula_perfil.php';
                                                            $alv = $med_perfil;

                                                            echo"<option value='".$valor1_al."'> (".$alv." mm) ".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> +/- <input type="number" name="dv2" value="0" style="width: 40px;"> / 
                                                <input type="number" name="divisor_alto" value="1" style="width: 40px;">
                                            - <select name="acp" style="width:140px">
                                                     <?php 
                                                echo '<option value="0">No Utilizar Alto cf</option>'
                                                     . '<option value="1">+ Alto cf</option>'
                                                        . '<option value="-1">- Alto cf</option>';
                                             ?></select></div>
                                                                               
                                           

                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Cantidad (Und)</label>

                                            <div class="controls"><input type="text" name="cant_v" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder="Digite la cantidad de vidrios" required></div>
                                            
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Pertenece al modulo</label>

                                               <div class="controls">
                                                   <select name="pertenece">
                                                       <?php
                                                       for($x=1; $x<=$hoja; $x=$x+1){
                                                           echo '<option value="'.$x.'">'.$x.'</option>';
                                                           
                                                       }
                                                       
                                                       ?>
                                                   </select>
                                               </div>
                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Observaciones</label>

                                            <div class="controls"><input type="text" name="obs_v" value="<?php echo $obs_v ?>" class="span6" placeholder="" required></div>
                                   
Por favor sea lo mas exacto en la medida de la hoja de vidrio de la ventana
                                </div>

<!--                                        <center><span class="label label-info">Montura adicional del producto</span></center>-->
                                        <div class="control-group">
                                              
                                             
<!--                                            <h4><label>Si el Producto tiene una montura adicional seleccione algun valor, sino dejelo en 0</label><div class="controls"> </div>
                                            </h4><div class="controls"> 
                                               Altura Cuerpo fijo <?php echo $altura; ?><input type="radio" name="op1" value="1">
                                            </div>  <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                               Altura Ventana Corrediza <?php echo $altura_v_c; ?><input type="radio" name="op1" value="2">
                                            </div> <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                                Ninguno <input type="radio" checked name="op1" value="0">
                                            </div> 
                                         <label></label><div class="controls"> </div>-->
                                         <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->
                                   

                                </div>
</fieldset>
                                
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<!--Fin Modulo de Vidrio -->
<!--Modulo de regillas -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Detalles de la ventana con rejillas</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse3" class="body collapse in">

                                <div class="body-inner">

                            <div class="tabbable" style="margin-bottom: 25px;">
                                <ul class="nav nav-tabs">
                                    <div style="float: right">
                                        <button type="button" class="btn btn-primary" onclick="modalrejillas();LimpiarRejilla()">Agregar Rejilla</button>
                                </div>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab12">
                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                             
                                    <div id="MostrarRejillas"> 
<?php 

$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
   
if($request_v){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'referencia'.'</th>'; 
              $table = $table.'<th class="hidden-phone">'.'Medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Rejillas'.'</th>';
            
              $table = $table.'<th class="hidden-phone">'.'Valor'.'</th>';
               $table = $table.'<th>Editar</th>';
               $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            if($row["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($row["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($row["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($row["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["id_referencia_med"]."");
                $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
                $id_p= $fil_an["id_p"];
                $nw_medida = $fil_an['medida_r_a'];
                $nw_lado = $fil_an['lado'];
                $nw_var1 = $fil_an['descuento'];
                $nw_ope = $fil_an['signo'];
                $nw_var2 = $fil_an['variable'];
                $nw_cant = $fil_an['cantidad'];
                $nw_div = $fil_an['division'];
                $altura_v_c = $altura_v_c; // altura ventana corrediza
                $altura = $altura;// altura cuerpo fijo
                $anchura = $anchura; //ancho cuerpo fijo
                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                $ancho = $ancho;
                $alto = $alto;
                include '../vistas/version2/productos/formula_perfil.php';
                $al = $med_perfil;
            }
         
            $al2 = ($alto+$fil_an["descuento"]);
          // calculo de del ancho de la rejilla
      $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($conexion,$sqlxr));
            $id_p= $fil_anrej["id_p"];
            
             $nw_medida = $fil_anrej['medida_r_a'];
            $nw_lado = $fil_anrej['lado'];
            $nw_var1 = $fil_anrej['descuento'];
            $nw_ope = $fil_anrej['signo'];
            $nw_var2 = $fil_anrej['variable'];
            $nw_cant = $fil_anrej['cantidad'];
            $nw_div = $fil_anrej['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
            include '../vistas/version2/productos/formula_perfil.php';
            $alr = $med_perfil;

            $tvR = $alr + $col['var1'];


         }
              
             
                
            
            $tv2 = ($al / $row['var3']) * $row['multiplo'];
            if($row["medida_rej"]==0 || $row["medida_rej"]==999994){
                $medrej = ($ancho + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999999){
                    $medrej = ($alto + $row["varr"]) / $row["en"]; 
                }else{
                    if($row["medida_rej"]==999998){
                        $medrej = ($altura + $row["varr"]) / $row["en"]; 
                    }else{
                         if($row["medida_rej"]==999997){
                             $medrej = ($altura_v_c + $row["varr"]) / $row["en"]; 
                         }else{
                             if($row["medida_rej"]==999996){
                                $medrej = ($anchura_v_c + $row["varr"]) / $row["en"]; 
                            }else{
                                 if($row["medida_rej"]==999995){
                                    $medrej = ($anchura + $row["varr"]) / $row["en"]; 
                                }else{
                                    $medrej = ($tvR + $row["varr"]) / $row["en"]; 
                                } 
                            } 
                         } 
                    } 
                } 
            }
          
           
            $table = $table.'<tr>'
                    . '<td width="10%"  title="'.$al.'">'.$row['codigo'].'</a></td>'
                    . '<td width="10%">'.$row['descripcion'].'</a></td>'
                    . '<td width="10%">'.$row['referencia'].'</font></td>
               <td class="hidden-phone">'.number_format($medrej).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]/1000).'</font></td>'
                    . '<td><button onclick="EditarRejilla('.$row["id_r_rej"].','.$_GET['cod'].')"  data-toggle="modal" data-target="#ModalRejillas"><img src="../imagenes/modificar.png"></button></td>'
                    . '<td> <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_8='.$row["id_r_rej"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
	echo $table;
      
}

 ?>
                                        </div>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab13">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_rej.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_rej.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                            <section class="body">

                                <table></table>
                                    <legend>Detalles de Rejillas</legend>
                                        <div class="control-group">
                                      
                            </section>                       
 

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<!--Fin Modulo de regillas -->
                         



                         
 <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">LISTADO DE ACCESORIOS PARA FABRICACIÓN E INSTALACION <button onclick="masacc(<?php echo $_GET['cod'] ?>)">+</button></h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">
                                    <div style="float: right">
                                        <button type="button" class="btn btn-primary" onclick="openaccesorios(0)"> + Agregar Accesorios</button>
                                </div>
                    

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab3x">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 


$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." order by b.para ");
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Referencia'.'</th>'; 
               $table = $table.'<th width="7%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="7%">'.'Color'.'</th>';
              $table = $table.'<th  width="5%">'.'Variante'.'</th>';
              $table = $table.'<th width="5%">'.'Cant x MT'.'</th>';
              $table = $table.'<th width="7%">'.'Costo Fab'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Para'.'</th>';
               $table = $table.'<th>Editar</th>';
               $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{     
            ///----------------------------------------
            if($row['can_rej']!=0){
            $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_rej=".$row['can_rej']." ");
            $rt = 0;
                while($rowz=mysqli_fetch_array($request_v2))
            {
            if($rowz["id_referencia_med"]=='90001'){
                $al = $alto;
            }else if($rowz["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowz["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowz["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$rowz["id_referencia_med"]."");
                $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
                $id_p= $fil_an["id_p"];
                $nw_medida = $fil_an['medida_r_a'];
                $nw_lado = $fil_an['lado'];
                $nw_var1 = $fil_an['descuento'];
                $nw_ope = $fil_an['signo'];
                $nw_var2 = $fil_an['variable'];
                $nw_cant = $fil_an['cantidad'];
                $nw_div = $fil_an['division'];
                $altura_v_c = $altura_v_c; // altura ventana corrediza
                $altura = $altura;// altura cuerpo fijo
                $anchura = $anchura; //ancho cuerpo fijo
                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                $ancho = $ancho;
                $alto = $alto;
                include '../vistas/version2/productos/formula_perfil.php';
                $al = $med_perfil;
            }
            $cant_rej = ($al / $rowz['var3']) * $rowz['multiplo'];
       
            }}else{
               $cant_rej = 1;
            }
            if($row["lado"]=='Vertical'){
                 $canfach = $vert = 1;
                 $ambos_alto = $row["ambos"] * ($alto / 1000)*$vert;
                 $ambos_ancho = 0;
                 
             }else{
                 $canfach = $hori = 1;
                 $ambos_alto = 0;
                 $ambos_ancho = $row["ambos"] * ($ancho / 1000)*$hori;
             }
             if($row["multiplica"]=='Si'){
                 $canfach = $canfach  ;
                 $ambos = $row["ambos"];
             }else{
                 $canfach = 1;
                 $ambos = 1;
             }
             //formula para calcular medida fijas
             if($row['fija']==1){
                  if($row["lado"]=='Vertical'){
                    $medidalado = ($alto/1000);
                 }else{
                    $medidalado = ($ancho/1000);
                 }
                 if($row["yes"]=='Si'){
                    $metro = $row["metro"];
                     $res = $row["cantidad_acc"]*($medidalado/$row["metro"])*$row["med"]*$ambos;
                 }else{
                    $metro = 1;
                    $res = $row["cantidad_acc"]*($row["med"]/1000);
                 }
                  
                 //$res = $row["cantidad_acc"]*($row["med"]/1000);
             }else{
                if($row['calcular']=='ML'){

                  $res = ((($ancho / 1000) * 2)  + (($alto/1000)*2))*$row["cantidad_acc"] + $ambos_alto +$ambos_ancho;
                }else{
                   if($row['calcular']=='M2'){
                         $res = (($ancho / 1000)) * (($alto/1000))* $row["cantidad_acc"]*$canfach;
                   }else{
                    if($row["yes"]=='Si'){
                        if($row["lado"]=='Vertical'){
                            $res = (($row["cantidad_acc"]*$alto) / $row["metro"])*$canfach*$ambos;
                        }else{
                            $res = (($row["cantidad_acc"]*$ancho) / $row["metro"])*$canfach*$ambos;
                        }             
                    }else{
                         $res = $row["cantidad_acc"]*$canfach*$ambos;//*
                    }            
               }} 
             }//se  quito }
           
             if($row["med"]!=1){
                 $m = 1;
                 $f = ($taa);
                 $valor = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.($taa).' '.$row["calcular"].'';
                 $valor = 'No aplica' ;
                 $a = '' ;
             }
             $taa = $cant_rej * $res;
            $table = $table.'<tr><td width="5%" title=" rej:'.$rt.'">'.$row['codigo'].'</td>'
                    . '<td width="30%">'.$row['descripcion'].'<br><i>'.$row['observacion_acc'].'</i></td>'
                    . '<td width="5%">'.$row['referencia'].'</td>'
                    . '<td width="7%">'.$row['lado'].'</td>'
                    . '<td width="7%">'.$row["color_acc"].'<font></a></td>'
                    . '<td width="5%">'.$row["yes"].'<font></a></td>
               <td width="5%">'.$taa.' '.$row["calcular"].'*</font></td>'
                    . '<td width="7%">'.$valor.'</font></td>'
                    . '<td class="hidden-phone">'.$row["para"].'</font></td>'
                    . '<td><button onclick="editaracc('.$row["id_r_ac"].')"><img src="../imagenes/modificar.png"></button> </td>'
                    . '<td> <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_4='.$row["id_r_ac"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
   }
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab4x">

                                        <div class="row-fluid">



                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<!--Modulo de Accesorio -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Gastos de maquina</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab14" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab15" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab14">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia'].'</a></td><td width="10%">'.$row['descripcion_ma'].'</font></td><td width="10%"> '.$row["porcentaje_ma"].' %<font></a></td>
               '
                    . '<td  width="10%">  <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_3='.$row["id_rep_ma"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab15">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_ma.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_ma.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione la maquina</label>
                                            <div class="controls"> 
                                               <select name="ref_ma" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_ma`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_ma'];
                                                            $valor2=$fila['descripcion_ma'];
                                                            $valor3=$fila['referencia'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                              <label></label><div class="controls"> </div>
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div> 
<!--Fin Modulo de Accesorio -->

<!--Gasto de Maquina-->
                            
<!--Fin Gasto de Maquina-->    

<!--Gasto de mano de obra-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Mano de Obra por Producto</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab7" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab8" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab7">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Instalacion?'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Und.'.'</th>';
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia'].'</a></td><td width="10%">'.$row['descripcion_mo'].'</font></td><td width="10%"> '.$row["instalacion"].'<font></a></td><td width="10%">$ '.$row["valor_mo"].'<font></a></td>
               <td  width="10%">  <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_5='.$row["id_rep_mo"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab8">

                                        <div class="row-fluid">

                                            <form name="formulario" class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_mo.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_mo.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione mano de obra</label>
                                            <div class="controls"> 
                                               
                                               <select name="ref_mo" >
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_mo`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_mo'];
                                                            $valor2=$fila['descripcion_mo'];
                                                            $valor3=$fila['referencia'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                              <label></label><div class="controls"> </div>
                                          <a href="../vistas/checkeds_manoobra.php?cod=<?php echo $_GET['cod'].''; ?>" title="Seleccionar materiales por cantidad" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/check.png"> Agregar Multiples</a><br> 
                                                                                        
                                           

                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<!--Fin Gasto de mano de obra-->

<!--Gasto administrativo-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Gastos Administrativo y Utilidad</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab9" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab10" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab9">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia_ad'].'</a></td><td width="10%">'.$row['descripcion_ad'].'</font></td><td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td  width="10%"> <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_6='.$row["id_rep_ad"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab10">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_ad.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_ad.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione los gastos administrativos</label>
                                            <div class="controls"> 
                                               <select name="ref_ad" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_admin`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_ad'];
                                                            $valor2=$fila['descripcion_ad'];
                                                            $valor3=$fila['referencia_ad'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div> 
                                             <a href="../vistas/checkeds_gastos.php?cod=<?php echo $_GET['cod'].''; ?>" title="Seleccionar materiales por cantidad" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/check.png"> Agregar Multiples</a><br> 
                                           
                                              <label></label><div class="controls"> </div>
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<!--Fin Gasto administrativo-->
<!--Otros GASTOS-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Otros Gastos</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab16" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab17" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab16">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Cantidad.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor'.'</th>';
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia_ot'].'</a></td><td width="10%">'.$row['descripcion_ot'].'</font></td><td width="10%"> '.$row["cantidad_ot"].' Und<font></a></td><td width="10%">$ '.$row["valor_ot"].' <font></a></td>
               <td  width="10%"> <a href="../vistas/?id=nuevo_producto&cod='.$_GET['cod'].'&del_7='.$row["id_r_ot"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab17">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_otro.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_otro.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione referencia</label>
                                            <div class="controls"> 
                                               <select name="ref_ot" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_otro`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_ot'];
                                                            $valor2=$fila['descripcion_ot'];
                                                            $valor3=$fila['referencia_ot'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                             
                                               <label></label><div class="controls"> </div>
                                               
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
                               <div id="modalper"></div>             
<!--Fin Gasto administrativo-->
<?php }
if(isset($_GET['del_1'])){
$sql = "DELETE FROM producto_rep_alu WHERE id_r_a=".$_GET['del_1']."";

$que = mysqli_query($conexion,"INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`) VALUES (NULL, 'Se elimino el perfil ".$_GET['pr']."  ','".$_SESSION['k_username']."','Productos','".$_GET["cod"]."') ");

mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_2'])){
$sql = "DELETE FROM producto_rep_vid WHERE id_r_v=".$_GET['del_2']."";
mysqli_query($conexion,$sql);
$que = mysqli_query($conexion,"INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`) VALUES (NULL, 'Se elimino el vidrio ".$_GET['vr']."  ','".$_SESSION['k_username']."','Productos','".$_GET["cod"]."') ");

echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_3'])){
$sql = "DELETE FROM producto_rep_ma WHERE id_rep_ma=".$_GET['del_3']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_4'])){
$sql = "DELETE FROM producto_rep_acc WHERE id_r_ac=".$_GET['del_4']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_5'])){
$sql = "DELETE FROM producto_rep_mo WHERE id_rep_mo=".$_GET['del_5']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_6'])){
$sql = "DELETE FROM producto_rep_ad WHERE id_rep_ad=".$_GET['del_6']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_7'])){
$sql = "DELETE FROM producto_rep_otro WHERE id_r_ot=".$_GET['del_7']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
 if(isset($_GET['del_8'])){
$sql = "DELETE FROM producto_rep_rej WHERE id_r_rej=".$_GET['del_8']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
 if(isset($_GET['del_db'])){
$sql = "DELETE FROM vidrios_divisiones WHERE id_db=".$_GET['del_db']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=nuevo_producto&cod=".$_GET['cod']."'";
echo "</script>";
}
?>

<div class="modal fade" id="ModalRejillas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulario de Rejillas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table>
                <tr>
                    <td>Id Producto</td>
                    <td><input type="text" id="cod" disabled value="<?php echo $_GET['cod']; ?>" style="width: 100%;"></td>
                <tr>
                <tr>
                    <td>Id</td>
                    <td><input type="text" id="idrefe" disabled value="" style="width: 100%;"></td>
                <tr>
                    
                    <td><button onclick="BuscarReferencia()">Codigo</button> </td>
                    <td><input type="text" id="refrej" disabled style="width: 180px;">
                        </td>
                   <tr>
                    <td>Descripcion</td>
                    <td><input type="text" id="b" disabled style="width: 100%;"></td>
                    <tr>
                    <td>Referencia</td>
                    <td><input type="text" id="c" disabled style="width: 100%;"></td>
                </tr>
                <tr>
                    <td>Calcular Cant. de Rejillas</td>
                    <td> 
                        
                        <select name="perfil_med" id="perfil_med"  style="width: 80px;" required onchange="sacar_medida_perfil()">
                                               <?php

                                               echo ' <option value="'.$id_ancho.'">'.$descripcion_ancho.'</option>';
                                                   require '../modelo/conexion.php';
                                       $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where c.grupo in ('Perfileria','Perfileria Acero') and b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                        $result=  mysqli_query($conexion,$consulta);
                                        $ta = 0;
                                        while($row=  mysqli_fetch_array($result)){
                                        $valor1_an = $row['id_r_a'];
                                        $valor2=$row['descripcion'];
                                        $valor3=$row['lado'];
                                        $descuento=$row['descuento'];
                                        $medida_1=$row['medida_r_a'];
                                        $nw_medida = $row['medida_r_a'];
                                        $nw_lado = $row['lado'];
                                        $nw_var1 = $row['descuento'];
                                        $nw_ope = $row['signo'];
                                        $nw_var2 = $row['variable'];
                                        $nw_cant = $row['cantidad'];
                                        $nw_div = $row['division'];
                                        $altura_v_c = $altura_v_c; // altura ventana corrediza
                                        $altura = $altura;// altura cuerpo fijo
                                        $anchura = $anchura; //ancho cuerpo fijo
                                        $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                        $ancho = $ancho;
                                        $alto = $alto;

                                        include '../vistas/version2/productos/formula_perfil.php';
                                        $alv = $med_perfil;

                                                            echo"<option value='".$valor1_an."'>(".$alv.") ".$valor2." </option>";
                                                            
                                                            }
                                                            ?>
                             <option disabled>----------------------</option>
                             <option value="90002"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option>
                             <option value="90001"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option>
                             <option value="90003"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option>
                             <option value="90004"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option>
                </select> 
                        <input type="text" id="medp" value="" style="width: 30px;" disabled>
                        / <input type="text" name="var3" id="var3" value="1" style="width: 30px;">
                                        * <input type="text" name="multiplo"  id="multiplo" value="1" style="width: 30px;">
                   
                <button onclick="cal_can_rej()">=</button>
                <input type="text"  id="res_can_rej" value="" disabled style="width: 30px;">
                 </td>
                                    </tr>
                                    <tr>
                                        <td>Medida del perfil (mm)</td>
                                        <td>
                                            <select name="med_rej" id="med_rej" style="width: 80px;" onchange="sacar_medida_perfil2()">
                                                            <option value="999994"><?php if(isset($_GET['cod'])){echo $ancho;} ?> Ancho de producto</option> 
                                                            <option value="999999"><?php if(isset($_GET['cod'])){echo $alto;} ?> Alto de producto</option> 
                                                            <option value="999998"><?php if(isset($_GET['cod'])){echo $altura;} ?> Alto Cuerpo Fijo de producto</option> 
                                                            <option value="999997"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> Alto Ventana Corrediza</option> 
                                                            <?php
                                                            $request_vw=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            if($request_vw){

                                                            $total2=0;
                                                            while($row=mysqli_fetch_array($request_vw))
                                                            {      
                                                                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
                                                                $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
                                                                $id_p= $fil_an["id_p"];

                                                                 $nw_medida = $fil_an['medida_r_a'];
                                                                $nw_lado = $fil_an['lado'];
                                                                $nw_var1 = $fil_an['descuento'];
                                                                $nw_ope = $fil_an['signo'];
                                                                $nw_var2 = $fil_an['variable'];
                                                                $nw_cant = $fil_an['cantidad'];
                                                                $nw_div = $fil_an['division'];
                                                                $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                                $altura = $altura;// altura cuerpo fijo
                                                                $anchura = $anchura; //ancho cuerpo fijo
                                                                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                                $ancho = $ancho;
                                                                $alto = $alto;

                                                                include '../vistas/version2/productos/formula_perfil.php';
                                                                $al = $med_perfil;

                                                                $tv = $al + $row['var1'];

                                                                 $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
                                                                $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));

                                                                 $nw_medida = $fil_al['medida_r_a'];
                                                                $nw_lado = $fil_al['lado'];
                                                                $nw_var1 = $fil_al['descuento'];
                                                                $nw_ope = $fil_al['signo'];
                                                                $nw_var2 = $fil_al['variable'];
                                                                $nw_cant = $fil_al['cantidad'];
                                                                $nw_div = $fil_al['division'];
                                                                $altura_v_c = $altura_v_c; // altura ventana corrediza
                                                                $altura = $altura;// altura cuerpo fijo
                                                                $anchura = $anchura; //ancho cuerpo fijo
                                                                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                                                                $ancho = $ancho;
                                                                $alto = $alto;

                                                                include '../vistas/version2/productos/formula_perfil.php';
                                                                $al2 = $med_perfil;
                                                                $tv2 = $al2 + $row['var2'];
                                                                echo"<option value='".$row['id_r_v']."'>(".$tv." mm) ".$row['descripcion']."-".$row['id_r_v']."</option>";      
                                                            } 	
                                                    }
?>
                                                            <option value='999995'><?php if(isset($_GET['cod'])){echo $anchura;} ?>Ancho C.F </option>
                                                            <option value='999996'><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?>Ancho Ventana Corrediza</option>
                                            </select>
                                            <input type="text" id="medm" value="" style="width: 30px;">-/+ 
                                            
                                            <input type="text" name="varr" id="varr" value="" style="width: 30px;"> /
                                            <input type="text" name="en" id="en" value="1" style="width: 30px;">
                                            <button onclick="cal_med_rej()">=</button>
                                            <input type="text"  id="res_med_rej" value="" disabled style="width: 40px;">
                                        </td>
                 </tr>
              </table>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="LimpiarRejilla()">Close</button>
        <button type="button" class="btn btn-danger" onclick="LimpiarRejilla()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="SaveRejillas()">Save changes</button>
      </div>
    </div>
  </div>
</div>   
<div class="modal fade" id="ModalAccesorios" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Configuracion de Accesorios</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>  
      <form  action="<?php echo '../modelo/reparto_acc.php?id_p='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
<div class="modal-body">
                    
                                            <table>
                                                <tr>
                                                    <td>Id</td>
                                                    <td>  <input type="number" name="acc_id" id="acc_id"  class="span6"  value="" placeholder="" readonly></td>
                                              
                                                </tr>
                                                <tr>
                                                    <td>Digite el Codigo</td>
                                                    <td colspan="1">
<!--                                                        <input type="text" id="acc_idref" onclick="BuscarAccesorios()"> -->
                                                         <select  name="ref_ac"  id="select2_4" required  onclick="BuscarAccesorios()">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                            $valor3=$fila['codigo'].'-'.$fila['descripcion'].'-'.$fila['referencia'];
                                                           

                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select>
                                                    </td>
                                                    <td>
                                                        <select name="color_acc" class="span6" required id="acc_col"> 
                                                <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysqli_query($conexion,$consulta6);
                                                            while($fila=  mysqli_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                
                                                 
                                                  
                                          </select>
                                                    </td>   
                                                        
                                                </tr>
                                                
                                                <tr>
                                                    <td>Calcular</td>
                                                    <td>
                                                        <select name="cal" class="span6" id="perimetro" required> 
                                                            <option value="">Ninguno</option> 
                                                              <option value="Und">Und</option>
                                                            <option value="ML">ML</option>
                                                            <option value="M2">M2</option>
                                                            <option value="Kg">Kg</option>
                                                        </select>
                                                    </td>
                                                      <td>Medida Fija <select name="fija" class="span6" id="fija" required> 
                                                            <option value="0">No</option> 
                                                             <option value="1">Si</option>
                                                           </select></td>
                                                      <td>
                                                          
                                                      </td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Digite la Cantidad</td>
                                                    <td id="cantidad"><input type="text" name="cant_acc" id="acc_can" value="" class="span6" placeholder=" " required></td>
                                                    <td> Medida=<input type="number" name="med" id="acc_med"  class="span6"  value="" placeholder="En Milimetros" required> </td>
                                                    <td>Solo para perfiles</td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Calculo por rejillas</td>
                                                    <td><select name="can_rej" class="span8" required id="acc_rej">
                                                                   <?php
                                                                   
                                                                   echo ' <option value="0">1</option>';
                                                                       require '../modelo/conexion.php';
                                                           $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            while($row=mysqli_fetch_array($request_v2))
                                                            {
                                                               echo ' <option value="'.$row['id_r_rej'].'">'.$row['descripcion'].'</option>';
                                                            }
                                                            ?>
                                                           </select> 
                                                    </td>
                                                    <td><i>Para calcular los tornillos de las rejillas por favor seleccione la rejila, de lo contrario dejelo en 1.</i></td>
                                                </tr>
                                                 <tr>
                                                    <td>Por Cada </td>
                                                    <td><input type="text" name="metros" id="acc_metro" style="width:50px;" value="1000" class="span6" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i></td>
                                                      <td>, Lleva este parametro? 
                                                          <select name="yes" id="acc_yes">
                                                              <?php echo '<option value="'.$yes.'">'.$yes.'</option>'; ?>
                                                              <option value="Si">Si</option>
                                                               <option value="No">No</option>
                                                          </select></td>
                                                      <td></td>
                                                        
                                                </tr>
                                                 <tr>
                                                    <td>En el Lado </td>
                                                    <td><select name="lado" style="width:80px;" id="acc_lado">
                                                             <option value="Vertical">Vertical</option>
                                                            <option value="Horizontal">Horizontal</option>
                                                            
                                                        </select> <i>" En este lado se aplicara la formula"</i></td>
                                                      <td>Multiplica por Horizontales | Verticales
                                                          <select name="mul" style="width:60px" id="acc_mul">
                                                             <option value="No">No</option>
                                                             <option value="Si">Si</option>
                                                               
                                                          </select> X 
                                                          <input type="number" name="ambos" value="1" class="span6" id="acc_ambos"  style="width:60px"></td>
                                                      <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Para :</td>
                                                    <td><select name="para" class="span8" required id="acc_para">  
                                                            <option value="">Seleccione uno</option>
                                                <option value="Fabricacion">Fabricacion</option> 
                                                <option value="Instalacion">Instalacion</option> 

                                          </select></td>
                                          <td><button type="button" onclick="calcularacc()">resultado</button> <input type="text" name="res" value="" class="span6" id="acc_res"  style="width:60px" disabled></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Observacion</b>
                                                    </td>
                                                    <td colspan="2"><textarea id="acc_obs" name="acc_obs" class="form-control" style="width:  290px;" placeholder=""></textarea></td>
                                                </tr>
                                            </table>
                                           
                                             
                                           
               </div>

      <!-- Modal footer -->
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>                

                        </form>
     

    </div>
  </div>
</div>