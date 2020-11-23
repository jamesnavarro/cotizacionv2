<script src="../js/funciones2.js" type="text/javascript"></script>
<script src="../js/buscadores2.js" type="text/javascript"></script>
<?php 
    include '../modelo/conexion.php';
    include '../clases/clases2.php'; 
    
    $idpt = $_GET['idpt'];
    $codigo = $_GET['codigo'];
    $linea = $_GET['linea'];
    
    $sql21 = "SELECT a.*, b.* FROM pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_pt='".$idpt."'";
    $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
    $subpro = $fila21["nombre_subpro"];
    $tiempo = $fila21["tiempo_esp"];
    $id = $fila21["id_subpro"];
    $orden = $fila21["orden"];
?>
<input type="text" id="idpt" value="<?php echo $idpt; ?>">
<input type="text" id="codigox" value="<?php echo $codigo; ?>">
<input type="text" id="lineax" value="<?php echo $linea; ?>">

<table>
    <tr>
        <td width="300px">
            Procesos
        </td>
        <td width="200px">
            <select name="p2" id="procesox" required>
                <?php if(isset($idpt)){
                    echo "<option value='".$id."'>".$subpro."</option>";
                }else{
                    echo "<option value=''>.:Seleccione:.</option>"; 
                } ?>
                
                <?php
                    include "../modelo/conexion.php";
                    $consulta= "SELECT * FROM subproceso where sede_sub='".$linea."'";                     
                    $result=  mysqli_query($conexion,$consulta);
                    while($fila=  mysqli_fetch_array($result)){
                        $valor1=$fila['id_subpro'];
                        $valor2=$fila['nombre_subpro'];
                        echo"<option value=".$valor1.">".
                                $valor2."</option>";
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td width="300px">
            Secuencia
        </td>
        <td width="200px">
            <input type="number" name="secuencia" id="secuenciax" value="<?php if(isset($idpt)){echo $orden;}else{echo $paso;} ?>" placeholder="" required>
        </td>
    </tr>
    <tr>
        <td width="300px">
            Tiempo maximo esperado para comenzar subproceso
        </td>
        <td width="200px">
            <input type="text"  name="time" id="timex" value="<?php if(isset($idpt)){echo $tiempo;}else{echo '00:00:00';} ?>" placeholder="" required>
        </td>
    </tr>
</table>

<div class="modal-footer">

    <button type="button" id="editar_proceso" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Editar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>