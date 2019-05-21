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

<table class="table table-bordered table-striped table-hover">
    <tr>
        <td>
            Digite el Codigo
        </td>
        <td>
            <select  name="ref_ac"  id="select2_3" required style="width: 150px;">
                <option value="">Seleccione...</option>
                <?php
                    require '../modelo/conexion.php';
                    $consulta= "SELECT * FROM `referencias`";                     
                    $result=  mysql_query($consulta);
                    while($fila=  mysql_fetch_array($result)){
                        $valor1=$fila['id_referencia'];
                        $valor2=$fila['descripcion'];
                        $valor3=$fila['codigo'].' -'.$fila['descripcion'].'-'.$fila['referencia'];

                        echo"<option value='".$valor1."'>".$valor3."</option>";
                    }
                ?>
            </select>
            <select name="" id="d" style="width: 100px;"><?php  echo '<option value="'.$descripcion.'">'.$descripcion.'</option>'; ?></select>
            <select name="" id="e" style="width: 100px;"><?php  echo '<option value="'.$referencia.'">'.$referencia.'</option>'; ?></select>
        </td>
    </tr>
    <tr>
        <td>
            Cantidad
        </td>
        <td>
            <input type="text" name="cantidad" id="cantidad" style="width:100px" value="" placeholder=" " required>
        </td>
    </tr>
    <tr>
        <td>
            Medida
        </td>
        <td>
            <input type="text" name="med" id="med" style="width:70px" value="" placeholder=" " required>(mm), <i>Si es un perfil, digite la medida</i>
        </td>
    </tr>
    <tr>
        <td>
            Calcular
        </td>
        <td>
            <select name="calcular" id="perimetro" required style="width:100px;"> 
                <option value="">Seleccione...</option>
                <option value="Und">Por Unidad</option>
                <option value="ML">Por ML</option>
                <option value="M2">Por M2</option>
                <option value="GL">Galon</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Por Cada
        </td>
        <td>
            <input type="text" name="metro" id="metro" style="width:50px;" value="" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i>
        </td>
    </tr>
    <tr>
        <td>
            Lleva este parametro?
        </td>
        <td>
            <select name="yes" id="yes" style="width:80px;">
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            En el Lado
        </td>
        <td>
            <select name="lado" id="lado" style="width:100px;">
                <option value="Vertical">Vertical</option>
                <option value="Horizontal">Horizontal</option>
            </select> 
            <i>" En este lado se aplicara la formula"</i>
        </td>
    </tr>
</table>
<div class="modal-footer">

    <button type="button" id="guardar_material" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Guardar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>
                                                  
                                             
                                             