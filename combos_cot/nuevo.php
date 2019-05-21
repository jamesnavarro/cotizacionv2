<script src="../js/funciones2.js" type="text/javascript"></script>
<script src="../js/buscadores2.js" type="text/javascript"></script>
<?php
    
    include '../modelo/conexion.php';
    include '../clases/clases2.php'; 
    
    $clases = new general2;
    $por = $_GET['por'];
    $pagina = $_GET['pagina'];
    $idcot = $_GET['mas'];
    $cotizacion = $_GET['cotizacion'];
    $cliente = $_GET['cliente'];
    $pvi = $_GET['pvi'];
    $pal = $_GET['pal'];
    $pac = $_GET['pac'];
    
    $cons = mysql_fetch_array(mysql_query("select * from dolares order by id_dolar desc limit 1"));
    $pd = $cons['precio_dolar'];
    
?>

<label>Precio Dollar: $<?php echo $pd ?></label>
<input type="hidden" value="<?php echo $cons['id_dolar'] ?>" name="id_dolar" id="id_dolar" style="width:40px;" >
<input type="hidden" value="<?php echo $cliente ?>" id="cliente" style="width:40px;">
<input type="hidden" value="<?php echo $cotizacion ?>" id="cotizacion" style="width:40px;" >  
<input type="hidden" value="<?php echo $idcot ?>" id="idcot" style="width:40px;" >      
<input type="hidden" value="<?php echo $por ?>" id="por" style="width:40px;" >    
<input type="hidden" value="<?php echo $pagina ?>" id="pagina" style="width:40px;" >    

