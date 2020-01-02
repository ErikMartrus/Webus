<?php
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
//Recibimos los datos del formulario productos.php y los almacenamos en variables.
 //petición sql para buscar los prodcutoos
 $sql = "SELECT * from productos";

 if($result = mysqli_query($conn, $sql)){
     //comprobar que el email está en la BD
     if(mysqli_num_rows($result)){
         //Lista de productos
         while($row = mysqli_fetch_assoc($result)){
             $idProducto = $row['id'];
             $nombreProducto = $row['nombre'];
             $descripcion = $row['descripcion'];
             $precio = $row['precio'];
             $fecha = $row['fecha'];
             $image = $row['image'];
             $stock = $row['stock'];
         
      
?>
 <section class="channels-section">
                        <article>
                                <figure>
                                    <img class="img-borrarProducto" src="../assets/img/delete-icon.png" onClick="borrar(
                                    <?php echo "$idProducto";?>)">
                                </figure>
                            <?php
                            echo"<div class='card'>
                            <img class='producto' src= $image alt='Producto'>
                            <div class='container'>
                                <p>Información del producto: " . $nombreProducto. "</p>
                                <p>Descripción del producto: ". $descripcion. "</p>
                                <p>Fecha de creación: ".$fecha."</p>
                                <p>Precio del producto: " . $precio. " €</p>
                            </div>
                          </div>
                        </article>
                        <form method='post' action='carrito.php'>
                        <input type='hidden' name='idproducto' value='$idProducto'>
                        <input type='hidden' name='precio' value='$precio'>
                        <input type='hidden' name='stock' value='1'>
                        <input type='hidden' name='nombre' value='$nombreProducto'>
                                <div class='enter'>
                                    <button class='btn btn--iot' type='submit'>Add to Cart</button>
                                </div>
                        </form>
                        </section>";
}
            
}else{
    echo "No hay productos disponibles";
}
}else{
echo mysqli_error($connection);
}






?>
