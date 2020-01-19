<?php
$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}
$nombreGrupo = "nombreGrupo";
$amigoGrupo = "miembrosGrupo";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$nombreGrupo]) && isset($_POST[$amigoGrupo])
    ) {
        $nombreGrupo = $_POST['nombreGrupo'];
        $amigoGrupo = $_POST['miembrosGrupo'];
        //$idUsuarioLogeado = $_SESSION["user"]["id"];
        //$nombreUsuarioLogeado= $_SESSION["user"]["nombre"];
// Mostramos los usuarios que siguen al usuario

    echo "<h4> Grupo formados: </h4>";
    $sqlUsuarioGrupo = "INSERT INTO grupos(nombre_grupo, id_usuario) VALUES ('$nombreGrupo','$amigoGrupo')";
    if ($result = mysqli_query($connection, $sqlUsuarioGrupo)) {
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<p>
                <h3>El grupo '$nombreGrupo' esta formado por : </h3> 
                <b> $nombreUsuarioLogeado</b> 
                <b> $amigoGrupo</b>
                </p>";  
        }
    }
    mysqli_close($connection);
    }else {
        echo "<h2> No existen grupos formados aún </h2>";
    }

} 