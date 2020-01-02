<?php
require_once 'header.php';
$servername = "localhost";
$username = "root";
$password = ""; //Dependiendo de la base de datos cambiar
$dbname = "l1_prograweb";
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$i = 1;
//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "SELECT * FROM users WHERE email='" . $_SESSION["user"] . "'";
    if ($result = mysqli_query($conn, $sql)) {
        if ($row = mysqli_fetch_array($result)) {
            $id_user = $row["id"];
            $sql = "SELECT * FROM canales WHERE id_user='$id_user'";
            if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
                    $nombreCanal = $row["nombreCanal"];
                    $descripcion = $row["descripcion"];
                    $fecha = $row["fecha"];
                    $enlace = $row["url"];
                    $id = $row["id"];
                    echo "<article id=\"canal1\">";
                    echo "<h5>Informacion sobre el canal $i</h5>";
                    echo "<p>Descripción del canal: $descripcion</p>";
                    echo "<p>Fecha de creación: $fecha</p>";
                    echo "<a href='../showChannel.php?url=$enlace'>URL: $enlace</a>";
                    echo "</article>";
                    $i++;
                }
            }
        }
    }
    $sql1 = "SELECT * FROM friends WHERE friend='" . $_SESSION["user"] . "'";
    if ($result1 = mysqli_query($conn, $sql1)) {
        while ($row1 = mysqli_fetch_array($result1)) {
            $friend = $row1["user"];
            $sql2 = "SELECT * FROM users WHERE email='$friend'";
            if ($result2 = mysqli_query($conn, $sql2)) {
                while ($row2 = mysqli_fetch_array($result2)) {
                    $nombre = $row2["nombre"];
                    $email = $row2["email"];
                    echo "<h2>Canales de $email</h2>";
                    $sql3 = "SELECT * FROM users WHERE email='$email'";
                    if ($result3 = mysqli_query($conn, $sql3)) {
                        while ($row3 = mysqli_fetch_array($result3)) {
                            $id_user = $row3["id"];
                            $sql4 = "SELECT * FROM canales WHERE id_user='$id_user'";
                            if ($result4 = mysqli_query($conn, $sql4)) {
                                while ($row4 = mysqli_fetch_array($result4)) {
                                    $nombreCanal = $row4["nombreCanal"];
                                    $descripcion = $row4["descripcion"];
                                    $fecha = $row4["fecha"];
                                    $enlace = $row4["url"];
                                    $id = $row4["id"];
                                    echo "<article id=\"canal1\">";
                                    echo "<h5>Informacion sobre el canal de $nombre</h5>";
                                    echo "<p>Descripción del canal: $descripcion</p>";
                                    echo "<p>Fecha de creación: $fecha</p>";
                                    echo "<a href='../showChannel.php?url=$enlace'>URL: $enlace</a>";
                                    echo "</article>";
                                    $i++;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    $conn->close();
}