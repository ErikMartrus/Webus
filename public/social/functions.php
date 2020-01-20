<?php // Example 26-1: functions.php
$dbhost  = 'localhost';    // Unlikely to require changing
$dbname  = 'laboratorio';   // Modify these...
$dbuser  = 'root';   // ...variables according
$dbpass  = '';   // ...to your installation
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


if ($connection->connect_error) die("Fatal Error");

function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    return $result;
}
function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
        $var = stripslashes($var);
    return $connection->real_escape_string($var);
}
function showProfile($user){
    $result = "SELECT * FROM profiles WHERE user='$user'";
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
    }
    else echo "<p>Nothing to see here, yet</p><br>";
}

function _userExist($userID, $nombreGrupo){
    echo "<script>console.log('Entro') </script>";
    $sqlGrupo = "SELECT * FROM grupos WHERE nombre_grupo = '$nombreGrupo' AND id_usuario = '$userID'";
    $result=queryMysql($sqlGrupo);
    if(mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $usuariobdd=$row['id_usuario'];

       
        echo "<script>console.log('$usuariobdd') </script>";
        echo "<script>console.log('$userID') </script>";

        if ($usuariobdd == $userID) {
            echo "<script>console.log('Match') </script>";
            return true;
        } else {
            echo "<script>console.log('no Match') </script>";
            return false;
        }
        
    }
}

function _groupExist($nombreGrupo) {
    $sqlGrupo = "SELECT nombre_grupo FROM grupos WHERE nombre_grupo = '$nombreGrupo'";
    $result=queryMysql($sqlGrupo);
    if(mysqli_num_rows($result)) {
       
        $row = mysqli_fetch_assoc($result);
        foreach ($row as $key => $value) {
            if ($value == $nombreGrupo) {
                return true;
            } else {
                return false;
            }
        }
    }

}

function addUserTo($userID, $nombreGrupo) {
    $currentUser = $_SESSION['user']['id'];
    $sqlAddUserGroup = "INSERT INTO grupos(nombre_grupo, id_usuario, id_admin) 
    VALUES ('$nombreGrupo','$userID','$currentUser')";
    $resultado = queryMysql($sqlAddUserGroup);
    
}

function createGroupAndAddUser($nombreGrupo, $userID) {
    $currentUser = $_SESSION['user']['id'];
    $sqlCreateGroup = "INSERT INTO grupos(nombre_grupo, id_usuario, id_admin) 
    VALUES ('$nombreGrupo','$userID','$currentUser')";
    $resultado = queryMysql($sqlCreateGroup);
}
?>