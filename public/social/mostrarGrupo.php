<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

$sqlUsuariosGrupos = "SELECT * FROM grupos";

if ($result = mysqli_query($connection, $sqlUsuariosGrupos)) {
    while ($row = mysqli_fetch_array($result)) {
        $idUsuarioParticipantes = $row["id_usuario"];
        $nombreGrupo = $row["nombre_grupo"];
        

        $sqlUsuarioAmigo = "SELECT * FROM users WHERE id = '$idUsuarioParticipantes'";

        if ($result2 = mysqli_query($connection, $sqlUsuarioAmigo)) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $nombreUsuario = $row2["nombre"];
                $correoUsuario = $row2["email"];
                echo "<p> <b> Nombre del grupo: </b> $nombreGrupo
                <b> Nombre: </b> $nombreUsuario 
                <b> Correo Electrónico: $correoUsuario</b> 
                </p>";        
            }
        }
    }
}
mysqli_close($connection);
