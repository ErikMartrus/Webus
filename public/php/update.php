<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['dato'])&&isset($_POST['url'])){
            $dato = $_POST['dato'];
            $url = $_POST['url'];

            $hoy = date("Y-m-d H:i:s");

            //conectarnos a la BD
            $host = "localhost";
            $database = "l1_pweb";
            $user = "root";
            $pass = "";

            $connection = mysqli_connect($host,$user,$pass, $database);

            //comprobar error
            if(mysqli_connect_errno()){
                echo "ERROR";
                die(mysqli_connect_error()); //die == exit)
            }

            //petición url para el canal
            $sql = "SELECT * from canales WHERE url = '$url'";

            echo $sql;

            if($result = mysqli_query($connection, $sql)){
                if(mysqli_num_rows($result)){
                    $row = mysqli_fetch_assoc($result);
                    $idCanal = $row['id'];
                }else{
                    echo "Canal inválido";
                }
            }else{
                echo mysqli_error($connection);
            }

            //petición sql para el sensor
            $sql = "INSERT INTO datossensores (id_canal, dato, fecha)
            VALUES ('$idCanal', '$dato', '$hoy')";

            if(mysqli_query($connection, $sql)){
                echo "Correcto";
            }else{
                echo mysqli_error($connection);
            }









        }
    }
?>