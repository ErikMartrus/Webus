<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);



if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}


$sqlNombreAmigo = "SELECT * FROM mensajes WHERE privado = 0 ORDER BY fecha DESC LIMIT 5";

if ($result4 = mysqli_query($connection, $sqlNombreAmigo)) {
    while ($row4 = mysqli_fetch_array($result4)) {
        $mensaje = $row4["mensaje"];
        $idEmisor = $row4["sender"];
        $idReceptor = $row4["receiver"];
        $fechaMensaje = $row4["fecha"];

        $sqlEmisor = "SELECT * FROM users WHERE id = $idEmisor";

        $nombreEmisor = "";
        if ($result2 = mysqli_query($connection, $sqlEmisor)) {
            if ($row2 = mysqli_fetch_assoc($result2)) {
                $nombreEmisor = $row2["nombre"];
            }
        }

        $sqlReceptor = "SELECT * FROM users WHERE id = $idReceptor";

        $nombreReceptor = "";
        if ($result3 = mysqli_query($connection, $sqlReceptor)) {
            if ($row3 = mysqli_fetch_assoc($result3)) {
                $nombreReceptor = $row3["nombre"];
            }
        }

        echo "<p class='parrafo-miembros-social'>
                <b>Mensaje:</b> $mensaje. 
                <b>Receptor:</b> $nombreReceptor.
                <b>Emisor:</b> $nombreEmisor.
                <b>Fecha:</b> $fechaMensaje. 
                </p>";
    }
}

mysqli_close($connection);