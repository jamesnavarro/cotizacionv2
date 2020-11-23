<?php
include('../../modelo/conexion.php');
?>
<script src="../vistas/aluminio/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	<a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
    </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_temp();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>Items</th> 
        <th>Espesor</th>
        <th>Costo temple</th>
        <th>Editar</th>
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" style="width: 100%" disabled/></td> 
        <td><input type="text" id="cod" placeholder="Color" style="width: 100%"/></td>
        <td><input type="text" id="des" placeholder="" style="width: 100%" disabled/></td>
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
                    <input type="text" id="id_alu" placeholder="" class="col-xs-10 col-sm-5" disabled/>
                    </div>
                   </div><br>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Color de aluminio</label>
                    <div class="col-sm-9">
                    <input type="text" id="col_alu" placeholder="descripcion de la linea" class="col-xs-10 col-sm-5" />
                    </div>
                    </div><br>
                   
                      <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costo</label>
                    <div class="col-sm-9">
                    <input type="text" id="tip_alum" placeholder="descripcion de la linea" class="col-xs-10 col-sm-5" />
                    </div>
                      </div><br>
                      <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Acabado</label>
                    <div class="col-sm-9">
                  
                    <select name="tipo" id="var_alu"  class="col-xs-10 col-sm-5" >
                                                       <option value="0">Crudo</option>
                                                       <option value="1">Anonizado</option>
                                                       <option value="10">Pintado</option>
                                                   </select>
                    </div>
                      </div><br>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-9">
                    <input type="text" id="codigo_alu" placeholder="descripcion de la linea" class="col-xs-10 col-sm-5" />
                    </div>
                     </div><br>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Rendimiento</label>
                    <div class="col-sm-9">
                    <input type="text" id="ren_alu" placeholder="descripcion de la linea" class="col-xs-10 col-sm-5" />
                    </div>
                     </div><br>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Medida</label>
                    <div class="col-sm-9">
                    <input type="text" id="med_alu" placeholder="descripcion de la linea" class="col-xs-10 col-sm-5" />
                    </div>
                    </div><br>
                    
                    </div>
                     <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_alu()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_alu()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
       
        
         
         
  
     

      





