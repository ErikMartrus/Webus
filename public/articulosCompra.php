<?php
    if (isset($_POST['idproducto'])) {
        if  (isset($_POST['cantidad'])) {
            //Añadir producto al carrito
            if (isset($_SESSION['carrito'][$_POST['idproducto']]))
                $_SESSION['carrito'][$_POST['idproducto']] += $_POST['cantidad'];
            else
                $_SESSION['carrito'][$_POST['idproducto']] = $_POST['cantidad'];
        }
        elseif (isset ($_POST['Eliminar'])) {
            //Eliminar producto del carrito
            unset ($_SESSION['carrito']['idProducto']);
        }
    }
    elseif (isset($_POST['Vaciar'])) {
        unset ($_SESSION['carrito']);
    }

    if (!isset($_SESSION['carrito'])) {
        //Crear  carrito
        $_SESSION['carrito']=array();
        echo "El carrito está vacío";
    }
    elseif (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        // Mostramos carrito
        echo "El carrito tiene ".count($_SESSION['carrito'])." productos<br>";
        echo "<table><tr><th>Cantidad</th></tr>";
        foreach ($_SESSION['carrito'] as $id => $valor) {
            echo "<tr><td>$valor</td>";
            echo "<td><form method='post' action='carrito.php'>";
            echo "<input type='submit' name='Eliminar' value='Eliminar'>";
            echo "</form></td></tr>";
        }
        echo "</table>";

         // Botón Vaciar carrito
         echo "<form method='post' action='carrito.php'>";
         echo "<input type='submit' name='Vaciar' value='Vaciar Carrito'>";
         echo "</form>";



    }
?>