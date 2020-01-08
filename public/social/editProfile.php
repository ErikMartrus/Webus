<?php
session_start();
$nombrePerfil = "nombreUsuario";
$informacionPerfil = "informacionUsuario";
$foto =  "foto";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$nombrePerfil]) && isset($_POST[$informacionPerfil])
    ) {

        $name = $_POST[$nombrePerfil];
        $info = $_POST[$informacionPerfil];
        $foto =  $_POST[$foto];

        function saveInformationToDatabase($name, $info, $foto)
        {

            $host = "localhost";
            $database = "laboratorio";
            $user = "root";
            $databasePassword = "";

        
            $connection = mysqli_connect($host, $user, $databasePassword, $database);

           

           
            if (mysqli_connect_errno()) {
                die(mysqli_connect_error());
            }

            $email=$_SESSION["user"]["email"];

            $sqlUser = "SELECT * FROM users WHERE email='$email'";
            $userID = 0;
            if ($result = mysqli_query($connection, $sqlUser)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    $userID = $row['id'];
                }
            }


            $sql = "UPDATE profiles SET nombre = '$name', texto = '$info', image ='$foto' WHERE id_user = '$userID'";

            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
                header('Location: social.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

            mysqli_close($connection);
        }

      
        saveInformationToDatabase($name, $info, $foto);
    }
}
?>