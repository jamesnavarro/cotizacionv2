<?php include '../../modelo/conexion.php';
 session_start();
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../seguimientos/func_info.js"></script>
  <title>Reportes de seguimientos</title>
  <style>
        div.esp{
            padding: 0cm 1cm;
        }
  </style>
</head>
<body>
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">REPORTE DE SEGUIMIENTOS</h4>
        </div>
        <div class="modal-body">
            <p>Descripcion del seguimiento</p>
            <input type="hidden"  id="rad" class="form-control" disabled value="">
            <input type="hidden"  id="id_s" class="form-control" disabled value="">
            <input type="text"  id="id_prin" class="form-control" disabled value="">
             <input type="hidden" value="<?php echo $_SESSION["k_username"]; ?>" id="regis_se_nu" class="form-control" disabled >
             <input type="hidden"  id="fecha_seg_nu" class="form-control" value="<?php echo date("Y-m-d"); ?>" disabled >
            <textarea id="seguim_cot" placeholder="hacer seguimiento a la cotizacion"  style="width:100%; height: 100px; background-color:#d6e9c6"></textarea>
        </div>
        <div class="modal-footer">
            <button id="btn_guardard" type="button" class="btn btn-primary" onclick="guardar_seguimientos()">Guardar Comentario</button>
            <button id="btn_guardard" type="button" class="btn btn-danger" onclick="limpiar()">Nuevo Comentario</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 <div class="page-content">
 <div> 
 <div class="table-responsive">  
   <br>
   <div>
   <div style="float:left">
   <table style="width: 20%">
             <tr>
             <th>Desde</th>
             <td nowrap><input type="date" id="fecha" class="form-control"></td>
             <th>Hasta</th>
             <td>
             <input type="date" id="fecfin" class="form-control"></td> 
             </tr>
   </table><br></div>
   
   <div  style="float:right; padding-right: 10px">
       <table>
           <button type="button" style="background-color: #D6EAF8"  onclick="embudo()">EMBUDO</button> 
           &nbsp; <button type="button" style="background-color: #D6EAF8"  onclick="ver_repor()">SEGUIMIENTOS</button>
       </table> 
   </div><br>
   </div>
   <table>
       <TR>
     
       </TR>
   </table><BR>
   <table style="width: 100%; padding-left: 10px">
         <tr>
             <td><input type="text" id="coti" class="form-control" placeholder="### cotizacion"></td>
             <td> <select  id="valor" class="form-control">
                  <option value="">Valores</option>
                  <option value="mayor">Mayor 60mm</option>
                  <option value="menor">Menor 60mm</option>
                  </select>
             </td>
             <td><input type="text" id="nombre" class="form-control" placeholder="nombre del cliente"></td>
             <td>
               <select class="form-control" id="asesor" name="numero" required>
	        <?php
		if (isset($_GET['cot'])){
		echo "<option value='" . $reg . "'>" . $reg . "</option>";
		} else {
			echo "<option value=''>Asesores</option>";
		}
                $consulta2= "SELECT * FROM `usuarios` where area='Ventas' and estado='Activo' order by nombre";   
                $result2=  mysql_query($consulta2); 
                echo "<option value='ADMIN'>ADMIN</option>";  
                while($fila=  mysql_fetch_array($result2)){       
                $valor3=$fila['usuario'];  
                $valor4=$fila['nombre'].' '.$fila['apellido'];   
                echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                }                                                       
                ?>       
                </select>
                </td>
                <td>
                <select id="estado_cs" name="estado" class="form-control" required>
                <option value="">Estado</option>
                <option value="'Adjudicado','Aprobado'">Adjudicado</option>
                <option value="'Descartado'">Descartado</option>
                <option value="'En proceso'">En proceso</option>
                <option value="'PA'">PA</option>
                </select>
                </td>
                <td> 
                <select  id="linea_segui" class="form-control">
                <option value="">Todas</option>
                <option value="Vidrio">Vidrio(Sala de ventas)</option>
                <option value="Aluminio">Obras(alum)</option>
                <option value="Adicional">Adicional</option>
                </select>
                </td>         
                </tr>
     </table> <br>      
     </div> 
   
     <div style="width: 99% ; padding-left: 10px " id="mostrar_tabla">
     <br>
     </div> 
     <h4><B>FILTRAR POR COLUMNAS DE:</B>
     <select id="filtro">
         <option value="7">7</option>
         <option value="10">10</option>
         <option value="25">25</option>
         <option value="50">50</option>
         <option value="100">100</option>
     </select></h4>
     <br>
    </div> 
  </div> 
</body>
<br>
</html>
  
 
                
        

                              
                                