<?php
include '../../../../modelo/conexioni.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>Lista de referencias</title>
        <meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
               <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css?v=2.5">
               <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap-responsive.min.css">
               <script src="../../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="../../../../js/sweetalert.css">
                <script src="funciones.js?<?php echo rand(1,100) ?>"></script>

    </head>
    <body>
        <div class="page-content">
            <div>
<!--                <button data-toggle="modal" data-target="#exampleModal"> Agregar Sistemas</button> -->
                <button onclick="window.close()">Cerrar</button>
            </div>
           
            <div class="col-xs-12">
           
  
                <div class="datagrid">
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                           
                                    <tr>
                                       
                                        <th>REFERENCIA</th>
                                        <th>DESCRIPCION</th>
                                        <th>COSTO</th>
                                    
                                    </tr>
                             
                                       <tr>
                                        
                                           <td>
                                               <input type="hidden" id="linea" value="<?php echo $_GET['linea'] ?>"> 
                                               <input type="text" id="ref" style="width:90%" onchange="mostrar(1)"> 
                                           </td>
                                           <td>
                                              <input type="text" id="des" style="width:90%" onchange="mostrar(1)"> 
                                           </td>
                                           <td>
                                              <input type="text" id="" style="width:90%" onchange="mostrar(1)" disabled> 
                                           </td>
                                        
                                       </tr>
                            </thead>
                        <tbody id="empleados">
                            
                        </tbody>
                    </table>
                         
                </div>
                
            </div>
            
        </div>
        <script src="../../../assets/js/jquery-2.1.4.min.js"></script>
		<script src="../../../assets/js/bootstrap.min.js"></script>

	
    </body>
</html>