<table class="table table-bordered table-striped table-hover">
    <tr>
        <td style="width:30%" >linea de produccion</td>
        <td>
            <select name="linea" id="linea">             
                <?php
                    echo "<option value=''>.:Seleccione la linea:.</option>"; 
                    require '../modelo/conexion.php';
                    $consulta= "SELECT * FROM `lineas`";                     
                    $result=  mysql_query($consulta);
                    while($fila=  mysql_fetch_array($result)){
                        $valor1=$fila['linea'];                                                          
                        $valor3=$fila['linea'];                                                        
                        echo"<option value='".$valor1."'>".$valor3."</option>"; 
                    }
                ?>
            </select>
            <input type="hidden" name="pvi" value="<?php echo $pvi; ?>" id="pvi">
            <input type="hidden" name="pal" value="<?php echo $pal; ?>" id="pal">
            <input type="hidden" name="pac" value="<?php echo $pac; ?>" id="pac">
        </td>
        <td style="width:30%">Instalacion:</td>
        <td> 
            <select name="install" id="install" style="width: 80px;">
                <option value="Si">Si</option>    
                <option value="No">No</option>
            </select>
        </td>
        <td rowspan="7" id="imagen"  style="width:40%">Imagen del producto</td>
    </tr>
    <tr>
        <td>Referencia del producto</td>
        <td>
            <div id="busqueda"></div>
            <input name="a" type="hidden" readonly id="refer">
            <input name="b" readonly type="text" id="descr">
            <input type="hidden" readonly name="ref" id="codig">
        </td>
        <td>Precio de Venta:</td>
        <td> 
            <select name="precio" id="precio" style="width: 80px;">
                <option value="p1">p1</option>
                <option value="p2">p2</option>
                <option value="p3">p3</option>    
            </select>
        </td>
    </tr>
    <tr>
        <td>Sentido</td>
        <td>
            <select name="lado" id="lado"  style="width: 100%;" required>                                                       
                <option value="">Seleccione</option> 
                <option value="Derecho">Derecho</option>
                <option value="Izquierdo">Izquierdo</option>
            </select>
        </td>
                <td>Desperdicio de materia prima:</td>
        <td> 
            <select name="precio_mp" id="precio_mp" style="width: 80px;">
                <option value="p1">p1</option>    
                <option value="p2">p2</option>
                <option value="p3">p3</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Trazabilidad del vidrio</td>
        <td id="vidrios"></td>
        <td>Con descuento de:</td>
        <td id="descuento">  
            <input type="text" name="desc" value="0" id="desc" style="width: 60px;">%
        </td>
    </tr>
    <tr>
        <td>Laminas del Vidrio</td>
        <td>
            <div id="lam"></div>
            <div id="lam2"></div>
            <div id="lam3"></div>
            <div id="lam4"></div>
        </td>
        <td>Tipo:</td>
        <td>
            <input type="text" name="tip" value="" id="tip" placeholder="ej: PV-1">
        </td>
    </tr>
    <tr>
        <td>Color y Espesor del Vidrio</td>
        <td>
            <div  id="vid">hhi</div>
            <div  id="vid2"></div>
            <div  id="vid3"></div>
            <div  id="vid4"></div>
        </td>
        <td>Ubicacion</td>
        <td>
            <textarea name="ubicacion" id="ubicacion" placeholder="digite la ubicacion de este producto">
            </textarea>
        </td>
    </tr>
    <tr>
        <td>Color del Aluminio</td>
        <td id="res_alum"> 
            <select name="alum" id="alum" required>
                <?php
                    echo "<option value=''>.:Seleccione el color:.</option>"; 
                    require '../modelo/conexion.php';
                    $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                    $result6=  mysql_query($consulta6);
                    while($fila=  mysql_fetch_array($result6)){
                        $valor1=$fila['id_ta'];
                        $valor3=$fila['color_a'];
                        echo"<option value='".$valor3."'>".$valor3."</option>";
                    }
                ?>
            </select>
        </td>
        <td>Duracion del proyecto</td>
        <td>
            <input type="number" name="duracion" id="duracion" style="width: 80px;" value="" placeholder=""> dias
        </td>
    </tr>
    <tr>
        <td>Tiene cierre?</td>
        <td id="res_cierre">
            <select name="cierre" id="cierre" required >
                <?php
                    echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; 
                    require '../modelo/conexion.php';
                    $consulta= "SELECT * FROM `tipo_aluminio`";                     
                    $result=  mysql_query($consulta);
                    while($fila=  mysql_fetch_array($result)){
                        $valor1=$fila['color_a'];
                        echo"<option value='".$valor1."'>".$valor1."</option>";
                    }
                ?>
            </select>
        </td>
        <td>Observaciones</td>
        <td>
            <textarea name="descripcion" id="descripcion" placeholder="Comente las especificaciones de este producto">
            </textarea>
        </td>
        <td rowspan="7" id="areas">trazabilidad</td>
    </tr>
        <div id="hoja"> 
            <input type="hidden" id="hoja2" name="hoja" value="">
        </div>
    <tr>
        <td>Medidas</td>
        <td>
            <input type="text" name="ancho" id="ancho" autocomplete="off" value="" style="width: 70px;"  placeholder="Ancho en mm" required>
       X     <input type="text" name="alto" id="alto" autocomplete="off" value="" style="width: 70px;"  placeholder="Alto en mm" required>
       
        </td>
        <td>Medida Alto Cuerpo Fijo</td>
        <td>
            <input type="text" name="cuerpo" id="cuerpo" value="0">
        </td>
    </tr>
    <tr>
        <td>Cantidad</td>
        <td>
            <input type="text" name="cant" id="cant" autocomplete="off" value=""  style="width: 60px;"  placeholder="Cantidad" required> 
        </td>
         <td>Medida Ancho Cuerpo Fijo</td>
        <td>
            <input type="text" name="ladomm" id="ladomm" value="0">
        </td>
    </tr>
    <tr>
        <td>Medidas Totales con Compuestos</td>
        <td>
            <input type="text" autocomplete="off" name="ancho_temp" id="ancho_temp" value="" style="width: 70px;"  placeholder="Ancho en mm" >
            X <input type="text" autocomplete="off" name="alto_temp" id="alto_temp" value="" style="width: 70px;"  placeholder="Alto en mm" >
        </td>
        <td>Lleva Pelicula ?</td>
        <td>
            <select name="pelicula" id="pelicula">
                <option value="No Aplica">No Aplica</option>
                <option value="Una Cara">Una Cara</option>
                <option value="Doble Cara">Doble Cara</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
        <td>
            <input type="text" name="ancho_abajo" id="ancho_abajo" value="0">
        </td>
        <td>Observaciones adicionales:</td>
        <td>
            <textarea name="obs2" id="obs2" placeholder="Observacion adicional"></textarea>
        </td>
    </tr>
    <tr>
        <td>Digite la cantidad de verticales y horizontales</td>
        <td>Verticales
            <input type="text" name="vert" id="vert" value=""  style="width: 70px;">
        </td>
        <td>Horizontales</td>
        <td>
            <input type="text" name="hori" id="hori" value=""  style="width: 70px;">
        </td>
    </tr>
    <tr>
        <td></td>
        <td> 
            <input type="checkbox" name="d1" id="d1" value="1">Automatico
        </td>
        <td></td>
        <td></td>
    </tr>
</table>
<div class="modal-footer">
    <button type="button" id="guardar_prod" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Guardar</button>
    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
</div>