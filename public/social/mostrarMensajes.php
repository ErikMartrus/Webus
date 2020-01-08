<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}


$idUsuarioLogeado = $_SESSION["user"];

$sqlUsuarioLogeado = "SELECT * FROM users WHERE id = $idUsuarioLogeado";

$nombreEmisor = "";

if ($result1 = mysqli_query($connection, $sqlUsuarioLogeado)) {
    if ($row1 = mysqli_fetch_assoc($result1)) {
        $nombreEmisor = $row1["nombre"];
        $emailReceptor = $row1["email"];
    }
}


// MENSAJES ENVIADOS

$sqlMensajes = "SELECT * FROM mensajes WHERE sender = $idUsuarioLogeado";

echo "<h3> Mensajes enviados </h3>";

if ($result = mysqli_query($connection, $sqlMensajes)) {
    while ($row = mysqli_fetch_array($result)) {
        $senderID = $idUsuarioLogeado;
        $receiverID = $row["receiver"];
        $privado = $row["privado"];
        $fechaMensaje = $row["fecha"];
        $mensaje = $row["mensaje"];

        $sqlUser = "SELECT * FROM users WHERE id='$receiverID'";

        if ($result2 = mysqli_query($connection, $sqlUser)) {
            if ($row2 = mysqli_fetch_assoc($result2)) {
                $nombreReceptor = $row2["nombre"];
                $emailReceptor = $row2["email"];

                echo "<p class='parrafo-miembros-social'>
                <b>Mensaje:</b> $mensaje. 
                <b>Receptor:</b> $nombreReceptor.
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

//MENSAJES RECIBIDOS CORRECTAMENTE

echo "<h3 class='parrafo-miembros-social'> Mensajes recibidos </h3>";

$sqlMensajes = "SELECT * FROM mensajes WHERE receiver = $idUsuarioLogeado";

if ($result = mysqli_query($connection, $sqlMensajes)) {
    while ($row = mysqli_fetch_array($result)) {
        $senderID = $idUsuarioLogeado;
        $receiverID = $row["receiver"];
        $privado = $row["privado"];
        $fechaMensaje = $row["fecha"];
        $mensaje = $row["mensaje"];

        $sqlUser = "SELECT * FROM users WHERE id='$receiverID'";

        if ($result2 = mysqli_query($connection, $sqlUser)) {
            if ($row2 = mysqli_fetch_assoc($result2)) {
                $nombreReceptor = $row2["nombre"];
                $emailReceptor = $row2["email"];

                echo "<p class='parrafo-miembros-social'>
                <b>Mensaje:</b> $mensaje. 
                <b>Receptor:</b> $nombreReceptor.
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
