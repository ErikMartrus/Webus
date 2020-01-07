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
    $precioTotal=0;
    echo "El carrito tiene ".count($_SESSION['carrito'])." productos<br>";
    echo "<table>
    <tr><th>Cantidad</th>
    <th>Precio por Producto: </th></tr>";
    foreach ($_SESSION['carrito'] as $id => $valor) {
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
    $sql="SELECT * from productos WHERE id='$id'";
    if($result = mysqli_query($conn, $sql)){
        //comprobar que el email está en la BD
        if(mysqli_num_rows($result)){
            //Lista de productos
            while($row = mysqli_fetch_assoc($result)){
                $nombreProducto = $row['nombre'];
                $precio = $row['precio'];
                $stock = $row['stock'];
                $precioTotal= $precioTotal + ($valor * $precio);
                if($stock<$valor){
                    echo "No hay suficientes productos en stock";
                }else{
                    echo "
                    <td>$valor</td>
                    <td>$precio</td>
                    <td>
                    <form method='post' action='carrito.php'>
                        <input type='submit' name='Eliminar' value='Eliminar'>
                        <input type='hidden' name='idproducto' value='$id'>
                    </form>
                    </td></tr>
                    ";  
                }
            }
        } 
    }
}
    echo "</table>";
    echo "El total de la compra es: $precioTotal";

     // Botón Vaciar carrito
     echo "<form method='post' action='carrito.php'>";
     echo "<input type='submit' name='Vaciar' value='Vaciar Carrito'>";
     echo "</form>";
     //Boton de Paypal
     echo "<div class='enter'>";
     echo"<form method='POST' action='paypal/payments.php'>
     <input type='hidden' name='nombre' value='$nombreProducto'>
     <input type='hidden' name='precioTotal' value='$precioTotal'>
     <input type='hidden' name='stock' value='$stock'>";
     echo "<button class='btn btn--iot' type='submit'><a href='paypal/payments.php'><img src='assets/img/PayPal-logo.png' alt='PayPal' width='50' height='35' />Checkout</button></a>";
     echo "</div>";
     
}
?>