<?php
include('../../modelo/conexion.php');
?>
<script src="../vistas/mano_obra/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_man();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
              <table class="table table-hover">
  <tr class="bg-info">
        <th>ITEM</th> 
        <th>INST?&nbsp;&nbsp;&nbsp;</th> 
        <th>REFERENCIA</th>
        <th>DESCRIPCION</th>
        <th>PRECIO</th>
         <th>COBRADO POR</th>
        <th>UTILIDAD</th>
        <th>PARAFISCALES</th>
        <th>OPC</th>
  </tr>
    <tr>
           <td><input type="text" id="" placeholder="" style="width: 20%" disabled/></td>
           <td>
             <select name="tipo" id="inst_b"  style="width: 70px" >
                  <option value="">Todos</option>
                           <option value="No">No</option>
                         <option value="Si">Si</option>
                     </select>
           </td> 
        <td><input type="text" id="cod" placeholder="Color" style="width: 100%"/></td>
        <td><input type="text" id="des" placeholder="" style="width: 100%" /></td>
        <td><input type="text" id="" placeholder="" style="width: 50%" disabled/></td>
        <td><input type="text" id="" placeholder="" style="width: 50%" disabled/></td>  
         <td><input type="text" id="" placeholder="" style="width: 50%" disabled/></td>
         <td><input type="text" id="" placeholder="" style="width: 50%" disabled/></td>
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                    <div class="col-sm-9">
                        <input type="hidden" id="id_mano" placeholder="" class="col-xs-10 col-sm-5" disabled/>
                    </div>
                   </div><br>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Referencia</label>
                    <div class="col-sm-9">
                    <input type="text" id="ref_mano" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div><br>
                   
                      <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion</label>
                    <div class="col-sm-9">
                    <input type="text" id="des_mano" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                      </div><br>
                      
                      <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Es una instalacion?</label>
                    <div class="col-sm-9">
                  
                    <select name="tipo" id="inst_mano"  class="col-xs-10 col-sm-5" >
                         <option value="No">No</option>
                         <option value="Si">Si</option>
                     </select>
                    </div>
                      </div><br>
                      <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cobrado por?</label>
                    <div class="col-sm-9">
                  
                    <select name="tipo" id="cobra_mano"  class="col-xs-10 col-sm-5" >
                                  <option value="Und">Und</option>
                                  <option value="M2">M2</option>
                                  <option value="ML">ML</option>
                                  <option value="Kg">Kg</option>
                    </select>
                    </div>
                      </div><br>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costo mano de obra</label>
                    <div class="col-sm-9">
                    <input type="text" id="costo_mano" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                     </div><br>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Utilidad de servicio</label>
                    <div class="col-sm-9">
                    <input type="text" id="uti_mano" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                     </div><br>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Parafiscales</label>
                    <div class="col-sm-9">
                    <input type="text" id="paraf_mano" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div><br>
                    
                    </div>
                     <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                           <button type="button" class="btn btn-success" onclick="guardar_man()">Guardar</button>
                           <button type="button" class="btn btn-danger" onclick="limpiar_man()">Nuevo
                                   <i data-dismiss="modal"></i>
                           </button>
                    </div>
                    </div>
                   </div>
               </div>
        </div> 
       
        
         
         
  
     

      





