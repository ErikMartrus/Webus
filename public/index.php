<!DOCTYPE html>
<html lang="en">
  <?php
  session_start();
  $user = $_SESSION["user"];
?>
<head>
  <meta charset="utf-8">
  <meta name="description" content="This is an HTML5/CSS3 example">
  <meta name="keywords" content="HTML5, CSS3, JavaScript">
  <title>Plataforma Web para IoT</title>
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
            <a class="nav-link" href="contacto.html">Contactos</a>
          </li>
        </ul>
    <?php
    if(isset($_SESSION["user"])){
     ?>
          <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="login.html"><?php echo $user?><span class="sr-only">(current)</span></a>
          </li>

        </ul>
        <?php
          }else{
        ?>

        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="login.html">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.html">Register</a>
          </li>

        </ul>

      </div>
      <?php
    }
    ?>
    </nav>
  </header>
  <!-- 80% -->
  <div class="contenedor">

    <section id="main">
      <article class="articulo">
        <header>
          <hgroup>
            <h1>MywebIOT</h1>
          </hgroup>
        </header>
        <p class="entradaPost">Lorem ipsum dolor sit amet consectetur adipiscing elit, mus sem sociosqu dapibus nisl cum
          quis gravida, tempor bibendum justo lacus habitasse lacinia. Accumsan integer laoreet sollicitudin facilisis
          faucibus diam cras feugiat tristique, aptent primis felis sem praesent magnis sociis leo donec, suscipit
          dictumst sapien massa metus ac porta volutpat. Viverra massa urna vivamus quis nam justo quam cum molestie,
          nostra conubia accumsan scelerisque consequat rutrum velit. Hac montes rhoncus vestibulum aptent taciti
          malesuada ultrices dis, phasellus tortor erat molestie dictum netus vulputate habitasse, libero facilisi nulla
          porttitor facilisis nostra vehicula. </p>
        <div class="enter">
            <a href="register.html"><button class="btn btn--iot">Empieza ya</button></a>
        </div>
      </article>
      <article class="articulo">
        <header>
          <div class="grafica1">
            <ul>
              <li class="listaDatosSensor"><a href=""></a>Info del Canal A</a></li>
              <li class="listaDatosSensor"><a href=""></a>Autor</a></li>
              <li class="listaDatosSensor"><a href=""></a>URL</a></li>
            </ul>
          </div>
          <div class="grafica2">
            <ul>
              <li class="listaDatosSensor"><a href=""></a>Info del Canal B</a></li>
              <li class="listaDatosSensor"><a href=""></a>Autor</a></li>
              <li class="listaDatosSensor"><a href=""></a>URL</a></li>
            </ul>
          </div>
        </header>
      </article>
    </section>

    <aside id="lateral">
      <p class="infoLateralPost1">Información actualizada de los datos almacenados en la BBDD (al menos los siguientes):
      </p>
      <p class="infoLateralPost">Número de usuarios</p>
      <p class="infoLateralPost">Canales</p>
      <p class="infoLateralPost">Bytes/MB almacenados</p>
    </aside>
  </div>
  <!-- Esto es una paginacion desde Boostrap 4 -->
  <!--   <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav> -->
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