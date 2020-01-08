<?php

session_start();

$destinatarioIDInput = "destinatario";
$messageIDInput = "mensaje";
$privadoIDInput = "privado";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$destinatarioIDInput]) &&
        isset($_POST[$messageIDInput])
    ) {

        $emisor = $_SESSION["user"]["id"];
        $destinatario = $_POST[$destinatarioIDInput];
        $destinatarios = explode('|', $destinatario);
        $destinatario1= $result_explode[0];
        $destinatario2= $result_explode[1];;
        $message = $_POST[$messageIDInput];
        $fechaMensaje = date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]);

        // Privado marcado
        if (isset($_POST[$privadoIDInput])) {
            $privado = 1;
        }

        // Privado NO marcado
        else {
            $privado = 0;
        }

        echo "Emisor: $emisor <br>";
        echo "Destinatarios: $destinatario1 + $destinatario2 <br>";
        echo "Mensaje: $message <br>";
        echo "Privado: $privado <br>";
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

        $sql = "INSERT INTO mensajes (sender, receiver, privado, fecha, message)
                VALUES ('$emisor', '$destinatario1', '$privado', '$fechaMensaje', '$message')
                VALUES ('$emisor', '$destinatario2', '$privado', '$fechaMensaje', '$message')";

        if (mysqli_query($connection, $sql)) {
            echo "New record created successfully";
            header('Location: ../mensajes.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}
