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
?>