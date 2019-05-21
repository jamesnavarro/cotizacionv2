<script src="../js/funciones.js" type="text/javascript"></script>
<script src="../js/buscadores.js" type="text/javascript"></script>
<?php 
    include '../modelo/conexion.php';
    include '../clases/clases.php'; 
    
    $cotizacion = $_GET['cotizacion'];
    $cliente = $_GET['cliente'];
?>
<input type="hidden" id="cotizacion" value="<?php echo $cotizacion; ?>">
<input type="hidden" id="cliente" value="<?php echo $cliente; ?>">

<table  class="table table-bordered table-striped table-hover">
    <tr>
        <th style="width:30%">Seleccionar Material</th>
        <td>
            <input type="text" name="refe" id="refere"  value="" placeholder="Descripcion del material">
            <input type="hidden" name="ref" id="idrefe"  value="">
            <a href="../vistas/materiales.php?cot=<?php echo $cotizacion; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/buscar.png"></a>
        </td>
    </tr>
    <tr>
        <th>Referencia</th>
        <td>
            <input type="text" name="refer" id="descrefe"  value="" placeholder="Referencia">
        </td>
    </tr>
    <tr>
        <th>Cantidad</th>
        <td>
            <input type="text" name="cant" id="cant1" value="">
        </td>
    </tr>
     <tr>
    <th>Color del Material</th>
        <td  id="alum"> 
            <select name="color" id="color" required>
            <?php echo "<option value=''>.:Seleccione el color:.</option>";  
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
    </tr>
    <tr>
        <th>Medida</th>
        <td>
            <input type="text" id="medida" name="medida" value="">Nota: Si es un perfil, digite la medida.
        </td>
    </tr>
    <tr>
        <th>Descuento (%)</th>
        <td>
            <input type="text" name="desc" id="desc" value="">
        </td>
    </tr>
    <tr>
        <th>Porcentaje Materia Prima %</th>
        <td>
            <select name="mp" id="mp" style="width: 80px;">
                <option value="p1">p1</option>    
                <option value="p2">p2</option>
                <option value="p3">p3</option>
            </select>
        </td>
    </tr>
</table>
<div class="modal-footer">

    <button type="button" id="guardar_mate" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Guardar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>
