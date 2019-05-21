<!DOCTYPE html>
<?php
   include '../../modelo/conexion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reporte de existencia</title>
       <link href="../../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../../css/estilo.css" rel="stylesheet">
<script src="../../js/jquery.js"></script>
<script src="../../js/funcion_global.js"></script>
<script src="funciones.js"></script>
<script src="../../js/bootstrap.min.js"></script>

    </head>
    <body style="background-color: white">
        <div>
            <h3>Registro de Existencia </h3>
        </div>
        <div class="border">
  
                <div>
                    <div  style="float:left" id="pr">
                   <img src="../../images/salir.png" class="panel"  id="Salir"title="Salir del Formulario" data-toggle="tooltip"> 
                   <button onclick="imp_rep()">Imprimir</button>
               </div>
             </div>
        </div><hr>
        <div class="border">
            <div id="pr2">
            <select id="linea"  required>
                                                    <option value="">Seleccione</option>
                                                          <?php
                                                          $consulta= "SELECT * FROM `grupos`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['nombre_grupo'];
                                                            $v1=$fila['cod_grupo'];
                                                            echo"<option value='".$v1."'>".$fila['cod_grupo']." - ".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
             </select>
            <select id="mes" style="width: 60px">
                <option value=''>Todas</option>
                <?php
                for($i=1;$i<=12;$i++){
                    if(date("m")==$i){$selected = 'selected';}else{$selected = '';}
                    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                }
                ?>
            </select>
            <input type="number" id="ano" value="<?php echo date("Y") ?>" style="width: 60px">
            <select id="existencia"  style="width: 130px">
                <option value="3">Todas</option>
                <option value="1">Con Existencia</option>
                <option value="0">Sin Existencia</option>
            </select>
            <input type="text" id="producto" value="">
            <button onclick="consultar(<?php echo $_GET['cod']; ?>)">Consultar</button>
            <br><hr>
            </div>
            <table>
                <th>Referencia</th>
                <th>Descripcion</th>
                <th>Inv. Inicial</th>
                <th>Entradas</th>
                <th>Salidas</th>
                <th>Stock Actual</th>
                <th>Costo Sin IVA</th>
                <th>Detalles</th>
                <tbody id="mostrar">
                    
                </tbody>
            </table>
        </div>


    </body>
    
</html>
