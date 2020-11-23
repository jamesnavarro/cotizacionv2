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

<table class="table table-bordered table-striped table-hover">
    <tr>
        <th style="width:50%">Seleccionar Servicios</th>
        <td>
            <select name="servicio" id="servicio" required> 
                <?php 
                    echo '<option value="">Seleccione el Servicio:</option>';
                    require '../modelo/conexion.php';
                    $consulta= "SELECT * FROM `referencia_mo` where instalacion='Si' ";                     
                    $result=  mysqli_query($conexion,$consulta);
                    while($fila=  mysqli_fetch_array($result)){
                        $valor1=$fila['id_ref_mo'];
                        $valor3=$fila['descripcion_mo'];
                        echo"<option value='".$valor1."'>".$valor3."</option>";
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th>Cantidad</th>
        <td>
            <input type="text" name="cant" id="cant" placeholder="Cantidad">
        </td>
    </tr>
    <tr>
        <th>Descuento (%)</th>
        <td>
            <input type="text" name="desc" id="desc" placeholder="0">
        </td>
    </tr>
</table>
<div class="modal-footer">

    <button type="button" id="guardar_serv" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Guardar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>