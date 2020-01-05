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

                echo "<a href=\"./scripts/deleteFromCart.php?id=" . $idProducto . "\" class='btn btn-danger float-right deleteButton'></a>";
                echo "<article class='canales_article'>";
                echo "<p id='paragraph_canales'>Nombre del producto: $nombreProducto </p>";
                echo "<p id='paragraph_canales'>Cantidad: $cantidadProducto </p>";
                echo "<p id='paragraph_canales'>Precio unitario: $precioProducto €</p>";
                echo "<p id='paragraph_canales'>Precio total: $precioTotal €</p>";
                echo "</article>";
            }
        }
    }
    mysqli_close($connection);
} else {
    echo "<h1 id='canales_heading'>Carrito Vacío</h1>";
}
