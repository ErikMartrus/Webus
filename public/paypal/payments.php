<?php
session_start();

// ANTES DE NADA COMPROBAMOS QUE EXISTA UN USUARIO LOGEADO

if (!isset($_SESSION["user"])) {
    header('Location: ../carrito.php');
    $_SESSION["errorLogeadoTienda"] = 1;
    exit;
}

// DESPUÉS COMPROBAMOS QUE EL CARRITO NO ESTÉ VACÍO

if (!isset($_SESSION["carrito"])) {
    header('Location: ../carrito.php');
    $_SESSION["errorCarritoVacio"] = 1;
    exit;
}

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.

$enableSandbox = true;

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'name' => 'laboratorio'
];

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'email' => 'sb-trsds802190@business.example.com',
    'return_url' => 'http://localhost/paypal/payments.php',
    'cancel_url' => 'http://localhost/paypal/carrito.php',
    'notify_url' => 'http://localhost/paypal/payments.php' // PARA IPN SOLO
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// CONTAMOS EL TOTAL AÑADIDO AL CARRITO

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";

$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
}

// Product being purchased.
$itemName = "Compra Web Erik MyIOT";
$itemAmount = $precioTotal;

// Include Functions
require 'functions.php';

// Check if paypal request or response

if (!empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])) {
    // Get transaction information from URL

    $data = [
        'tx' => $_GET['tx'],
        'amt' => $_GET['amt'],
        'cc' => $_GET['cc'],
        'st' => $_GET['st'],
        'fecha' => date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]),
        'userID' => $_SESSION["user"]
    ];

    addPaymentToDatabse($data);

} else {

// Grab the post data so that we can set up the query string for PayPal.
// Ideally we'd use a whitelist here to check nothing is being injected into
// our post data.
    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = stripslashes($value);
    }

// Set the PayPal account.
    $data['business'] = $paypalConfig['email'];

// Set the PayPal return addresses.
    $data['return'] = stripslashes($paypalConfig['return_url']);
    $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
    $data['notify_url'] = stripslashes($paypalConfig['notify_url']);

// Set the details about the product being purchased, including the amount
// and currency so that these aren't overridden by the form data.
    $data['item_name'] = $itemName;
    $data['amount'] = $itemAmount;
    $data['currency_code'] = 'EUR';

// Add any custom fields for the query string.
//$data['custom'] = USERID;

// Build the query string from the data.
    $queryString = http_build_query($data);

// Redirect to paypal IPN
    header('location:' . $paypalUrl . '?' . $queryString);
    exit();
}
