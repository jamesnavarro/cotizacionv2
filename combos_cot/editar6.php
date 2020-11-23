<script src="../js/funciones2.js" type="text/javascript"></script>
<script src="../js/buscadores2.js" type="text/javascript"></script>
<?php 
    include '../modelo/conexion.php';
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    $s3 = "SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.id_ref_acce=".$_GET['idmaterial']."";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $id_referencia= $fi3["id_referencia"];
                $descripcion= $fi3["descripcion"];
                $cantidad_m= $fi3["cantidad_m"];
                $calcular= $fi3["calcular"];
                $metro= $fi3["metro"];
                $referencia= $fi3["referencia"];
                $yes= $fi3["yes"];
                $lado= $fi3["lado"];
                $codigo= $fi3["codigo"];
                $med= $fi3["med"];
                
    $cotizacion = $_GET['cotizacion'];
    $cliente = $_GET['cliente'];
    $mas = $_GET['mas'];
    $por = $_GET['por'];
    $idmaterial = $_GET['idmaterial'];
?>
<input type="hidden" id="cotizacionx" value="<?php echo $cotizacion; ?>">
<input type="hidden" id="clientex" value="<?php echo $cliente; ?>">
<input type="hidden" id="masx" value="<?php echo $mas; ?>">
<input type="hidden" id="porx" value="<?php echo $por; ?>">
<input type="hidden" id="id_material" value="<?php echo $idmaterial; ?>">

<table class="table table-bordered table-striped table-hover">
    <tr>
        <td>
            Digite el Codigo
        </td>
        <td>
            <select name="ref_ac" id="select2_3" required style="width: 150px;">
                <?php if(isset($_GET['idmaterial'])){
                    $refe = $codigo.'-'.$descripcion.'-'.$referencia;
                    echo '<option value="'.$id_referencia.'">'.$refe.'</option>';
                }else{
                    echo '<option value="">Seleccione</option>';
                } ?>
                                                                  
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
            <select name="" id="d" style="width: 100px;">
                <?php  echo '<option value="'.$descripcion.'">'.$descripcion.'</option>'; ?>
            </select>
            <select name="" id="e" style="width: 100px;">
                <?php  echo '<option value="'.$referencia.'">'.$referencia.'</option>'; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Cantidad
        </td>
        <td>
            <input type="text" name="cantidad" id="cantidadx" style="width:100px" value="<?php echo $cantidad_m ?>" placeholder=" " required>
        </td>
    </tr>
    <tr>
        <td>
            Medida
        </td>
        <td>
            <input type="text" name="med" id="medx" style="width:70px" value="<?php echo $med ?>" placeholder=" " required>(mm), <i>Si es un perfil, digite la medida</i>
        </td>
    </tr>
    <tr>
        <td>
            Calcular
        </td>
        <td>
            <select name="calcular" id="perimetrox" required style="width:100px;"> 
                <?php if(isset($_GET['idmaterial'])){
                    echo '<option value="'.$calcular.'">'.$calcular.'</option>';
                }else{ ?>
                    <option value="">Seleccione...</option>
                <?php } ?>
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
            <input type="text" name="metro" id="metrox" style="width:50px;" value="<?php echo $metro ?>" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i>
        </td>
    </tr>
    <tr>
        <td>
            Lleva este parametro?
        </td>
        <td>
            <select name="yes" id="yesx" style="width:80px;">
                <?php if(isset($_GET['idmaterial'])){ 
                    echo '<option value="'.$yes.'">'.$yes.'</option>';
                }else{
                     echo '<option value="">Seleccione..</option>';
                } ?>
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
            <select name="lado" id="ladox" style="width:100px;">
                <?php if(isset($_GET['idmaterial'])){ 
                    echo '<option value="'.$lado.'">'.$lado.'</option>';
                }else{
                    echo '<option value="">Seleccione..</option>';
                } ?>
                <option value="Vertical">Vertical</option>
                <option value="Horizontal">Horizontal</option>
            </select> 
            <i>" En este lado se aplicara la formula"</i>
        </td>
    </tr>
</table>
<div class="modal-footer">

    <button type="button" id="edit_material" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Editar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>
                                                  
                                             
                                             