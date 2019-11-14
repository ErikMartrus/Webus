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
    <title>Contactos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/misEstilos.css">
</head>

<body>
    <!-- 10% -->
    <header>
        <nav class="cabecera navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php"><img src="https://picsum.photos/120/38" alt=""
                    style="object-fit: cover"></a>
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
                <?php
                    if(isset($_SESSION["user"])){     
          $nombreUsuario = $_SESSION["user"]["nombre"]; 
       
                ?>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="FormularioLogin.php"><?php echo $nombreUsuario?><span class="sr-only">(current)</span></a>
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
            <article class="articuloContacto">
                <header>
                    <hgroup>
                        <h1>Contacto</h1>
                        <h2>Directorio Telefónico</h2>
                        <a href="http://www2.ulpgc.es/index.php?pagina=directorio&amp;ver=inicio">Directorio telefónico
                            de
                            la ULPGC</a> (incluye buscador de personas)
                        <h3>Campus Virtual y Telecomunicación</h3>
                        <p class="entradaPost">Soporte telefónico: (+34) 928 459 596</p>
                        <p class="entradaPost">Correo Campus Virtual: <a
                                href="mailto:campusvirtual@ulpgc.es">campusvirtual@ulpgc.es</a></p>
                        <h4>Informacion de la Sede Institucional</h4>
                        <p class="entradaPost">Dirección: Juan de Quesada, 30</p>
                        <p class="entradaPost">35001 Las Palmas de Gran Canaria,España</p>
                        <p class="entradaPost"><a
                                href="https://www.google.es/maps/preview#!data=!1m8!1m3!1d3!2d-15.420134!3d28.099363!2m2!1f149.7!2f90.85!4f90!2m7!1e1!2m2!1shF91uS97u-XIfM7qXfJ1MQ!2e0!5m2!1shF91uS97u-XIfM7qXfJ1MQ!2e0&amp;fid=5">Ver
                                en Google Maps</a></p>
                        <h5>Servicio de información al estudiante</h5>
                        <p class="entradaPost"><strong>E-mail:</strong> sie@ulpgc.es</p>
                        <p class="entradaPost"><strong>Tlf: </strong>(+34) 928 451 075</p>
                        <p class="entradaPost"><strong><a href="https://web.whatsapp.com/send?phone=+34660599038"><img
                                        alt="Acceso por WhatsApp" src="assets/img/WA.png"
                                        style="width: 25px; height: 25px; float: left;"></a> </strong>(+34) <span><b>622
                                    78
                                    9393</b></span></p>
                        <p class="entradaPost"><strong><a
                                    href="mailto:universidad@ulpgc.es">universidad@ulpgc.es</a></strong>

                                    <!-- Prueba -->
                    </hgroup>
                </header>
            </article>
        </section>

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
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

</html>