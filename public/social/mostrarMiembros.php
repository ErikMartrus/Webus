<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";

$connection = mysqli_connect($host, $user, $databasePassword, $database);

// 2. Managing errors

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// 3. Cogemos ID usuario logeado

$idUsuarioLogeado = $_SESSION["user"]["id"];

// 4. Cogemos todos los usuarios menos el logeado 

$sqlUsuarios = "SELECT * FROM users WHERE id != '$idUsuarioLogeado'";

$nombreUsuario = "";
$idUsuario = "";

// 5. Realizamos la conexión entre los usuarios (SI ANTERIORMENTE SE HA PRESIONADO UN BOTÓN DE SEGUIR O DEJAR DE SEGUIR)

// 5.1 Si se ha presionado en SEGUIR 
if (isset($_GET["add"])) {
    $idUsuarioASeguir = $_GET["add"];

    // 5.2 Comprobamos primero que la conexión ya no está hecha
    $sqlSeguir = "SELECT * FROM amigos WHERE id_usuario = '$idUsuarioLogeado' AND id_amigo = '$idUsuarioASeguir'";
    $resultSeguir = mysqli_query($connection, $sqlSeguir);
    $tSeguir = mysqli_num_rows($resultSeguir);

    // Si no existe la conexión, la establecemos
    if ($tSeguir == 0) {
        $sqlSeguir = "INSERT INTO amigos (id_usuario, id_amigo) VALUES ('$idUsuarioLogeado', '$idUsuarioASeguir')";
        mysqli_query($connection, $sqlSeguir);
    }

} 
// 5.2 Si se ha presionado en DEJAR DE SEGUIR 
elseif (isset($_GET["remove"])) {
    $idUsuarioADejarDeSeguir = $_GET["remove"];

    $sqlBorrar = "DELETE FROM amigos WHERE id_usuario = '$idUsuarioLogeado' AND id_amigo = '$idUsuarioADejarDeSeguir'";
    mysqli_query($connection, $sqlBorrar);
}

// Finalmente mostramos la relación entre los usuarios
if ($result = mysqli_query($connection, $sqlUsuarios)) {
    while ($row = mysqli_fetch_array($result)) {
        $nombreUsuario = $row["nombre"];
        $idUsuario = $row["id"];

        // Comprobamos la relación del usuario logeado con el de la base de datos
        $sqlAmigo = "SELECT * FROM amigos WHERE id_usuario = $idUsuario AND id_amigo = $idUsuarioLogeado";
        $result2 = mysqli_query($connection, $sqlAmigo);
        $t1 = mysqli_num_rows($result2);


        // Si existe t2 --> El usuario logeado sigue al otro
        $sqlAmigo = "SELECT * FROM amigos WHERE id_usuario = $idUsuarioLogeado AND id_amigo = $idUsuario";
        $result2 = mysqli_query($connection, $sqlAmigo);
        $t2 = mysqli_num_rows($result2);

        // Caso 1. Se siguen mutuamente
        if (($t1 + $t2) > 1) {
            echo "<p>$nombreUsuario y tú os seguís mutuamente ";
        } 
        // Caso 2. Usuario logeado sigue al otro
        elseif ($t1) {
            echo "<p>$nombreUsuario te sigue ";
        } 
        // Caso 3. El otro usuario le sigue
        elseif ($t2) {
            echo "<p>Estás siguiendo a $nombreUsuario ";
        } 
        // Caso 4. No se siguen mutuamente
        else {
            echo "<p>$nombreUsuario y tú no os estáis siguiendo ";
        }

        // Si el usuario logeado no sigue al otro usuario
        if (!$t2) {
            echo "<a href='miembros.php?add=" . $idUsuario . "'>Seguir</a></p>";
        } 
        // Si ya lo sigue
        else {
            echo "<a href='miembros.php?remove=" . $idUsuario . "'>Dejar de seguir</a></p>";
        }
    }
}

mysqli_close($connection);
