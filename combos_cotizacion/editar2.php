<script src="../js/funciones.js" type="text/javascript"></script>
<script src="../js/buscadores.js" type="text/javascript"></script>
<?php 
    include '../modelo/conexion.php';
    include '../clases/clases.php'; 
    
    $cotizacion = $_GET['cotizacion2'];
    $cliente = $_GET['cliente2'];
    $idserv = $_GET['idserv'];
    
    $sql21 = "SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cot_serv=".$idserv;
    $fila21 =mysql_fetch_array(mysql_query($sql21));
        $des_sv= $fila21["descripcion_mo"];
        $ca= $fila21["cantidad_serv"];
        $dd= $fila21["descuento_serv"];
        $idfrm= $fila21["id_ref_mo"];
?>
<input type="hidden" id="cotizacionx" value="<?php echo $cotizacion; ?>">
<input type="hidden" id="clientex" value="<?php echo $cliente; ?>">
<input type="hidden" id="id_serv" value="<?php echo $idserv; ?>">

<table class="table table-bordered table-striped table-hover">
    <tr>
        <th style="width:50%">Seleccionar Servicios</th>
        <td>
            <select name="servicio" id="serviciox" required > 
                <?php if(isset($_GET['idserv'])){
                    echo "<option value='".$idfrm."'>".$des_sv."</option>";
                }else{
                    echo "<option value=''>.:Seleccione el Servicio:.</option>"; 
                } ?>
                 <?php
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
            <input type="text" name="cant" id="cantx" value="<?php if(isset($_GET['idserv'])){ echo $ca; } ?>">
        </td>
    </tr>
    <tr>
        <th>Descuento (%)</th>
        <td>
            <input type="text" name="desc" id="descx" value="<?php if(isset($_GET['idserv'])){ echo $dd; } ?>">
        </td>
    </tr>
</table>
<div class="modal-footer">

    <button type="button" id="editar_servi" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Editar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>