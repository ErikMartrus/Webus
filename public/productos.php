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
?>
<head>
  <meta charset="utf-8">
  <meta name="description" content="This is an HTML5/CSS3 example">
  <meta name="keywords" content="HTML5, CSS3, JavaScript">
  <title>Mis Productos Web IoT</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/misEstilos.css">
</head>

<body>
  <!-- 10% -->

  <header>
    <nav class="cabecera navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php"><img src="https://picsum.photos/120/38" alt="" style="object-fit: cover"></a>
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
            <a class="nav-link" href="../php/logOut.php">LogOut</a>
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
  <form  action="php/register.php" method="POST">
    <div class="contenedor--form">
      <div class="items--form">
        <label for="name">Nombre: <span class="required">*</span></label>
        <input type="text" id="name" name="name" value="" placeholder="Nombre Usuario" required autofocus />
      </div>
      <div class="items--form">
        <label for="name">Descripción: <span class="required">*</span></label>
        <input type="text" id="description" name="description" value="" placeholder="Breve descripcion" required autofocus />
      </div>
      <div class="items--form">
      <label for="name">Precio del producto: <span class="required"></span></label>
      <input type="number" name="precio"> </p>
      </div>
      <div class="enter">
          <a href="misCanales.php"><button type="submit" class="btn btn--iot">Añadir producto</button></a>
        </div>
    </div>

  <section class="grid">
    <article class=" column articuloCanales ">
      <header>
        <hgroup>
          <h3>Listado de todos los productos</h3>
        </hgroup>
      </header>
    </article>
    <article class="column articuloDatosCanales">
      <header>
      <?php
        include './php/listaCanales.php';
    ?>
      </header>
    </article>
  </section>

  <!-- 10% -->
  <footer id="piePagina">
    <p class="text">Footer</p>
  </footer>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>