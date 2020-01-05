<?php

// 1. Comprobamos que el carrito está creado 
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {

    $host = "localhost";
    $database = "laboratorio";
    $user = "root";
    $databasePassword = "";

    $connection = mysqli_connect($host, $user, $databasePassword, $database);

    echo "<h1 id='canales_heading'>Carrito</h1>";

    foreach ($_SESSION['carrito'] as $key => $valor) {

        $nombreProducto = "";
        $descripcionProducto = "";
        $precioProducto = "";
        $fechaProducto = "";

        $idProducto = $key;
        $cantidadProducto = $valor;

        $sql = "SELECT * FROM productos WHERE id = '$idProducto'";
        if ($result = mysqli_query($connection, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $nombreProducto = $row["nombre"];
                $descripcionProducto = $row["descripcion"];
                $precioProducto = $row["precio"];
                $fechaProducto = $row["fecha"];
                $idProducto = $row["id"];

                $precioTotal = $cantidadProducto * $precioProducto;

                echo "<a href=\"deleteFromCart.php?id=" . $idProducto . "\" class='btn btn--iot'></a>";
                echo "<article class='articulo'>";
                echo "<p>Nombre del producto: $nombreProducto </p>";
                echo "<p>Cantidad: $cantidadProducto </p>";
                echo "<p>Precio unitario: $precioProducto €</p>";
                echo "<p>Precio total: $precioTotal €</p>";
                echo "</article>";
            }
        }
    }
    mysqli_close($connection);
} else {
    echo "<h1 id='canales_heading'>Carrito Vacío</h1>";
}
