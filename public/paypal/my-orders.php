<?php
require __DIR__ . '/lib/PayPalDemo.php';
if (empty($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}
$app = new PayPalDemo();
if (isset($_GET['status']) && $_GET['status'] == TRUE) {
    $message = 'Your payment transaction has been successfully completed.';
}
$user = $app->getUserDetails($_SESSION['user']);
$orders = $app->getOrders($user['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/stylesPayPal.css">

</head>
<body>
<?php require 'navigation.php'; ?>

<div class="container">


    <div class="row">
        <div class="col-md-12">
            <h2>
                My Orders
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">

            <?php
            if (isset($message) && $message != "") {
                echo '<div class="alert alert-success"><strong>Success: </strong> ' . $message . '</div>';
            }
            ?>

            <?php if (count($orders) > 0) {
                foreach ($orders as $order){
                    ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Order @ <?php echo $order['fecha'] ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                    <th>Cantidad</th>
                                </tr>
                                <?php foreach ($app->getOrderItems($order['id']) as $item){?>
                                    <tr>
                                        <td>
                                            <?php echo $item['nombre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $item['precio']; ?>
                                        </td>
                                        <td>
                                            <?php echo "USD"; ?>
                                        </td>
                                        <td>
                                            <?php echo $item['cantidad']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <h4>
                                Total: <?php echo $order['total']; ?> USD
                            </h4>
                        </div>
                    </div>

                <?php }
            }else{ ?>
                <p>
                    You don't have any orders yet, visit <a href="products.php">Products</a> to order.
                </p>
            <?php }?>

        </div>
    </div>
</div>

</body>
</html>