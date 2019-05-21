<?php
include "../modelo/conexion.php";

if (isset($_POST["elegido2"])) {
  
    echo '' ?>  <a href="../vistas/lista_productos.php?linea=<?php echo $_POST["elegido2"]; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"> <button type="button"><img src="../imagenes/pop.png"> Busqueda Avanzada</button></a> <?php 

}	
