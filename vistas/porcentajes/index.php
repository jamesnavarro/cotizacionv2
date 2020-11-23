<?php
include('../../modelo/conexion.php');
?>
<script src="../vistas/porcentajes/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	<a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
    </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_porc();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>Items</th> 
        <th>Linea</th>
        <th>Porcentaje 1</th>
        <th>Porcentaje 2</th>
        <th>Porcentaje 3</th>
        <th>Grupo</th>
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" style="width: 100%" disabled/></td> 
        <td><input type="text" id="cod" placeholder="" style="width: 100%"/></td>
        <td><input type="text" id="des" placeholder="" style="width: 100%" disabled/></td>
        <td><input type="text" id="" placeholder="" style="width: 100%" disabled/></td>
        <td><input type="text" id="" placeholder="" style="width: 100%" disabled/></td>
       
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
  
         
          <div id="lin2" class="tab-pane fade in">
                <div class="modal-header">
                  <h4 class="modal-title">FORMULARIO</h4>
                  </div>
               
                   <div class="form-horizontal" role="form">
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Id</label>
                    <div class="col-sm-9">
                    <input type="text" id="id_porc" placeholder="" class="col-xs-10 col-sm-5" disabled/>
                    </div>
                   </div><br>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Linea</label>
                    <div class="col-sm-9">
                    <input type="text" id="lin_porc" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Porcentaje 1</label>
                    <div class="col-sm-9">
                    <input type="text" id="uno_porc" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Porcentaje 2</label>
                    <div class="col-sm-9">
                    <input type="text" id="dos_porc" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                      </div><br>

                   
                 <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Porcentaje 3</label>
                 <div class="col-sm-9">
                    <input type="text" id="tres_porc" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                      </div><br>
                      
                      <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Grupo</label>
                    <select name="tipo" id="grup_por"  class="col-xs-10 col-sm-5" >
                                                       <option value="General">General</option>
                                                       <option value="Perfileria">Perfileria</option>
                                                       <option value="Vidrios">Vidrios</option>
                                                       <option value="Acesorios">Acesorios</option>
                                                       <option value="Otros">Otros</option>
                     </select>
                      </div><br>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Division</label>
                    <select name="tipo" id="div_porc"  class="col-xs-10 col-sm-5" >
                                                       <option value="Venta">Venta</option>
                                                       <option value="Desperdicio">Desperdicio</option>
                                                       <option value="Imprevistos">Imprevistos</option>
                                                       <option value="Bogota">Bogota</option>
                     </select>
                      </div><br>
                    
                    
                    </div>
                     <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                     <button type="button" class="btn btn-success" onclick="guardar_porc()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_porc()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
       
        
         
         
  
     

      





