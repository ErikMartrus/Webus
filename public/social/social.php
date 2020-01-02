<?php
session_start();
require_once 'functions.php';
$userstr = 'Welcome Guest';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
} else {
    $loggedin = FALSE;
    header('location:../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Red Social</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src ="https://code.jquery.com/jquery 3.4.1.js"></script>
    <link rel='stylesheet' href='jquery.mobile-1.4.5.min.css'>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/stylesPayPal.css">
    <script>
        function get_messages() {
            $("#messages").load("ajaxMensajes.php");
            setTimeout(get_messages, 10000);
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="cabecera">
    <div class="container-fluid">

        <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="../index.php">MyWebIoT</a>
                </li>
                <li class='nav-item' role='presentation'><a class='nav-link active' href='../frontEndUser.php'>Mis
                        Canales</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="../ayuda.php">Ayuda</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="../contacto.php">Contacto</a>
                </li>
                <li class='nav-item' role='presentation'><a class='nav-link active' href='../paypal/products.php'>Productos</a>
                </li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="../atencionCliente.php">Atención
                        al cliente</a></li>

            </ul>
            <ul class="nav navbar-nav">
                <li class='nav-item' role='presentation'><a class='nav-link active' href='social.php'>Social</a></li>
                <li class='nav-item' role='presentation'><a class='nav-link active' href='../scripts/logout.php'>Log
                        Out</a></li>


            </ul>
        </div>
    </div>
</nav>

<?php if($loggedin){?>
<div class="container">
    <div class="row"></div>
    <div class="row">
        <div class="col-5 col-lg-3 d-flex flex-column justify-content-between px-0" id="header">
            <nav class="navbar navbar-expand-lg navbar-light d-flex flex-column px-0">
                <div id="m-navbar-brand" class="text-center"
                     style="border: solid #505e6c; border-radius: 10px;height: 180px; width: 240px;padding: 10px">
                    <img src="<?php echo $user;?>.jpg" alt="" class="rounded-circle img-fluid mx-auto mb-3">
                    <h2 class="h5"> <?php echo $user; ?></h2>
                    <h3 class="h5"> <?php echo showProfile($user); ?></h3>


                </div>

            </nav>
        </div>
        <div class="col flex-wrap">
            <a href="members.php">
                <button class="btn btn-outline-dark btn-block d-block" type="button">Miembros</button>
            </a>
            <a href="friends.php">
                <button class="btn btn-outline-dark btn-block d-block" type="button">Amigos</button>
            </a>
            <a href="messages.php">
                <button class="btn btn-outline-dark btn-block" type="button">Mensajes</button>
            </a>
            <a href="canales.php">
                <button
                        class="btn btn-outline-dark btn-block" type="button">Canales
                </button>
            </a>
            <a href="profile.php">
                <button class="btn btn-outline-dark btn-block" type="button">Perfil</button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div id="muro">
                <h1>Muro de MyWebIoT</h1>

                <div id="messages"></div>


            </div>
        </div>
    </div>
</div>
 <?php }?>
<script>
setTimeout(get_messages, 1000);
</script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
<script src="../assets/js/vertical-navbar-with-menu-and-social-menu.js"></script>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>