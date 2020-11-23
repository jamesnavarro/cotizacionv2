<script src="../js/funciones.js" type="text/javascript"></script>
<script src="../js/buscadores.js" type="text/javascript"></script>
<?php 
    include '../modelo/conexion.php';
    include '../clases/clases.php'; 
    
    $idmate = $_GET['idmate'];
    $cotizacion = $_GET['cotizacion2'];
    $cliente = $_GET['cliente2'];
    
    $sql21 = "SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cot_mat=".$idmate;
    $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
    $idmt= $fila21["id_referencia"];
    $ref= $fila21["referencia"];
    $des_mt= $fila21["descripcion"];
    $color_ma= $fila21["color_ma"];
    $camt= $fila21["cantidad_mat"];  
    $ddmt= $fila21["descuento_mat"];
    $por_mp= $fila21["pe"];
    $med= $fila21["med"];
 
?>
<input type="text" id="idmate" value="<?php echo $idmate; ?>">
<input type="text" id="cotizacionx" value="<?php echo $cotizacion; ?>">
<input type="text" id="clientex" value="<?php echo $cliente; ?>">

<table  class="table table-bordered table-striped table-hover">
    <tr>
        <th style="width:30%">Seleccionar Material</th>
        <td>
            <input type="text" name="refe" id="refe1"  value="<?php if(isset($_GET['idmate'])){ echo $des_mt; } ?>" placeholder="Descripcion del material">
            <input type="hidden" name="ref" id="refe2"  value="<?php if(isset($_GET['idmate'])){ echo $idmt; } ?>">
            <a href="../combos_cotizacion/materiales.php?cot=<?php echo $cotizacion; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/buscar.png"></a>
         </td>
    </tr>
    <tr>
        <th>Referencia</th>
        <td>
            <input type="text" name="refer" id="refe3"  value="<?php if(isset($_GET['idmate'])){ echo $ref; } ?>" placeholder="Referencia">
        </td>
    </tr>
    <tr>
        <th>Cantidad</th>
        <td>
            <input type="text" name="cant" id="cantx" value="<?php if(isset($_GET['idmate'])){ echo $camt; } ?>">
        </td>
    </tr>
     <tr>
    <th>Color del Material</th>
        <td  id="alum"> 
            <select name="color" id="colorx" required>
            <?php if(isset($_GET['idmate'])){
                echo "<option value='".$color_ma."'>".$color_ma."</option>";
            }else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>

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
        <th>Medida</th>
        <td>
            <input type="text" id="refe4" name="medida" value="<?php if(isset($_GET['idmate'])){ echo $med; }else{echo '1';} ?>">Nota: Si es un perfil, digite la medida.
        </td>
    </tr>
    <tr>
        <th>Descuento (%)</th>
        <td>
            <input type="text" name="desc" id="descx" value="<?php if(isset($_GET['idmate'])){ echo $ddmt; } ?>">
        </td>
    </tr>
    <tr>
        <th>Porcentaje Materia Prima %</th>
        <td>
            <select name="mp" id="mpx" style="width: 80px;">
            <?php if(isset($_GET['idmate'])){echo "<option value='".$por_mp."'>".$por_mp."</option>";} ?>
                <option value="p1">p1</option>    
                <option value="p2">p2</option>
                <option value="p3">p3</option>
            </select>
        </td>
    </tr>
</table>
<div class="modal-footer">

    <button type="button" id="editar_mate" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Editar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>