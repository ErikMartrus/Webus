<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

if(isset($_SESSION["user"])){
$idUsuarioLogeado = $_SESSION["user"]["id"];

$sqlUsuarioLogeado = "SELECT * FROM grupos WHERE id_usuario = '$idUsuarioLogeado'";

$nombreEmisor = "";

if ($result1 = mysqli_query($connection, $sqlUsuarioLogeado)) {
    if ($row1 = mysqli_fetch_assoc($result1)) {
        $nombreGrupo = $row1['nombre_grupo'];
        $idGrupo = $row1['id'];
    }
}


// MENSAJES ENVIADOS

$sqlMensajes = "SELECT * FROM mensajesgrupos WHERE id_grupos = '$idGrupo'";

echo "<h3> Mensajes enviados al Grupo </h3>";

if ($result = mysqli_query($connection, $sqlMensajes)) {
    while ($row = mysqli_fetch_array($result)) {
        $senderID = $row['sender'];
        $privado = $row['privado'];
        $fechaMensaje = $row['fecha'];
        $mensaje = $row['message'];

        $sqlUser = "SELECT * FROM users WHERE id='$senderID'";

        if ($result2 = mysqli_query($connection, $sqlUser)) {
            if ($row2 = mysqli_fetch_assoc($result2)) {
                $nombreEmisor = $row2['nombre'];

                echo "<p>
                <b>Mensaje Enviado a Grupo :</b> $nombreGrupo.
                <b>Mensaje:</b> $mensaje. 
                <b>Emisor:</b> $nombreEmisor.
                <b>Fecha:</b> $fechaMensaje.";

                if ($privado == 1) {
                    echo "<b> Privado </b>";
                }

                echo "</p>";
            }
        }
    }
}



mysqli_close($connection);
}else{
    echo "Ha de estar logueado primero";
}
