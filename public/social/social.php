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
  <title>MyIOTSocial</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/misEstilos.css">
</head>

<body>
  <!-- 10% -->

  <header>
    <nav class="cabecera navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="../index.php"><img class="img-Index" src="../assets/img/IOT.png" alt="" style="object-fit: cover"></a>
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
            <a class="nav-link" href="../index.php">MywebIOT <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../canales.php">Canales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../ayuda.php">Ayuda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contacto.php">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../productos.php">Productos</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="../FormularioLogin.php">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../register.php">Register</a>
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
            <a class="nav-link" href="../index.php">MywebIOT <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../canales.php">Canales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../ayuda.php">Ayuda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contacto.php">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../productos.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../carrito.php">MyIOTShop</a>
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
            <a class="nav-link" href="../index.php">MywebIOT <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../canales.php">Canales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../ayuda.php">Ayuda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contacto.php">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../carrito.php">MyIOTShop</a>
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
            <a class="nav-link" href="../FormularioLogin.php"><?php echo $nombreUsuario?><span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../php/LogOut.php">LogOut<span class="sr-only">(current)</span></a>
          </li>
          </ul>
        <?php
         }else{
        ?>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="../FormularioLogin.php">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../register.php">Register</a>
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
  <div class="contenedorPerfil">

<section id="main">
  <article class="articuloSocial">
    <header>
      <hgroup>
        <h1>Bienvenido a la tienda virtual de MywebIOT</h1>
      </hgroup>
    </header>
    <?php include('./actualizarPerfil.php'); ?>
  </article>

  <article class="articuloCompra">
       <header>
         <header>
        <h3>Últimos mensajes</h3>
        <p id="lastMessages"></p>


      </header>
        </header>
  </article>
  </section>

  <aside id="lateralSocial">
  <div class="col d-flex flex-column article1_shop">
                    <h3 class="text-center" style="margin-top: 10px;">Opciones</h3>
                    <div class="row">
                        <div class="col d-flex flex-column justify-content-center align-items-center">
                            <a href="amigos.php"> <button class="btn btn-primary opciones-perfil" type="button">Amigos</button> </a>
                            <a href="miembros.php"> <button class="btn btn-primary opciones-perfil" type="button">Miembros</button> </a>
                            <a href="mensajes.php"> <button class="btn btn-primary opciones-perfil-azul" type="button">Mensajes</button> </a>
                            <a href="perfil.php"> <button class="btn btn-primary opciones-perfil-azul" type="button">Perfil</button> </a>
                            <a href="grupo.php"> <button class="btn btn-primary opciones-perfil-azul" type="button">Grupo</button> </a>
                            </div>
                    </div>
                </div>
    </aside>

   <!-- CONSEGUIMOS POR AJAX LOS ÚLTIMOS 5 MENSAJES DE LA RED SOCIAL-->
   <script>
        function get_lastMessages() {
            $("#lastMessages").load("ultimoMensaje.php");
            setTimeout(get_lastMessages, 1000);
        };
    </script>
    <script>
        setTimeout(get_lastMessages, 1000);
    </script>

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