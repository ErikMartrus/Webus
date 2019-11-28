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
  <title>Ayuda</title>
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
          <li class="nav-item">
            <a class="nav-link" href="carrito.php">Carrito</a>
          </li>
        </ul>
        <?php
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
  ?>


      </div>
    </nav>
  </header>
  <!-- 80% -->
  <div class="contenedor">

    <section id="main">
      <article class="articulo1">
        <header>
          <hgroup>
            <h1>Ayuda</h1>
          </hgroup>
        </header>
        <p class="entradaPost">La realización de estos bloques conlleva al desarrollo de una web que implementa una
          plataforma de Internet de las Cosas (myWebIoT) donde cualquier visitante puede ver los
          datos recibidos de los sensores registrados. Por otro lado, cada usuario, previamente
          registrado, pueda dar de alta al menos un canal con un sensor (temperatura, humedad,
          …). Los datos recogidos por los sensores se enviarán periódicamente al servidor web, los
          cuales serán almacenados en una base de datos, y podrán ser visualizados de forma
          gráfica por cualquier visitante de la web. Cada canal tendrá su propia URL que se crea
          aleatoriamente al darlo de alta</p>
        <p class="entradaPost">La opción Canales llevará a una página que liste todos los canales, junto con los datos
          de
          cada canal, autor, descripción, fecha, y un enlace para visualizar la información.
          Las opciones Ayuda y Contacto mostrarán sendas páginas relativas a la ayuda para el
          manejo de la Web, e información de contacto, respectivamente.</p>
        <p class="entradaPost">La opción Login llevará a un formulario para acceder a la zona personal del usuario.
          Con la opción Register y Empieza YA se accede a un formulario para que un usuario se
          registre en el portal.</p>
        <p class="entradaPost">En el contenedor central se muestra una descripción de la web, y a continuación se
          presentan los datos de los dos últimos canales registrados.</p>
        <p class="entradaPost">En la barra lateral aparecerá información actualizada del número de usuarios y canales
          registrados, así como el número de bytes recibidos.</p>
        </header>
      </article>
    </section>
  </div>
  <footer id="piePagina">
    <p class="text">Footer</p>
  </footer>
</body>





<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>