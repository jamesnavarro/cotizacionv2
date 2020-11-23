<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviar Solicitud</title>
                <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <style>
            form {
    overflow: hidden;
}
 
label {
    float: left;
    width: 200px;
    padding-right: 12px;
}
 
input, textarea, select {
    float: left;
    width: calc(100% - 200px);
}
 
/*button {
    float: right;
    width: calc(100% - 200px);
}*/
            </style>
            <script>
                function buscar(){
                   
                    var usuario = $("#usuario").val();
                    if(usuario!=''){
                     $.ajax({
                            post:'GET',
                            data:'usuario='+usuario+'&sw=11',
                            url:'../desglose/acciones.php',
                            success:function(d){
                               $("#email").val(d);

                            } 
                        });
                    }else{
                        $("#email").val('');
                    }
                }
            </script>
    </head>
    <body>
        <form>
            <label for="firstName" class="first-name">DE:</label>
            <input id="de" type="text" value="<?php echo $_SESSION["email"] ?>">

            <label for="lastName" class="last-name">USUARIO</label>
            <input id="usuario" type="text" placeholder="Nombre Apellido" onkeyup="buscar()">
            <label for="lastName" class="last-name">PARA</label>
            <input id="email" type="text" placeholder="Email">
            
            <label for="lastName" class="last-name">NOTAS</label>
            <textarea id="obs"></textarea>
            <label for="lastName" class="last-name">?</label>
            <button onclick="sendnoti()">Enviar Notificacion</button> 
            <button onclick="window.close()">Cancelar</button>
                

            <!-- more inputs -->
        </form>
    </body>
</html>
