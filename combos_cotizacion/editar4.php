<script src="../js/funciones.js" type="text/javascript"></script>
<script src="../js/buscadores.js" type="text/javascript"></script>
<?php 
    include '../modelo/conexion.php';
    include '../clases/clases.php'; 
    
    $cotizacion = $_GET['cotizacion2'];
    $cliente = $_GET['cliente2'];
    $idkit = $_GET['idkit'];
    
    $sql21 = "SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_ck=".$idkit;
    $fila21 =mysql_fetch_array(mysql_query($sql21));
    $idmt= $fila21["id_p"];
    $ref= $fila21["referencia_p"];
    $des_mt= $fila21["producto"];
    $color_k= $fila21["color_k"];
    $camt= $fila21["cantidad_k"];  
    $ddmt= $fila21["desc_k"];
    $por_mp= $fila21["por_k"];
?>
<input type="hidden" id="idkit" value="<?php echo $idkit; ?>">
<input type="hidden" id="cotizacionx" value="<?php echo $cotizacion; ?>">
<input type="hidden" id="clientex" value="<?php echo $cliente; ?>">

<table class="table table-bordered table-striped table-hover">
    <tr>
        <th style="width:40%">Seleccionar Kit</th>
        <td>
            <input type="text" name="refe" id="refer1x"  value="<?php if(isset($_GET['idkit'])){ echo $des_mt; } ?>" placeholder="Descripcion del material">
            <input type="hidden" name="ref" id="refer2x"  value="<?php if(isset($_GET['idkit'])){ echo $idmt; } ?>">
            <a href="../combos_cotizacion/kit.php?cot=<?php echo $_GET['cot']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/buscar.png"></a>
        </td>
    </tr>
    <tr>
        <th>Referencia</th>
        <td>
            <input type="text" name="refer" id="refer3x"  value="<?php if(isset($_GET['idkit'])){ echo $ref; } ?>" placeholder="Referencia">
        </td>
    </tr>
    <tr>
        <th>Cantidad</th>
        <td>
            <input type="text" name="cantx" id="cantx" value="<?php if(isset($_GET['idkit'])){ echo $camt; } ?>">
        </td>
    </tr>
    <tr>
        <th>Color del Kit</th>
        <td  id="alum"> 
            <select name="color" id="colorx" required>
            <?php if(isset($_GET['idkit'])){echo "<option value='".$color_k."'>".$color_k."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>

                       <?php
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
        <th>Descuento (%)</th>
        <td>
            <input type="text" name="desc" id="descx" value="<?php if(isset($_GET['idkit'])){ echo $ddmt; } ?>">
        </td>
    </tr>
    <tr>
        <th>Porcentaje Materia Prima %</th>
        <td>
            <select name="mp" id="mpx" style="width: 80px;">
                <?php if(isset($_GET['idkit'])){echo "<option value='".$por_mp."'>".$por_mp."</option>";} ?>
                <option value="p1">p1</option>    
                <option value="p2">p2</option>
                <option value="p3">p3</option>
            </select></td>
    </tr>
</table>
<div class="modal-footer">

    <button type="button" id="editar_kit2" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Editar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>