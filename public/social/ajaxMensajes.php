<?php
$servername = "localhost";
$username = "root";
$password = ""; //Dependiendo de la base de datos cambiar
$dbname = "l1_prograweb";
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    $sql = "Select * FROM messages WHERE pm = 0 ORDER BY id DESC LIMIT 5";
    if($result = mysqli_query($conn,$sql)){
        while($row =mysqli_fetch_array($result)){
            $auth = $row["auth"];
            $recip = $row["recip"];
            $message = $row["message"];
            echo "<div>
                <img src='1.png' style='display: inline; height: 20px; width: 20px;'";
            if($auth==$recip){
                echo "
                <h5 style='display: inline;margin-left: 15px'>  $auth</h5>
                <p>$message</p>
                </div>";
            }
            else {
                echo "
                <h5 style='display: inline;margin-left: 15px'>  $auth ---> $recip</h5>
                <p>$message</p>
                </div>";
            }
        }
    }
    $conn->close();
}