<?php

session_start();

include('functions.php');

$destinatarioIDInput = "destinatarioGrupo";
$messageIDInput = "mensaje";

consoleLog("esto está vacio: ".$_POST['destinatarioGrupo']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$destinatarioIDInput]) &&
        isset($_POST[$messageIDInput])
    ) {

        $emisor = $_SESSION["user"]["id"];
        $destinatario = $_POST[$destinatarioIDInput];
        $message = $_POST[$messageIDInput];
        $fechaMensaje = date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]);

        

        echo "Emisor: $emisor <br>";
        echo "Mensaje enviado a Grupo: $destinatario <br>";
        echo "Mensaje: $message <br>";
        echo "Fecha mensaje: $fechaMensaje <br>";

        // Guardar mensaje en la base de datos

        $host = "localhost";
        $database = "laboratorio";
        $user = "root";
        $databasePassword = "";

        // 1 Stablishing connection to Database
        $connection = mysqli_connect($host, $user, $databasePassword, $database);

        // 2. Managing errors

        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }

        // 4. Checking if the table is created

        $sql = "INSERT INTO mensajesgrupos (id_grupos, sender, fecha, mensaje)
                VALUES ('$destinatario', '$emisor', '$fechaMensaje', '$message')";

        if (mysqli_query($connection, $sql)) {
            echo "New record created successfully";
            header('Location: grupo.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}
