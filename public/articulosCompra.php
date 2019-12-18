<?php
    if (isset($_POST['idproducto'])) {
        if  (isset($_POST['cantidad'])) {
            //Añadir producto al carrito
            if (isset($_SESSION['carrito'][$_POST['idproducto']]))
                $_SESSION['carrito'][$_POST['idproducto']] += $_POST['cantidad'];
            else
                $_SESSION['carrito'][$_POST['idproducto']] = $_POST['cantidad'];
        }
        elseif(isset($_POST['Eliminar'])) {
            //Eliminar producto del carrito           
            unset ($_SESSION['carrito'][$_POST['idproducto']]);
           
        }
    }
    elseif(isset($_POST['Vaciar'])) {
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
            echo "
            <tr><td>$valor</td>
            <td>
            <form method='post' action='carrito.php'>
                <input type='submit' name='Eliminar' value='Eliminar'>
                <input type='hidden' name='idproducto' value='$id'>
            </form>
            </td></tr>
            ";
        }
        echo "</table>";

         // Botón Vaciar carrito
         echo "<form method='post' action='carrito.php'>";
         echo "<input type='submit' name='Vaciar' value='Vaciar Carrito'>";
         echo "</form>";
         //Boton de Paypal
         echo "<div class='enter'>";
         echo "<button class='btn btn--iot' type='submit'><a href='paypal.php'><img src='assets/img/PayPal-logo.png' alt='PayPal' width='50' height='35' />Checkout</button></a>";
         echo "</div>";
         



    }
?>