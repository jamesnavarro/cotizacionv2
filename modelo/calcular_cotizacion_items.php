<?php
session_start();
require("conexion.php");
$id_items = $_GET['item'];
include '../vistas/cotizacion/calculo_producto.php';
echo $pvbi_2;