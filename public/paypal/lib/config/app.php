<?php
session_start();
define('HOST', 'localhost'); // Database host name ex. localhost
define('USER', 'root'); // Database user. ex. root ( if your on local server)
define('PASSWORD', ''); // Database user password  (if password is not set for user then keep it empty )
define('DATABASE', 'laboratorio'); // Database name
$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
function DB()
{
    $con = new mysqli(HOST, USER, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    return $con;
}
?>