<?php
require __DIR__ . '/lib/PayPalDemo.php';
if (empty($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}
if (!empty($_GET['payment_id']) && !empty($_GET['payer_id']) && !empty($_GET['token'])) {
    $app = new PayPalDemo();
    $user = $app->getUserDetails($_SESSION['user']);
    $payment_id = $_GET['payment_id'];
    $payer_id = $_GET['payer_id'];
    $token = $_GET['token'];
    $payer_email= $_GET['payer_email'];
    if ($app->paypal_check_payment($payment_id, $payer_id, $token, $user['id'],$payer_email)) {
        header("Location: my-orders.php?status=true");
        exit;
    } else {
        header('Location: shopping-cart.php?status=false');
        exit;
    }
} else {
    header('Location: products.php');
    exit;
}
?>