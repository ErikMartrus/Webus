<?php
    if(!isset($_SESSION["user"])){
        echo "Es necesario registrarse" . "<br>";
    }else{
        // Create connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $bdname = "laboratorio";
        
        $conn = mysqli_connect($servername, $username, $password, $bdname);
        // Check connection
        
        if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
        }
         

    if (isset($_POST['id'])) {
        if  (isset($_POST['cantidad'])) {
            //Añadir producto al carrito
            if (isset($_SESSION['carrito'][$_POST['id']]))
                $_SESSION['carrito'][$_POST['id']] += $_POST['cantidad'];
            else
                $_SESSION['carrito'][$_POST['id']] = $_POST['cantidad'];
        }
        elseif (isset ($_POST['Eliminar'])) {
            //Eliminar producto del producto
            unset ($_SESSION['carrito'][$_POST['id']]);
        }
    }
    elseif (isset($_POST['Vaciar'])) {
        unset ($_SESSION['carrito']);
    }


    if (!isset($_SESSION['carrito'])) {
        //Crear  carrito
        $_SESSION['carrito'] = array();
        echo "El carrito está vacío";
    }
    elseif (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        // Mostrar carrito
        echo "<table><tr><th>Cantidad</th></tr>";
        foreach ($_SESSION['carrito'] as $key => $valor) {
            echo "</td><td>$valor</td>";
            echo "<td><form method='post' action='carrito.php'>";
            echo "<input type='submit' name='Eliminar' value='Eliminar'>";
            echo "</form></td></tr>";
        }
        echo "</table>";

        // Botón Vaciar carrito
        echo "<hr><form method='post' action='carrito.php'>";
        echo "<input type='submit' name='Vaciar' value='Vaciar Carrito'>";
        echo "</form>";


    }
}
?>