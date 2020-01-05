<?php
session_start();
// 1. Si el carrito está creado podemos borrar el elemento

if (isset($_SESSION['carrito'])) {

    // Restamos 1 a la cantidad actual 

    $idProducto = $_GET["id"];
    $cantidadActual = $_SESSION['carrito'][$idProducto];

    echo "Elemento a eliminar $idProducto <br>";
    echo "Cantidad actual: $cantidadActual";

    if ($cantidadActual == 0) {
        header('Location: ../carrito.php');
        exit;
    }

    // Si queda 1 elemento antes de borrar, lo quitamos del carrito
    elseif ($cantidadActual == 1) {
        unset($_SESSION['carrito'][$idProducto]);
        
        // Si no hay más elementos en el carrito, lo borramos por completo
        if (empty($_SESSION["carrito"])) {
            unset($_SESSION["carrito"]);
        }
    } else {
        // Si no, decrementamos en 1 la cantidad del carrito
        $_SESSION['carrito'][$idProducto] = $cantidadActual - 1;
    }

    header('Location: ../carrito.php');
    exit;
    
} else {
    header('Location: ../carrito.php');
    exit;
}
