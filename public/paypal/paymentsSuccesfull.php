<?php
session_start();

// Database settings. Change these for your database configuration.
$dbConfig = [
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'name' => 'laboratorio'
];

// Include Functions
require 'functions.php';

	$data = [
        'tx' => $_GET['tx'],
        'amt' => $_GET['amt'],
        'cc' => $_GET['cc'],
        'st' => $_GET['st'],
        'fecha' => date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]),
        'userID' => $_SESSION["user"]["id"]
    ];
    addPaymentToDatabse($data);
    
?>