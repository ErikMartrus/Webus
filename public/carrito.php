<!DOCTYPE html>
<html lang="en">
<?php
//Arrancamos la sesion del usuario
session_start();
$productos=['Basico','Pro','Premium'];
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
?>
<head>
  <meta charset="utf-8">
  <meta name="description" content="This is an HTML5/CSS3 example">
  <meta name="keywords" content="HTML5, CSS3, JavaScript">
  <title>Carrito</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/misEstilos.css">
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
        <?php
        if(isset($_SESSION["user"])){
          $nombreUsuario = $_SESSION["user"]["nombre"];

        ?> 
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#"><?php echo $nombreUsuario?><span class="sr-only">(current)</span></a>
          <li class="nav-item">
            <a class="nav-link" href="php/logOut.php">LogOut</a>
          </li>
        </ul>
        <?php
          }else{
            header('Location: FormularioLogin.php');
        
        ?>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="FormularioLogin.php">Login<span class="sr-only">(current)</span></a>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        </ul>
      <?php
          }
      ?>
      </div>
    </nav>
  </header>
  <!-- 80% -->
  <form  name="lista" action="carrito.php" method="POST">
    <div class="contenedor--form">
      <div class="items--form">
        <label>Productos</label>
        <select name="producto">
        <?php
        foreach ($productos as $key=> $val){
            echo "<option value='$key'>$val</option>";
        }
        ?>
        </select>
      </div>
        <div class="items--form">
        <label>Cantidad</label>
        <input type="number" name="cantidad" value="1">
        </div>
        <div class="items--form">
        <input class="btn--add" type="submit" value="Añadir al Carrito">
        </div>
    </div>
    </form>
<?php
    if(isset($_POST['producto'])){
        if(isset($_POST['cantidad'])){
            //Añadir producto al carrito
            if(isset($_SESSION['carrito'][$_POST['producto']]))
                $_SESSION['carrito'][$_POST['producto']] += $_POST['cantidad'];
            else
                $_SESSION['carrito'][$_POST['producto']] = $_POST['cantidad']; 
            }elseif (isset($_POST['Eliminar'])) {
                //Eliminar producto
                unset($_SESSION['carrito'][$_POST['producto']]);

            }  
        }
        elseif (isset($_POST['Vaciar'])) {
            unset($_SESSION['carrito']);
        }
        if(!isset($_SESSION['carrito'])){
            //Crear carrito
            $_SESSION['carrito'] = array();
            echo "El carrito esta vacío";
        }
        elseif (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>0) {
            //Mostrar carrito
            echo "El carrito tiene ".count($_SESSION['carrito'])." productos<br>";
            echo "<table><tr><th>Producto</th><th>Cantidad</th><th></th></tr>";
            foreach ($_SESSION['carrito'] as $key => $value) {
                echo "<tr><td>$productos[$key]";
                echo "</td><td>$value</td>";
                echo "<td><form method='POST' action='carrito.php'>";
                echo "<input type='hidden' name='producto' value='$key'>";
                echo "<input type='submit' name='Eliminar' value='Eliminar'>";
                echo "</form></td></tr>";
                
            }
            echo "</table>";

        //Boton Vaciar Carrito
        echo "<hr><form method='POST' action='carrito.php'>";
        echo "<input type='submit' name='Vaciar' value='Vaciar Carrito'>";
        echo "</form>";

        //Boton Checkout
        echo "<hr><form method='POST' action='chechout.php'>";
        echo "<input type='submit' name='Checkout' value='Checkout Carrito'>";
        echo "</form>";


        
        
    }
?>


  <!-- 10% -->
  <footer id="piePaginaLogin">
    <p class="text">Footer</p>
  </footer>


</body>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>