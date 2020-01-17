<?php
session_start();
if (!isset($_SESSION["user"])) {
    echo '<script>
        alert("Es necesario que este logeado para poder realizar la compra");
        window.history.go(-1);
        </script>';
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
	'email' => 'sb-uxix2804584@business.example.com',
	'return_url' => 'http://193.145.145.25/paypal/paymentsSuccesfull.php',
    'cancel_url' => 'http://193.145.145.25/paypal/carrito.php',
    'notify_url' => 'http://193.145.145.25/paypal/payments.php' // PARA IPN SOLO
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
$itemName = "Compra Web Erik MyIOT";
$precioTotal = $_POST["precioTotal"];
$itemAmount = $precioTotal;

// Include Functions
require 'functions.php';

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {

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
}else{

}

