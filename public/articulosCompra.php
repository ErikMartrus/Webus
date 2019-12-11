<!DOCTYPE html>
<html lang="en">
<?php
//Arrancamos la sesion del usuario
session_start();
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
//petición sql para buscar los productos
$sql = "SELECT * from productos";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result)){
       
       
        
    

?>
<head>
  <meta charset="utf-8">
  <meta name="description" content="This is an HTML5/CSS3 example">
  <meta name="keywords" content="HTML5, CSS3, JavaScript">
  <title>MyIOTShop</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/misEstilos.css">
  <script> 
    function borrar(dato){
        alert(dato);
        $.post("php/borrarProducto.php", {id: dato}, function(data){
          alert(data);
        }); 
        
    }
    
  </script>
</head>

<body>
  <!-- 10% -->

  <header>
    <nav class="cabecera navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php"><img class="img-Index" src="assets/img/IOT.png" alt="" style="object-fit: cover"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php
      if(!isset($_SESSION["user"])){
      ?>
      <div class="collapse navbar-collapse" id="navbarSupportedContent"
        style="display: flex; justify-content:space-between">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">MywebIOT <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="canales.php">Canales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ayuda.php">Ayuda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contacto.php">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos.php">Productos</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="FormularioLogin.php">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>

        </ul>
        </div>
    </nav>
  </header>
      <?php
      }else{
        if($_SESSION["user"]["nombre"]=='Erik Martrus'){
      ?> 
      <div class="collapse navbar-collapse" id="navbarSupportedContent"
        style="display: flex; justify-content:space-between">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">MywebIOT <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="canales.php">Canales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ayuda.php">Ayuda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contacto.php">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="carrito.php">MyIOTShop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="social.php">MyIOT Social</a>
          </li>
        </ul>
        <?php
        
        }else{
        
        ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent"
        style="display: flex; justify-content:space-between">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">MywebIOT <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="canales.php">Canales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ayuda.php">Ayuda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contacto.php">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="carrito.php">MyIOTShop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="social.php">MyIOT Social</a>
          </li>
        </ul>
        <?php
        }
        if(isset($_SESSION["user"])){    
          $nombreUsuario = $_SESSION["user"]["nombre"]; 
        ?>
          <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="FormularioLogin.php"><?php echo $nombreUsuario?><span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="php/LogOut.php">LogOut<span class="sr-only">(current)</span></a>
          </li>
          </ul>
        <?php
         }else{
        ?>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="FormularioLogin.php">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>

        </ul>
        <?php
         }
        }
        ?>
      </div>
    </nav>
  </header>
  <!-- 80% -->
  <div class="contenedor">

<section id="main">
  <article class="articulo">
    <header>
      <hgroup>
        <h1>Lista de la compra</h1>
      </hgroup>
    </header>
    <p class="entradaPost">Aquí puede observar los artículos que va a comprar </p>
  </article>

  <article class="articuloCompra">
        <header>
          <div>
        <header>
          <hgroup>
            <h1>Listado de todos los productos</h1>
          </hgroup> 
        </header>
        <header>
        <form name="lista" method="post" action="articulosCompra.php">
            <label>Productos</label>
                <select>
                <option value="0">Please Select</option>
                <?php
                while($row = mysqli_fetch_assoc($result)){
                        $idProducto = $row['id'];
                        $nombreProducto = $row['nombre'];
                        $descripcion = $row['descripcion'];
                        $precio = $row['precio'];
                        $fecha = $row['fecha'];
                ?>
                <option value = "<?php echo($row['nombre'])?>" >
                <?php echo($row['nombre']) ?>
            </option>
            <?php
                }  
            }
        }  
                ?>
                </select>
            <br>
            <label>Cantidad</label>
                <input type="number" name="cantidad" value="1">
            <br>
                 <input type="submit" value="Añadir al Carrito">

        </form>
      </header>
        </header>
  </article>
  </section>
  <?php
    if (isset($_POST['producto'])) {
        if  (isset($_POST['cantidad'])) {
            //Añadir producto al carrito
            if (isset($_SESSION['carrito'][$_POST['producto']]))
                $_SESSION['carrito'][$_POST['producto']] += $_POST['cantidad'];
            else
                $_SESSION['carrito'][$_POST['producto']] = $_POST['cantidad'];
        }
        elseif (isset ($_POST['Eliminar'])) {
            //Eliminar producto del producto
            unset ($_SESSION['carrito'][$_POST['producto']]);
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
        echo "El carrito tiene ".count($_SESSION['carrito'])." productos<br>";
        echo "<table><tr><th>Producto</th><th>Cantidad</th><th></th></tr>";
        foreach ($_SESSION['carrito'] as $key => $valor) {
            echo "<tr><td>$productos[$key]";
            echo "</td><td>$valor</td>";
            echo "<td><form method='post' action='carrito.php'>";
            echo "<input type='hidden' name='producto' value='$key'>";
            echo "<input type='submit' name='Eliminar' value='Eliminar'>";
            echo "</form></td></tr>";
        }
        echo "</table>";

        // Botón Vaciar carrito
        echo "<hr><form method='post' action='carrito.php'>";
        echo "<input type='submit' name='Vaciar' value='Vaciar Carrito'>";
        echo "</form>";

        // Botón Chekout carrito
        echo "<hr><form method='post' action='checkout.php'>";
        echo "<input type='submit' name='Checkout' value='Checkout'>";
        echo "</form>";

    }
?>

</body>
</html>

    <aside id="lateralCompra">
      <div>
      <img class="carro" src="assets/img/carrito.png" alt="Carrito de compra" width="60" height="50">
      <div class="enter">
            <button class="btn btn--iot" type="submit"><a href="paypal.php"><img src="assets/img/PayPal-logo.png" alt="PayPal" width="50" height="35" />Checkout</button></a>
      </div>
      </div>
    </aside>
</div>
  <!-- 10% -->
  <footer id="piePaginaCarrito">
    <p class="text">Footer</p>
  </footer>


</body>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>