<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="This is an HTML5/CSS3 example">
  <meta name="keywords" content="HTML5, CSS3, JavaScript">
  <title>Register</title>
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
            <a class="nav-link" href="carrito.php">MyIOTShop</a>
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
  <!-- 80% -->


  <form  action="php/register.php" method="POST">
    <div class="contenedor--form">
      <div class="items--form">
        <label for="name">Nombre: <span class="required">*</span></label>
        <input type="text" id="name" name="name" value="" placeholder="Nombre Usuario" required autofocus />
      </div>
      <div class="items--form">
        <label for="start">Fecha de Nacimiento:</label>
        <input type="date" id="fechaDeNacimiento" name="fechaDeNacimiento" value="2019-07-10" min="1990-01-01" max="2019-12-31">
      </div>

      <div class="items--form">
        <label for="exampleInputEmail1">Correo electrónico</label>
        <input type="email" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

      <div class="items--form">
        <label for="telefono">Contraseña: <span class="required">*</span></label>
        <input id="pass" name="pass" type="password" required />
      </div>

      <div class="items--form">
        <label for="telefono">Repetir contraseña: <span class="required">*</span></label>
        <input id="pass2″ name="pass2″ type="password" required />
      </div>
    </div>
    <div class="contenedor--btn">

      <div class="items-grid">
        <div class="enter">
          <a href="index.php"><button class="btn btn--iot">Cancelar</button></a>
        </div>
  
        <div class="enter">
          <a href="misCanales.php"><button type="submit" class="btn btn--iot">Register</button></a>
        </div>
      </div>
    </div>

  </form>

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