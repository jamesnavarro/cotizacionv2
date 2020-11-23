<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reportes de Cotizaciones</title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="estilo.css">
        <link rel="stylesheet" href="estilo_medio.css">
        <link rel="stylesheet" href="estilo_grande.css">
        <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../../js/ajax.js" type="text/javascript"></script>
        <script src="funciones.js?<?php echo rand(1,100) ?>" type="text/javascript"></script>

    </head>
    <body>
        <div class="bod blueTable"><br>
            <center><legend><h2>MODULO EMBUDO DE VENTAS</h2></legend></center>
               <table class = "blueTable" style="width: 100%">
        
            <tr>
                <td><B>No. COTIZACION:</B></td>
                <td><input type="text" id="cot"></td>
                <td><B>CLIENTE</B></td>
                <td><input type="text" id="cli"></td>
                <td><B>NOMBRE DE LA OBRA</B></td>
                <td><input type="text" id="obr"></td>  
            </tr>
            <tr> 
                <td><B>CIUDAD:</B></td>
                <td><input type="text" id="ciu"></td>
                <td><B>VALOR MAYOR A</B></td>
                <td><input type="text" id="pre" min="5000000" value="" style="width:80px"> a <input type="text" id="pref" min="5000000" value="" style="width:80px"></td>
                <td><B>ASESOR</B></td>
                <td>
                     <select id="ase">
                         <option value="">Seleccione</option>
				<?php
                                include '../../modelo/conexion.php';
                                $consulta2= "SELECT * FROM `usuarios` where area='Ventas' and estado='Activo' order by nombre";   
                                $result2=  mysqli_query($conexion,$consulta2);       
                                echo"<option value='ADMIN'>ADMIN</option>";  
                                while($fila=  mysqli_fetch_array($result2)){       
                                $valor3=$fila['usuario'];  
                                $valor4=$fila['nombre'].' '.$fila['apellido'];   
                                echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                  }                                                       
                               ?>       
                     </select>
                </td>
            </tr>
            <tr>
                <td><B>ESTADO</B></td>
                <td>
                    <select id="est">
                        <option value="">Seleccione Estado</option>
                        <option value="'Preventa'">Preventa</option>
                        <option value="'En proceso'">En proceso</option> 
                        <option value="'PA'">PA</option>
                        <option value="'En contratacion'">En contratacion</option>
                        <option value="'Adjudicado','Aprobado'">Aprobado</option>
                        <option value="'Descartado'">Descartado</option>
                    </select>
                </td>
                <td><B>FECHA INICIAL</B></td>
                <td>
                    <input type="date" id="f1" value="" style="width:150px">
                    
                </td>
                <td><B>ORDENAR POR</B></td>
                <td>
                    <select id="ord">
                        <option value="costo_total">VALOR</option>
                        <option value="fecha_reg_c">FECHA</option>
                        <option value="numero_cotizacion"># COTIZACION</option>
                        <option value="ciudad">CIUDAD</option>
                    </select>
                    <select id="orden" style="width: 190px">
                        <option value="DESC">DE MAYOR A MENOR</option>
                        <option value="ASC">DE MENOR A MAYOR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>TIPO DE OBRA</b></td>
                <td>
                    <select id="bus_tip" style="width: 190px" value="">
                    <option value="">Seleccione</option>
                    <option value="EDIFICIO">Edificio</option>
                    <option value="FACHADA">Fachada</option>
                    <option value="CENTRO COMERCIAL">Centro comercial</option>
                    <option value="CASA">Casa</option>
                    <option value="APARTAMENTO">Apartamento</option>
                    <option value="VIP">VIP/VIP</option>
                    <option value="COMERCIAL">Comercial</option>
                    <option value="HOSPITAL">Hospital</option>
                    <option value="CLINICA">Clinica</option>
                    <option value="IGLESIA">Iglesia</option>
                    <option value="HOTEL">Hotel</option>
                    <option value="UNIVERSIDAD">Universidad</option>
                    <option value="COLEGIO">Colegio</option>
                    <option value="OTROS">Otros</option>
                </select>
                </td>
                <td><B>FECHA FINAL</B></td>
                <td>
                    <input type="date" id="f2" value="" style="width: 150px">
                   <input type="hidden" id="sin_lista" >
                </td>
                 <td></td>
                  <td></td>
                  
            </tr>
        </table>
            <div class="ex1" id="mostrar_tabla">
                <img src="../../imagenes/load.gif"> Espera un momento <?php echo $_SESSION['nombre'] ?>
          </div>
            <B>Cotizacion</B> <input type="checkbox" id="ver_cot">  |
            <B>ciudad</B> <input type="checkbox" id="ver_ciu">  |
            <B>direccion</B> <input type="checkbox" id="ver_dir"> |
            <B>estado</B> <input type="checkbox" id="ver_est"> |
            <B>asesor</B> <input type="checkbox" id="ver_ase"> |
            <B>fecha</B> <input type="checkbox" id="ver_fec"> |
            <B>opciones</B> <input type="checkbox" id="ver_opc"> |
            <B>tipo</B> <input type="checkbox" id="ver_tip"> |
            <B>mostrar filas de</B> 
            <select id="lista" style="width: 60px">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select> |
            <B>Tamaño de Fuente</b> <select id="fuente" style="width: 90px">
                <option value="1">Pequeña</option>
                <option value="2">Media</option>
                <option value="3">Grande</option>
            </select> |
            <select id="seg" style="width: 150px">
                <option value="0">Sin Seguimiento</option>
                <option value="1">Con Seguimiento</option>
                
                <option value="2">Eliminadas</option>
            </select>
</div>
 </body>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seguimiento de venta <span id="titulo_obra"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
           </div>
        <div class="modal-body">
        </div>
        <div class="modal-body" id="mostrar_detalles">
        </div>
        <div class="modal-footer">
          <span id="se"></span> 
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
  <div class="modal" id="myModal2">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Registrar Seguimiento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
             <table width="96%">
                <tr>
                    <td><input type="hidden" id="rel">
                    <input type="hidden" id="id_sg"></td>
                </tr>
                <tr>
                    <td><textarea id="des_seg" class="form-control" style="resize: none;height: 200px;" placeholder="Digite el seguimiento."></textarea></td>
                </tr>
                <tr><td> <button type="button" class="btn btn-success" onclick="add_seg()">Guardar Seguimiento</button></td></tr>
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
    <div class="modal" id="myModal3">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cambiar estado del Seguimiento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
             <table width="96%">
                 <tr>
                     <td><input type="text" id="obra_seg" style="width:100%"></td>
                </tr>
                <tr>
                    <td><input type="hidden" id="id_seguimiento"></td>
                </tr>
                <tr>
                    <td>
                        <select id="est_seg" class="form_control">
                        <option value="">Seleccione Estado</option>
                       <option value="Aprobado">Aprobado</option>
                        <option value="Descartado">Descartado</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Preventa">Preventa</option> 
                         <option value="En contratacion">En contratacion</option>
                        <option value="PA">PA</option>   
                       
                    </select>
                    </td>
                </tr>
                <tr><td> <button type="button" class="btn btn-success" onclick="cambiar_estado()">Cambiar estado</button></td></tr>
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</html>
