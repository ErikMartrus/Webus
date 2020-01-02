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
$orders = $app->getAllOrders();
$transaccion = $app->getAllTransferencias();
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
                Orders
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8" >
            <?php
            if (isset($message) && $message != "") {
                echo '<div class="alert alert-success"><strong>Success: </strong> ' . $message . '</div>';
            }
            ?>
            <?php if (isset($_GET["orden_id"])) {
                $id = $_GET["orden_id"];
                $sql = "SELECT * FROM factura WHERE orden_id='$id'";
                if ($result = mysqli_query($con, $sql)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $transaccion_id = $row["id"];
                            ?>
                            <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php echo "Orden id: " . $id; ?>
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
                              <?php  foreach ($app->getOrderItems($id) as $orden) { ?>
                            <tr>
                                <td>
                                    <?php echo $orden['nombre']; ?>
                                </td>
                                <td>
                                    <?php echo $orden['precio']; ?>
                                </td>
                                <td>
                                    <?php echo "USD"; ?>
                                </td>
                                <td>
                                    <?php echo $orden['cantidad']; ?>
                                </td>

                            </tr>
                        <?php } ?>
                        </table>
                        <h4>
                            Total = <?php foreach ($orders as $order) {
                                if ($order["id"] == $id) {
                                    echo $order["total"] . " USD";
                                }
                            }
                            ?>
                        </h4>
                        <a href="AdminTransacciones.php?transaccion_id=<?php echo $transaccion_id ?>">
                            <button class="btn btn-primary">Ver Transaccion</button>
                        </a>
                        </div>
                        </div>
                    <?php }
                }
            } else { ?>
                <?php if (count($orders) > 0) {
                    foreach ($orders as $order) {
                        $id=$order["id"];
                        $sql = "SELECT * FROM factura WHERE orden_id='$id'";
                        if ($result = mysqli_query($con, $sql)) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $transaccion_id = $row["id"];
                                ?>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <?php echo "Orden " . $order['id'] . " --Order @" . $order['fecha'] ?>
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
                                            <?php foreach ($app->getOrderItems($order['id']) as $item) { ?>
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
                                        <a href="AdminTransacciones.php?transaccion_id=<?php echo $transaccion_id ?>">
                                            <button class="btn btn-primary">Ver Transaccion</button>
                                        </a>
                                    </div>
                                </div>

                            <?php }
                        }
                    }
                } else { ?>
                    <p>
                        You don't have any orders yet, visit <a href="products.php">Products</a> to order.
                    </p>
                <?php }
            } ?>

        </div>
    </div>
</div>

</body>
</html>