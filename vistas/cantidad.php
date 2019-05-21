<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Digite la cantidad de laminas</title>
        <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../js/ajax.js" type="text/javascript"></script>
        <script>
         function pasar(){
             var c = $("#cantidad").val();
             window.opener.PasarCantidad(c);
             window.close();
         }
  </script>
    </head>
    <body>
        <table width="100%">
            <thead>
            <tbody>
                <tr>
                    <td>Digite la cantidad de laminas</td>
                </tr>
                <tr>
                    <td><input type="number" id="cantidad" ></td>
                </tr>
                <tr>
                    <td><button onclick="pasar();"> Agregar </button></td>
                </tr>
            </tbody>
        </table>

    </body>
</html>
