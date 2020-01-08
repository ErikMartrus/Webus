<?php
session_start();
$nombrePerfil = "nombreUsuario";
$emailPerfil = "emailUsuario";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$nombrePerfil]) && isset($_POST[$emailPerfil])
    ) {

        $name = $_POST[$nombrePerfil];
        $email = $_POST[$emailPerfil];

        function saveInformationToDatabase($name, $email)
        {

            $host = "localhost";
            $database = "laboratorio";
            $user = "root";
            $databasePassword = "";

        
            $connection = mysqli_connect($host, $user, $databasePassword, $database);

           

           
            if (mysqli_connect_errno()) {
                die(mysqli_connect_error());
            }

            

            $sqlUser = "SELECT * FROM users WHERE email='" . $_SESSION["user"] . "'";
            $userID = 0;
            if ($result = mysqli_query($connection, $sqlUser)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    $userID = $row["id"];
                }
            }


            $sql = "UPDATE users SET nombre = '$name', email = '$email' WHERE id_user = '$userID'";

            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
                header('Location: social.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

            mysqli_close($connection);
        }

      
        saveInformationToDatabase($name, $email);
    }
}
?>