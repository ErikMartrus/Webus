<?php 
session_start();
// 1. Si el carrito está vacío lo creamos
if (!isset($_SESSION['carrito'])) {
    // Crear carrito
    $_SESSION['carrito'] = array();
    echo "Carrito creado correctamente <br>";
} 

// 2. Añadimos el id del producto al carrito
$idProducto = $_GET["id"];
if (!isset($_SESSION['carrito'][$idProducto])) {
    $_SESSION['carrito'][$idProducto] = 0;
} 

$cantidadActual = $_SESSION['carrito'][$idProducto];

echo "Cantidad antes de cambiar: $cantidadActual <br>";

$_SESSION['carrito'][$idProducto] = $cantidadActual + 1;
$cantidadTrasCambiar = $_SESSION['carrito'][$idProducto];

echo "Cantidad actual de producto $idProducto = $cantidadTrasCambiar";

header('Location: ../carrito.php');
exit;
