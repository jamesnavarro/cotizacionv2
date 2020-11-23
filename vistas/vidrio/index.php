<?php
include('../../modelo/conexion.php');
?>
<script src="../vistas/vidrio/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 60px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Lista</B></h6>
           </a>
   </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_vid();" href="#lin2"><h6><B>Crear Vidrio</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             <table class="table table-hover">
                 <tr class="bg-info">
                     <th><b>ITEM</b></th>
                     <th><b>CODIGO</b></th>
                     <th><b>COLOR DE VIDRIO</b></th>
                     <TH><b>REFERENCIA</b></TH>
                     <TH><b>ESPESOR</b></TH>
                     <TH><b>MONEDA</b></TH>
                     <TH>VALOR COP</TH>
                     <TH>VALOR USD</TH>
                     <th><b>ACTIVO</b></th>
                     <th><b>OPCIONES</b></th> 
  </tr>
    <tr>
         <td>
             <input type="text" id="" disabled style="width: 100%"/>
        </td>
         <td>
              <input type="text" id="cod" style="width: 100%"/>
        </td>
          <td>
            <input type="text" id="des" style="width: 100%"/>
        </td>
        <td>
              <input type="text" id=""disabled style="width: 100%"/>
        </td>
        <td>
            <input type="text" id=""disabled style="width: 100%"/>
        </td>
         <td>
            <input type="text" id=""disabled style="width: 100%"/>
        </td>
           <td>
            <input type="text" id=""disabled style="width: 100%"/>
        </td>
           <td>
            <input type="text" id=""disabled style="width: 100%"/>
        </td>
             <td>
            <input type="text" id=""disabled style="width: 100%"/>
        </td>
       
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id cargo</label>
                            <div class="col-sm-9">
                            <input type="text" id="id_vid" class="col-xs-10 col-sm-5" disabled />
                         </div>
                        </div>  <br>
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                          <div class="col-sm-9">
                         <input type="text" id="cod_vid" placeholder="" class="col-xs-10 col-sm-5" />
                         </div>
                        </div> <br>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Color de vidrio</label>
                          <div class="col-sm-9">
                         <input type="text" id="color_vid" placeholder="" class="col-xs-10 col-sm-5" />
                         </div>
                       </div> <br>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Referencia</label>
                          <div class="col-sm-9">
                         <input type="text" id="ref_vid" placeholder="" class="col-xs-10 col-sm-5" />
                         </div>
                       </div> <br>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Espesor de vidrio</label>
                          <div class="col-sm-9">
                         <input type="text" id="esp_vid" placeholder="" class="col-xs-10 col-sm-5" />
                         </div>
                       </div> <br>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costo</label>
                          <div class="col-sm-9">
                         <input type="text" id="cos_vid" placeholder="" class="col-xs-10 col-sm-5" />
                         </div>
                       </div> <br>
                        
                       <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Moneda</label>
                        <div class="col-sm-9">
                            <select id="mon_vid" class="col-xs-10 col-sm-5" onchange="calculardolar()">
                            <option value=""></option>
                            <option value="COP">COP</option>
                            <option value="USD">USD</option>
                         </select>
                       </div>
                       </div> <br>
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costo USD</label>
                          <div class="col-sm-9">
                              <input type="text" id="cos_usd" placeholder="" class="col-xs-10 col-sm-5" onchange="calusd()"/>
                         </div>
                        </div> <br>
                  
                         <div class="form-actions">
                  <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                  <button type="button" class="btn btn-success" onclick="guardar_vid()">Guardar</button>
                  <button type="button" class="btn btn-danger" onclick="limpiar_vid()">Nuevo
                  <i data-dismiss="modal"></i></button>
                 </div>
                   </div> 
                 
                 
          </div>
        </div>       
                     
                   </div>
                
        
       
         
         
         
  
     

      





