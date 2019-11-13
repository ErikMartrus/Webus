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
  <title>Mis Canales webIoT</title>
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
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#"><?php echo $user?><span class="sr-only">(current)</span></a>

        </ul>

      </div>
    </nav>
  </header>
  <!-- 80% -->
  <div class="enter">
    <a href="addCanal.php"><button type="submit" class="btn btn--iot">Añadir Canal</button></a>
</div>

  <section class="grid">
    <article class=" column articuloCanales ">
      <header>
        <hgroup>
          <h3>Listado de todos los canales dados de alta del usuario</h3>
        </hgroup>
      </header>
    </article>
    <article class="column articuloDatosCanales">
      <header>
        <ul>
          <li class="listaDatosSensor"><a href=""></a>Info del Canal A</a></li>
          <li class="listaDatosSensor"><a href=""></a>Autor</a></li>
          <li class="listaDatosSensor"><a href=""></a>Descripción</a></li>
          <li class="listaDatosSensor"><a href=""></a>Fecha</a></li>
          <li class="listaDatosSensor"><a href=""></a>Enlace URL(habilitar enlace para acceder a la representación
            gráfica de los datos almacenados) </a></li>
        </ul>
      </header>
    </article>
    <article class="column articuloDatosCanales">
      <header>
        <ul>
          <li class="listaDatosSensor"><a href=""></a>Info del Canal A</a></li>
          <li class="listaDatosSensor"><a href=""></a>Autor</a></li>
          <li class="listaDatosSensor"><a href=""></a>Descripción</a></li>
          <li class="listaDatosSensor"><a href=""></a>Fecha</a></li>
          <li class="listaDatosSensor"><a href=""></a>Enlace URL(habilitar enlace para acceder a la representación
            gráfica de los datos almacenados) </a></li>
        </ul>
      </header>
  </section>

  <!-- Esto es una paginacion desde Boostrap 4 -->
  <!--   <nav aria-label="Page navigation example">
     <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
     </ul> -->

  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>

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