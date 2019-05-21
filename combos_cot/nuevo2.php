<script src="../js/funciones2.js" type="text/javascript"></script>
<script src="../js/buscadores2.js" type="text/javascript"></script>
<?php 
    include '../modelo/conexion.php';
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    $cotizacion = $_GET['cotizacion'];
    $cliente = $_GET['cliente'];
    $mas = $_GET['mas'];
    $por = $_GET['por'];
    $pagina = $_GET['pagina'];
?>
<input type="hidden" id="cotizacion" value="<?php echo $cotizacion; ?>">
<input type="hidden" id="cliente" value="<?php echo $cliente; ?>">
<input type="hidden" id="mas" value="<?php echo $mas; ?>">
<input type="hidden" id="por" value="<?php echo $por; ?>">
<input type="hidden" id="pagina" value="<?php echo $pagina; ?>">

<table class="table table-bordered table-striped table-hover">
    <tr>
        <th style="width:50%">Seleccionar Servicios</th>
        <td>
            <select name="servicio" id="servicio" required> 
                <?php 
                    echo '<option value="">Seleccione el Servicio:</option>';
                    require '../modelo/conexion.php';
                    $consulta= "SELECT * FROM `referencia_mo` where instalacion='Si' ";                     
                    $result=  mysql_query($consulta);
                    while($fila=  mysql_fetch_array($result)){
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

    <button type="button" id="guardar_servicio" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Guardar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>