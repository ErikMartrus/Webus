<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// Cogemos el id del usuario
if(isset($_SESSION["user"])){
$idUsuarioLogeado = $_SESSION["user"]["id"];
$nombreUsuarioLogeado= $_SESSION["user"]["nombre"];

$nombreUsuario = "";
$idUsuario = "";

// Mostramos los usuarios que siguen al usuario

echo "<h4> Grupo formados </h4>";

$sqlUsuariosSeguidos = "SELECT * FROM amigos WHERE id_usuario = '$idUsuarioLogeado'";

if ($result = mysqli_query($connection, $sqlUsuariosSeguidos)) {
    while ($row = mysqli_fetch_array($result)) {
        $idUsuarioSeguido = $row['id_amigo'];

        $sqlUsuarioAmigo = "SELECT * FROM users WHERE id = '$idUsuarioSeguido'";

        if ($result2 = mysqli_query($connection, $sqlUsuarioAmigo)) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $nombreUsuario = $row2['nombre'];
                $correoUsuario = $row2['email'];
                $idAmigo = $row2['id'];

            $sqlUsuarioGrupo = "INSERT INTO grupos(id_miembros) VALUES ('$idAmigo')";
            if ($result = mysqli_query($connection, $sqlUsuarioGrupo)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>
                        <h3>El grupo esta formado por : </h3> 
                        <b> $nombreUsuarioLogeado</b> 
                        <b> $nombreUsuario</b>
                        </p>";  
                }
            }
        }

        }
    }
}



mysqli_close($connection);
}else{
    echo "Ha de loguearse primero";
}
